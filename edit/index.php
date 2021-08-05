<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/");
    exit;
} else {
	$username = $_SESSION["username"]; 
}
?>
<!doctype html>
<html>
<head>
<title>Expendor | Edit Record</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a href="http://localhost/expendor/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<span class="fs-4">Expendor</span>
</a>

<ul class="nav nav-pills">
<li class="nav-item"><a href="http://localhost/expendor/dashboard/" class="nav-link">Dashboard</a></li>
<li class="nav-item"><a href="http://localhost/expendor/log/" class="nav-link">Expense Log</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
<?php
include('../header.php');

if($conn == true){
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);

	if(isset($_POST["edit"])) {
  		if(isset($_POST['uid'])){
			$date = $_POST['uid'];
			$type = $_POST['type'];
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
<select name="currency">
<option>Currency?</option>
<?php
foreach($currencies as $key => $value):
echo '<option ';
if($_POST['currency'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
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
<tr><td align="center">
<select name="type">
<option>Tracking?</option>
<option 
<?php if($type == 0){echo 'selected ';}?>
value="0">This is payment.</option>
<option 
<?php if($type == 1){echo 'selected ';}?>
value="1">I owe this.</option>
</select>
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
<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Bill</strong></th><th></th></tr>
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
<center><a href="../dashboard/">Dashboard</a><br/></center>
<?php
	}
}
include('../footer.php');
?>
<footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Expendor</p>
</footer>
</body>
</html>