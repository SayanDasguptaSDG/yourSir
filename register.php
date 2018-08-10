<?php
    include 'connection.php';
     if(isset($_SESSION['email'])){
        header("location:quizLandingPage.php");
    }
    else{

    }
    $msg ='';
    if(isset($_GET['action'])){
        $action= base64_decode(urldecode($_GET['action']));
        switch($action){
            case 'hasEmail':
                    $msg="<font color='#F6111D'>Email Id already linked with an account</font>";
                    break;
            case 'hasPhone':
                    $msg="<font color='#F6111D'>Phone no already linked with an account</font>";
                    break;
//            case '':
//                    $msg="<font color='#3193F5'>Login First</font>";
//                    break;
            default:
                $msg='';


        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script>
        var redBorder = "border-color:#FE4551;color:#FE4551;box-shadow: 0px 0px 15px 0px rgba(216, 21, 21, 0.70);transition:1s;";
        var greyBorder = "border-color:#D0D2D3; transition:1s;";
        var yellowBorder = "border: 2px solid #FBFF02;";


        function validateEmail(email){
            var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
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
            if (document.getElementById('phone').value=='' || document.getElementById('phone').value.length < 10){
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
                <p><font color="#FFFFFF">Your SIR</font></p>
            </div>
            <div class="menu">
                 <nav>
                    <ul>
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
    <div class="mainBody" style="height:;">
        <div class="wrap">
        <div class="toogleBox">
            <div class="twoTabs">
                <div class="tab" id="login" onclick="window.location='login.php'">
                    <p>Login</p>
                </div>

                <div class="tab active" id="signUp" >
                    <p>SignUp</p>
                </div>
                <div class="clearFix"></div>
            </div>

            <div class="form">
                <center>
                 <div class="showMsg"><?php echo $msg; ?></div>
                <form class="" id="signUpForm" method="post" action="SQLRegister.php" onsubmit="return checkAll();">

                    <input type="text" id="name" class="inputBox1" name="name" placeholder="Enter Name" onfocus="removeRedborder(id)" onblur='checkNull(id)'/>
                    <input type="text" class="inputBox1" name="email" placeholder="Enter Email" id="email" onfocus="removeRedborder(id)" onblur='checkNull(id)'/>


                    <input type="password" class="inputBox1" name="password" placeholder="Enter password" onfocus="removeRedborder(id)"  id="password" onblur='checkNull(id)'/>

                    <textarea class="inputBox1" name="address" placeholder="Enter Address" rows="5" id="address" onfocus="removeRedborder(id)" onblur='checkNull(id)'></textarea>

                    <input type="text" class="inputBox1" name="city" placeholder="Enter City" id="city" onfocus="removeRedborder(id)" onblur='checkNull(id)'/>

                    <input type="text" size=10 maxlength=10 class="inputBox1" name="phone" placeholder="Enter Phone No" id="phone" onblur='checkNull(id)' onfocus="removeRedborder(id)" onkeypress='return isNumber(event)'/>

                    <input type="submit" class="inputBox1 " value="Register"  style="width:100%;"/>

                </form>
                </center>
            </div>
        </div>
        <div class="clearFix"></div>
        </div>
    </div><!--End of Main Body-->
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
