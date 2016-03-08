<?php
session_start();
include("login_required.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php")?>
</head>
<body>
<script type="text/javascript" src="../js/materialize.js"></script>
<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>
<div class="container active-bar">
    <div class="inner">
        <br>
        <br>
        <div class="card" style="background-color:#1f7e9a;color:white;text-align: center">
            <div class="card-image waves-effect waves-block waves-light">
            </div>
            <div class="card-content">
                <h3 id="name">Welcome <?php echo $_SESSION["name"]; ?></h3>
                <br>
                <br>
                <br>
                <a class="btn tooltipped"  data-position="top"  onclick="logout()" data-delay="20" data-tooltip="Goodbye">Logout</a>
            </div>
        </div>

        </div>
    </div>
</body>
</html>