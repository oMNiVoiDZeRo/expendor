<?php
include('../header.php');
if(isset($_POST['date']) && $_POST['category'] != "Category?" && $_POST['who'] != "" && $_POST['amount'] != "" && $_POST['bill'] != "Is this a bill?" && $_POST['type'] != "Tracking?"){
$fmt = numfmt_create('en_US', NumberFormatter::CURRENCY );
$date = mysqli_real_escape_string($conn, $_POST['date']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$who = mysqli_real_escape_string($conn, $_POST['who']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$bill = mysqli_real_escape_string($conn, $_POST['bill']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$currency = mysqli_real_escape_string($conn, $_POST['currency']);
$note = mysqli_real_escape_string($conn, $_POST['note']);
	
$sql = "SELECT * FROM `$username` WHERE `UID` = '$date'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$file = $row['File'];
$target_link = '<a class="btn btn-warning" target="_blank" href="' . $file . '">View Attachment</a>';

if(isset($_POST['deleteAttachment'])) {

	if($file != 'No file attached.' && file_exists($file)) {
		if (!unlink($file)) {
			$fileDeleteMessage = "<br/><br/>File attachment cannot be deleted due to an error."; 
		} else { 
			$fileDeleteMessage = "<br/><br/>File attachment has been deleted or file doesn't exist.";
			$target_link = 'Deleted attached file.';
		} 
	} else {
			$fileDeleteMessage = "<br/><br/>No attachment found to delete.";
	}
} else {}

echo '<center>';
	
if(empty($_FILES['fileToUpload']['name'])){
	echo 'No file to upload.';
	if($file != 'No file attached.'){
		$target_link = '<a class="btn btn-warning" target="_blank" href="' . $file . '">View Attachment</a>';
		$target_asset = $file;
	} else {
		$target_link = 'No file attached.';
	}
} else {
	$target_dir = dirname(__DIR__, 1) . '/uploads/' . $username . '/';
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$target_asset = '../uploads/' . $username . '/' . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo  "File is an image - " . $check["mime"] . ".<br/>";
			$uploadOk = 1;
		} else {
			echo "File is not an image.<br/>";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		echo '<a href="' . $target_asset . '">File</a> already exists.<br/>';
		$uploadOk = 0;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "Your file is too large.<br/>";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType != "pdf") {
		echo "Only JPG, JPEG, PNG, GIF & PDF files are allowed.<br/>";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Your file was not uploaded.<br/>";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//			echo '<a class="btn btn-warning" target="_blank" href="' . $target_asset . '">View Attachment</a>.';
		} else {
			echo "There was an error uploading your file.<br/>";
		}
	}
	
	$target_link = '<a class="btn btn-warning" target="_blank" href="' . $target_asset . '">View Attachment</a>';
	
}
	
echo '</center>';

if($type == 0){
	$typeMessage = "Payment.";
} else {
	$typeMessage = "Debt.";
}
	
if(isset($_POST["add"])) {
	$sql = "INSERT INTO `$username` (uid, category, who, amount, currency, bill, type, note, file) VALUES ('$date', '$category', '$who', '$amount', '$currency', '$bill', '$type', '$note', '$target_asset')";
	if(mysqli_query($conn, $sql)){		
		echo '<center><p><strong>Expense successfully recorded.</strong></p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Currency</strong></th><th align="center"><strong>Bill</strong></th><th><strong>Type</strong></th><th><strong>Note</strong></th><th><strong>File</strong></th></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . numfmt_format_currency($fmt, $amount, $currency) . '</td><td>' . $currency . '</td><td>' . $bill . '</td><td>' . $typeMessage . '</td><td>' . $note . '</td><td>';
		
		if(isset($target_asset)){
			echo $target_link;
		} else { 
			echo '';
		}
		
		echo '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
if(isset($_POST["update"])) {	
	if(empty($_FILES['fileToUpload']['name'])){
		if(isset($_POST['deleteAttachment'])) {
			$target_asset = 'No file attached.';
		} else {}
		
		$sql = "UPDATE `$username` SET category = '$category', who = '$who', amount = '$amount', currency = '$currency', bill = '$bill', note = '$note', file = '$target_asset' WHERE uid = '$date'";
		$fileDeleteMessage = '';

	} else {
		$sql = "SELECT * FROM `$username` WHERE `uid` = '$date'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$file = $row['File'];
		if($file != 'No file attached.' && file_exists($file)) {
			if (!unlink($file)) {
					$fileDeleteMessage = "File attachment cannot be deleted due to an error."; 
				} else { 
					$fileDeleteMessage = "Existing file attachment has been deleted.";
			}		
		} else {
				$fileDeleteMessage = "No existing attachment found to replace.";
		}
		
		$sql = "UPDATE `$username` SET category = '$category', who = '$who', amount = '$amount', currency = '$currency', bill = '$bill', note = '$note', file = '$target_asset' WHERE uid = '$date'";
	}
	if(mysqli_query($conn, $sql)){		
		echo '<center><p><strong>Expense successfully updated.</strong></p><p>' . $fileDeleteMessage . '</p></center>';
		echo '<table border="1" cellpadding="10" align="center">';
		echo '<tr><th align="center"><strong>Datetime</strong></th><th align="center"><strong>Category</strong></th><th align="center"><strong>Who</strong></th><th align="center"><strong>Amount</strong></th><th align="center"><strong>Currency</strong></th><th align="center"><strong>Bill</strong></th><th><strong>Type</strong></th><th><strong>Note</strong></th><th><strong>File</strong></th></tr>';
		echo '<tr><td>' . $date . '</td><td>' . $category . '</td><td>' . $who . '</td><td>' . numfmt_format_currency($fmt, $amount, $currency) . '</td><td>' . $currency . '</td><td>' . $bill . '</td><td>' . $typeMessage . '</td><td>' . $note . '</td><td>';
		
		if(file_exists($target_asset)){
			echo $target_link;
		} else {
			echo '';
		}
		
		echo '</td></tr>';
		echo '</table>';
	} else {echo 'Error: ' . $sql . '<br/>' . mysqli_error($conn);}
}
	
echo '<br/>';
echo '<center><a class="btn btn-warning" href="../dashboard/">Dashboard</a> ';
echo ' <a class="btn btn-warning" href="../log/">Log</a> ';
echo ' <a class="btn btn-warning" href="../add/">Add Expense</a> ';
echo ' <a class="btn btn-warning" href="../custom/">Edit Classifications</a><br/></center>';
include('../footer.php');
} else {
echo '<center>You submitted an incomplete record.</center><br/>';
echo '<center><a class="btn btn-warning" href="../add/">Fill out the record.</a></center>';}

include('../footer.php');
?>