<?php
session_start();
include_once("templates/connection.php");

//Post data retrival
$salt = "srtg5849jnswf9045h";
$input_email = $_POST["email"];
$input_password = md5($salt . $_POST["password"]);

$sql = "SELECT `personid`,`email`,`password` FROM `persons` WHERE `email` = '$input_email'";
$query = $sql;
$result = mysql_query($query);

$values = mysql_fetch_array($result);
$database_password = $values["password"];
$database_email = $values["email"];
echo $database_password;

if($input_email!=null) {
    if ($database_password == $input_password and $input_email == $database_email) {
        $_SESSION["email"] = $input_email;
        $_SESSION["logged_in"] = true;
        header("Location: templates/home.php");
    } else {
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

            if(e.style.display == 'block') {
                e.style.display = 'none';
                e.style.opacity = "0";
                login.style.display ="block";

            }
            else {
                e.style.display = 'block';
                e.style.opacity = "1";

                login.style.display ="none";
            }
        }
    </script>
</head>
<body id="background">
<div id="reg">
    <?php include 'register.php';?>
</div>
<br>
<center>
    <div id="login">
        <h2>Welcome - Please sign in</h2>
        <br>
    <form class="form-horizontal" role="form" method="POST" action="index.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id ="email" name="email" placeholder="Enter email">
            </div>
        </div>
        <br>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id ="password" name="password" placeholder="Enter password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-0 col-sm-0">
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>
            </div>
        </div>
        <br>
        <br>
            <button type="submit" name="submit" class="btn btn-success" style="margin-right: 20px;">Login</button>
            <button onclick="toggle_visibility('reg')" type="button" id="register" class="btn btn-info">Register</button>
    </form>
        </div>
</center>
<br>
<br>
<br>
</body>
</html>