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
<meta charset="utf-8">
<title>Expendor | Customize Classifications</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link active" aria-current="page">Edit Classifications</a></li>
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
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(!isset($_POST["categories"])){
		echo "You don't have any categories.<br/>";
	} else {
		$categories = mysqli_real_escape_string($conn, implode(',', $_POST["categories"]));
		$sql = "UPDATE `users` SET `categories`='$categories' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Categories successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	
	if(!isset($_POST["bills"])){
		echo "You don't have any bill classifications.<br/>";
	} else {
		$bills = mysqli_real_escape_string($conn, implode(',', $_POST["bills"]));
		$sql = "UPDATE `users` SET `bills`='$bills' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Bills successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	
	if(!isset($_POST["currencies"])){
		echo "You don't have any currencies.<br/>";
	} else {
		$currencies = mysqli_real_escape_string($conn, implode(',', $_POST["currencies"]));
		$sql = "UPDATE `users` SET `currencies`='$currencies' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Currencies successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}

	echo '<br/>';
}	

$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);
echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post">';
echo '<table class="custom categories" align="center">';
echo '<tr><td><center><h2>Customize your categories:</h2></center><hr/></td></tr>';
foreach($categories as $key => $value):
echo '<tr><td><input type="text" name="categories[]" value="'.$value.'" /> <a class="delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="addCat" href="#">Add Category</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom bills" align="center">';
echo '<tr><td><center><h2>Customize your bills:</h2></center><hr/></td></tr>';
foreach($bills as $key => $value):
echo '<tr><td><input type="text" name="bills[]" value="'.$value.'" /> <a class="delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="addBill" href="#">Add Bill</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom currencies" align="center">';
echo '<tr><td><center><h2>Customize your currencies:</h2></center><hr/></td></tr>';
foreach($currencies as $key => $value):
echo '<tr><td><input type="text" name="currencies[]" value="'.$value.'" /> <a class="delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="addCurrency" href="#">Add Currency</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<center><input type="submit" value="Save Classifications" /></center></form>';
echo '<br/>';
echo '<center><a href="../dashboard/">Dashboard</a></center>';
include('../footer.php');
?>
<footer class="py-3 my-4">
    <p class="text-center text-muted">&copy; 2021 Expendor</p>
</footer>
<script>
$(document).ready(function() {
	$('table').on("click",".delete", function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	})	
	$('table').on("click",".addCat", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="addCat" href="#">Add Category</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="categories[]" value="" /> <a class="delete" href="#">Delete</a>');
	});
	$('table').on("click",".addBill", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="addBill" href="#">Add Bill</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="bills[]" value="" /> <a class="delete" href="#">Delete</a>');
	});
	$('table').on("click",".addCurrency", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="addCurrency" href="#">Add Currency</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="currencies[]" value="" /> <a class="delete" href="#">Delete</a>');
	});
});
</script>
</body>
</html>