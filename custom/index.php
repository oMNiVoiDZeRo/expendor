<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
</head>
<?php
include('../header.php');
# Get categories from mysql database for logged in user table.
# Should be CSV in one column.
# Loop to display each value in row with edit and delete buttons.
#	Edit button swaps label with text input.
#	Delete button asks to confirm deletion of category.
# After loop add new category button.
# Without postback (AJAX) have category inserted into row above add new category.
# Accomplish same with bill management.
# Return to dashboard button and add expense button.
include('../footer.php');
?>
<body>
</body>
</html>