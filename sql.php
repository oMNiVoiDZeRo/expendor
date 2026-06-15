<?php

sql('dashIncome', $username, "`Category` = 'Income' AND `Type` = '0' AND `Currency` = '$value");


function sql($action, $table, $where){
	switch($action){
		case 'dashIncome':
			$sql = "SELECT SUM(`Amount`) AS value_sum FROM `$table` WHERE $where"	}
}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>