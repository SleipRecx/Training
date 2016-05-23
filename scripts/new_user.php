<?php
session_start();
include_once("db_connection.php");

$salt = "srtg5849jnswf9045h";
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$nickname = $_POST["displayname"];
$password = md5($salt . $_POST["password"]);

$sql = /** @lang MYSQL */
    "SELECT personid
    FROM persons
    WHERE email='$email'";

$result = $conn->query($sql);

if($result->num_rows > 0){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else {
    $sql =
        /** @lang MYSQL */
        "INSERT INTO persons(lastname,firstname,password,adress,city,email)
        VALUES ('$lastname','$firstname','$password',NULL,NULL,'$email')";

    if($conn->query($sql) == TRUE) {
        echo "Entered data successfully\n";
        header("Location: ../index.php");
    }
    else{
        die('Could not enter data: ' . $conn->error);
    }
}
