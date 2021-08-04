<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login/");
    exit;
} else {
	$username = $_SESSION["username"]; 
}
?>
<!doctype html>
<html>
<head>
<title>Add Record</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include('../header.php');
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
?>
<center><strong>You are about to add a record.</strong></center><br/>
<table border="1" cellpadding="10" align="center">
<form name="record" action="../record/" method="post">
<tr><td align="center"><input type="text" name="date" value="<?php
	date_default_timezone_set('America/Los_Angeles');
	$date = date("Y-m-d H:i:s");
	echo $date;	
?>"/>
</td></tr>
<tr><td align="center">
<select name="category">
<option>Category?</option>
<?php
foreach($categories as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
<input type="text" name="who" placeholder="Who?" /><br/>
<input type="text" name="amount" placeholder="Amount?" /><br/>
<select name="bill">
<option>Is this a bill?</option>
<?php
foreach($bills as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center"><input type="submit" name="add" value="Add!" /></td></tr>
</form>
</table>
<br/>
<center><a href="../custom/">Edit Classifications</a><br/></center>
<br/>
<center><a href="../">Dashboard</a><br/></center>
<?php
include('../footer.php');
?>
</body>
</html>