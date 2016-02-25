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
    <?php include("head.php")?>
</head>
<body>

<nav>
    <?php include("nav.php")?>
</nav>

<div id="sidebar" class="visible">
    <?php include("sidebar.php")?>
</div>

<div id="container">
    <div class="inner">
    <br>
    <div class="alert alert-success" style="width: 50%; text-align: center; margin: 0 auto;" role="alert">
        <br>
        <span id="name">Welcome <?php echo $_SESSION["name"]; ?></span>
        <br>
        <br>
        <br>
        <br>
        <button class="btn btn-warning" onclick="logout()"> Logout </button>
        <br>
    </div>
    <br>
    </div>
</div>

</body>
</html>