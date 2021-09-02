<?php
session_start();

$url_array =  explode('/', $_SERVER['REQUEST_URI']);
$url = $url_array[2];
if($url != 'login' && $url != 'register'){
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/");
    exit;
} else {
	$username = $_SESSION["username"]; 
}
}

date_default_timezone_set('America/Los_Angeles');
$date = date("Y-m-d H:i:s");
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'expendor';
$conn = mysqli_connect($server, $user, $pass, $database);
if($conn == true){echo '<!--Database Successfully Connected.-->';}

$nav = True;

switch ($url) {
    case 'dashboard':
        $pageTitle = "Dashboard";
        break;
    case 'log':
        $pageTitle = "Log";
        break;
    case 'add':
        $pageTitle = "Add Expense";
        break;
    case 'custom':
        $pageTitle = "Edit Classifications";
        break;
	case 'edit':
		$pageTitle = "Edit Record";
		break;
    case 'record':
        $pageTitle = "Record Expense";
        break;
    case 'reset':
        $pageTitle = "Reset Password";
		if($username == 'test'){
			header("location: ../login/");
			exit;
		}
        break;
    case 'submit':
        $pageTitle = "Delete Expense Record";
        break;
	case 'register':
		$pageTitle = "Register Account";
		$nav = False;
		break;
	case 'login':
		$pageTitle = "Login to Expendor";
		$nav = False;
		break;
}

function active($current_page){
	$url_array =  explode('/', $_SERVER['REQUEST_URI']);
	$url = $url_array[2];
	if($current_page == $url){
		echo 'active" aria-current="page';
	} else {
		echo '"';
	}
}

?>	