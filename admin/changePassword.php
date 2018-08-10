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
		function changePass(){
			if(document.getElementById('oldPass').value ==''){
				document.getElementById('oldPassError').innerHTML = "Enter Old Password"
                return false;
			}
			if(document.getElementById('newPass').value ==''){
				document.getElementById('newPassError').innerHTML = "Enter New Password"
                return false;
			}
			if(document.getElementById('conPass').value ==''){
				document.getElementById('conPassError').innerHTML = "Enter Password Again"
                return false;
			}
			if(document.getElementById('conPass').value != document.getElementById('newPass').value ){
                document.getElementById('conPassError').innerHTML = "Passwords Not Matched";
                return false;
            }
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
			<a href="home.php">Home</a>
			<a href="logout.php">Logout</a>
		</div>
		<div class="clearFix"></div>
	</div><!--End of Wrap-->
	</div> <!--End Of Header-->

	<div class="mainBody">
		<div class="wrap">
			<div class="heading lightYellow">Change Password</div>
			<center>
			<form method="post" action="changePassword.php?action=change" id="changePasswordForm" onsubmit="return changePass()">
				<table border="0">
					<tr>
						<th> <label for=oldPass class="yellowBorder">Old Password</label></th>
						<td><input type=password placeholder="Enter Old Password" name="oldPass" id="oldPass" class="inputBox1 bottomBorder yellowBorder">
						<p id="oldPassError" class="redFont"></p></td>
					</tr>
					<tr>
						<th> <label for=oldPass class="yellowBorder">New Password</label></th>
						<td><input type=password placeholder="Enter New Password" id="newPass" name="newPass" class="inputBox1 bottomBorder yellowBorder">
						<p id="newPassError" class="redFont"></p></td>
					</tr>
					<tr>
						<th> <label for=oldPass class="yellowBorder">Confirm Password</label></th>
						<td><input type=password placeholder="Confirm Password" id="conPass" name="confirmPass" class="inputBox1 bottomBorder yellowBorder">
							<p id="conPassError" class="redFont"></p></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" class="addNewBtn yellowBorder yellowHover" value="Change Password" /></td>
					</tr>
				</table>
			</form>
			</center>
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
<?php
if(isset($_GET['action'])){
        $sql = "SELECT login_pass FROM mst_admin";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $oldPass = md5($_POST['oldPass']);
        if($row['login_pass'] == $oldPass){
            $newPass = md5($_POST['newPass']);
            mysqli_query($con,"UPDATE mst_admin SET login_pass = '".$newPass."'");
            echo "<script> alert('Password Changed Successfully')</script>";
        }
        else{
            echo "<script> alert('Wrong Old Password')</script>";
        }
    }

?>
