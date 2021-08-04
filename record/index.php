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
<title>Record Expense</title>
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
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link active" aria-current="page">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
<?php
if(isset($_POST['date']) && $_POST['category'] != "Category?" && $_POST['who'] != "" && $_POST['amount'] != "" && $_POST['bill'] != "Is this a bill?"){
include('../header.php');
$date = mysqli_real_escape_string($conn, $_POST['date']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$who = mysqli_real_escape_string($conn, $_POST['who']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$bill = mysqli_real_escape_string($conn, $_POST['bill']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
if($type == 0){
	$typeMessage = "Payment.";
} else {
	$typeMessage = "Debt.";
}
	
if(isset($_POST["add"])) {
	$sql = "INSERT INTO `$username` (uid, category, who, amount, bill, type) VALUES ('$date', '$category', '$who', '$amount', '$bill', '$type')";
	if(mysqli_query($conn, $sql)){
		echo '<center><p><strong>Expense successfully recorded.</strong></p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Bill</strong></th><th><strong>Type</strong></th></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . $amount . '</td><td>' . $bill . '</td><td>' . $typeMessage . '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
if(isset($_POST["update"])) {
	$sql = "UPDATE `$username` SET category = '$category', who = '$who', amount = '$amount', bill = '$bill' WHERE uid = '$date'";
	if(mysqli_query($conn, $sql)){
		echo '<center><p><strong>Expense successfully updated.</strong></p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Bill</strong></th><th><strong>Debt</strong></th></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . $amount . '</td><td>' . $bill . '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
echo '<br/>';
echo '<center><a href="../dashboard/">Dashboard</a></center>';
include('../footer.php');
} else {
echo '<center>You submitted an incomplete record.</center><br/>';
echo '<center><a href="../add/">Fill out the record.</a></center>';}
?>
</body>
</html>
