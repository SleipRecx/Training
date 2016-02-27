<?php
session_start();
include_once("connection.php");
$salt = "srtg5849jnswf9045h";
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$nickname = $_POST["displayname"];
$password = md5($salt . $_POST["password"]);

$sql = "SELECT personid FROM persons WHERE email='$email'";

$result = mysql_query($sql);

if (mysql_num_rows($result) != 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else {
    $sql = "INSERT INTO `persons`(`lastname`, `firstname`, `password`, `adress`, `city`, `email`)

    VALUES ('$lastname','$firstname','$password',NULL,NULL,'$email')";

    $retval = mysql_query($sql);
    if(! $retval) {
        die('Could not enter data: ' . mysql_error());
    }
    echo "Entered data successfully\n";
    header("Location: ../index.php");
}
if(empty($id)){

}
