<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL successfully.<br/><br/>";
?>
<!doctype html>
<html>
<head>
<title>Expendor</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
body {
	text-align: left;
	font-family: arial;
	font-size: 18px;
}

body label {
	display: block;
}

body label#where, body label#amount, body div#bills, body label#bill, body input[name='submit'] {
	display: none;
}
</style>
<script>
jQuery(document).ready(function(){
	
	$("select[name='category']").change(function() {
		$("label#where").show();
	});
	
	$("input[name='where']").on('input', function(e) {
		$("label#amount").show();
	});
	
	$("input[name='amount']").on('input', function(e) {
		$("div#bills").show();
	});
	
	$("input:radio[name='isbill']").change(function() {
		if ($(this).val() == 'yes'){
            $("label#bill").show();
			if ($("select[name='bill']").val() == '---'){
				$("input[name='submit']").hide();
			}
        } else {
            $("label#bill").hide();
			$("input[name='submit']").show();
		}
	});
	
	$("select[name='bill']").change(function() {
		$("input[name='submit']").show();
	});
	
})
</script>
</head>
<body>
<form>
<label id="category"><strong>Category:</strong><br/>
<select name="category">
<option>---</option>
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
</select></label>
<br/>
<label id="where"><strong>Where?</strong><br/>
<input type="text" name="where" /></label>
<br/>
<label id="amount"><strong>Amount?</strong><br/>
<input type="text" name="amount" /></label>
<br/>
<div id="bills">
<label><strong>Bill?</strong></label>
<label><input type="radio" name="isbill" value="yes" /> Yes</label>
<label><input type="radio" name="isbill" value="no" /> No</label>
</div>
<label id="bill"><select name="bill">
<option>---</option>
<option>Rent</option>
<option>Electric</option>
<option>General Utility</option>
<option>Home Insurance</option>
<option>Health Insurance</option>
<option>Auto Insurance</option>
<option>Phone</option>
<option>Student Loan</option>
<option>Internet Service</option>
<option>Web Hosting</option>
</select></label>
<input type="submit" name="submit" />
</form>
</body>
<?php
mysqli_close($conn);
?>