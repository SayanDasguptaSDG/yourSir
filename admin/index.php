<?php

include 'connection.php';
$errorMsg = '';
if(isset($_GET['action'])){
	if(base64_decode(urldecode($_GET['action']))== 'invalidId'){
		$errorMsg = 'Invaild Login Details';

	}
}
$sql = "select * from mst_admin";
if(mysqli_num_rows(mysqli_query($con,$sql)) <1){
	$needRegister = true;
}
else{
	$needRegister = false;

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>YourSir | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/adminCss.css"/>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<script>
		document.getElementsByTagName('input').click = function(){
			alert("asshole");
		}
		function checkNull(id){

            if (document.getElementById(id).value==''){
                document.getElementById(id).classList.add('redBorder');
                return false;
            }
            else{
                document.getElementById(id).classList.remove('redBorder');
                return true;
            }
        }
		function checkAll(){
		var rtrn = true;
		if (document.getElementById('userName').value==''){
				document.getElementById('userName').classList.add('redBorder');
				rtrn = false;
			}
		if (document.getElementById('password').value==''){
				document.getElementById('password').classList.add('redBorder');
				rtrn = false;
			}
		return rtrn;
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

		</div>
		<div class="clearFix"></div>
	</div><!--End of Wrap-->
	</div> <!--End Of Header-->
	<details>
		<summary>
		<font color="#848181">Login Details:</font>
		</summary>
		<p><font color="#D07908">Administrator (First time user) :-</font><br>
        <font color="#bef67a">login_user: admin</font> <br>
        <font color="#b22222">password: nopass</font><br><br></p>
	</details>
	<div class="loginBody">
	<div class="wrap">
			<center>
			<h1 class="heading deepYellow">
				YourSir Admin Panel
			</h1>
			<?php
			if($errorMsg == 'Invaild Login Details')
			{
			?>
				<p class="redMsgbox">Invaild Login Details</p>
			<?php
			}
			?>
			<div class="loginBox">
				<form method="post" action="<?php echo ($needRegister?'SQLlogin.php?action=signUp':'SQLlogin.php');?>" onsubmit="return checkAll();">
					<table>
						<tr>
							<td><input type="text" name="userName" id="userName" placeholder="User Name" class="inputBox1 whiteFont bottomBorder yellowFocus" autocomplete="off"></td>
						</tr>
						<tr>
							<td><input type="password" name="password" id="password" placeholder="Password" class="inputBox1 whiteFont bottomBorder yellowFocus" autocomplete="off"></td>
						</tr>
						<tr>
							<td><input type="submit" value="Login &nbsp&gt&gt" class="inputBox1 fullBorder yellowHover whiteFont"></td>

						</tr>
					</table>

				</form>
			</div>
			</center>
			<div class="clearFix"></div>
		</div>
	</div><!--End of login Body-->
	<div class="footer">
		<div class="wrap">
			<div class="footNote">
					<p>Designed and Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
			</div>
		</div>
	</div>


</div><!--End of Wrapper-->
</body>
</html>
