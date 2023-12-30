<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Planned Courses</title>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/plannedCourses.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="js/index.js"></script>
    <style>
        main {
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ?>
    <header id="home_header">
        <div class="header_container">
            <h1>View Planned Courses</h1>
        </div>
    </header>
    <main class='courseSearch_main'>

        <?php
        // The api/course.php route, for getting/deleting/updating a course
        // declare(strict_types=1);
        // require "api/errorHandler.php";

        // set_error_handler("handleError");
        // set_exception_handler("handleException");

        // check that it's a POST request, otherwise reject
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $courses = $_POST["PlannedList"] != null ? $_POST["PlannedList"] : null;
            if ($courses == null) {
                http_response_code(400);
                echo "<p>No courses to display.</p>";
            } else {
                $str_courses = str_replace('"', "'", $courses);
                // echo $str_courses . '<br/><br/>';
                $decoded_courses = json_decode($courses, true);
                echo '<button class="download-button" onclick="download(' . $str_courses . ')">Download planned courses (.txt)</button><br /><br />';
                foreach ($decoded_courses as $course) {
                    echo '<div class="courseCard">
                        <button type="button" onclick="toggleCourse(this)" class="collapsible planned_course"><b>' . $course["CourseID"] . '</b></button>
                        <div style="display:none;" class="collapsible_content">
                            <p><b>Name: </b>' . $course["CourseName"] . '</p>
                            <p><b>Prerequisites:</b> ' . $course["UnParsedPrerequisites"] . '</p>
                            <p><b>Restrictions:</b> ' . $course["Restrictions"] . '</p>
                            <p><b>Semesters:</b> ' . $course["Semester"] . '</p>
                            <p><b>Description:</b> ' . $course["Description"] . '</p>
                            <p><b>Credit:</b> ' . $course["Credit"] . '</p>
                            <p><b>Department:</b> ' . $course["Department"] . '</p>
                            <p><b>Equate:</b> ' . $course["Equate"] . '</p>
                        </div>
                    </div>';
                }
            }
        } else {
            http_response_code(405);
            header("Allow: POST");
        }
        ?>
    </main>
    <!-- TODO: "lock" footer to bottom of page? -->
    <?php include 'footer.php' ?>
</body>

</html>