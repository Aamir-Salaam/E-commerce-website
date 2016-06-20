<?php

session_start();
$_SESSION = array();
session_destroy();
if(!isset($_SESSION['email'])){
     header("location: user_login.php");
	 }else{
	 echo "<h2>Could not log you out,sorry an error is encountered by the system.</h2>";
	 exit();
}


?>