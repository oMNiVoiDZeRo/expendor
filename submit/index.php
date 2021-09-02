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

include('../footer.php');
?>