<?php
	require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");

    }
    else{
        $login=TRUE;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>YourSir | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/adminCss.css"/>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<script>
		function goToPage(id){
			window.location = id+".php";
		}
	</script>
</head>
<body>
<div class="wrapper">
	<div class="header">
	<div class="wrap">
		<div class="logo">
			your Sir
		</div>
		<div class="menu">
			<a href="logout.php">Logout</a>
		</div>
		<div class="clearFix"></div>
	</div><!--End of Wrap-->
	</div> <!--End Of Header-->

	<div class="mainBody">
		<div class="wrap">
			<div class="heading lightYellow">Welcome</div>
			<div class="menuGrid fullSize">
				<div class="menuItem" id="subject" onclick="goToPage(id)">
					<img src="images/subject.png" class="menuIcon">
					<p class="menuIconLabel">Subjects</p>
				</div>
				<div class="menuItem" id="test" onclick="goToPage(id)">
					<img src="images/test.png" class="menuIcon">
					<p class="menuIconLabel">Tests</p>
				</div>
				<div class="menuItem" id="question" onclick="goToPage(id)">
					<img src="images/qustion.png" class="menuIcon">
					<p class="menuIconLabel">Questions</p>
				</div>
				<div class="menuItem" id="changePassword" onclick="goToPage(id)">
					<center>
					<img src="images/key.png" class="menuIcon">
					</center>
					<p class="menuIconLabel">Change Password</p>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="wrap">
			<div class="footNote">
					<p>Designed and Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
			</div>
		</div>
	</div>
</div><!--End of wrapper-->
</body>
</html>
