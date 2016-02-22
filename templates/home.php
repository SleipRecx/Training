<?php
session_start();

if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/mycss.css">
    <title>Home</title>
    <script>

        $(document).ready(function () {
            $('#sidebar-btn').click(function(){
                $('#sidebar').toggleClass('visible');
            })

            $('#sidebar-btn').click(function(){
                $('#container').toggleClass('active-bar');
            })
        });

        function logout(){
            window.location.href = 'logout.php'
        }
        window.onload = function(){
            var name = "<?php echo $_SESSION["name"]; ?>";
            document.getElementById("name").innerHTML = "Welcome " + name;
        }


        $(document).ready(function(){
            $("#records").click(function(){
                $("#container").load('registerForm.php');
            });
        });


    </script>
</head>
<body>
    <nav>
        <div id="sidebar-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <a href="#" class="glyphicon glyphicon-cog white" aria-hidden="true" style="float: right; margin-right: 40px; margin-top: 15px; font-size: 1.1em"></a>
        <a href="#" class="glyphicon glyphicon-envelope white" aria-hidden="true" style="float: right; margin-right: 35px; margin-top: 15px; font-size: 1.1em"></a>
        <a href="#" class="glyphicon glyphicon-user white" aria-hidden="true" style="float: right; margin-right: 35px; margin-top: 15px; font-size: 1.1em"></a>

    </nav>

    <div id="sidebar" class="visible">
        <br>
        <ul>
            <li id ="home"><span class="glyphicon glyphicon-home white" style="margin-right: 10px; font-size: 0.9em"></span>Home</li>
            <hr>
            <li><span class="glyphicon glyphicon-plus-sign white" style="margin-right: 10px; font-size: 0.9em"></span>New Session</li>
            <li id ="records"><span class="glyphicon glyphicon-list-alt white" style="margin-right: 10px; font-size: 0.9em"></span>Records</li>
            <li><span class="glyphicon glyphicon-stats white" style="margin-right: 10px; font-size: 0.9em"></span>Progress</li>
            <li><span class="glyphicon glyphicon-calendar white" style="margin-right: 10px; font-size: 0.9em"></span>Calendar</li>

        </ul>
    </div>

    <div id="container">
        <br>
        <div class="alert alert-success" style="width: 50%;  margin: 0 auto;" role="alert">
            <br>
            <span id="name"></span>
            <br>
            <br>
            <br>
            <br>
            <button class="btn btn-warning" onclick="logout()"> Logout </button>
            <br>
        </div>
 <br>


    </div>

</body>
</html>