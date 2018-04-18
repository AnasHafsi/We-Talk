<?php
require_once 'config.php';

session_start();
// Escape user inputs for security
$Message = mysqli_real_escape_string($link, $_REQUEST['Message']);
$Username = mysqli_real_escape_string($link, $_SESSION['Username']);

$sql2= "SELECT id FROM users WHERE Username='$Username';";

$result = mysqli_query($link, $sql2);
$row = mysqli_fetch_array($result);
$id_Sender = $row['id'];
 
// attempt insert query execution
$sql = "INSERT INTO messages (Sender, Message, id_Sender) VALUES ('$Username', '$Message', $id_Sender)";
if ($Message != "") {
	
	if(mysqli_query($link, $sql)){
	} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}
 
// close connection
header("location: index.php");
?>