<?php
session_start();
include_once("db_connection.php");

$response = 0;

if($_SESSION["logged_in"]==true){
   $response= 1;
}

else{
    $salt = "srtg5849jnswf9045h";
    $input_email = $_POST["email"];
    $input_password = md5($salt . $_POST["password"]);

    $sql = /** @lang MYSQL */
        "SELECT personid, password,firstname,lastname
        FROM persons
        WHERE email = '$input_email'";


    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $database_password = $row["password"];
            if ($database_password == $input_password) {
                $_SESSION["personid"] = $row["personid"];
                $_SESSION["name"] = $row["firstname"] . " " . $row["lastname"];
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["logged_in"] = true;
                $response = 1;
                if ($row["firstname"] == "Admin") {
                    $_SESSION["name"] = "Admin";
                }
            } else {
                $response = 0;
            }
        }
    }
    echo $response;
}





