<?php
    include 'connection.php';
    $errorMsg = "";
	if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
    $tid=base64_decode(urldecode($_GET['tid']));
	if($tid == ''){
		header('location: subject.php');
	}
    $allQuestion=mysqli_query($con,"SELECT * FROM mst_question WHERE test_id=".$tid);
    if(mysqli_num_rows($allQuestion)>0){
        $foundQuestion=TRUE;
		$qc = mysqli_num_rows($allQuestion);

		$checkReview = "SELECT * FROM mst_result WHERE user_name = '".$_SESSION['email']."' AND test_id = '".$tid."'";
		if($query = mysqli_query($con,$checkReview)){
			if(mysqli_num_rows($query)>0){
				header('location:review.php?tid='.urlencode(base64_encode($tid)).'&source='.urlencode(base64_encode("other")));
			}
		}

	}

    else{
        $foundQuestion=FALSE;
		$errorMsg= "No Question Found";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />

    <script>


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
        <div class="wrap" style="width:95%; ">
			<center>
                <p class="headline ">Subject Name:</p>
				<p class="headline" style="font-size:110%;padding-bottom:1%;">Test Name:</p>
			</center>
				<div class="quizBox">
					<div class="clearFix"></div>
					<p class="errorMsg"><?php echo $errorMsg; ?></p>
					<?php
						if ($foundQuestion){
					?>
					<form method="POST" action="<?php echo 'quizSubmit.php?tid='.$_GET['tid']; ?>">
					<?php
						$qusCount=0;
						while($qus= mysqli_fetch_assoc($allQuestion)){
						$qusCount++;
					?>
						<p class="question"><b>Q.&nbsp;&nbsp;</b><?php echo $qus['ques_details']; ?></p>
					<table class="ansTable">
						<tr>
							<td><b>Ans:</b></td>
							<input type="text" hidden="hidden" readonly value="<?php echo $qus['id']; ?>" name="<?php echo 'qid'.$qusCount; ?>">
							<td><input type="radio" class="quizRadioBtn" name="<?php echo 'Q'.$qusCount; ?>" value="1"></td><td><lebel for="quizRadioBtn"><?php echo $qus['ans1'];?></lebel></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="radio" class="ansRadio" name="<?php echo 'Q'.$qusCount; ?>" value="2"></td><td><lebel for="quizRadioBtn"><?php echo $qus['ans2'];?></lebel></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="radio" name="<?php echo 'Q'.$qusCount; ?>" value="3"></td>
							<td><label for="quizRadioBtn"><?php echo $qus['ans3'];?></lebel></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="radio" name="<?php echo 'Q'.$qusCount; ?>" value="4"></td>
							<td><label for="quizRadioBtn"><?php echo $qus['ans4'];?></lebel></td>
						</tr>
					</table>
					<?php
						}

					?>
						<center><input type="submit" class="quizSubmitButton" value="Submit"></center>
					</form>
					<?php
						}
					?>
				</div>
        </div>
    </div>
    <div class="footer">
		<div class="wrap">

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
