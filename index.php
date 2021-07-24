<!doctype html>
<html>
<head>
<title>Expendor</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<?php
include('header.php');
if($conn == true){
echo '<center><strong>Expenses All Time</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>Income</strong></td><td align="center"><strong>Food</strong></td><td align="center"><strong>Health</strong></td><td align="center"><strong>Home</strong></td><td><strong>Auto</strong></td><td><strong>Insurance</strong></td><td><strong>Utility</strong></td><td><strong>Loan</strong></td><td><strong>Work</strong></td><td><strong>Entertainment</strong></td></tr>';
echo '<tr><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Income'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Food'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Health'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Home'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Auto'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Insurance'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Utility'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Loan'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Work'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Entertainment'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td></tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Expenses This Year</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>Income</strong></td><td align="center"><strong>Food</strong></td><td align="center"><strong>Health</strong></td><td align="center"><strong>Home</strong></td><td><strong>Auto</strong></td><td><strong>Insurance</strong></td><td><strong>Utility</strong></td><td><strong>Loan</strong></td><td><strong>Work</strong></td><td><strong>Entertainment</strong></td></tr>';
echo '<tr><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Income' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Food' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Health' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Home' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Auto' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Insurance' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Utility' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Loan' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Work' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Entertainment' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td></tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Expenses This Month</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>Income</strong></td><td align="center"><strong>Food</strong></td><td align="center"><strong>Health</strong></td><td align="center"><strong>Home</strong></td><td><strong>Auto</strong></td><td><strong>Insurance</strong></td><td><strong>Utility</strong></td><td><strong>Loan</strong></td><td><strong>Work</strong></td><td><strong>Entertainment</strong></td></tr>';
echo '<tr><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Income' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Food' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Health' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Home' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Auto' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Insurance' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Utility' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Loan' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Work' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Category` = 'Entertainment' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td></tr>';
echo '</table><br/><br/>';

echo '<center><strong>Monthly Bill Tracking</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>Rent</strong></td><td align="center"><strong>Electric</strong></td><td align="center"><strong>Utility</strong></td><td><strong>Home Insurance</strong></td><td><strong>Car Insurance</strong></td><td><strong>Internet</strong></td><td><strong>Phone</strong></td><td><strong>Loan</strong></td><td><strong>Web Hosting</strong></td></tr>';
echo '<tr><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Rent' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Electric' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Utility' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Home Insurance' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Car Insurance' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Internet' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Phone' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Loan' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td><td>';
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `expenses` WHERE `Bill` = 'Web Hosting' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td></tr>';
echo '</table><br/><hr/><br/><br/>';	

echo '<center><strong>Expenses Log</strong></center><br/>';
$sql = "SELECT * FROM `expenses` ORDER BY UID DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($row == null){
echo '<table border="1" cellpadding="10" align="center"><tr><td align="center">';
echo 'No expenses to display.<br/>';
echo '</td></tr></table>';
} else {
echo '<table id="expenses" border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>When</strong></td><td><strong>Category</strong></td><td align="center"><strong>Who</strong></td><td align="center"><strong>Amount</strong></td><td align="center"><strong>Bill</strong></td><td></td></tr>';
echo'<tbody>';
foreach($result as $row){
$UID = $row['UID'];
if($UID != 1){
$UID = 'UID';}
echo '<tr><td class="x"><form action="delete/" method="post"><input type="hidden" name="uid" value="' . $row['UID'] . '" />' . $row['UID'] . '</td><td>' . $row['Category'] . '</td><td>' . $row['Who'] . '</td><td>' . '$' . number_format($row['Amount'], 2, '.', ',') . '</td><td>' . $row['Bill'] . '</td><td><input type="submit" name="delete" value="Delete"/></form></td></tr>';}
echo '</tbody></table><br/>';

}
echo '<br/>';
echo '<center><a href="add/">Add expense to database.</a></center>';
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
include('footer.php');
?>
</body>
</html>