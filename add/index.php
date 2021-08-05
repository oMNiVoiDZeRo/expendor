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
<title>Expendor | Add Record</title>
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
<li class="nav-item"><a href="http://localhost/expendor/log/" class="nav-link">Log</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link active" aria-current="page">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<?php
		if($username != 'test'){
?>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<?php
		}
?>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
<?php
include('../header.php');
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);
?>
<center><strong>You are about to add a record.</strong></center><br/>
<table id="add" border="1" cellpadding="10" align="center">
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
</td></tr>
<tr><td align="center">
<input type="text" name="who" placeholder="Who?" />
</td></tr>
<tr><td  align="center">
<input type="number" name="amount" placeholder="Amount?" />
</td></tr>
<tr><td  align="center">
<select name="currency">
<option>What currency?</option>
<?php
foreach($currencies as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td  align="center">
<select name="bill">
<option>Is this a bill?</option>
<?php
foreach($bills as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td  align="center">
<select name="type">
<option>Tracking?</option>
<option value="0">This is a payment.</option>
<option value="1">I owe this.</option>
</td></tr>
<tr><td align="center"><input type="submit" name="add" value="Add!" /></td></tr>
</form>
</table>
<br/>
<center><a href="../custom/">Edit classifications</a><br/></center>
<br/>
<center><a href="../">Dashboard</a><br/></center>
<?php
include('../footer.php');
?>
<footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Expendor</p>
</footer>
</body>
</html>