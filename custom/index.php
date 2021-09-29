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
echo '<tr><td><input type="text" name="categories[]" value="'.$value.'" /> <a class="btn btn-danger delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="btn btn-warning addCat" href="#">Add Category</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom bills" align="center">';
echo '<tr><td><center><h2>Customize your bills:</h2></center><hr/></td></tr>';
foreach($bills as $key => $value):
echo '<tr><td><input type="text" name="bills[]" value="'.$value.'" /> <a class="btn btn-danger delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="btn btn-warning addBill" href="#">Add Bill</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom currencies" align="center">';
echo '<tr><td><center><h2>Customize your currencies:</h2></center><hr/></td></tr>';
foreach($currencies as $key => $value):
echo '<tr><td><input type="text" name="currencies[]" value="'.$value.'" /> <a class="btn btn-danger delete" href="#">Delete</a></td></tr>';
endforeach;
echo '<tr><td><br/><a class="btn btn-warning addCurrency" href="#">Add Currency</a><br/><br/><br/></td></tr>';
echo '</table><br/><hr/><br/>';
echo '<center><input class="btn btn-warning" type="submit" value="Save Classifications" /></center></form>';
echo '<br/>';
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo ' <a class="btn btn-warning" href="../log/">Log</a> ';
echo ' <a class="btn btn-warning" href="../add/">Add Expense</a></center>';
?>
<script>
$(document).ready(function() {
	$('table').on("click",".delete", function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	})	
	$('table').on("click",".addCat", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="btn btn-warning addCat" href="#">Add Category</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="categories[]" value="" /> <a class="btn btn-danger delete" href="#">Delete</a>');
	});
	$('table').on("click",".addBill", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="btn btn-warning addBill" href="#">Add Bill</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="bills[]" value="" /> <a class="btn btn-danger delete" href="#">Delete</a>');
	});
	$('table').on("click",".addCurrency", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().append('<tr><td><br/><a class="btn btn-warning addCurrency" href="#">Add Currency</a><br/><br/><br/><br/></td></tr>');
		$(this).parent().html( '<input type="text" name="currencies[]" value="" /> <a class="btn btn-danger delete" href="#">Delete</a>');
	});
});
</script>
<?php
include('../footer.php');
?>