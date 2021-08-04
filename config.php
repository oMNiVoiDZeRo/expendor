<?php 
date_default_timezone_set('America/Los_Angeles');
$date = date("Y-m-d H:i:s");
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'expendor';
$conn = mysqli_connect($server, $user, $pass, $database);
if($conn == true){echo '<!--Database Successfully Connected.-->';}	
?>	