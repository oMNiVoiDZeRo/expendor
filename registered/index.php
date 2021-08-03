<!doctype html>
<html>
<head>
<title>Register Account</title>
<link href="../style.css" rel="stylesheet" />
</head>
<body>
<?php
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password-confirm'])){
if($_POST['password'] == $_POST['password-confirm']){
include('../header.php');
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = md5($password);
$sql = "SELECT `email` FROM `users` WHERE email = '$email'";

if ($stmt = $conn->prepare($sql)){

        if($stmt->execute()){
            $stmt->store_result();

            $email_check= "";         
            $stmt->bind_result($email_check);
            $stmt->fetch();

            if ($stmt->num_rows == 1){

            echo "<center>That email already exists.</center>";
			echo '<center><a href="../register/">Try again.</a></center>';

            } else {
				$sql = "INSERT INTO `users` (email, password) VALUES ('$email', '$password')";
				if(mysqli_query($conn, $sql)){
					echo '<center><p><strong>Account successfully registered.</strong></p></center>';
					echo '<table border="1" cellpadding="10" align="center">';
					echo '<tr><td>' . $email . '</td></tr>';
					echo '</table>';
				} else {
					echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);
				}
			}
        }
    }
echo '<br/>';
echo '<center><a href="../">Public Records</a></center>';
include('../footer.php');
} else {
echo '<center>Your passwords did not match.</center><br/>';
echo '<center><a href="../register/">Try again.</a></center>';}
} else {
echo '<center>You submitted an incomplete form.</center><br/>';
echo '<center><a href="../register/">Try again.</a></center>';}
?>
</body>
</html>