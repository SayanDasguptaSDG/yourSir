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
    <script>
        var redBorder = "border-color:#FE4551;color:#FE4551;box-shadow: 0px 0px 15px 0px rgba(216, 21, 21, 0.70);transition:1s;"
        var whiteBorder = "border-color:#fff;color:#fff;transition:1s;"
        var yellowBorder = "border: 2px solid #FBFF02;"


        function validateEmail(email){
            var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

		function removeRedborder(id){
			document.getElementById(id).classList.remove('redBorder');
		}
		function isNumber(evt)
		{
			 var charCode = (evt.which) ? evt.which : event.keyCode
			 if (charCode != 45  && charCode > 31 && (charCode < 48 || charCode > 57))
				return false;

			 return true;
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

            if (document.getElementById('password').value==''){
                document.getElementById('password').classList.add('redBorder');
                rtrn = false;
            }
            if (document.getElementById('address').value==''){
                document.getElementById('address').classList.add('redBorder');
                rtrn = false;
            }
            if (document.getElementById('city').value==''){
                document.getElementById('city').classList.add('redBorder');
                rtrn = false;
            }
            if (document.getElementById('phone').value==''){
                document.getElementById('phone').classList.add('redBorder');
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
    <center>
    <div class="mainBody addBG1">
        <h2 class="signUpHeading disableSelect"><span>Register.</span> <font color="#06EA8B"> Participate.</font> Get Certified.</h2>
        <div class="wrap">
            <div class="signUpBox">
                <p class="errorMsg"></p>
                <form class="signUpForm" id="signUpForm" method="post" action="SQLRegister.php" onsubmit="return checkAll();">
                    <table>
                        <tr>
                            <td><input type="text" id="name" class="transperent" name="name" placeholder="Enter Name" onfocus="removeRedborder(id)" onblur='checkNull(id)' style="width:400px;"/></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="transperent" name="email" placeholder="Enter Email" id="email" onblur='checkNull(id)' onfocus="removeRedborder(id)" style="width:400px;"/></td>
                        </tr>

                        <tr><td><input type="password" class="transperent" name="password" placeholder="Enter Password" id="password" onblur='checkNull(id)' onfocus="removeRedborder(id)" style="width:400px;"/></td></tr>

                        <tr><td><textarea class="transperent" name="address" placeholder="Enter Address" rows="5" id="address" onblur='checkNull(id)' onfocus="removeRedborder(id)" style="width:400px;"></textarea></td></tr>

                        <tr><td><input type="text" class="transperent" name="city" placeholder="Enter City" id="city" onblur='checkNull(id)' onfocus="removeRedborder(id)" style="width:400px;"/></td></tr>

                        <tr><td><input type="tel" size=10 maxlength=10 class="transperent" name="phone" placeholder="Enter Contact Number" id="phone" onblur='checkNull(id)' onkeypress='return isNumber(event)' onfocus="removeRedborder(id)" style="width:400px;"/></td></tr>
                        <tr><td></td></tr>
                        <tr><td><input type="submit" class="button transperent" value="Register" style="width:450px;"/></td></tr>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <div class="mainBody" style="height:400px;">
    <div class="head">
				<h1 class="disableSelect yellowFont" style="font-size:150%"> About Us</h1>
		</div>
        <div class="aboutBody">
            yourSir is an online based custom quiz application. It provides an user interactive environment and let the user practice quizzes on different topics available in the application.Users have to register themselves to our portal in order to avail quiz services.It contains all the results of the users and users can check their results after logging. Feel free to use and register now to avail the quiz services.
No subscription fee is required, users can enjoy unlimited access to yourSir, provided they register themselves.  </br>
        <div style="text-align:right"> <a href="about.php" class="yellowFont" >More About Us &rarr;</a></div>
        </div>
    </div>
        </center>
    <div class="footer">
        <div class="wrap">
            <div class="footNote">
                <p>Designed And Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
            </div>
        </div>
    </div>

</div><!--End of wrapper-->
</body>
</html>
