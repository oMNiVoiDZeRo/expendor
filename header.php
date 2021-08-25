<?php
include('config.php');
echo '<br/>';
?>
<!doctype html>
<html>
<head>
<title>𝐄𝐗𝐏𝐄𝐍𝐃𝐎𝐑 | <?php echo $pageTitle; ?></title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link href="../style.css" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a href="http://localhost/expendor/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
<span class="fs-4">Expendor</span>
</a>
<ul class="nav nav-pills">
<li class="nav-item"><a href="http://localhost/expendor/dashboard/" class="nav-link <?php active('dashboard');?>">Dashboard</a></li>
<li class="nav-item"><a href="http://localhost/expendor/log/" class="nav-link <?php active('log');?>">Log</a></li>
<li class="nav-item"><a href="http://localhost/expendor/add/" class="nav-link <?php active('add');?>">Add Expense</a></li>
<li class="nav-item"><a href="http://localhost/expendor/custom/" class="nav-link <?php active('custom');?>">Edit Classifications</a></li>
<?php
		if($username != 'test'){
?>
<li class="nav-item"><a href="http://localhost/expendor/reset/" class="nav-link <?php active('reset');?>">Reset Password</a></li>
<?php
		}
?>
<li class="nav-item"><a href="http://localhost/expendor/logout/" class="nav-link">Logout</a></li>
</ul>
</header>