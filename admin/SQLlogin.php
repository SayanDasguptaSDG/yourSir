<?php
	include 'connection.php';
	if(!empty($_GET['action'])){
		if($_GET['action'] == 'signUp'){
			$userName = $_POST['userName'];
			$password = md5($_POST['password']);
			$sql = "INSERT INTO mst_admin (login_user,login_pass) VALUES('".$userName."','".$password."')";
			if(mysqli_query($con,$sql)){
				$_SESSION['userName']=$userName;
				header("location:home.php?action=".urlencode(base64_encode('newAdmin')));
			}
		}
		
	}
	else{
		$userName = $_POST['userName'];
		$password = md5($_POST['password']);
		$sql = "SELECT * FROM mst_admin WHERE login_user ='".$userName."' AND login_pass ='".$password."'";
		//echo $sql;
		if($result = mysqli_query($con,$sql)){
			if(mysqli_num_rows($result) >0){
				$_SESSION['userName']=$userName;
				header('location:home.php');
			}
			else{
				
				header("location:index.php?action=".urlencode(base64_encode('invalidId')));
			}
		}
		
	}
?>