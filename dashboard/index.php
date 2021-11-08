<?php
include('../header.php');
?>
	<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! Welcome to your <span>&nbsp;Expendor</span> dashboard.</h1>
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
echo '<th align="center" width="45%"><strong>Spent</strong></th>';
echo '<th align="center" width="45%"><strong>Invested</strong></th>';
echo '</tr>';

foreach($currencies as $key => $value):
echo '<tr>';
	
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Type` = '0' AND `Currency` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$spent = $row['value_sum'];
# Total logged income subtracted by total logged expenses equals net remaining balance.
	
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Type` = '1' AND `Currency` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$invested = $row['value_sum'];
# Currency amount of net remaining balance subtracted by amount owed.
	
echo '<td align="right">' . $value . '</td>';
echo '<td align="center">';
	
if($value == 'usd'){
	echo number_format($spent, 2);
} else {
	echo floatval($spent);
}

echo '</td>';
echo '<td align="center">';
if($value == 'usd'){
	echo number_format($invested, 2);
} else {
	echo floatval($invested);
}
echo '</td>';	
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

if($currency == 'usd'){
	echo number_format($row['value_sum'], 2);
} else {
	echo floatval($row['value_sum']);
}
	
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

if($currency == 'usd'){
	echo number_format($row['value_sum'], 2);
} else {
	echo floatval($row['value_sum']);
}
	
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

if($currency == 'usd'){
	echo number_format($row['value_sum'], 2);
} else {
	echo floatval($row['value_sum']);
}

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
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND `Type` = '0' AND `Currency` = '$currency'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$paid = $row['value_sum'];
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND `Type` = '0' AND `Currency` = '$currency' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$monthPaid = $row['value_sum'];
echo '<td ';
if($monthPaid > 0){echo 'class="paid"';}
echo ' >';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND `Type` = '1' AND `Currency` = '$currency'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$owed = $row['value_sum'];

if($currency == 'usd'){
	echo number_format($owed - $paid, 2);
} else {
	echo floatval($owed - $paid);
}
	
echo '</td>';
endforeach;
echo '</tr>';
endforeach;
	
echo '</table><br/><br/>';

echo '<br/>';
echo '<center><a class="btn btn-warning" href="../log/">Log</a> ';
echo '<a class="btn btn-warning" href="../add/">Add Expense</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit Classifications</a><br/></center>';
echo '<br/>';
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
include('../footer.php');
?>