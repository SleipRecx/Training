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
    <script src="js/validator.js"></script>

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
        function clearFields(){
            document.getElementById("firstname").value="";
            document.getElementById("lastname").value="";
            document.getElementById("email").value="";
            document.getElementById("displayname").value="";
            document.getElementById("registerpassword").value="";
            document.getElementById("registerpassword2").value="";
        }

        function validate(){
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("registerpassword").value;
            var password2 = document.getElementById("registerpassword2").value;
            var strength = document.getElementsByClassName("password-verdict")[0].innerHTML;
            if(firstname!="" & lastname!="" && email!=""  && password!=""){
                if(strength=="Weak"){
                    alert("That password sucks, pick another one");
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
<body style="background-color: rgba(49, 107, 136, 0.84)">
<a href="https://github.com/SleipRecx/Training" class="github-corner"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:rgba(55, 58, 60, 0.71); color:#fff; position: absolute; top: 0; border: 0; right: 0;"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
<div id="reg" class="logindiv">
    <?php include 'templates/registerForm.php';?>
</div>
<div id="login" class="logindiv">
    <?php include 'templates/loginForm.php';?>
</div>

<br>
<br>
<br>
</body>
</html>