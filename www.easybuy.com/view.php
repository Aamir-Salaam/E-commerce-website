<?php
session_start();
if(!isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}

include_once("scripts/connect.php");

$sql = mysql_query("SELECT * FROM site_style WHERE status='1' LIMIT 1");
while($row = mysql_fetch_array($sql)){
     $style = $row["name"];

}


////
$id="";
if(isset($_GET['id'])){

  $id=preg_replace('#[^0-9]#i','',$_GET['id']);

}else{
    header("location: index.php");
	exit();
}

///////////////////

/////////////////////
$price = "";
$product="";
$sql2 = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
$count = mysql_num_rows($sql2);
if($count > 0){
        
	    while($row=mysql_fetch_array($sql2)){
	        
			$id= $row["id"];
			$name= $row["name"];
			$brand= $row["brand"];
			$category= $row["category"];
			$sizes=$row["sizes"];
			$description=$row["description"];
			$price= $row["price"];
			$source = "products/$id.jpg";
			$img = '<a href="' . $source . '"target="_blank"><img src="' .$source. '" width="290" border="0"></a>';
			$quantity= $row["quantity"];
			$status= $row["status"];
			$date_added= $row["date_added"];
         	$product = '
			    <div id="d_p">
			   <table width="580" border="0" cellpadding="4" cellspacing="4">
			      <tr>
			          <td width="300">' . $img . '</td>
					  <td width="280">
					       <br/>
				           <h2 class="page_title">' . $name . '</h2>
				           <br/>
						   <br/>
				           Brand: ' . $brand . '
						   <br/>
						   <br/>
				           Sizes: ' . $sizes . '
				           <br/>
						   <br/>
				           Price: $' . $price . '
						   <br/>
						   <br/>
				           Description: ' . $description . '
				           <br/>
						   <br/>
						   <a href="add_product.php?id=' . $id . '">Add To Cart</a>
						  
					  </td>
				   </tr>	  
				     
			  
			   </table> 
			   </div> 
			
			';
			/*
			$user_customer=$_SESSION['id'];
            $sql4 = mysql_query("INSERT INTO shopping(mem_id, cart, total) VALUES('$user_customer','$id','$price')");
	*/
	
	}
	
  

}else{

   header("location: index.php");
   exit();


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy_Buy-View</title>
<meta charset="utf-8">
<meta name ="keywords" content="">
<meta name ="description" content="">
<link rel="stylesheet" type="text/css"  media="screen" href="style/<?php echo $style;?>">
<link rel="stylesheet" href="style/main.css" media="screen">
<link rel="stylesheet" href="style/forms.css" media="screen">
<style type="text/css">
#newest_products{
    width: 750px;
	border-top: 2px solid #333;
	padding-top: 20px;
	padding-right:30px;
}

#d_p{

   float:left;
   width:290px;
   padding: 10px;
   font-family:tahoma;
   margin-right: 10px;
   margin-bottom: 10px;
   text-align:left;
   font-weight:bold;
   border: 0px;
   

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
						     <?php echo $product; ?>
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