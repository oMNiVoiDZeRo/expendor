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
<title>Delete Expense Record</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a href="http://localhost/expendor/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<span class="fs-4">Expendor</span>
</a>

<ul class="nav nav-pills">
<li class="nav-item"><a href="http://localhost/expendor/dashboard/" class="nav-link">Dashboard</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
<?php
include('../header.php');
if(isset($_POST['date'])){
$date = $_POST['date'];
$sql = "DELETE FROM `$username` WHERE `UID` = '$date'";
if(mysqli_query($conn, $sql)){
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center">Record has been successfully deleted.</td></tr>';
echo '</table>';}
else {
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center">Failed to delete record.</td></tr>';
echo '</table>';}}
include('../footer.php');
?>
<br/>
<center><a href="../">Dashboard</a></center>
<footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Expendor</p>
</footer>
</body>
</html>