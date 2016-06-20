<?php
session_start();
if(!isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}

$style = "";
include_once("scripts/connect.php");

$sql = mysql_query("SELECT * FROM site_style WHERE status='1' LIMIT 1");
while($row = mysql_fetch_array($sql)){
     $style = $row["name"];

}
////
$new_products="";
$sql2 = mysql_query("SELECT * FROM products WHERE category='t-shirt' ORDER BY date_added DESC");
$count = mysql_num_rows($sql2);
if($count > 0){
      
	    while($row=mysql_fetch_array($sql2)){
	        
			$id= $row["id"];
			$name= $row["name"];
			$brand= $row["brand"];
			$category= $row["category"];
			$price= $row["price"];
			$source = "products/$id.jpg";
			$img = '<img src="' .$source. '" width="160" border="0">';
			$quantity= $row["quantity"];
			$status= $row["status"];
			$date_added= $row["date_added"];
         	$new_products .= '
			
			   <div id="d_p">
			   
			       <a href="view.php?id=' . $id . '">' . $img . '</a>
				     <br/>
				   ' . $name . '
				     <br/>
				   ' . $brand . '
				     <br/>
				   $' . $price . '
				     <br/>	 
			   
			   </div>  
			
			';
	
	}
  

}else{

   $new_products = "<p style='color: #C00; font-weight: bold; font-size= 18px;'>No Products In The Store Right Now</p>"; 


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy_Buy</title>
<meta charset="utf-8">
<meta name ="keywords" content="">
<meta name ="description" content="">
<link rel="stylesheet" type="text/css"  media="screen" href="style/<?php echo $style;?>">
<link rel="stylesheet" href="style/main.css" media="screen">
<style type="text/css">
#newest_products{
    width: 750px;
	border-top: 2px solid #333;
	padding-top: 20px;
	padding-right:30px;
}

#d_p{

   float:left;
   width: 160px;
   padding: 10px;
   font-family:grafikimport;
   margin-right: 10px;
   margin-bottom: 10px;
   text-align: center;
   border: 0px;
   background:url(images/b8.jpg);

}

</style>
</head>
<body>
      <div id = "main_wrapper">
	      <?php include_once("templates/tmp_header.php"); ?>
		 <?php include_once("templates/tmp_menu.php"); ?>
		 <div id="content_wrapper">
		     <table cellpadding="0" cellspacing"0" border="0" width="1000">
			     <tr>
				     <td valign="top">
					  <?php include_once("templates/tmp_left.php"); ?>
		                
					 </td>
					 <td valign="top">
					 <section id ="main_content">
						     <div id="newest_products">
							 <?php echo $new_products; ?>
							 </div>
						 </section>
		                 
					 </td>
					 <td valign="top">            
		                 <?php include_once("templates/tmp_right.php"); ?>
					 </td>
				</tr>
			</table>	
		 </div>
		
	  </div>
	   <?php include_once("templates/tmp_footer.php"); ?>
</body>
</html>