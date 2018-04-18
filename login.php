<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$Username = $Password = "";
$Username_err = $Password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if Username is empty
    if(empty(trim($_POST["Username"]))){
        $Username_err = 'Please enter Username.';
    } else{
        $Username = trim($_POST["Username"]);
    }
    
    // Check if Password is empty
    if(empty(trim($_POST['Password']))){
        $Password_err = 'Please enter your Password.';
    } else{
        $Password = trim($_POST['Password']);
    }
    
    // Validate credentials
    if(empty($Username_err) && empty($Password_err)){
        // Prepare a select statement
        $sql = "SELECT Username, Password FROM users WHERE Username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Username);
            
            // Set parameters
            $param_Username = $Username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if Username exists, if yes then verify Password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $Username, $hashed_Password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(Password_verify($Password, $hashed_Password)){
                            /* Password is correct, so start a new session and
                            save the Username to the session */
                            session_start();
                            $_SESSION['Username'] = $Username;      
                            header("location: index.php");
                        } else{
                            // Display an error message if Password is not valid
                            $Password_err = 'The Password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if Username doesn't exist
                    $Username_err = 'No account found with that Username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
    <div class="register-page">
        
        <head>
            <meta charset="UTF-8">
            <title>Login</title>
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/style.css">
        </head>
        
        <body>
            <di0v class="form">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($Username_err)) ? 'has-error' : ''; ?>">
                        <input type="text" name="Username" class="form-control" value="<?php echo $Username; ?>" placeholder="Username">
                        <span class="help-block"><?php echo $Username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($Password_err)) ? 'has-error' : ''; ?>">
                        
                        <input type="Password" name="Password" class="form-control" placeholder="Password">
                        <span class="help-block"><?php echo $Password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" value="Login">Login</button><br>
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                    <p class="message">Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>    
        </body>
    </div>
</html>