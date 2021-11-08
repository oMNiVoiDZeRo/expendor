<?php
ob_start();

require_once "../header.php";

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
        $sql = "INSERT INTO users (username, password, categories, bills, currencies) VALUES (?, ?, 'Food,Health,Home,Auto,Insurance,Utility,Debt,Work,Entertainment', 'Rent,Electric,Utility,Home Insurance,Health Insurance,Car Insurance,Phone,Loan,Internet,Web Hosting,Medical,This is not a bill.', 'usd')";
         
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

        $sql = "CREATE TABLE IF NOT EXISTS `$username` (`UID` datetime NOT NULL, `Category` text NOT NULL, `Who` text NOT NULL, `Amount` decimal(13,8) NOT NULL, `Currency` text NOT NULL, `Bill` text NOT NULL, PRIMARY KEY (`UID`), `Type` tinyint(1) NOT NULL, `Note` text NOT NULL, `File` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		
		if (!file_exists('../uploads/' . $username . '/')) {
			mkdir('../uploads/' . $username . '/', 0777, true);
		}

        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){
                header("location: ../login/", true, 301);
				exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>
<div class="dialog">
	<h2>Register Account</h2>
	<p>Please fill this form to create an account.</p>
	<form id="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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