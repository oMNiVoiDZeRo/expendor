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
<title>𝐄𝐗𝐏𝐄𝐍𝐃𝐎𝐑 | Expense Log</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
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
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a href="http://localhost/expendor/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<span class="fs-4">Expendor</span>
</a>

<ul class="nav nav-pills">
<li class="nav-item"><a href="http://localhost/expendor/dashboard/" class="nav-link">Dashboard</a></li>
<li class="nav-item"><a href="http://localhost/expendor/log/" class="nav-link active" aria-current="page">Log</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link">Edit Classifications</a></li>
<?php
		if($username != 'test'){
?>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link">Reset Password</a></li>
<?php
		}
?>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>
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

if($row['File'] != 'No file attached.') { 
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
<?php
include('../footer.php');
?>
<footer class="py-3 my-4">
    <p class="text-center">&copy; 2021 Expendor</p>
</footer>
</body>
</html>