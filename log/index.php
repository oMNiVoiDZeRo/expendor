<?php
include('../header.php');
if($conn == true){
$fmt = numfmt_create('en_US', NumberFormatter::CURRENCY );

echo '<center><h2>Expense Log</h2></center><br/>';
$sql = "SELECT * FROM `$username` ORDER BY UID DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($row == null){
echo '<table border="1" cellpadding="10" align="center"><tr><td align="center">';
echo 'No expenses to display.<br/>';
echo '</td></tr></table>';
} else {
echo '<table id="expenses" border="1" cellpadding="10" align="center">';
echo '<thead><tr><th align="center"><strong>When</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Bill</strong></th><th align="center"><strong>Tracking</strong></th><th align="center"><strong>Note</strong></th><th></th></thead></tr>';
echo'<tbody>';
foreach($result as $row){
$UID = $row['UID'];
$type = $row['Type'];
if($type == 0){
	$typeMessage = "Payment.";
} else {
	$typeMessage = "Debt.";
}
if($UID != 1){
$UID = 'UID';}
echo '<tr><td class="x"><form action="../edit/" method="post"><input type="hidden" name="file" value="' . $row['File'] . '" /><input type="hidden" name="note" value="' . $row['Note'] . '" /><input type="hidden" name="currency" value="' . $row['Currency'] . '" /><input type="hidden" name="type" value="' . $row['Type'] . '" /><input type="hidden" name="uid" value="' . $row['UID'] . '" />' . $row['UID'] . '</td><td>' . $row['Category'] . '</td><td>' . $row['Who'] . '</td><td>' . numfmt_format_currency($fmt, $row['Amount'], $row['Currency']) . '</td><td>' . $row['Bill'] . '</td><td>' . $typeMessage . '</td><td>' . $row['Note'] . '</td><td>';

if($row['File'] != 'No file attached.' && file_exists($row['File'])) { 
echo	'<a class="btn btn-secondary" target="_blank" href="' . $row['File'] . '">View Attachment</a> ';
}

echo ' <input class="btn btn-secondary" type="submit" name="edit" value="Edit"/> <input class="btn btn-danger" type="submit" name="delete" value="Delete"/></form></td></tr>';
}
echo '</tbody></table><br/>';

}
echo '<br/>';
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo ' <a class="btn btn-warning" href="../add/">Add Expense</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit Classifications</a><br/></center>';
echo '<br/>';
} else {
echo '<br/>';
echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
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
<script>
$(document).ready( function () {
    $('#expenses').DataTable({
		"order": [ 0, 'desc' ],
		"columnDefs": [ {
		"targets"  : -1,
		"orderable": false,
		}]
	});
		
} );
</script>
<?php
include('../footer.php');
?>