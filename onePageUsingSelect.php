<?php
	$array=array(1,2);
	$getId=$_GET['id'];
	if(isset($getId)){
		$foundId=TRUE;
	}
	else{
		$foundId=FALSE;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Show Div using Select box </title>
</head>
<body>
<center>
<form method="GET">
<select name='id' required="required">
	<option value="">SELECT ANY</option>
<?php 
	//HERE you can run a database value fatching and run a while loop like
	//while($row=mysqli_fetch_assoc($resultSet)){
	foreach($array as $value){ 
?>
	<option value="<?php echo $value;?>">Div <?php echo $value;?> </option>
<?php
}//End of foreach loop. 
?>
</select>
<input type="submit" name="" value="SHOW DIV">
</select>
</form>
<?php
	if($foundId && $getId==1){
?>
	<div style="border: 1px solid red; color: red; height:50px; width: 50%;">
		<p>This is Div 1</p>
	</div>
<?php
}
elseif($foundId && $getId==2){
?>
	<div style="border: 1px solid green; color: green; height:50px; width: 50%;">
		<p>This is Div 2</p>
	</div>
<?php
}
?>

</center>
</body>
</html>