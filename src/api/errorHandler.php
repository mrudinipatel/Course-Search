<?php
// Resource guide: https://www.youtube.com/watch?v=X51KOJKrofU

// Function for returning internal server error information on exceptions, instead of crashing the server to the client
function handleException(Throwable $exception): void {
    // If the error is because of 
    if($exception->getCode() == 23000) {
        http_response_code(400);

        echo json_encode([
            "message" => "Course already exists",
            "verbose" => $exception->getMessage(),
            "success" => false
        ]);
    }
    else{
        http_response_code(500);

        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine(),
            "success" => false
        ]);
    }
}

// This function throws an errorexception if there's an error
function handleError(int $errno, string $errstr, string $errfile, int $errline): bool {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

?>