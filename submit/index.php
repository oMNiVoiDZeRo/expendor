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
<title>𝐄𝐗𝐏𝐄𝐍𝐃𝐎𝐑 | Delete Expense Record</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
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
<li class="nav-item"><a href="http://localhost/expendor/log/" class="nav-link">Log</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link">Add Expense</a></li>
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
if(isset($_POST['date'])){
$date = $_POST['date'];
	
$sql = "SELECT * FROM `$username` WHERE `UID` = '$date'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$file = $row['File'];
if($file != 'No file attached.' && file_exists($file)) {
	if (!unlink($file)) {
		$fileDeleteMessage = "<br/><br/>File attachment cannot be deleted due to an error."; 
	} else { 
		$fileDeleteMessage = "<br/><br/>File attachment has been deleted or file doesn't exist."; 
	} 
} else {
		$fileDeleteMessage = "<br/><br/>No attachment found to delete.";
}
	
$sql = "DELETE FROM `$username` WHERE `UID` = '$date'";
if(mysqli_query($conn, $sql)){
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center">Record has been successfully deleted.' . $fileDeleteMessage . '</td></tr>';
echo '</table>';}
else {
echo '<table border="1" cellpadding="10" align="center">';
echo '<tr><td align="center">Failed to delete record.' . $fileDeleteMessage . '</td></tr>';
echo '</table>';}}
include('../footer.php');
?>
<br/>
<?php
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo '<a class="btn btn-warning" href="../log/">Log</a>';
echo ' <a class="btn btn-warning" href="../add/">Add Expense</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit Classifications</a><br/></center>';
?>
	<hr/><br/>
    <p>
<?php
		if($username != 'test'){
?>
        <a href="../reset" class="btn btn-secondary">Reset Password</a>
<?php
		}
?>
        <a href="../logout" class="btn btn-danger">Logout</a>
    </p>
<footer class="py-3 my-4">
    <p class="text-center">&copy; 2021 Expendor</p>
</footer>
</body>
</html>