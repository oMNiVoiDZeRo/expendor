<?php
include('../header.php');
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(!isset($_POST["categories"])){
		echo "You don't have any categories.<br/>";
	} else {
		$categories = mysqli_real_escape_string($conn, implode(',', $_POST["categories"]));
		$sql = "UPDATE `users` SET `categories`='$categories' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Categories successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	
	if(!isset($_POST["bills"])){
		echo "You don't have any bill classifications.<br/>";
	} else {
		$bills = mysqli_real_escape_string($conn, implode(',', $_POST["bills"]));
		$sql = "UPDATE `users` SET `bills`='$bills' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Bills successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}
	
	if(!isset($_POST["currencies"])){
		echo "You don't have any currencies.<br/>";
	} else {
		$currencies = mysqli_real_escape_string($conn, implode(',', $_POST["currencies"]));
		$sql = "UPDATE `users` SET `currencies`='$currencies' WHERE `username` = '$username'";
		if(mysqli_query($conn, $sql)){
			echo '<center><p><strong>Currencies successfully updated.</strong></p></center>';
		} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
	}

	echo '<br/>';
}	

$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$categories = explode (",", $row['categories']);
$bills = explode (",", $row['bills']);
$currencies = explode (",", $row['currencies']);
echo '<form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="post">';
$itemRow = function($name, $value) {
	return '<tr class="sortable-item"><td class="d-flex"><span class="drag-handle" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span> <input type="text" name="'.$name.'[]" value="'.$value.'" /> <a class="btn btn-danger delete" href="#">Delete</a></td></tr>';
};
echo '<table class="custom categories" align="center">';
echo '<tr><td><center><h2>Customize your categories:</h2></center><hr/></td></tr>';
echo '<tbody class="sortable-list">';
foreach($categories as $key => $value):
echo $itemRow('categories', $value);
endforeach;
echo '</tbody>';
echo '<tbody class="custom-add"><tr><td><br/><a class="btn btn-warning addCat" href="#">Add Category</a><br/><br/><br/></td></tr></tbody>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom bills" align="center">';
echo '<tr><td><center><h2>Customize your bills:</h2></center><hr/></td></tr>';
echo '<tbody class="sortable-list">';
foreach($bills as $key => $value):
echo $itemRow('bills', $value);
endforeach;
echo '</tbody>';
echo '<tbody class="custom-add"><tr><td><br/><a class="btn btn-warning addBill" href="#">Add Bill</a><br/><br/><br/></td></tr></tbody>';
echo '</table><br/><hr/><br/>';
echo '<table class="custom currencies" align="center">';
echo '<tr><td><center><h2>Customize your currencies:</h2></center><hr/></td></tr>';
echo '<tbody class="sortable-list">';
foreach($currencies as $key => $value):
echo $itemRow('currencies', $value);
endforeach;
echo '</tbody>';
echo '<tbody class="custom-add"><tr><td><br/><a class="btn btn-warning addCurrency" href="#">Add Currency</a><br/><br/><br/></td></tr></tbody>';
echo '</table><br/><hr/><br/>';
echo '<center><input class="btn btn-warning" type="submit" value="Save Classifications" /></center></form>';
echo '<br/>';
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo ' <a class="btn btn-warning" href="../log/">Log</a> ';
echo ' <a class="btn btn-warning" href="../add/">Add Expense</a></center>';
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
var itemRowHtml = function(name) {
	return '<span class="drag-handle" title="Drag to reorder"><i class="fas fa-grip-vertical"></i></span> <input type="text" name="' + name + '[]" value="" /> <a class="btn btn-danger delete" href="#">Delete</a>';
};
var sortableRowHelper = function(e, $row) {
	var $cells = $row.children();
	var $helper = $row.clone();
	$helper.children().each(function(i) {
		$(this).width($cells.eq(i).width());
	});
	return $helper;
};
$(document).ready(function() {
	$('table.custom .sortable-list').sortable({
		handle: '.drag-handle',
		items: 'tr.sortable-item',
		helper: sortableRowHelper,
		placeholder: 'sortable-placeholder',
		forcePlaceholderSize: true,
		cursor: 'grabbing',
		opacity: 0.8,
		tolerance: 'intersect',
		start: function(e, ui) {
			if (!ui.placeholder.children('td').length) {
				ui.placeholder.html('<td>&nbsp;</td>');
			}
			ui.placeholder.height(ui.item.outerHeight());
			ui.placeholder.children('td').height(ui.item.outerHeight());
		}
	});
	$('table').on("click",".delete", function(e){
		e.preventDefault();
		$(this).closest('tr.sortable-item').remove();
	});
	$('table').on("click",".addCat", function(e){
		e.preventDefault();
		var $table = $(this).closest('table');
		var $row = $(this).closest('tr');
		$table.find('tbody.custom-add').append('<tr><td><br/><a class="btn btn-warning addCat" href="#">Add Category</a><br/><br/><br/></td></tr>');
		$(this).parent().addClass('d-flex').html(itemRowHtml('categories'));
		$row.addClass('sortable-item').appendTo($table.find('.sortable-list'));
	});
	$('table').on("click",".addBill", function(e){
		e.preventDefault();
		var $table = $(this).closest('table');
		var $row = $(this).closest('tr');
		$table.find('tbody.custom-add').append('<tr><td><br/><a class="btn btn-warning addBill" href="#">Add Bill</a><br/><br/><br/></td></tr>');
		$(this).parent().addClass('d-flex').html(itemRowHtml('bills'));
		$row.addClass('sortable-item').appendTo($table.find('.sortable-list'));
	});
	$('table').on("click",".addCurrency", function(e){
		e.preventDefault();
		var $table = $(this).closest('table');
		var $row = $(this).closest('tr');
		$table.find('tbody.custom-add').append('<tr><td><br/><a class="btn btn-warning addCurrency" href="#">Add Currency</a><br/><br/><br/></td></tr>');
		$(this).parent().addClass('d-flex').html(itemRowHtml('currencies'));
		$row.addClass('sortable-item').appendTo($table.find('.sortable-list'));
	});
});
</script>
<?php
include('../footer.php');
?>