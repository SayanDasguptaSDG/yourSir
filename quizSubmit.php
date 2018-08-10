<?php
    include 'connection.php';
    if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
    $tid=base64_decode(urldecode($_GET['tid']));
	if($tid == '' || empty($_POST)){
		header('location: quizLandingPage.php');
	}
	$sess_id =  session_id();
	$allQuestion=mysqli_query($con,"SELECT * FROM mst_question WHERE test_id=".$tid);
    if(mysqli_num_rows($allQuestion)>0){
		$qc = mysqli_num_rows($allQuestion);
        $foundQuestion=TRUE;
		$count = 1;
	}
	else{
		header('location:quizLandingPage.php');
	}
	$values='';
	$rightAns = 0;
	while($row=mysqli_fetch_assoc($allQuestion))
	{

		if(!empty($_POST['Q'.$count])){
			$yourAns = $_POST['Q'.$count];
		}
		else{
			$yourAns = null;
		}
		if($yourAns == $row['correct_ans']){
			$rightAns += 1;
		}

		//createing multirows values string
		$values=$values."('".$_SESSION['id']."','".$sess_id."','".$tid."','".$row['id']."','".$row['ques_details']."','".$row['ans1']	."','".$row['ans2']."','".$row['ans3']."','".$row['ans4']."','".$row['correct_ans']."','".$yourAns."')";

		$count++;
		//prevent to put the ',' after the last value.
		if($count<=$qc){
			$values = $values . ',';
		}
	}

	$score = ($rightAns/$qc)*100;

	$sql = "INSERT INTO mst_useranswer (user_id,sess_id,test_id,ques_id,ques_details,ans1,ans2,ans3,ans4,correct_ans,your_ans) VAlUES ".$values;
	$date = date('Y/m/d');
	$date=date("Y-m-d",strtotime($date));

	$sqlResult = "INSERT INTO mst_result (user_name,test_id,test_date,your_score,qus_count) VALUES('".$_SESSION['email']."','".$tid."','".$date."','".$score."','".$qc."')";
	$submitSuccess = FALSE;
	if(mysqli_query($con,$sql) && mysqli_query($con,$sqlResult)){
		$submitSuccess = TRUE;
	}
	//echo $sqlResult;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />

    <script>
        function goReview(tid){
			window.location = 'review.php?tid='+tid+'&source='+encodeURI(btoa("other"));

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
                        <li><a href="index.php" class="<?php echo ($login?'hide':'show');?>">LOGIN</a></li>
						<li><a href="quizLandingPage.php" class="<?php echo ($login?'show':'hide');?>">LOGOUT</a></li>
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
			<div class="reviewBox">

				Your Score  is <?php echo $score. "%"; ?>
				<br/>
				<br/>
				<input type="button" onclick="goReview('<?php echo $_GET['tid']; ?>')" value="Review">
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
</div>
</body>
</html>
