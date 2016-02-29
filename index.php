<?php
session_start();
include_once("templates/connection.php");

//Head to home.php if user is already logged in
if($_SESSION["logged_in"]==true){
    header("Location: templates/home.php");
}

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
if($input_email!=null) {
    if ($database_password == $input_password) {
        $_SESSION["personid"] = $values["personid"];
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $values["firstname"]." ".$values["lastname"];
        header("Location: templates/home.php");
    }
    else {
        echo "<script>alert('Wrong username or password')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="js/pwstrength.js"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            $(':password#registerpassword').pwstrength();
        });

        function toggle_visibility(id) {
            var e = document.getElementById(id);
            var login = document.getElementById("login");

            if(e.style.display == 'block'){
                e.style.display = 'none';
                e.style.opacity = "0";
                login.style.display ="block";}
            else {
                e.style.display = 'block';
                e.style.opacity = "1";
                login.style.display ="none";
            }
        }
        function validate(){
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var email = document.getElementById("email").value;
            var nickname = document.getElementById("displayname").value;
            var password = document.getElementById("registerpassword").value;
            var password2 = document.getElementById("registerpassword2").value;
            var strength = document.getElementsByClassName("password-verdict")[0].innerHTML;
            if(firstname!="" & lastname!="" && email!="" && nickname!="" && password!=""){
                if(strength=="Weak"){
                    alert("Password strength has to be normal or better");
                    return false;
                }
                if(password!=password2){
                    return false;
                }
                return true;
            }
            else{
                alert("All fields needs to be filled out");
                return false;
            }

        }
    </script>

</head>
<body id="background">
<div id="reg">
    <?php include 'templates/registerForm.php';?>
</div>
<br>
    <?php include 'templates/loginForm.php';?>
<br>
<br>
<br>
</body>
</html>