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
            case 'invalidId':
                    $msg="<font color='#F6111D'>Invalid Email Id or Password</font>";
                    break;
            case 'loggedOut':
                    $msg="<font color='#3193F5'>Logged out Successfully</font>";
                    break;
            case 'notLogin':
                    $msg="<font color='#3193F5'>Login First</font>";
                    break;


        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
         var redBorder = "border-color:#FE4551;color:#FE4551;box-shadow: 0px 0px 15px 0px rgba(216, 21, 21, 0.70);moz-box-shadow: 0px 0px 15px 0px rgba(216, 21, 21, 0.70);webkit-box-shadow: 0px 0px 15px 0px rgba(216, 21, 21, 0.70);transition:1s;";
        var greyBorder = "trsnsition:1s";
        function validateEmail(email){
            var re=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function checkNull(id){

            if (document.getElementById(id).value==''){
                document.getElementById(id).style.cssText=redBorder;
                return false;
            }
            else{
                document.getElementById(id).style.cssText='';
                return true;
            }
        }

        function checkAll(){
            var email= document.getElementById('email').value;
            var rtrn = true;
//            if (document.getElementById('name').value==''){
//                document.getElementById('name').style.cssText=redBorder;
//                rtrn = false;
//            }
            if (document.getElementById('email').value==''){
                document.getElementById('email').style.cssText=redBorder;
                rtrn = false;
            }else if(!validateEmail(email)){
                document.getElementById('email').style.cssText=redBorder;
                rtrn = false;

            }

            if (document.getElementById('password').value==''){
                document.getElementById('password').style.cssText=redBorder;
                rtrn = false;
            }
//            if (document.getElementById('address').value==''){
//                document.getElementById('address').style.cssText=redBorder;
//                rtrn = false;
//            }
//            if (document.getElementById('city').value==''){
//                document.getElementById('city').style.cssText=redBorder;
//                rtrn = false;
//            }
//            if (document.getElementById('phone').value==''){
//                document.getElementById('phone').style.cssText=redBorder;
//                rtrn = false;
//            }
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
                        <li><a href="index.php">HOME</a></li>
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
    <div class="mainBody" style="height:600px;">
        <div class="wrap">
        <div class="toogleBox">
            <div class="twoTabs">
                <div class="tab active" id="login">
                    <p>Login</p>
                </div>

                <div class="tab" id="signUp" onclick="window.location='register.php'">
                    <p>SignUp</p>
                </div>
                <div class="clearFix"></div>
            </div>

            <div class="form">
                <center>
                <div class="showMsg"><?php echo $msg; ?></div>
                <form name="loginForm" method="post" action="SQLLogin.php" onsubmit="return checkAll();">
                    <input type="text" class="inputBox1" name="email" id="email" placeholder="Enter Email Address" autocomplete="off" onfocus="defaultBorder(email)" onblur="checkNull(id)"/>

                    <input type="password" class="inputBox1"  name="password" id="password" placeholder="Enter Password" onfocus="password" onblur="checkNull(id)" autocomplete="off" />
                    <br/>
                    <input type="submit" class="inputBox1" value="LOGIN"/>
                </form>
                </center>
            </div>

        </div>
        </div>
    </div><!--End of Main Body-->
    <div class="footer">
        <div class="wrap">
            <div class="footNote">
                <p>Designed And Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
            </div>
        </div>
    </div>
</div><!--End of Wrapper-->
</body>
</html>
