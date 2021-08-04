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
<title>Edit Record</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
<?php
include('../header.php');

if($conn == true){
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);

	if(isset($_POST["edit"])) {
  		if(isset($_POST['uid'])){
			$date = $_POST['uid'];
			$sql = "SELECT * FROM `$username` WHERE `uid` = '$date'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
?>
	
<center><strong>You are about to edit a record.</strong></center><br/>
<table border="1" cellpadding="10" align="center">
<form name="record" action="../record/" method="post">
<tr><td align="center"><input type="text" name="date" value="<?php echo $date; ?>"/>
</td></tr>
<tr><td align="center">
<select name="category">
<option>Category?</option>
<?php
foreach($categories as $key => $value):
echo '<option ';
if($row['Category'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center">
<input type="text" name="who" placeholder="Who?" value="<?php echo $row['Who']; ?>" /><br/>
</td></tr>
<tr><td align="center">
<input type="text" name="amount" placeholder="Amount?" value="<?php echo $row['Amount']; ?>" /><br/>
</td></tr>
<tr><td align="center">
<select name="bill">
<option>Bill Classification?</option>
<?php
foreach($bills as $key => $value):
echo '<option ';
if($row['Bill'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
</td></tr>
<tr><td align="center"><input type="submit" name="update" value="Update!" /></td></tr>
</form>
</table>
<br/>
<center><a href="../">Dashboard</a><br/></center>
	
<?php
  			}
	}
	
		if(isset($_POST["delete"])) {
?>
<center><strong>You are about to delete a record.</strong></center><br/>
<form name="delete" action="../submit/" method="post">
<table border="1" cellpadding="10" align="center">
<?php
  		if(isset($_POST['uid'])){
			$date = $_POST['uid'];
			$sql = "SELECT * FROM `$username` WHERE `uid` = '$date'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
?>
<tr><td align="center"><strong>Datetime</strong></td><td align="center"><strong>Category</strong></td><td align="center"><strong>Who</strong></td><td align="center"><strong>Amount</strong></td><td align="center"><strong>Bill</strong></td></tr>
<tr><td align="center" class="x">
<input type="hidden" name="date" value="<?php echo $date; ?>" /><?php echo $date; ?>
</td>
<td>
<?php echo $row['Category']; ?>
</td>
<td>
<?php echo $row['Who']; ?>
</td>
<td>
<?php echo number_format($row['Amount'], 2, '.', ','); ?>
</td>
<td>
<?php echo $row['Bill']; ?>
</td>
<?php
  		}
?>
<td align="center"><input type="submit" value="Delete!" /></td></tr>
</table>
</form>
<br/>
<center><a href="../">Dashboard</a><br/></center>
<?php
	}
}
include('../footer.php');
?>
</body>
</html>