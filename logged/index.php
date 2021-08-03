<!doctype html>
<html>
<head>
<title>Logging in...</title>
<link href="../style.css" rel="stylesheet" />
</head>
<body>
<?php
include('header.php');
if($conn == true){
if(isset($_POST['email']) && isset($_POST['password'])){
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);	
?>
<!--

Get form fields from login form.

Select if account exists to compare passwords.

If correct password add boolean variable set to true in a session.

If incorrect password throw error.

-->
<?php
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	include('footer.php');
?>
</body>
</html>