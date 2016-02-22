<?php
session_start();
unset($_SESSION["logged_in"]);
unset($_SESSION["personid"]);
header("Location: ../index.php");