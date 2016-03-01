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

<div class="container active-bar">

    <div class="inner">
        <br>

        <br>
    <div class="alert alert-success" role="alert" style="max-width: 800px;">
        <br>
        <h3 id="name">Welcome <?php echo $_SESSION["name"]; ?></h3>
        <br>

        <br>
        <br>
        <button class="btn btn-success" onclick="logout()"> Logout </button>
        <br>
    </div>
    <br>

    </div>
</div>

</body>
</html>