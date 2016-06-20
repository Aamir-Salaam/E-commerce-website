<?php

session_start();
if(!isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}
/////////////////////////////
$messages = "";
$messages2 = "";
$sum="";
$id="";

$user_customer= preg_replace('#[^0-9]#i','',$_SESSION['id']);
include_once("scripts/connect.php");
$sql=mysql_query("SELECT * FROM shopping WHERE mem_id=$user_customer ORDER BY total");
$count=mysql_num_rows($sql);
if($count > 0){
         
    while($row=mysql_fetch_array($sql)){
	
	     $id= $row["id"];
		 $mem_id= $row["mem_id"];
		 $cart= $row["cart"];
		 $total= $row["total"];
		 $sum=$sum+$total;
		 $messages .='
		     <tr>
			 
			    <td align="center">' . $mem_id . '</td>
			    <td align="center">' . $cart . '</td>
				<td align="center">' . $total . '</td>
	
				<td align="center"><a href="del_cart.php?id=$id">Delete ' . $id . '</a></td>     
			    
			 </tr>
			 
		 ';
	
	
	}
	$messages2 .='
	   
	   			 <tr>
			 <td>' . $sum . '</td>
			 </tr>
			 
		 ';


}else{

  $messages="No Orders To Display Right Now";
}

?>


<!DOCTYPE html > 
<html lang="en">
<head>
<title>Shopping Cart</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style/main.css" media="screen">
<link rel="stylesheet" href="style/forms.css" media="screen">
<title>Untitled Document</title>
</head>

<body>

  <div id="main_wrapper">
<?php include_once("templates/tmp_header.php"); ?>
<?php include_once("templates/tmp_menu.php"); ?>
	 

	 <section id="main_content">
	 <h2 class="page_title">Shopping Cart</h2>
	 <br/>
	 <table width="730" cellspacing="0" cellpadding="3" border="1">
	     <tr>
		    <td align="center" width="100">Member Id</td>
			<td align="center" width="300">Product Id</td>
			<td align="center" width="300">Price</td>
			<td align="center" width="100">Actions</td>
		 </tr>
	     <?php echo $messages; ?>
         	 
	 </table>
	 <table>
	 <tr>
	 <td style="font-size:28px; font-weight:800">Your Total:</td>
	 </tr>
	 <?php echo $messages2; ?>
	 </table>
	 </section>
	 
<?php include_once("templates/tmp_right.php"); ?>
  </div>
  <div id = "page_bottom">
    <h1>Welcome!</h1>
	</div>
	<div id ="page_bottom">
	
	</div>

<?php include_once("templates/tmp_left.php"); ?>
<?php include_once("templates/tmp_footer.php"); ?>	 
	
</body>
</html>
