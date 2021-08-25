<?php
ob_start();
require_once "../config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (username, password, categories, bills, currencies) VALUES (?, ?, 'Income,Food,Health,Home,Auto,Insurance,Utility,Debt,Work,Entertainment', 'Rent,Electric,Utility,Home Insurance,Health Insurance,Car Insurance,Phone,Loan,Internet,Web Hosting,Medical,This is not a bill.', 'usd')";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }

        $sql = "CREATE TABLE IF NOT EXISTS `$username` (`UID` datetime NOT NULL, `Category` text NOT NULL, `Who` text NOT NULL, `Amount` decimal(11,2) NOT NULL, `Currency` text NOT NULL, `Bill` text NOT NULL, PRIMARY KEY (`UID`), `Type` tinyint(1) NOT NULL, `Note` text NOT NULL, `File` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		
		if (!file_exists('../uploads/' . $username . '/')) {
			mkdir('../uploads/' . $username . '/', 0777, true);
		}
         
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){
                header("location: ../login/");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>𝐄𝐗𝐏𝐄𝐍𝐃𝐎𝐑 | Register Account</title>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link href="../style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ position:absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 100%; padding: 20px; }
		.wrapper input { display: block; width: 360px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Register Account</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" placeholder="Username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
<!-- Option to select default categories and bill classifications or go through the configuration wizard. -->
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Submit"><br/>
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>
            <p>Already have an account? <a href="../login/">Login here</a>.</p>
        </form>
<?php
include('../footer.php');
?>