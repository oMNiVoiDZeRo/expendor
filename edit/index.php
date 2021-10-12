<?php
include('../header.php');

if($conn == true){
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);

	if(isset($_POST["edit"])) {
  		if(isset($_POST['uid'])){
			$date = $_POST['uid'];
			$type = $_POST['type'];
			$sql = "SELECT * FROM `$username` WHERE `uid` = '$date'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
?>
	
<center><strong>You are about to edit a record.</strong></center><br/>
<table id="edit" border="1" cellpadding="10" align="center">
<form name="record" action="../record/" method="post" enctype="multipart/form-data">
<tr><td align="center"><input readonly type="text" name="date" value="<?php echo $date; ?>"/>
</td></tr>
<tr><td align="center">
<select name="currency">
<option>Currency?</option>
<?php
foreach($currencies as $key => $value):
echo '<option ';
if($_POST['currency'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center">
<input type="text" name="who" placeholder="Who?" value="<?php echo $row['Who']; ?>" /><br/>
</td></tr>
<tr><td align="center">
<input type="number" step=".00000001" name="amount" placeholder="Amount?" value="<?php echo floatval($row['Amount']); ?>" /><br/>
</td></tr>
<tr><td align="center">
<select name="category">
<option>Category?</option>
<?php
foreach($categories as $key => $value):
echo '<option ';
if($row['Category'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center">
<select name="bill">
<option>Is this a bill?</option>
<?php
foreach($bills as $key => $value):
echo '<option ';
if($row['Bill'] == $value){echo 'selected';}
echo ' value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center">
<select name="type">
<option value="Tracking?">Tracking?</option>
<option 
<?php if($type == 0){echo 'selected ';}?>
value="0">This is payment.</option>
<option 
<?php if($type == 1){echo 'selected ';}?>
value="1">I owe this.</option>
</select>
</td></tr>
<tr><td  align="center">
<input type="text" name="note" placeholder="Additional notes?" value="<?php echo $row['Note']; ?>" />
</td></tr>
<?php
if($_POST['file'] != 'No file attached.' && file_exists($row['File'])){
?>
<tr><td>
<a class="btn btn-secondary" href="<?php echo $row['File']; ?>" target="_blank">View Attached File</a>
</td></tr>
<tr><td>
<strong>Replace attached file: </strong> <input type="file" name="fileToUpload" id="fileToUpload" />	
</td></tr>
<?php
} else {
?>
<tr><td>
<input type="file" name="fileToUpload" id="fileToUpload" />	
</td></tr>
<?php
}
?>
<tr><td  align="center">
<input type="checkbox" name="deleteAttachment" id="deleteAttachment" /> Delete existing file attachment?
</td></tr>
<tr><td align="center"><input class="btn btn-warning" type="submit" name="update" value="Update!" /></td></tr>
</form>
</table>
<br/>
<?php
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo '<a class="btn btn-warning" href="../log/">Log</a>';
echo ' <a class="btn btn-warning" href="../add/">Add an expense.</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit classifications</a><br/></center>';
  			}
	}
	
		if(isset($_POST["delete"])) {
?>
<center><strong>You are about to delete this record and any attached file that could be shared between expense records.</strong></center><br/>
<form name="delete" action="../submit/" method="post">
<table border="1" cellpadding="10" align="center">
<?php
  		if(isset($_POST['uid'])){
			$date = $_POST['uid'];
			$sql = "SELECT * FROM `$username` WHERE `uid` = '$date'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
?>
<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Note</strong></th><th>Bill</th><th></th></tr>
<tr><td align="center" class="x">
<input type="hidden" name="date" value="<?php echo $date; ?>" /><?php echo $date; ?>
</td>
<td>
<?php echo $row['Category']; ?>
</td>
<td>
<?php echo $row['Who']; ?>
</td>
<td>
<?php echo number_format($row['Amount'], 2, '.', ','); ?>
</td>
<td>
<?php echo $row['Note']; ?>
</td>
<td>
<?php echo $row['Bill']; ?>
</td>
<?php
  		}
?>
<td align="center">
<?php
if($row['File'] != 'No file attached.'){
?>
<a class="btn btn-secondary" target="_blank" href="<?php echo $row['File'] ?>">View Attachment</a>	
<?php
}
?>
	<input class="btn btn-danger" type="submit" value="Delete!" />
</td></tr>
</table>
</form>
<br/>
<?php
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo '<a class="btn btn-warning" href="../log/">Log</a>';
echo ' <a class="btn btn-warning" href="../add/">Add Expense.</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit Classifications</a><br/></center>';
	}
}

include('../footer.php');
?>