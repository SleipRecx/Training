<?php
session_start();
include_once("connection.php");

//Head to home.php if user is already logged in
if($_SESSION["logged_in"]==true){
   $result = 1;
}
else{
    //Retrive user input
    $salt = "srtg5849jnswf9045h";
    $input_email = $_POST["email"];
    $input_password = md5($salt . $_POST["password"]);

    //Retrive from database
    $sql = "SELECT personid, password,firstname,lastname FROM persons WHERE email = '$input_email'";
    $result = mysql_query($sql);
    $values = mysql_fetch_array($result);
    $database_password = $values["password"];

    //Check if password is correct
    if($input_email!=null){
        if ($database_password == $input_password) {
            $_SESSION["personid"] = $values["personid"];
            $_SESSION["logged_in"] = true;
            $_SESSION["name"] = $values["firstname"]." ".$values["lastname"];
            if($values["firstname"]=="Admin"){
                $_SESSION["name"] = "Admin";
            }
            $result = 1;
        }
        else{
            $result = 0;
        }
    }
    else{
        $result = 0;
    }
}
echo $result;




