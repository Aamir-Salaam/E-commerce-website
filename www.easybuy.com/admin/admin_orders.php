<?php
session_start();
if(!isset($_SESSION['name'])){
   header("location: ../index.php");
    exit();
}

$inventory_products="";
include_once("../scripts/connect.php");
$sql=mysql_query("SELECT * FROM shopping ORDER BY mem_id");
$count=mysql_num_rows($sql);
if($count > 0){
    
	while($row=mysql_fetch_array($sql)){
	        
			$id= $row["id"];
			$mem_id= $row["mem_id"];
			$cart= $row["cart"];
			$total= $row["total"];
			
         	$inventory_products .="$id | $mem_id | $cart | $total | <a href='#'>Remove</a><br/>";
	
	}

}else{

  $inventory_products="No Orders In The Database Right Now";
}

?>


<!DOCTYPE html > 
<html lang="en">
<head>
<title>Admin Orders</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style/main.css" media="screen">
<link rel="stylesheet" href="style/forms.css" media="screen">
<title>Untitled Document</title>
</head>

<body>

  <div id="main_wrapper">
<?php include_once("templates/tmp_header.php"); ?>
<?php include_once("templates/tmp_nav.php"); ?>
	 

	 <section id="main_content">
	 <h2 class="page_title">Orders</h2>
	 <br/>
	 <?php echo $inventory_products; ?>
	 </section>
	 
<?php include_once("templates/tmp_aside.php"); ?>
<?php include_once("templates/tmp_footer.php"); ?>	 
	
  </div>
  <div id = "page_bottom">
    <h1>Welcome Admin!</h1>
	</div>
	<div id ="page_bottom">
	
	</div>
</body>
</html>
