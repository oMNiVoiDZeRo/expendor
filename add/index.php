<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
# str_getcsv to get categories and bills from user table in database.
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
print_r($categories);
echo '<br/>';
print_r($bills);
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
echo '<option value="'.$key.'">'.$value.'</option>'; //close your tags!!
endforeach;
?>
</select>
<input type="text" name="who" placeholder="Who?" /><br/>
<input type="text" name="amount" placeholder="Amount?" /><br/>
<select name="bill">
<option>Is this a bill?</option>
<?php
foreach($bills as $key => $value):
echo '<option value="'.$key.'">'.$value.'</option>'; //close your tags!!
endforeach;
?>
</select>
</td></tr>
<tr><td align="center"><input type="submit" value="Add!" /></td></tr>
</form>
</table>
<br/>
<center><a href="../">Dashboard</a><br/></center>
<?php
include('../footer.php');
?>
</body>
</html>