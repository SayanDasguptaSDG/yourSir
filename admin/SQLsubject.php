<?php

require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }

if(isset($_GET['action'])){
	$action  = $_GET['action'];
}
switch($action){
	case 'addNew':
		$subjectName = $_POST['subjectName'];
		$insertSql = "INSERT INTO mst_subject (sub_name) VALUES('".$subjectName."')";
		if(mysqli_query($con,$insertSql)){
			header('location:subject.php');
		}
		break;
	case 'edit':
		$subjectName = $_POST['sub_name'];
		$id = $_POST['sub_id'];
		$updateSql = "UPDATE mst_subject SET sub_name = '".$subjectName."' WHERE
		id='".$id."'";
		if(mysqli_query($con,$updateSql)){
			header('location:subject.php');
		}
		break;
	case 'del':
		$subId = $_GET['subId'];
		$delSql = "UPDATE mst_subject SET enable = 0 WHERE
		id='".$subId."'";
		
		if(mysqli_query($con,$delSql)){
			header('location:subject.php');
		}
		break;
}
?>