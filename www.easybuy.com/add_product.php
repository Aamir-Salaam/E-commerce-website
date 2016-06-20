<?php
session_start();
if(!isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}

include_once("scripts/connect.php");
$id="";
$total="";
$price="";

if(isset($_GET['id'])){

  $id=preg_replace('#[^0-9]#i','',$_GET['id']);


///////////
	$mem_id = preg_replace('#[^0-9]#i','',$_SESSION['id']);
	$result3 = mysql_query("SELECT price FROM products WHERE id='$id'");
	$count3 = mysql_num_rows($result3);
	if($count3 > 0){
	while($row2=mysql_fetch_array($result3)){
	    $price = $row2["price"];
		
		$result1 = mysql_query("SELECT * FROM shopping WHERE mem_id='$mem_id'");
	$count1 = mysql_num_rows($result1);
	if($count1 > 0){
	    while($row = mysql_fetch_array($result1)){
		    $cart = $row["cart"];
			$total = $row["total"];
			
		    $result2 = mysql_query("INSERT INTO shopping(mem_id, cart, total) VALUES('$mem_id','$id','$price')");
		    header("location: shopping_cart.php");
		    exit();
		}
	
	
	}else{
	
	    mysql_query("INSERT INTO shopping(mem_id, cart, total) VALUES('$mem_id','$id','$price')");
	    header("location: shopping_cart.php");
		exit();
	}
	
	}
	}else{
	
	header("location: index.php");
	exit();
	
	}
	

}else{
    header("location: index.php");
	exit();
}

?>