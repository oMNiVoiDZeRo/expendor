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
<title>Expendor</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php
include('header.php');
?>
	<table align="center">
	<tr><td>
	<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your dashboard.</h1>
	</td></tr>
	</table>
<?php
if($conn == true){
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);	

echo '<center><strong>Expenses All Time</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td align="center"><strong>'.$value.'</td>';
endforeach;
	
echo '</tr>';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td>';
#Custom categories would require a recurring loop to display all categories one at a time.
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td>';
endforeach;
	
echo '</tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Expenses This Year</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td align="center"><strong>'.$value.'</td>';
endforeach;
	
echo '</tr>';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td>';
#Custom categories would require a recurring loop to display all categories one at a time.
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value' AND YEAR(UID) = YEAR(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td>';
endforeach;
	
echo '</tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Expenses This Month</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td align="center"><strong>'.$value.'</td>';
endforeach;
	
echo '</tr>';
echo '<tr>';
	
foreach($categories as $key => $value):
echo '<td>';
#Custom categories would require a recurring loop to display all categories one at a time.
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Category` = '$value' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td>';
endforeach;
echo '</tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Monthly Bill Tracking</strong></center><br/>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr>';
	
foreach($bills as $key => $value):
echo '<td align="center"><strong>'.$value.'</td>';
endforeach;
	
echo '</tr>';
echo '<tr>';
	
foreach($bills as $key => $value):
echo '<td>';
#Custom categories would require a recurring loop to display all categories one at a time.
$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$username` WHERE `Bill` = '$value' AND MONTH(UID) = MONTH(CURRENT_DATE())";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo '$' . number_format($row['value_sum'], 2, '.', ',');
echo '</td>';
endforeach;
	
echo '</tr>';
echo '</table><br/><hr/><br/><br/>';

echo '<center><strong>Expenses Log</strong></center><br/>';
$sql = "SELECT * FROM `$username` ORDER BY UID DESC";
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
echo '<tr><td class="x"><form action="delete/" method="post"><input type="hidden" name="uid" value="' . $row['UID'] . '" />' . $row['UID'] . '</td><td>' . $row['Category'] . '</td><td>' . $row['Who'] . '</td><td>' . '$' . number_format($row['Amount'], 2, '.', ',') . '</td><td>' . $row['Bill'] . '</td><td><input type="submit" name="delete" value="Delete"/></form></td></tr>';
# Add edit button that allows changing category and bill classification with existing option to save unchanged or cancel.
}
echo '</tbody></table><br/>';

}
echo '<br/>';
echo '<center><a href="add/">Add expense to database.</a></center>';
echo '<br/>';
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
?>
	<table align="center">
	<tr><td>
    <p>
        <a href="reset/" class="btn btn-warning">Reset Your Password</a>
        <a href="logout/" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
	</td></tr>
	</table>
<?php
include('footer.php');
?>
</body>
</html>