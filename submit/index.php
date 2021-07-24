<!doctype html>
<html>
<head>
<title>Delete Expense Record</title>
<link href="../style.css" rel="stylesheet" />
</head>
<body>
<?php
include('../header.php');
if(isset($_POST['date'])){
$date = $_POST['date'];
$sql = "DELETE FROM `expenses` WHERE `UID` = '$date'";
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
<center><a href="../">Public Records</a></center>
</body>
</html>