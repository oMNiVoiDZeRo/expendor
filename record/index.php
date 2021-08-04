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
<title>Record Record</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
<?php
if(isset($_POST['date']) && $_POST['category'] != "Category?" && $_POST['who'] != "" && $_POST['amount'] != "" && $_POST['bill'] != "Is this a bill?"){
include('../header.php');
$date = mysqli_real_escape_string($conn, $_POST['date']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$who = mysqli_real_escape_string($conn, $_POST['who']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$bill = mysqli_real_escape_string($conn, $_POST['bill']);
	
if(isset($_POST["add"])) {
	$sql = "INSERT INTO `$username` (uid, category, who, amount, bill, debt) VALUES ('$date', '$category', '$who', '$amount', '$bill')";
	if(mysqli_query($conn, $sql)){
		echo '<center><p><strong>Expense successfully recorded.</strong></p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><td align="center"><strong>Datetime</strong></td><td align="center"><strong>Category</strong></td><td align="center"><strong>Who</strong></td><td align="center"><strong>Amount</strong></td><td align="center"><strong>Bill</strong></td></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . $amount . '</td><td>' . $bill . '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
if(isset($_POST["update"])) {
	$sql = "UPDATE `$username` SET category = '$category', who = '$who', amount = '$amount', bill = '$bill' WHERE uid = '$date'";
	if(mysqli_query($conn, $sql)){
		echo '<center><p><strong>Expense successfully updated.</strong></p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><td align="center"><strong>Datetime</strong></td><td align="center"><strong>Category</strong></td><td align="center"><strong>Who</strong></td><td align="center"><strong>Amount</strong></td><td align="center"><strong>Bill</strong></td><td><strong>Debt</strong></td></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . $amount . '</td><td>' . $bill . '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
echo '<br/>';
echo '<center><a href="../">Dashboard</a></center>';
include('../footer.php');
} else {
echo '<center>You submitted an incomplete record.</center><br/>';
echo '<center><a href="../add/">Fill out the record.</a></center>';}
?>
</body>
</html>