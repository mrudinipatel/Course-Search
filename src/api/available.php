<?php
// The api/avaiable.php route, for getting the available courses based on taken courses.
declare(strict_types=1);
require "./database.php";
require "./courseController.php";
require "./courseGateway.php";
require "./errorHandler.php";

set_error_handler("handleError");
set_exception_handler("handleException");

header("Content-type: application/json; charset=UTF-8");
$taken = $_GET["taken"] ?? null;
$sem = $_GET["sem"] ?? null;

$database = new Database($_SERVER["DB_HOST"], $_SERVER["DB_USER"], $_SERVER["DB_PASS"], $_SERVER["DB_NAME"]);
$gateway = new CourseGateway($database);
$controller = new CourseController($gateway);

$controller->processAvailableRequest($_SERVER["REQUEST_METHOD"], $taken, $sem);
