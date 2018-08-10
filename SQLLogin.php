<?php
//require_once('connection.php') or die("opps Coonection error");
     require_once('connection.php');
$email=$_POST['email'];
$password=md5($_POST['password']);
$checkSql1 = "SELECT * from mst_user WHERE user_email='".$email."' AND user_pass='".$password."'";

$result= mysqli_query($con,$checkSql1);

if(mysqli_num_rows($result)>0){

    $row= mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
	$_SESSION['email']=$email;
    $_SESSION['name']=$row['user_name'];
    header('location:quizLandingPage.php');
}
else{
    header("location:login.php?action=".urlencode(base64_encode('invalidId')));
}

?>
