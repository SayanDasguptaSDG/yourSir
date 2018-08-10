<?php 
require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
if(isset($_GET['action']))
{
	$action=$_GET['action'];
	switch($action){
		case 'addNew':
			$sid = $_POST['sid'];
			$testName = $_POST['testName'];
			$qusCount = $_POST['qusCount'];
			$insertSQL = "INSERT INTO mst_test (sub_id,test_name,total_question) VALUES('".$sid."','".$testName."','".$qusCount."')";
			if(mysqli_query($con,$insertSQL)){
				header('location:test.php?sid='.$sid);
			}
			
			break;
		case 'del':
			$tid=$_GET['tid'];
			$sid = $_GET['sid'];
			$delSql = "UPDATE mst_test SET enable = 0 WHERE
			id='".$tid."'";
			if(mysqli_query($con,$delSql)){
				header('location:test.php?sid='.$sid);
			}
			break;
		case 'edit':
			$tid = $_POST['editTid'];
			$sid = $_GET['sid'];
			$testName = $_POST['editTestName'];
			$qusCount = $_POST['editQusCount'];
			$updateSql="UPDATE mst_test SET test_name='".$testName."',total_question='".$qusCount."' WHERE id='".$tid."'";
			if(mysqli_query($con,$updateSql)){
				header('location:test.php?sid='.$sid);
			}
	}
}

?>