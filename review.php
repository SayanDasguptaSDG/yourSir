<?php
	include 'connection.php';
$errorMsg = '';
    if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
    $tid=base64_decode(urldecode($_GET['tid']));
	if($tid == ''){
		header('location: quizLandingPage.php');
	}
	if(base64_decode(urldecode($_GET['source']))=="fromResult"){
		$source='fromResult';
	}
	else{
		$source='other';
	}
	$sql = "SELECT * FROM mst_useranswer WHERE test_id='".$tid."' AND user_id='".$_SESSION['id']."'";
 	$allQuestion=mysqli_query($con,$sql);
    if(mysqli_num_rows($allQuestion)>0){
        $foundQuestion=TRUE;
	//	$qc = mysqli_num_rows($allQuestion);
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

				<?php
				if($source=="fromResult"){
				?>
					<a href='result.php'><p class='backlink'><font color=''>&larr;&nbsp;&nbsp;Back To Results</font></p></a>
				<?php
				}
				elseif($source == 'other'){
				?>
					<a href='subject.php'><p class='backlink'><font color=''>&larr;&nbsp;&nbsp;Back To Subjects</font></p></a>
				<?php
				}
				?>
			</center>
				<div class="quizBox">
					<div class="clearFix"></div>
					<p class="errorMsg"><?php echo $errorMsg; ?></p>
					<?php
						if ($foundQuestion){
							while($qus= mysqli_fetch_assoc($allQuestion)){
					?>
								<p class="question"><b>Q.&nbsp;&nbsp;</b><?php echo $qus['ques_details']; ?></p>
								<table class="ansTable">
								<tr>
									<td><b>Ans:</b></td>
									<td><lebel for="quizRadioBtn">1) <?php echo $qus['ans1'];?></lebel></td>
									<td><?php
									echo ($qus['your_ans']==1 && $qus['correct_ans']==1)? '<img src="images/right.png" class="remark"/>':'';

									echo ($qus['your_ans']==1 && $qus['correct_ans']<>1)? '<img src="images/wrong.png" class="remark"/>':'';
									?>
									</td>
								</tr>

								<tr>
									<td></td>
									<td><lebel for="quizRadioBtn">2) <?php echo $qus['ans2'];?></lebel></td>
									<td><?php
									echo ($qus['your_ans']==2 && $qus['correct_ans']==2)? '<img src="images/right.png" class="remark"/>':'';

									echo ($qus['your_ans']==2 && $qus['correct_ans']<>2)? '<img src="images/wrong.png" class="remark"/>':'';

										?></td>
								</tr>
								<tr>
									<td></td>
									<td><lebel for="quizRadioBtn">3) <?php echo $qus['ans3'];?></lebel></td>
									<td><?php echo ($qus['your_ans']==3 && $qus['correct_ans']==3)? '<img src="images/right.png" class="remark"/>':'';

									echo ($qus['your_ans']==3 && $qus['correct_ans']<>3)? '<img src="images/wrong.png" class="remark"/>':''; ?></td>
								</tr>
								<tr>
									<td></td>
									<td><lebel for="quizRadioBtn">4) <?php echo $qus['ans4'];?></lebel></td>
									<td><?php echo ($qus['your_ans']==4 && $qus['correct_ans']==4)? '<img src="images/right.png" class="remark"/>':'';

									echo ($qus['your_ans']==4 && $qus['correct_ans']<>4)? '<img src="images/wrong.png" class="remark"/>':''; ?></td>
								</tr>
								</table>
									<td colspan="4"><p class="question">Correct Ans: Option <?php echo $qus['correct_ans'];?></p></td>
					<?php
							}
						}
					?>
				</div>
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
