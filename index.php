<?php
    // Initialize the session
    session_start();
     
    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['Username']) || empty($_SESSION['Username'])){
        header("location: login.php");
        exit;
    }
    $Message="";

?>
 
<!DOCTYPE html>
<html lang="en">
<div class="register-page">
    
    <head>
        <script type="text/javascript" src="jquery-3.3.1.js"></script>
        <script type="text/javascript">
            function upd() {
                var phpfonc =  " ";

                var eho =console.log(phpfonc);
                setTimeout( eho, 1000);
            }
            function setto() {
                
            }
        </script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <style type="text/css">
            p{ background: #76b852; /* fallback for old browsers */
                  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
                  background: -moz-linear-gradient(right, #76b852, #8DC26F);
                  background: -o-linear-gradient(right, #76b852, #8DC26F);
                  background: linear-gradient(to left, #76b852, #8DC26F);
                  font-family: "Roboto", sans-serif;
                  -webkit-font-smoothing: antialiased;
                  -moz-osx-font-smoothing: grayscale; font: 14px sans-serif; text-align: center; }
        </style>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="register-page">
            <div class="page-header">
                <h1>Hi, <b><?php echo $_SESSION['Username']; ?></b>. Welcome to our site.</h1>
            </div>
            <body>
                <div class="form">
                    <h2>Chat</h2>
                    <form action="Send.php" method="post">
                        <div class="form-group">
                            <div class="textinp">
                                <textarea type="text" name="Message" id="Message"  placeholder="Message"></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" value="Send">Send</button><br>
                            <button type="reset" onclick="upd()" value="ref">ref</button><br>
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        <?php
                    require_once 'config.php';
                    $sql2= "SELECT * FROM messages;";
                    $result = mysqli_query($link, $sql2);
                    while($row = mysqli_fetch_array($result)){
                        echo  '<br><b>'.$row['Sender']. " :</b>" . $row['Message'] ;
                    }    

                ?>
                    </form>
                    <p id="txt"></p>
                    </div>    

            
            </body>
        </div>
        <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
    </body>
    </div>
</html>