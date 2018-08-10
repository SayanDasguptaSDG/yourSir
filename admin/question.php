<?php
require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
	$subjectSql = "SELECT * FROM mst_subject WHERE enable = 1";
	$subjectResult=mysqli_query($con,$subjectSql);
	if(isset($_GET['sid']))
	{
		$sid=$_GET['sid'];
		$showTest = true;
		$sql = "SELECT * FROM mst_test where enable=1 AND sub_id=(SELECT id FROM mst_subject WHERE id = '".$_GET['sid']."' AND enable=1) order by test_name";
		$result = mysqli_query($con,$sql);
	}
	else{
		$sid='';
		$showTest = false;
	}
    if(isset($_GET['sid'])&&isset($_GET['tid'])){
        $questionCountSQL = "SELECT total_question FROM mst_test WHERE id = '".$_GET['tid']."'";
        $questionCountResult = mysqli_query($con,$questionCountSQL);
        $totalQuestion = mysqli_fetch_assoc($questionCountResult);
        $showQuestion=true;
        $questionSql = "SELECT * FROM mst_question WHERE enable=1 AND test_id = '".$_GET['tid']."'";
        $allQuestion = mysqli_query($con,$questionSql);

    }
    else{
        $showQuestion = false;
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>YourSir | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/adminCss.css"/>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script>
        window.onload=function (){
        var subjectBox = document.getElementById('subjectName');
        var testBox = document.getElementById('testName');
            subjectBox.value = '<?php
                                if(isset($_GET['sid']))
                                {
                                    echo $_GET['sid'];
                                }
                                ?>';
            testBox.value = '<?php
                                if(isset($_GET['tid']))
                                {
                                    echo $_GET['tid'];
                                }
                                ?>';
        };
        function selectSubject(){
			if(document.getElementById("subjectName").value != ''){

				document.getElementById("selectSubjectForm").submit();

			}

		}
        function edit(id){
            var qusid = id.split('_')
            document.getElementById("saveChange").style.display='block';
            document.getElementById('qus_'+qusid[1]).removeAttribute('readonly');
            document.getElementById('ans1_'+qusid[1]).removeAttribute('readonly');
            document.getElementById('ans2_'+qusid[1]).removeAttribute('readonly');
            document.getElementById('ans3_'+qusid[1]).removeAttribute('readonly');
            document.getElementById('ans4_'+qusid[1]).removeAttribute('readonly');
            document.getElementById('correct_'+qusid[1]).removeAttribute('readonly');
        }
        function del(id){
           var qusid = id.split('_');
           /*var Id = '<?php echo $sid; ?>';*/

				var confirm = window.confirm("Are you sure to delete this Question?");
				if(confirm){
					window.location = "SQLquestion.php?action=del&<?php echo 'sid='.$_GET['sid'].'&tid='.$_GET['tid'];  ?>&qid="+qusid[1];
				}
        }
        function saveChange(){
            document.getElementById('qustion').submit();
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
			<a href="home.php">Home</a>
			<a href="logout.php">Logout</a>
		</div>
		<div class="clearFix"></div>
	</div><!--End of Wrap-->
	</div> <!--End Of Header--><div class="mainBody">
		<div class="wrap">
			<div class="heading lightYellow">Subjects</div>
<!--			<hr style="border-color:#F2F2F2; margin-bottom:1vh;"/>-->

			<center>
			<div class="addNewBox">
				<form method="get" action="question.php" id="selectSubjectForm">
					<label for="subjectName" class="yellowBorder">
						Select Subject
					</label>
					<select name="sid" class="inputBox1 bottomBorder yellowBorder selectBox" id="subjectName">
						<option value="">SELECT SUBJECT</option>
					<?php
						while($eachSubject = mysqli_fetch_assoc($subjectResult))
						{
							echo "<option value='".$eachSubject['id']."'>".$eachSubject['sub_name']."</option>";

						}


					?>
					</select>
                    <br/>
                    <?php
                        if($showTest){
                    ?>
                    <label for="testName" class="yellowBorder">
						Test Name
					</label>
					<select name="tid" class="inputBox1 bottomBorder yellowBorder selectBox" id="testName">
						<option value="">SELECT Test</option>
					<?php
						while($eachTest = mysqli_fetch_assoc($result))
						{
							echo "<option value='".$eachTest['id']."'>".$eachTest['test_name']."</option>";
						}
					?>
					</select>
					<?php
                        }
                    ?>
				</form>

			</div>

			<div class="addNewBtn yellowBorder yellowHover" onclick="selectSubject()">Submit</div>

			<div class="clearFix"></div>
			<?php
				if($showQuestion){
			?>
			<div class="questionList">
                <p style="font-size:4vh;" class="skyBlue">Question List</p>
            <form id="qustion" method="post" action="SQLquestion.php?action=edit&<?php echo 'sid='.$_GET['sid'].'&tid='.$_GET['tid'];  ?>">
				<table class="questionList" border="0">
				<?php
					if(($questionCount = mysqli_num_rows($allQuestion))>0){
						while($row=mysqli_fetch_assoc($allQuestion)){
                ?>

                    <tr class="tableCol">
                        <td><input name='qid[]' value="<?php echo $row['id'];?>" hidden="hidden">
                            <input  readonly class="question_box" type="text" name="qus[]" id="<?php echo "qus_".$row['id'];?>" value="<?php echo $row['ques_details']; ?>" required></td>

                        <td class="" rowspan="5"><input type="button" class="" id="edit_<?php echo $row['id'];?>" value="Edit" onclick="edit(id)">
                        <input type="button" class="" id="del_<?php echo $row['id'];?>" value="Delete" onclick="del(id)">
                        </td>
                    </tr>

                    <tr><td><input readonly class="question_box" type="text" name="ans1[]" id="<?php echo "ans1_".$row['id'];?>" value="<?php echo $row['ans1']; ?>" required></td></tr>
                    <tr><td><input  readonly class="question_box" type="text" name="ans2[]" id="<?php echo "ans2_".$row['id'];?>" value="<?php echo $row['ans2']; ?>" required></td></tr>
                    <tr><td><input  readonly class="question_box" type="text" name="ans3[]" id="<?php echo "ans3_".$row['id'];?>" value="<?php echo $row['ans3']; ?>" required></td></tr>
                    <tr><td><input  readonly class="question_box" type="text" name="ans4[]" id="<?php echo "ans4_".$row['id'];?>" value="<?php echo $row['ans4']; ?>" required></td></tr>

                     <tr><td><span style="color:#4EB509">Correct Ans:</span><input  readonly class="question_box" style="width: 30vw;" type="number" max="4" min="1" name="correct[]" id="<?php echo "correct_".$row['id'];?>" value="<?php echo $row['correct_ans']; ?>" required></td></tr>


                <?php
                        }
                ?>
				</table>
                <input type="submit" class="addNewBtn yellowBorder yellowHover" id="saveChange" onclick="saveChange()" style="display:none; margin:3vh 1vw; width:20vw;" value="Save Changes"/>

                <?php
                    }else
                        echo "<p style='color:#EE2828;font-size:4vh'>No Question Found</p>";

				?>

            </form>
			</div>

			<div class="addQuestionBox">
                <?php
                    if(($addQusCount = $totalQuestion['total_question'] - $questionCount)>0){
                ?>
                <p style="font-size:4vh;" class="skyBlue">Add Question</p>
				<form method="post" action="SQLquestion.php?action=addNew&<?php echo 'sid='.$_GET['sid'].'&tid='.$_GET['tid'];?>" id="addNewForm">
				<?php
                    for($i=0;$i<$addQusCount;$i++){
                ?>
                    <table border="0" style="margin:4vh 0 4vh 0;">
                    <tr class="tableCol">
                    <td>
                        <label for="question" class="yellowBorder">
						Question
					   </label>
                    </td>
                    <td><input class="question_box" type="text" name="qus[]" id="<?php echo "qus_".$row['id'];?>" value="<?php echo $row['ques_details']; ?>" required></td>
                    </tr>

                    <tr>
                    <td>
                        <label for="ans1" class="yellowBorder">
						Option 1
					   </label>
                    </td>
                    <td><input  class="question_box" type="text" name="ans1[]" id="<?php echo "ans1_".$row['id'];?>" value="<?php echo $row['ans1']; ?>" required></td></tr>
                    <tr>
                    <td>
                        <label for="ans2" class="yellowBorder">
						Option 2
					   </label>
                    </td>
                    <td><input   class="question_box" type="text" name="ans2[]" id="<?php echo "ans2_".$row['id'];?>" value="<?php echo $row['ans2']; ?>" required></td></tr>
                    <tr>
                    <td>
                        <label for="ans3" class="yellowBorder">
						Option 3
					   </label>
                    </td>
                    <td><input   class="question_box" type="text" name="ans3[]" id="<?php echo "ans3_".$row['id'];?>" value="<?php echo $row['ans3']; ?>" required></td></tr>
                    <tr>
                    <td>
                        <label for="ans4" class="yellowBorder">
						Option 4
					   </label>
                    </td>
                    <td><input   class="question_box" type="text" name="ans4[]" id="<?php echo "ans4_".$row['id'];?>" value="<?php echo $row['ans4']; ?>" required></td></tr>

                     <tr>
                    <td>
                        <label for="ans1" class="yellowBorder">
                            <span style="color:#4EB509">Correct Ans:</span>
                        </label>
                    </td>
                    <td><input  class="question_box" style="width: 30vw;" type="number" max="4" min="1" name="correct[]" id="<?php echo "correct_".$row['id'];?>" value="<?php echo $row['correct_ans']; ?>" required></td></tr>

				    </table>

                <?php

                    }
                ?>
				<input type="submit" class="addNewBtn yellowBorder yellowHover" onclick="addNewTest()" value="Add New Tests"/>
				</form>
            <?php
                    }
            ?>
            </div>

			<?php

                }
			?>
                </div>

	</center>
	</div>
	<div class="footer">
		<div class="wrap">
			<div class="footNote">
					<p>Designed and Developed by Sayan Dasgupta, Subhashis Pal and Sourav Banerjee </p>
			</div>
		</div>
	</div>
</div><!--End of wrapper-->
</body>
</html>
