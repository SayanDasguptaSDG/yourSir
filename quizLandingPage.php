<?php
    include 'connection.php';
    if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <li><a href="#">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
<!--                        <li><a href="register.php">REGISTER</a></li>-->
                        <li><a href="login.php" class="<?php echo ($login?'hide':'show');?>">LOGIN</a></li>
                        <li><a href="logout.php" class="<?php echo ($login?'show':'hide');?>">LOGOUT</a></li>

                    </ul>
                </nav>
            </div>
        <div class="clearFix"></div>
        </div>
    </div><!--End of header-->
    <div class="mainBody" style="height:100%;">
        <div class="wrap" style="width:60%;">
            <div class="boxLink" style="float:left;" id="selectSubject" onclick="window.location='subject.php'">
                <div class="overlay">
					<p>Make Choice For Subject and Tests And Play Quiz</p>
					<p style="margin:0 auto;">&rarr;</p>
				</div>
                <div class="linkBoxHeading ">
                    <center>
                    <img src="images/Quiz-Games.png" alt="Select subject for Quiz">
                        <p>Select Subject</p>
                    </center>
                </div>
            </div>
            <div class="boxLink " style="float:right;" id="showResult" onclick="window.location='result.php'">
                <div class="overlay">
					<p>Check Results Of Previously Played Quizes</p>
					<p style="margin:0 auto;">&rarr;</p>
				</div>
                <div class="linkBoxHeading ">
                    <center>
                    <img src="images/result.png" alt="Select subject for Quiz " style="height:50%;">
                        <p>Check Results</p>
                    </center>
                </div>
            </div>
            <div class="clearFix"></div>
        </div>
    </div>
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
