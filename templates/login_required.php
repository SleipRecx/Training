<?php
if(empty($_SESSION['logged_in'])) {
    header('Location: ../index.php');
    exit;
}