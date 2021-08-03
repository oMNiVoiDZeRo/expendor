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
<title>Record Record</title>
<link href="../style.css" rel="stylesheet" />
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
$sql = "INSERT INTO `$username` (uid, category, who, amount, bill) VALUES ('$date', '$category', '$who', '$amount', '$bill')";
if(mysqli_query($conn, $sql)){
echo '<center><p><strong>Expense successfully recorded.</strong></p></center>';
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center"><strong>Datetime</strong></td><td align="center"><strong>Category</strong></td><td align="center"><strong>Who</strong></td><td align="center"><strong>Amount</strong></td><td align="center"><strong>Bill</strong></td></tr>';
echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . $amount . '</td><td>' . $bill . '</td></tr>';
echo '</table>';
} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
echo '<br/>';
echo '<center><a href="../">Public Records</a></center>';
include('../footer.php');
} else {
echo '<center>You submitted an incomplete record.</center><br/>';
echo '<center><a href="../add/">Fill out the record.</a></center>';}
?>
</body>
</html>