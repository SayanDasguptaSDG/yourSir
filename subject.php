<?php
    include 'connection.php';
    if(!isset($_SESSION['email'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
    $foundTest= FALSE;
    $foundSubject=FALSE;
    $errorMsg='';
    if(isset($_GET['sid'])){
        $sid=base64_decode(urldecode($_GET['sid']));
        $allTest=mysqli_query($con,"SELECT * FROM mst_test WHERE sub_id =".$sid);
        if(mysqli_num_rows($allTest)>0){
            $foundTest=TRUE;
        }
        else{
            $errorMsg="No Test Found";
        }
    }
    else{
        $allSubject=mysqli_query($con,"SELECT * FROM mst_subject");
        if(mysqli_num_rows($allSubject)>0){
            $foundSubject=TRUE;
        }
        else{
            $errorMsg="No Subject Found";
        }

    }
    $randColor=array('#9C27B0','#00CC00','#663300','#FF6600','#0288D1','#FF00FF');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Custom Quiz Application</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css" />

    <script>

        function goTest(id){

            window.location='subject.php?sid='+id;
        }
        function goQuiz(id){
            window.location='quiz.php?tid='+id;
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
            <p class="headline blueHeading">SELECT Subject And Tests</p>
            <p class="errorMsg"><?php echo $errorMsg; ?></p>
        <?php
            if($foundSubject){
                while ($row=mysqli_fetch_assoc($allSubject)){
                    $id=urlencode(base64_encode($row['id']));
                    $colorIndex=rand(0,5);
        ?>
                                <div class="subjectBox apearFadein" id="<?php echo $id; ?>" onclick="goTest(id)">

                                    <div class="subjctLogo" style="border-color:<?php echo $selectColor;?>;background:<?php echo $randColor[$colorIndex];?>;">
                                        <p class="logoLetter"><?php echo strtoupper(substr($row['sub_name'],0,1)); ?></p>
                                    </div>

                                    <div class="subjectName">
                                        <p><font color="<?php echo $randColor[$colorIndex];?>;"><?php echo ucwords($row['sub_name']); ?></font></p>
                                    </div>

                                    <div class="clearFix"></div>
                                </div>
        <?php
                }//End of whileLoop
            }//End of IF

            elseif($foundTest){
            ?>

            <?php
                $colorIndex=rand(0,5);
                echo "<a href='subject.php'><p class='backlink'><font color='$randColor[$colorIndex]'>&larr;&nbsp;&nbsp;Back To Subjets</p></a>";
                while ($rowTest=mysqli_fetch_assoc($allTest)){
                    $tid=urlencode(base64_encode($rowTest['id']));
            ?>
                    <div class="testBox appearFadein" id="<?php echo $tid; ?>" onclick="goQuiz(id)">
                        <div class="testName">
                                        <p><font color="<?php echo $randColor[$colorIndex];?>;">Test Name: <?php echo ucwords($rowTest['test_name']); ?></font></p>
                        </div>
                        <div class="qusCount">
                                        <p><font color="<?php echo $randColor[$colorIndex];?>;">Total Question: <?php echo ucwords($rowTest['total_question']); ?> &nbsp;&nbsp;&nbsp;&rarr;</font></p>
                        </div>
                        <div class="clearFix"></div>
                    </div>

        <?php

                }//End of whileLoop
            }//End of IF
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
</div><!--End of Wrapper-->
</body>
</html>
