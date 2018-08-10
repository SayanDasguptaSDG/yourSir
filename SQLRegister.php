<?php
//require_once('connection.php') or die("opps Coonection error");
     require_once('connection.php');
$name=$_POST['name'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$address=$_POST['address'];
$city=$_POST['city'];
$phone=$_POST['phone'];

$checkSql1 = "SELECT * from mst_user WHERE user_email='".$email."'";
$checkSql2 = "SELECT * from mst_user WHERE user_phone='".$phone."'";

$hasemail = mysqli_query($con,$checkSql1);
$hasphone = mysqli_query($con,$checkSql2);
if(mysqli_num_rows($hasemail)>0){

    //echo 'hasemail';
    header("location:register.php?action=".urlencode(base64_encode('hasEmail')));
}
elseif(mysqli_num_rows($hasphone)>0){

    header("location:register.php?action=".urlencode(base64_encode('hasPhone')));
}
else{
    $sql="INSERT INTO mst_user (user_email,user_pass,user_name,user_address,user_city,user_phone) VALUES('".$email."',
                                                                                                        '".$password."',
                                                                                                        '".$name."',
                                                                                                        '".$address."',
                                                                                                        '".$city."',
                                                                                                        '".$phone."')";
    if(mysqli_query($con,$sql)){
        $_SESSION['email']=$email;
        $_SESSION['name']=$name;
        header("location:quizLandingPage.php?action=".urlencode(base64_encode('newUser')));
    }
}

?>
