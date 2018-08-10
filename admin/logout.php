<?php
require_once('connection.php');

session_unset();
session_destroy();
header('location:index.php');

?>