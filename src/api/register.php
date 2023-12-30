<?php
echo 'No access';
// Below is used for only creating the admin account, we do not plan on having different accounts so its commented out.

// require "./database.php";
// require "./courseController.php";
// require "./courseGateway.php";
// require "./errorHandler.php";

// $database = new Database($_SERVER["DB_HOST"], $_SERVER["DB_USER"], $_SERVER["DB_PASS"], $_SERVER["DB_NAME"]);
// $conn = $database->getConnection();
// $hashedPassword = password_hash("pass1234", PASSWORD_DEFAULT);

// $sql = "INSERT INTO Users (username, password)
// VALUES (:username, :password)";

// $result = $conn->prepare($sql);

// $result->bindValue(":username", "admin", PDO::PARAM_STR);
// $result->bindValue(":password", $hashedPassword, PDO::PARAM_STR);;

// $result->execute();

// echo $result->rowCount();