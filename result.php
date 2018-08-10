<?php
	include 'connection.php';
    $msg ='';
	$foundResult ='';
	if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
	$user_name = $_SESSION['email'];

	$sql="SELECT * FROM mst_result WHERE user_name='".$user_name."' ORDER BY test_date";
	if($result = mysqli_query($con,$sql)){
		if(mysqli_num_rows($result)>0){
			$foundResult=TRUE;

		}
		else{
			$msg = "No tests have been done yet. ";
		}
	}
	else{
		echo "<script>alert('Error in SQL Query.');</script>";
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
        function expand(id){
			document.getElementById(id).children[2].classList.toggle('expand');
		};
		function goReviewPage(id){
			var source = encodeURI(btoa("fromResult"));
			window.location="review.php?tid="+id+"&source="+source;
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
			<?php
				if($foundResult){
				while($row=mysqli_fetch_assoc($result)){
						$getTestName = mysqli_query($con,"SELECT * FROM mst_test WHERE id = '".$row['test_id']."'");
						$testName = mysqli_fetch_assoc($getTestName);
						$date = date('d-M-Y',strtotime($row['test_date']));

			?>
						<div class="testBox" id="<?php echo 'test'.$row['test_id']; ?>" style="animation:none;opacity:1;" onclick="expand(id)">
							<div class="resultBoxTitle"><?php echo $testName['test_name']; ?></div>
							<div class="clearFix"></div>
							<div class="resultDetails" id="resultDetails">

								<hr style="border: 1px solid #EAEAEA" />

							<p style="margin-top:3%;"><span class="blueFont">Total Question:</span><span class="yellowFont"><?php echo $row['qus_count']; ?></span> </p>

							<p style="margin:2%;"><span class="blueFont">Date Of Quiz:</span><span class="yellowFont"><?php echo $date; ?></span> </p>

							<p style="margin:2%;"><span class="blueFont">Total Score:</span><span class="yellowFont"><?php echo $row['your_score']; ?>%</span> </p>

							<input type="button" id="<?php echo urlencode(base64_encode($row['test_id'])); ?>" class="quizSubmitButton" onclick="goReviewPage(id)" value="Review" style="margin-bottom:3%;"/>
						</div>
						</div>
				<?php

				}
				}else{
				?>
					<font color="red">Please Play Some Quiz First.</font>
				<?php
				}
				?>
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
</div>
</body>
</html>
