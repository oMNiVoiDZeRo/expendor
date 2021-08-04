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
<title>Customize Classifications</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php
include('../header.php');
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(!isset($_POST["categories"])){
		echo "You don't have any categories.<br/>";
	} else {
		$categories = implode(',', $_POST["categories"]);
		$sql = "UPDATE `users` SET `categories`='$categories' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Categories successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	
	if(!isset($_POST["bills"])){
		echo "You don't have any bill classifications.<br/>";
	} else {
		$bills = implode(',', $_POST["bills"]);
		$sql = "UPDATE `users` SET `bills`='$bills' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Bills successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	echo '<br/>';
}	

$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post">';
echo '<table class="custom categories" align="center">';
echo '<tr><td><center><strong>Customize your categories:</strong></center><hr/></td></tr>';
foreach($categories as $key => $value):
echo '<tr><td><input type="text" name="categories[]" value="'.$value.'" /> <a class="delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="addCat" href="#">Add Category</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom bills" align="center">';
echo '<tr><td><center><strong>Customize your bill classifications:</strong></center><hr/></td></tr>';
foreach($bills as $key => $value):
echo '<tr><td><input type="text" name="bills[]" value="'.$value.'" /> <a class="delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="addBill" href="#">Add Bill</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<center><input type="submit" value="Save Classifications" /></center></form>';
include('../footer.php');
?>
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
});
</script>
</body>
</html>