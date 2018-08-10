<?php
    require_once('connection.php');
    if (isset($_SESSION['email'])){
        $login=TRUE;
    }
    else{
        $login=FALSE;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="wrap">
            <div class="logo">
				your Sir
            </div>
            <div class="menu">
                 <nav>
                    <ul class="disableSelect">
                        <li><a href="index.php" class="<?php echo ($login?'hide':'show');?>">HOME</a></li>
                        <li><a href="quizLandingPage.php" class="<?php echo ($login?'show':'hide');?>">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
                        <li><a href="register.php">REGISTER</a></li>
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
		<div class="head">
				<h1 class="disableSelect yellowFont" style="font-size:150%"> About Us</h1>
		</div>
        <div class="aboutBody">
            <p>yourSir is an online based custom quiz application. It provides an user interactive environment and let the user practice quizzes on different topics available in the application.Users have to register themselves to our portal in order to avail quiz services.It contains all the results of the users and users can check their results after logging. Feel free to use and register now to avail the quiz services.
No subscription fee is required, users can enjoy unlimited access to yourSir, provided they register themselves.</p>
            <p>yourSir plans to provide the users a platform which will be useful to them in everty fields of their life. All the quizzes are MCQ based and comes with four options, only one is the correct answer. They can participate in the quizzes and can nurture themselves for the competitive examinations which are online based, and also examinations for job purposes. They will become accustomed to the e-learning platform. Many companies and developing websites solely for the purpose of online education and we are no different.</p>
        </div>

        </center>

        </div>
    </div>
    <div class="footer">
        <div class="wrap">
            <div class="footNote">
                <p>Designed And Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
        
