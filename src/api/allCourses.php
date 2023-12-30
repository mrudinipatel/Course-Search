<?php
// The api/course.php route, for getting/deleting/updating a course
declare(strict_types=1);
require "./database.php";
require "./courseController.php";
require "./courseGateway.php";
require "./errorHandler.php";

set_error_handler("handleError");
set_exception_handler("handleException");

// set response header(s)
header("Content-type: application/json; charset=UTF-8");

// connect to the database and create a controller to handle the request
$database = new Database($_SERVER["DB_HOST"], $_SERVER["DB_USER"], $_SERVER["DB_PASS"], $_SERVER["DB_NAME"]);
$gateway = new CourseGateway($database);
$controller = new CourseController($gateway);
// send the necessary information to the controller & it will handle the request
$controller->processAllRequest($_SERVER["REQUEST_METHOD"]);
