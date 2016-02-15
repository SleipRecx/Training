<?php
//Database connection
$dbhost = 'mysql.stud.ntnu.no';
$dbuser = 'markua_test';
$dbpass = '123456';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(!$conn )
{
    die('Could not connect: ' . mysql_error());
}
//Databse selection
mysql_select_db("markua_trening",$conn);

