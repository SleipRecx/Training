<?php
session_start();
    if(empty($_SESSION['logged_in']))
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/markua/etc/Treningsdagbok/index.php');
        exit;
    }

    echo 'You will only see this if you are logged in.';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/mycss.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Home</title>
</head>
<body id="background">
<br>
<center>
    <h1>Halla</h1>

</center>
</body>
</html>