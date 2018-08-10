<?php
include 'connection.php';
    $msg ='';
$mailSuccess ='';
	$foundResult ='';
	if(!isset($_SESSION['email'])){
        //header("location:index.php");
    }
    else{
        $login=TRUE;
    }
	if(isset($_GET['status'])){
		if(base64_decode(urldecode($_GET['status']))=='success'){
			$mailSuccess = '1';

		}
		elseif(base64_decode(urldecode($_GET['status']))=='error'){
			$mailSuccess='0';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function validateEmail(email){
            var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
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

		function removeRedborder(id){
			document.getElementById(id).classList.remove('redBorder');
		}

		function checkAll(){
				var email= document.getElementById('email').value;
				var rtrn = true;
				if (document.getElementById('name').value==''){
					document.getElementById('name').classList.add('redBorder');
					rtrn = false;
				}
				if (document.getElementById('email').value==''){
					document.getElementById('email').classList.add('redBorder');
					rtrn = false;
				}else if(!validateEmail(email)){
					document.getElementById('email').classList.add('redBorder');
					rtrn = false;

				}
				if (document.getElementById('message').value==''){
					document.getElementById('message').classList.add('redBorder');
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
                <p><font color="#FFFFFF">Your SIR</font></p>
            </div>
            <div class="menu">
                 <nav>
                    <ul>
                        <li><a href="quizLandingPage.php">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
                        <li><a href="login.php" class="<?php echo ($login?'hide':'show');?>">LOGIN</a></li>
                        <li><a href="logout.php" class="<?php echo ($login?'show':'hide');?>">LOGOUT</a></li>

                    </ul>
                </nav>
            </div>
        <div class="clearFix"></div>
        </div>
    </div><!--End of header-->
	<div class="mainBody" style="height:100%;">
		<div class="wrap" style="width:95%;">
		<center>
		<div class="headLine">
				<img src="images/contact.png" class="heading">
		</div>
		<?php
			if($mailSuccess=='1'){
		?>
		<div class="greenMsgbox">
			<?php echo "Message has been sent successfully. "?>
		</div>
		<?php
			}elseif($mailSuccess=='0'){
		?>
		<div class="redMsgbox">
			<?php echo "Some unknown error has occured. Please try again later. "?>
		</div>


		<?php
			}
		?>
			<div class="contactform">
			<div class="showMsg"><?php echo $msg; ?></div>
			<form class="" id="contactForm" method="post" action="SQLContact.php" onsubmit="return checkAll();">

				<input type="text" id="name" class="inputBox1" name="name" placeholder="Enter Name" onblur='checkNull(id)'/>
				<input type="text" class="inputBox1" name="email" placeholder="Enter Email Address" id="email" onfocus="removeRedborder(id)" onblur='checkNull(id)'/>

				<textarea class="inputBox1" name="message" placeholder="Enter Address" rows="5" id="meassage" onfocus="removeRedborder(id)" onblur='checkNull(id)'></textarea>


				<input type="submit" class="inputBox1 blueHover " value="Register"  style=""/>

			</form>
			</center>
		</div>
		</center>
		</div>
	</div>
  <div class="wrap">
      <div class="footNote">
          <p>Designed And Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
      </div>
  </div>
</div>
</body>
</html>
