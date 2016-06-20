<?php
session_start();
if(!isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}


$id="";
$total="";
$price="";
$message="";

if(isset($_GET['id'])){
    $proc_id=$_GET['id'];


///////////
			include_once("scripts/connect.php");
		    $result2 = mysql_query("DELETE FROM shopping WHERE id=$id");
			$message .='Hurrah!!';
			echo $message;
		    header("location: shopping_cart.php");
		    exit();
	
	

}else{
    header("location: index.php");
	exit();
}

?>