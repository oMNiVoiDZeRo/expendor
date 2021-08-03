<!doctype html>
<html>
<head>
<title>Add Record</title>
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<center><strong>You are about to add a record.</strong></center><br/>
<table border="1" cellpadding="10" align="center">
<form name="record" action="../record/" method="post">
<tr><td align="center"><input type="text" name="date" value="<?php
	date_default_timezone_set('America/Los_Angeles');
	$date = date("Y-m-d H:i:s");
	echo $date;
?>"/>
</td></tr>
<tr><td align="center">
<select name="category">
<option>Category?</option>
<option>Income</option>
<option>Food</option>
<option>Health</option>
<option>Home</option>
<option>Auto</option>
<option>Insurance</option>
<option>Utility</option>
<option>Loan</option>
<option>Work</option>
<option>Entertainment</option>
</select>
<input type="text" name="who" placeholder="Who?" /><br/>
<input type="text" name="amount" placeholder="Amount?" /><br/>
<select name="bill">
<option>Is this a bill?</option>
<option>Rent</option>
<option>Electric</option>
<option>Utility</option>
<option>Home Insurance</option>
<option>Health Insurance</option>
<option>Car Insurance</option>
<option>Phone</option>
<option>Loan</option>
<option>Internet</option>
<option>Web Hosting</option>
<option>This is not a bill.</option>
</select>
</td></tr>
<tr><td align="center"><input type="submit" value="Add!" /></td></tr>
</form>
</table>
<br/>
<center><a href="../">Dashboard</a><br/></center>
</body>
</html>