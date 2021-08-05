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
<title>Expendor | Dashboard</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a href="http://localhost/expendor/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<span class="fs-4">Expendor</span>
</a>

<ul class="nav nav-pills">
<li class="nav-item"><a href="http://localhost/expendor/" class="nav-link active" aria-current="page">Dashboard</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
<?php
include('../header.php');
?>
	<table align="center">
	<tr><td>
	<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to your Expendor dashboard.</h1>
	</td></tr>
	</table>
<?php
if($conn == true){
$fmt = numfmt_create('en_US', NumberFormatter::CURRENCY );
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);

echo '<center><h2>Net Tracking</h2></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr>';
echo '<th align="center" width="10%">Currency</th>';
echo '<th align="center" width="45%"><strong>Income</strong></th>';
echo '<th align="center" width="45%"><strong>Outcome</strong></th>';
echo '</tr>';

foreach($currencies as $key => $value):
echo '<tr>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = 'Income' AND `Type` = '0' AND `Currency` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$income = $row['value_sum'];

$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` != 'Income' AND `Type` = '0' AND `Currency` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$outcome = $income - $row['value_sum'];
	
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` != 'Income' AND `Type` = '1' AND `Currency` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$outcome = $outcome - $row['value_sum'];
echo '<td align="right">' . $value . '</td>';
echo '<td align="center">' . numfmt_format_currency($fmt, $income, $value) . '</td>';
echo '<td align="center">' . numfmt_format_currency($fmt, $outcome, $value) . '</td>';	
echo '</tr>';
endforeach;

echo '</table><br/><hr/><br/><br/>';
echo '<center><h2>Expenses All Time</h2></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';

echo '<tr>';
echo '<th align="center" width="10%"><strong>Currency</strong></th>';
foreach($categories as $key => $value):
echo '<th align="center"><strong>'.$value.'</th>';
endforeach;
echo '</tr>';
	
foreach($currencies as $key => $currency):
echo '<tr>';
echo '<td align="right">' . $currency . '</td>';
foreach($categories as $key => $value):
echo '<td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value' AND `Type` = '0' AND `Currency` = '$currency'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo numfmt_format_currency($fmt, $row['value_sum'], $currency);
echo '</td>';
endforeach;
echo '</tr>';
endforeach;
	
echo '</table><br/><hr/><br/><br/>';
echo '<center><h2>Expenses This Year</h2></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
	
echo '<tr>';
echo '<th align="center" width="10%"><strong>Currency</strong></th>';
foreach($categories as $key => $value):
echo '<th align="center"><strong>'.$value.'</th>';
endforeach;
echo '</tr>';
	
foreach($currencies as $key => $currency):
echo '<tr>';
echo '<td align="right">' . $currency . '</td>';
foreach($categories as $key => $value):
echo '<td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value' AND `Type` = '0' AND `Currency` = '$currency' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo numfmt_format_currency($fmt, $row['value_sum'], $currency);
echo '</td>';
endforeach;
echo '</tr>';
endforeach;
	
echo '</table><br/><hr/><br/><br/>';
echo '<center><h2>Expenses This Month</h2></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
	
echo '<tr>';
echo '<th align="center" width="10%"><strong>Currency</strong></th>';
foreach($categories as $key => $value):
echo '<th align="center"><strong>'.$value.'</th>';
endforeach;
echo '</tr>';

foreach($currencies as $key => $currency):
echo '<tr>';
echo '<td align="right">' . $currency . '</td>';
foreach($categories as $key => $value):
echo '<td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value' AND `Type` = '0' AND `Currency` = '$currency' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo numfmt_format_currency($fmt, $row['value_sum'], $currency);
echo '</td>';
endforeach;
echo '</tr>';
endforeach;
	
echo '</table><br/><hr/><br/><br/>';
echo '<center><h2>Monthly Bill Tracking</h2></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
	
echo '<tr>';
echo '<th align="center" width="10%"><strong>Currency</strong></th>';
foreach($bills as $key => $value):
if ($value == 'This is not a bill.') continue;
echo '<th align="center"><strong>'.$value.'</th>';
endforeach;
echo '</tr>';

foreach($currencies as $key => $currency):
echo '<tr>';
echo '<td align="right">' . $currency . '</td>';
foreach($bills as $key => $value):
if ($value == 'This is not a bill.') continue;
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND `Type` = '0' AND `Currency` = '$currency' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$paid = $row['value_sum'];
echo '<td ';
if($paid > 0){echo 'class="paid"';}
echo ' >';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND `Type` = '1' AND `Currency` = '$currency' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$owed = $row['value_sum'];
echo numfmt_format_currency($fmt, (-$owed + $paid), $currency);
echo '</td>';
endforeach;
echo '</tr>';
endforeach;
	
echo '</table><br/><hr/><br/><br/>';

echo '<center><h2>Expense Log</h2></center><br/>';
$sql = "SELECT * FROM `$username` ORDER BY UID DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($row == null){
echo '<table border="1" cellpadding="10" align="center"><tr><td align="center">';
echo 'No expenses to display.<br/>';
echo '</td></tr></table>';
} else {
echo '<table id="expenses" border="1" cellpadding="10" align="center">';
echo '<tr><th align="center"><strong>When</strong></th><th><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Bill</strong></th><th><strong>Tracking</strong></th><th></th></tr>';
echo'<tbody>';
foreach($result as $row){
$UID = $row['UID'];
$type = $row['Type'];
if($type == 0){
	$typeMessage = "Payment.";
} else {
	$typeMessage = "Debt.";
}
if($UID != 1){
$UID = 'UID';}
echo '<tr><td class="x"><form action="../edit/" method="post"><input type="hidden" name="currency" value="' . $row['Currency'] . '" /><input type="hidden" name="type" value="' . $row['Type'] . '" /><input type="hidden" name="uid" value="' . $row['UID'] . '" />' . $row['UID'] . '</td><td>' . $row['Category'] . '</td><td>' . $row['Who'] . '</td><td>' . numfmt_format_currency($fmt, $row['Amount'], $row['Currency']) . '</td><td>' . $row['Bill'] . '</td><td>' . $typeMessage . '</td><td><input type="submit" name="edit" value="Edit"/><input type="submit" name="delete" value="Delete"/></form></td></tr>';
}
echo '</tbody></table><br/>';

}
echo '<br/>';
echo '<center><a href="../add/">Add expense to database.</a></center>';
echo '<br/>';
echo '<center><a href="../custom/">Edit classifications</a><br/></center>';
echo '<br/>';
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
?>
	<hr/><br/>
	<table align="center">
	<tr><td>
    <p>
        <a href="../reset" class="btn btn-warning">Reset Password</a>
        <a href="../logout" class="btn btn-danger ml-3">Logout</a>
    </p>
	</td></tr>
	</table>
<?php
include('../footer.php');
?>
<footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Expendor</p>
</footer>
</body>
</html>