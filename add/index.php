<?php
include('../header.php');
$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);
?>
<center><strong>You are about to add a record.</strong></center><br/>
<table id="add" border="1" cellpadding="10" align="center">
<form name="record" action="../record/" method="post" enctype="multipart/form-data">
<tr><td align="center"><input type="text" name="date" value="<?php
	date_default_timezone_set('America/Los_Angeles');
	$date = date("Y-m-d H:i:s");
	echo $date;	
?>"/>
</td></tr>
<tr><td  align="center">
<select name="currency">
<option>What currency?</option>
<?php
foreach($currencies as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td align="center">
<input type="text" name="who" placeholder="Who?" />
</td></tr>
<tr><td  align="center">
<input type="number" step=".01" name="amount" placeholder="Amount?" />
</td></tr>
<tr><td align="center">
<select name="category">
<option>Category?</option>
<?php
foreach($categories as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td  align="center">
<select name="bill">
<option>Is this a bill?</option>
<?php
foreach($bills as $key => $value):
echo '<option value="'.$value.'">'.$value.'</option>';
endforeach;
?>
</select>
</td></tr>
<tr><td  align="center">
<select name="type">
<option>Tracking?</option>
<option value="0">This is a payment.</option>
<option value="1">I owe this.</option>
</td></tr>
<tr><td  align="center">
<input type="text" name="note" placeholder="Additional notes?" />
</td></tr>
<tr><td>
<input type="file" name="fileToUpload" id="fileToUpload" />	
</td></tr>
<tr><td align="center"><input class="btn btn-warning" type="submit" name="add" value="Add!" /></td></tr>
</form>
</table>
<br/>
<center>
<a class="btn btn-warning" href="../dashboard/">Dashboard</a> 
<a class="btn btn-warning" href="../log/">Log</a> 
<a class="btn btn-warning" href="../custom/">Edit Classifications</a> 
</center>
<?php
include('../footer.php');
?>