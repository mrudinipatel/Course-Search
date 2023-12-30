<?php
// https://shareurcodes.com/blog/creating%20a%20simple%20rest%20api%20in%20php
// Class for controlling the requests.
class CourseController
{
    public function __construct(private CourseGateway $gateway)
    {
    }

    // Process singular course requests 
    public function processCourseRequest(string $method, ?string $course_id, ?string $prereq_only, ?string $course_name, ?string $subject)
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        // defend from sql injection
        if (!$this->sqlInjectionCheck([$method, $course_id, $course_name, $subject])) {
            $this->returnErrorMessage("Unsecure input.", 400);
            return;
        }

        switch($method) {
            case "GET":
                // Return all course information for the given course ID
                // if no course id was provided in url params
                if (!$course_id && !$course_name && !$subject) {
                    $this->returnErrorMessage("Please provide a course ID, course name, or subject.", 400);
                    return;
                }

                if ($course_name) {
                    $this->handleCourseName($course_name, $prereq_only);
                }
                else if ($subject) {
                    $this->processSubject($subject);
                }
                else {
                    $this->handleCourseId($course_id, $prereq_only);
                }
                break;
            case "PUT":
                // make sure we actually have the info we need
                if (empty($data["course_id"]) || empty($data["update"])) {
                    $this->returnErrorMessage("Please provide the course_id and what you would like to update in 'update'.", 400);
                    return;
                }

                if (!$this->checkAuth()) return;

                $arr = [
                    $data["course_id"] ?? null,
                    $data["update"]["course_name"] ?? null,
                    $data["update"]["description"] ?? null,
                    $data["update"]["credit"] ?? null
                ];

                if (!$this->sqlInjectionCheck($arr)) {
                    $this->returnErrorMessage("Potential SQL injection detected.", 400);
                    return;
                }

                http_response_code(200);
                echo json_encode($this->gateway->updateCourse($data));
                break;
            case "POST":
                $course_id = $data["course_id"] ?? null;
                $name = $data["course_name"] ?? null;
                $credit = $data["credit"] ?? null;
                $semester = $data["semesters"] ?? null;
                $data["description"] = $data["description"] ?? null;
                $data["department"] = $data["department"] ?? null;
                $data["prerequisites"] = $data["prerequisites"] ?? null;
                $data["restrictions"] = $data["restrictions"] ?? null;
                $data["equate"] = $data["equate"] ?? null;

                if (!$course_id || !$name || !$credit || !$semester) {
                    $this->returnErrorMessage("Please provide the required parameters: course_id, course_name, credit and semesters.", 400);
                    return;
                }

                if (!$this->checkAuth()) return;

                $rows = $this->gateway->createCourse($data);

                http_response_code(201);
                echo json_encode([
                    "message" => "Course created",
                    "added_rows" => $rows,
                    "success" => true
                ]);
                break;
            case "DELETE":
                $course_id = $data["course_id"] ?? null;

                if (!$course_id) {
                    $this->returnErrorMessage("Please provide a course ID.", 400);
                    return;
                }
    
                if (!$this->checkAuth()) return;

                //Call this method from the gateway that deletes the course that has the course_id from the database (deletes it from prereq and offering databases too.)
                $rows = $this->gateway->deleteCourse($course_id);
    
                if ($rows["course_rows"] == 0) {
                    echo json_encode([
                        "message" => "Course not found",
                        "rows" => $rows,
                        "success" => false
                    ]);
                } else {
                    echo json_encode([
                        "message" => "Course $course_id deleted.",
                        "rows" => $rows,
                        "success" => true
                    ]);
                }
                break;
            default:
                http_response_code(405);
                header("Allow: GET, PUT, POST, DELETE");
                break;
        }
    }

    // separate subject search out
    private function processSubject(string $subject)
    {
        if (!empty($subject)) {
            if (!($this->sqlInjectionCheck([$subject])) || (!preg_match('/^[A-Za-z]+$/', $subject))) {
                $this->returnErrorMessage("Invalid subject.", 400);
                return;
            }
            echo json_encode($this->gateway->getCoursesBySubject($subject));
        }
    }

    // helper for getting list of courses by name
    private function handleCourseName(string $course_name, ?string $prereq_only) {
        $is_prereq_only = false;
        if($prereq_only) $is_prereq_only = strtoupper($prereq_only) === "TRUE";
        echo json_encode($this->gateway->getCourseByName($course_name, $is_prereq_only));
    }

    // helper for getting list of courses by id
    private function handleCourseId(string $course_id, ?string $prereq_only) {
        $is_prereq_only = false;
        if($prereq_only) $is_prereq_only = strtoupper($prereq_only) === "TRUE";

        $errors = $this->getCourseIdValidation($course_id);
        if ($errors) {
            $this->returnErrorMessage(json_encode($errors), 400);
            return;
        }

        echo json_encode($this->gateway->getCourse(strtoupper($course_id), $is_prereq_only));
    }

    //Process course requests with provided prerequisites
    public function processAvailableRequest(string $method, ?string $taken, ?string $sem)
    {
        if ($method != "GET") {
            http_response_code(405);
            header("Allow: GET");
            return;
        }
        
        if (!$this->sqlInjectionCheck([$taken, $sem])) {
            $this->returnErrorMessage("Unsecure input.", 400);
            return;
        }

        // split the courses if no errors are encountered
        $parts = [];
        if ($taken) {
            $parts = (array) explode("-", strtoupper($taken));
        }

        // check if semseter exists and is correct
        if ($sem) {
            $sem = ucfirst(strtolower($sem));

            if ($sem != "Summer" && $sem != "Fall" && $sem != "Winter") {
                $this->returnErrorMessage("Invalid semester. Accepted: Fall, Summer, Winter", 400);
                return;
            }
        }

        echo $this->gateway->getAvailable($parts, $sem);
    }

    /**
     * Returns all courses.
     */
    public function processAllRequest(string $method)
    {
        if ($method != "GET") {
            http_response_code(405);
            header("Allow: GET");
            return;
        }

        echo json_encode(["courses" => $this->gateway->getAll(), "success" => true]);
    }

    /** 
     * Validate the course ID and convert it to proper SQL string/format if necessary
     */
    private function getCourseIdValidation(string $course_id): array
    {
        // expected format: CIS*3760, engl*2550
        // if the given course_id doesn't match this, it will be considered an error/invalid input
        $errors = [];
        $parts = explode("*", $course_id);
        if (count($parts) != 2) {
            $errors[] = ["error" => "Please include an asterisk (*) in the course ID."];
            return $errors;
        }
        if (!preg_match('/^[A-Za-z]+$/', $parts[0])) {
            $errors[] = ["error" => "Course ID's subject must be alphabetical characters only."];
        }
        if (!preg_match('/^[0-9]+$/', $parts[1])) {
            $errors[] = ["error" => "Course ID's number must be numerical characters only."];
        }
        return $errors;
    }

    /**
     * Defend against SQL injection
     */
    private function sqlInjectionCheck(array $input): bool
    {
        for ($i = 0; $i < count($input); $i++) {
            if ($input[$i] !== NULL) {
                if (str_contains($input[$i], "%") || str_contains($input[$i], "--") || str_contains($input[$i], "'") || str_contains($input[$i], "\"")) {
                    return false;
                }
            }
        }
        return true;
    }

    // helper function to reduce code duplication
    private function returnErrorMessage(string $message, int $code): void
    {
        $success = true;
        if ($code == 400 || $code == 401) $success = false;

        http_response_code($code);
        echo json_encode(["message" => $message, "success" => $success]);
    }

    // helper function to check if the user is authorized to 
    private function checkAuth(): bool
    {
        // get basic auth username
        if (!isset($_SERVER["PHP_AUTH_USER"])) {
            http_response_code(401);
            echo json_encode(["message" => "Not authorized. Provide username and password using basic authentication", "success" => false]);
            return false;
        }

        $storedPassword = $this->gateway->getUserPassword($_SERVER["PHP_AUTH_USER"]);

        // compare basic auth password to the stored password
        if (password_verify($_SERVER["PHP_AUTH_PW"], $storedPassword)) {
            return true;
        }

        http_response_code(401);
        echo json_encode(["message" => "Not authorized. Provide username and password using basic authentication", "success" => false]);
        return false;
    }
}
