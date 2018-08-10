<?php
	require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }

	$sql = "SELECT * FROM mst_subject where enable = 1 order by sub_name";
	$result = mysqli_query($con,$sql);


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

				document.getElementById('editSubName').value=document.getElementById('subName'+array[1]).innerHTML;

				document.getElementById('editSubId').value = array[1];

				document.getElementById('editDiv').scrollIntoView();
			}else if(array[0]=='del'){
				var subName = document.getElementById('subName'+array[1]).innerHTML;
				var confirm = window.confirm("Are you sure to delete "+subName+"\n(All it's test will be deleted)");
				if(confirm){
					window.location = "SQLsubject.php?action=del&subId="+array[1];
				}
			}
		}
		function addNewSubject(){
			if(document.getElementById("subjectName").value != ''){

				document.getElementById("addNew").submit();

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
			<div class="heading lightYellow">Subjects</div>
<!--			<hr style="border-color:#F2F2F2; margin-bottom:1vh;"/>-->

			<center>
			<div class="addNewBox">
				<form method="post" action="SQLsubject.php?action=addNew" id="addNew">
					<label for="subjectName" class="yellowBorder">
						Subject Name
					</label>
					<input type="text" placeholder="Subject Name" class="inputBox1 yellowFocus fullBorder yellowBorder" id="subjectName" name="subjectName" style="width:45vw;margin:0 3% 3% 3%;"/>
				</form>
			<div class="addNewBtn yellowBorder yellowHover" onclick="addNewSubject()">Add New Subject</div>
			</div>
			<div class="clearFix"></div>
			<div class="subjectList">
				<table class="subjectList">
				<thead><tr><th colspan="4" class="skyBlue" style="padding:2vh;color: #2399D5;">SUBJECT LIST</th></tr></thead>
				<tbody>
				<tr>
<!--					<th>ID</th>-->
					<th>Subject Name</th>
					<th>No of test</th>
					<th>Option</th>
				</tr>
				<?php

					while($row=mysqli_fetch_assoc($result)){
						$count = mysqli_num_rows(mysqli_query($con,"SELECT * FROM mst_test WHERE sub_id =".$row['id']));
						echo "<tr class='tableRow'>"	;
//						echo "<td class='tableCol' id='id".$row['id']."'>".$row['id']."</td>";
						echo "<td class='tableCol' id='subName".$row['id']."'>".$row['sub_name']."</td>";
						echo "<td class='tableCol'>".$count."</td>";
				?>
						<td class="tableCol"><input type="button" class="" id="edit_<?php echo $row['id'];?>" value="Edit" onclick="goToPage(id)">
						<input type="button" class="" id="del_<?php echo $row['id'];?>" value="Delete" onclick="goToPage(id)"></td>

				<?php
						echo "</tr>";

					}
				?>
				</tbody>
				</table>
			</div>
			<div class="editDiv" id=editDiv>
				<img src="images/close.png" class="right" onclick="document.getElementById('editDiv').classList.remove('expand');" style="cursor:pointer;">
				<label for="subjectName" class="yellowBorder">
						Edit Subject Name
				</label>
				<form method="post" action="SQLsubject.php?action=edit">
					<input type="text" name="sub_id" id="editSubId" hidden="hidden" readonly />
					<input type="text" name= "sub_name" id="editSubName" class="inputBox1 bottomBorder yellowBorder yellowFocus" placeholder="Edit Subject" />
					<input type="submit" value="SAVE"/>
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
