<!doctype html>
<html>
<head>
<title>Delete Record</title>
<link href="../style.css" rel="stylesheet" />
</head>
<body>
<center><strong>You are about to delete a record.</strong></center><br/>
<form name="delete" action="../submit/" method="post">
<table border="1" cellpadding="10" align="center">
<?php
	if(isset($_POST['uid'])){
		$date = $_POST['uid'];
?>		
<tr><td align="center" class="x">
<input type="hidden" name="date" value="<?php echo $date; ?>" /><?php echo $date; ?><br/>
</td></tr>	
<?php
	}
?>
<tr><td align="center"><input type="submit" value="Delete!" /></td></tr>
</table>
</form>
<br/>
<center><a href="../">Public Records</a><br/></center>
</body>
</html>