<?php
// Class for the api talking to the database
class CourseGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    // This method is for getting the available courses based on provided taken courses, credits and current semester.
    public function getAvailable(array $parts, ?string $sem): string
    {
        $totalCredits = $this->getTotalCredits($parts);
        $data = [];

        $sql = "SELECT c.CourseID, c.UnParsedPrerequisites as Prerequisites, c.Prerequisites as ParsedPrerequisites, o.Semester, c.Restrictions, c.Equate, c.CourseName
                FROM Course c
                JOIN Offering o
                ON c.CourseID = o.CourseID
                WHERE (";

        // Iterate over courses and add them to the condition.
        for ($i = 0; $i < count($parts); $i++) {
            if ($i == (count($parts) - 1)) {
                $sql = $sql . "(c.Prerequisites LIKE \"%$parts[$i]%\"))";
            } else {
                $sql = $sql . "(c.Prerequisites LIKE \"%$parts[$i]%\") OR ";
            }
        }

        // If no courses are taken, get all courses with no prerequisites. (Prereq == N/A)
        if (count($parts) === 0) {
            $sql = "SELECT c.CourseID, c.UnParsedPrerequisites as Prerequisites, c.Prerequisites as ParsedPrerequisites, o.Semester, c.Restrictions, c.Equate, c.CourseName
                FROM Course c
                JOIN Offering o
                ON c.CourseID = o.CourseID
                WHERE (c.UnParsedPrerequisites = 'N/A')";
        }

        // check for semester if argument exists
        if ($sem) {
            $sql = $sql . " AND (o.Semester LIKE \"%$sem%\")";
        }

        $result = $this->conn->query($sql);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Filter out taken courses and check credit requirements
        $data = $this->filterCourses($data, $parts, $totalCredits);
        $data = array_values($data);

        if (count($parts) === 0) {
            return json_encode(["courses" => array_values($data), "credits" => $totalCredits, "success" => true]);
        }

        $filteredData = [];

        for ($i = 0; $i < count($data); $i++) {
            // Clean up the prereq string
            $data[$i]["ParsedPrerequisites"] = trim($data[$i]["ParsedPrerequisites"], '"');
            $data[$i]["ParsedPrerequisites"] = trim($data[$i]["ParsedPrerequisites"]);

            $result = false;
            // Split the prereq string to an array
            $splitPrereq = explode("^", $data[$i]["ParsedPrerequisites"]);

            $bracketResult = false;
            $isInBracket = false;
            $operation = "";
            $bracketOperation = "";

            // If there is only one element in the array, check if it is in the taken courses array
            if (count($splitPrereq) == 1 && in_array($splitPrereq[0], $parts)) {
                $result = true;
            }
            // If there are more than one element in the array
            else {
                // Iterate over the prereq parts and check if the element is in the taken courses array
                foreach ($splitPrereq as $element) {
                    $current = false;
                    if ($element == "&") {
                        if ($isInBracket == true) {
                            $bracketOperation = "&";
                        } else {
                            $operation = "&";
                        }
                    } else if ($element == "|") {
                        if ($isInBracket == true) {
                            $bracketOperation = "|";
                        } else {
                            $operation = "|";
                        }
                    } else {
                        for ($j = 0; $j < count($parts); $j++) {
                            // If the element is in the taken courses array, set current to true
                            if (str_replace(["(", ")"], "", $element) == $parts[$j]) {
                                $current = true;
                            }

                            // If the element is the start of a bracket, set isInBracket to true
                            if (str_starts_with($element, "(")) {
                                $isInBracket = true;
                            } else if (str_ends_with($element, ")")) { // If the element is the end of a bracket, set isInBracket to false
                                $isInBracket = false;
                                if ($bracketOperation == "&") {
                                    $current = ($bracketResult && $current);
                                } else if ($bracketOperation == "|") {
                                    $current = ($bracketResult || $current);
                                }
                                $bracketOperation = "";
                                $bracketResult = false;
                            }
                        }

                        if ($isInBracket == true) {
                            if ($bracketOperation == "&") {
                                $bracketResult = ($bracketResult && $current);
                            } else if ($bracketOperation == "|") {
                                $bracketResult = ($bracketResult || $current);
                            } else {
                                $bracketResult = $current;
                            }
                        } else {
                            if ($operation == "&") {
                                $result = ($result && $current);
                            } else if ($operation == "|") {
                                $result = ($result || $current);
                            } else {
                                $result = $current;
                            }
                        }
                    }
                }
            }

            // If the result is true, add the course to the filtered data array
            if ($result === true) {
                array_push($filteredData, $data[$i]);
            }
        }

        return json_encode(["courses" => $filteredData, "credits" => $totalCredits, "success" => true]);
    }

    // Helper function to get the total number of credits taken from the database using taken courseIDs.
    private function getTotalCredits(array $courseIds): float
    {
        if (empty($courseIds)) return 0;

        $placeholders = str_repeat('?,', count($courseIds) - 1) . '?';
        $sql = "SELECT SUM(Credit) as credits FROM Course WHERE CourseID IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($courseIds);
        $result = $stmt->fetch();

        return floatval($result["credits"]);
    }

    // Helper function to filter out taken courses and check credit requirements
    private function filterCourses(array $courses, array $takenCourses, float $totalCredits): array
    {
        return array_filter($courses, function ($course) use ($takenCourses, $totalCredits) {
            if (in_array($course["CourseID"], $takenCourses)) {
                return false;
            }

            // check if it has credit requirements and  our total credits is greater than or equal to it
            preg_match('/([0-9]+\.[0-9]+)/', $course["Prerequisites"], $matches);
            if (array_key_exists(1, $matches)) {
                $credit = (float) $matches[1];

                if ($totalCredits < $credit) {
                    return false;
                }
            }

            return true;
        });
    }

    // method for getting all courses from the database
    public function getAll()
    {
        $sql = "SELECT CourseID, CourseName FROM Course";
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]["CourseName"] = trim($data[$i]["CourseName"], '"');
        }
        return $data;
    }

    //method for creating courses in the database
    public function createCourse(array $data): array
    {
        $row_array = [
            "offering_rows" => 0,
            "course_rows" => 0
        ];

        //Sql query to insert deining wih placeholders
        $sql = "INSERT INTO Course (CourseID, CourseName, Description, Credit, Department, UnParsedPrerequisites, Restrictions, Equate)
                VALUES (:course_id, :course_name, :description, :credit, :department, :prerequisites, :restrictions, :equate)";

        $result = $this->conn->prepare($sql);

        //binds course_id course_name and credit to the placeholder and executes
        $result->bindValue(":course_id", strtoupper($data["course_id"]), PDO::PARAM_STR);
        $result->bindValue(":course_name", $data["course_name"], PDO::PARAM_STR);
        $result->bindValue(":description", $data["description"], PDO::PARAM_STR);
        $result->bindValue(":credit", $data["credit"], PDO::PARAM_STR);
        $result->bindValue(":department", $data["department"], PDO::PARAM_STR);
        $result->bindValue(":prerequisites", $data["prerequisites"], PDO::PARAM_STR);
        $result->bindValue(":restrictions", $data["restrictions"], PDO::PARAM_STR);
        $result->bindValue(":equate", $data["equate"], PDO::PARAM_STR);

        $result->execute();
        $row_array["course_rows"] = $result->rowCount();


        // add to offerings too
        $sql = "INSERT INTO Offering (CourseID, Semester)
                VALUES (:course_id, :semesters)";

        $result = $this->conn->prepare($sql);

        $result->bindValue(":course_id", strtoupper($data["course_id"]), PDO::PARAM_STR);
        $result->bindValue(":semesters", $data["semesters"], PDO::PARAM_STR);

        $result->execute();
        $row_array["offering_rows"] = $result->rowCount();

        //number of rows inserted
        return $row_array;
    }

    public function updateCourse(array $data)
    {
        $course_id = $data["course_id"];
        $update_list = $data["update"];
        $num_updates = 0;
        //  find the course first to make sure it exists
        $course_search_response = $this->getCourse($course_id, false);
        $course_search_message = $course_search_response["message"];
        $exists = (bool) ($course_search_message === "Course found.") ? true : false;
        if (!$exists) {
            return ["message" => "Unable to update course. " . $course_search_message, "success" => false];
        }
        // update the course
        $sql = "UPDATE Course SET ";
        // find what columns you've got
        $course_search_details = $course_search_response["course_data"];
        // record the changes made
        $changes = [];
        $course_name = $update_list["course_name"] ?? NULL;
        if (!empty($course_name)) {
            $sql .= " CourseName = '" . $course_name . "'";
            $changes[] = ["course_name" => "Course name updated to '" . $course_name . "' from '" . $course_search_details["CourseName"] . "'."];
            $num_updates++;
        }
        $desc = $update_list["description"] ?? NULL;
        if (!empty($desc)) {
            $sql .= $num_updates > 0 ? "," : "";
            $sql .=  " Description = '" . $desc . "'";
            $changes[] = ["description" => "Course description updated to '" . $desc . "' from '" . $course_search_details["Description"] . "'."];
            $num_updates++;
        }
        $credit = $update_list["credit"] ?? NULL;
        if (!empty($credit)) {
            $sql .= $num_updates > 0 ? "," : "";
            $sql .= " Credit = '" . $credit . "'";
            $changes[] = ["credit" => "Credit weight updated to " . $credit . " from '" . $course_search_details["Credit"] . "'."];
            $num_updates++;
        }

        $sql .= " WHERE CourseID='" . $course_id . "'";
        // prepare and perform the update
        $pdo = $this->conn->query($sql);
        $result = $pdo->rowCount();
        return [
            "message" => "Updated course.",
            "changes" => $changes,
            "success" => true
        ];
    }

    /**
     * Get an individual course from the database based on its ID.
     * Returns a message (success or fail), with the results on successful retrieval.
     */
    public function getCourse(string $course_id, bool $prereq_only)
    {
        if (!$prereq_only) {
            // Create & run SQL query
            $sql = "SELECT c.*, o.Semester
                    FROM Course c
                    JOIN Offering o
                    ON c.CourseID = o.CourseID
                    WHERE c.CourseID='" . $course_id . "'";
        } else {
            $sql = "SELECT CourseID, Prerequisites 
                    FROM Course
                    WHERE CourseID='" . $course_id . "'";
        }
        $pdo = $this->conn->query($sql);
        // Retrieve only the result of the query after executing it
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $result[$i]["Prerequisites"] = trim($result[$i]["Prerequisites"], '"');
            $result[$i]["Prerequisites"] = str_replace("\r", '', $result[$i]["Prerequisites"]);
        }

        // return message based on result of SQL query
        if (empty($result)) {
            return ["message" => "Course not found.", "success" => false];
        } else if (count($result) > 1) {
            return [
                "message" => "Multiple courses found. Please report this to the appropriate parties.",
                "success" => false
            ];
        } else {
            return [
                "message" => "Course found.",
                "course_data" => $result[0] ?? null,
                "success" => true
            ];
        }
    }

    public function getCourseByName(string $course_name, bool $prereq_only)
    {
        if ($prereq_only) {
            $sql = "SELECT CourseID, CourseName, Prerequisites 
                    FROM Course 
                    WHERE CourseName LIKE '%" . $course_name . "%'";
        } else {
            $sql = "SELECT * 
                    FROM Course 
                    WHERE CourseName LIKE '%" . $course_name . "%'";
        }
        $pdo = $this->conn->query($sql);
        // Retrieve only the result of the query after executing it
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        // return message based on result of SQL query
        if (empty($result)) {
            return ["message" => "No course found matching '" . $course_name . "'", "success" => false];
        } else {
            return [
                "message" => "Course(s) found.",
                "course_data" => $result ?? null,
                "success" => true
            ];
        }
    }

    public function getCoursesBySubject(string $subject): array
    {
        $course_list = [];
        $sql = "SELECT *
                FROM Course  
                WHERE CourseID LIKE '" . strtoupper($subject) . "%'";
        $pdo = $this->conn->query($sql);
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return ["message" => "No courses found.", "success" => false];
        }
        return [
            "message" => "Course(s) found.",
            "course_data" => $result,
            "success" => true
        ];
    }
    public function deleteCourse(string $course_id): array
    {
        $row_array = [
            "offering_rows" => 0,
            "course_rows" => 0
        ];

        // sql query to delete a course from Offering table with same id as one passed in
        $sql = "DELETE FROM Offering WHERE CourseID= :course_id";
        $result = $this->conn->prepare($sql);
        $result->bindValue(":course_id", $course_id, PDO::PARAM_STR);
        $result->execute();
        // save the number of rows deleted
        $row_array["offering_rows"] = $result->rowCount();

        // sql query to delete a course from Course table with same id as one passed in
        $sql = "DELETE FROM Course WHERE CourseID= :course_id";
        $result = $this->conn->prepare($sql);
        $result->bindValue(":course_id", $course_id, PDO::PARAM_STR);
        $result->execute();
        // save the number of rows deleted
        $row_array["course_rows"] = $result->rowCount();

        // return the number of rows deleted from the Course database
        return $row_array;
    }

    // to get stored user password using the username
    public function getUserPassword(string $username): string
    {
        $sql = "SELECT password FROM Users WHERE username = :username";
        $result = $this->conn->prepare($sql);
        $result->bindValue(":username", $username, PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() == 1) {
            $result = $result->fetch();
            return $result["password"];
        }
        // if username does not exist
        else {
            return '';
        }
    }
}
