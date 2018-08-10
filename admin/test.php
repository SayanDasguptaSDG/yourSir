<?php
	require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=true;
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

?>
<!DOCTYPE html>
<html>
<head>
	<title>YourSir | Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="css/adminCss.css"/>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<script>
		function goToPage(id){
			var	array= id.split('_');
			if(array[0]=='edit'){

				document.getElementById('editDiv').classList.add('expand');
				document.getElementById('editTestName').value=document.getElementById('testName'+array[1]).innerHTML;

				document.getElementById('editQusCount').value=document.getElementById('qusCount'+array[1]).innerHTML;
				document.getElementById('editTid').value = array[1];

				document.getElementById('editDiv').scrollIntoView();
			}else if(array[0]=='del'){
				var subId = '<?php echo $sid; ?>';
				var testName = document.getElementById('testName'+array[1]).innerHTML;
				var confirm = window.confirm("Are you sure to delete "+testName+"\n(All it's question will be deleted)");
				if(confirm){
					window.location = "SQLtest.php?action=del&tid="+array[1]+"&sid="+subId;
				}
			}
		}
		function selectSubject(){
			if(document.getElementById("subjectName").value != ''){

				document.getElementById("selectSubjectForm").submit();

			}

		}
		function addNewTest(){

			if(document.getElementById("addTestName").value != '' && document.getElementById('qusCount').value!=''){

				document.getElementById("addNewForm").submit();

			}
		}
		function editTest(){
			if(document.getElementById("editTestName").value != '' && document.getElementById('editQusCount').value!='' && document.getElementById('editQusCount').value!=0)
			{
			document.getElementById("editForm").submit();
			}
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
	</div> <!--End Of Header-->

	<div class="mainBody">
		<div class="wrap">
			<div class="heading lightYellow">Tests</div>
<!--			<hr style="border-color:#F2F2F2; margin-bottom:1vh;"/>-->

			<center>
			<div class="addNewBox">
				<form method="get" action="test.php" id="selectSubjectForm">
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

				</form>

			</div>

			<div class="addNewBtn yellowBorder yellowHover" onclick="selectSubject()">Show Tests</div>

			<div class="clearFix"></div>
			<?php
				if($showTest){
			?>
			<div class="testList">
				<table class="subjectList">
				<thead><tr><th colspan="4" class="skyBlue" style="padding:2vh;color: #2399D5;">SUBJECT LIST</th></tr></thead>
				<tbody>
				<tr>
<!--					<th>ID</th>-->
					<th>Test Name</th>
					<th>No of Questions</th>
					<th>Option</th>
				</tr>
				<?php
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							echo "<tr class='tableRow'>"	;
	//						echo "<td class='tableCol' id='id".$row['id']."'>".$row['id']."</td>";
							echo "<td class='tableCol' id='testName".$row['id']."'>".$row['test_name']."</td>";
							echo "<td class='tableCol' id='qusCount".$row['id']."'>".$row['total_question']."</td>";
				?>
							<td class="tableCol"><input type="button" class="" id="edit_<?php echo $row['id'];?>" value="Edit" onclick="goToPage(id)">
							<input type="button" class="" id="del_<?php echo $row['id'];?>" value="Delete" onclick="goToPage(id)"></td>

				<?php
							echo "</tr>";

						}
					}else{
						echo "<tr><td class='tableCol' colspan=3><font color='red'>No Test Found</font></td></tr>";
					}
				?>
				</tbody>
				</table>
			</div>
			<div class="addNewBox">
				<form method="post" action="SQLtest.php?action=addNew&sid=<?php echo $sid;?>" id="addNewForm">
					<input type="text" hidden="hidden" readonly value="<?php echo $_GET['sid'];?>" name="sid">
					<table border="0">
						<tr>
							<td><label for="testName" class="yellowBorder">
								Test Name
							</label></td>

						<td>
							<input type="text" placeholder="Test Name" class="inputBox1 yellowFocus fullBorder yellowBorder" id="addTestName" name="testName" style="width:30vw;margin:1% 0% 1% 0%;"/><br/>
						</td>
						</tr>
						<tr>
							<td><label for="testName" class="yellowBorder">
								No of Question
							</label></td>
							<td><input type="number" placeholder="No of Question" class="inputBox1 yellowFocus fullBorder yellowBorder" id="qusCount" name="qusCount" style=""></td>
						</tr>
				</table>
				</form>
				<div class="addNewBtn yellowBorder yellowHover" onclick="addNewTest()">Add New Tests</div>
			</div>

			<?php
				}
			?>
			<div class="editDiv" id=editDiv>
				<img src="images/close.png" class="right" onclick="document.getElementById('editDiv').classList.remove('expand');" style="cursor:pointer;">
				<form method="post" action="SQLtest.php?action=edit&sid=<?php echo $sid;?>" id="editForm">
					<input type="text"  readonly hidden="hidden" id='editTid' name="editTid">
					<table border="0">
						<thead>
							<tr><th colspan=2 class="yellowBorder">Edit Test Name</th></tr>
						</thead>
						<tr>
							<td><label for="testName" class="yellowBorder">
								Test Name
							</label></td>

						<td>
							<input type="text" placeholder="Test Name" class="inputBox1 yellowFocus fullBorder yellowBorder" id="editTestName" name="editTestName" style="width:30vw;margin:1% 0% 1% 0%;"/><br/>
						</td>
						</tr>
						<tr>
							<td><label for="testName" class="yellowBorder">
								No of Question
							</label></td>
							<td><input type="number" placeholder="No of Question" class="inputBox1 yellowFocus fullBorder yellowBorder" id="editQusCount" name="editQusCount" style=""></td>
						</tr>
						<tr>
							<td colspan=2 align='center'><div class="addNewBtn yellowBorder yellowHover" onclick="editTest()">Save</div></td>
						</tr>
				</table>
				</form>
			</div>

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
</div><!--End of wrapper-->
</body>
</html>
