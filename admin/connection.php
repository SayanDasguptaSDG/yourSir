<?php
$server='localhost';
$user='root';
$password='mysql';
$db='customQuizApplication';
$con=mysqli_connect($server,$user,$password,$db) or die ('OOPS! Database or Server Connection Error ');
session_start();
?>
