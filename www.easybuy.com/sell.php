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
$msg="";

if(isset($_POST['product_name'])){
   $product_name = $_POST['product_name'];
   $product_brand = $_POST['product_brand'];
   $product_category = $_POST['product_category'];
   $product_sizes = $_POST['product_sizes'];
   $product_description = $_POST['product_description'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];
   
   ////////////////////////////////////////////////// 
   $product_name = strip_tags($product_name);
   $product_brand = strip_tags($product_brand);
   $product_category = strip_tags($product_category);
   $product_description = strip_tags($product_description);
   $product_price = strip_tags($product_price);
   $product_quantity = strip_tags($product_quantity);
   ///////////////////////////////////////////////////
   $product_name = stripslashes($product_name);
   $product_brand = stripslashes($product_brand);
   $product_category = stripslashes($product_category);
   $product_description = stripslashes($product_description);
   $product_price = stripslashes($product_price);
   $product_quantity = stripslashes($product_quantity);
	
   if((!$product_name) || (!$product_brand) || (!$product_category) || (!$product_description) || (!$product_price) || (!$product_quantity)){
   
     $msg = "<p style='color: #C00; font-weight: bold; font-size= 18px;'>Please Enter All The Input Data!!</p>";
	    
   }else{ 
   if($_FILES['fileField']['tmp_name'] !=  ""){
      $maxfilesize = 1000000;
      if($_FILES['fileField']['size'] > $maxfilesize) {
	       $msg = '<p class="error message">Your image was too large, please try again.</p>';
	       unlink($_FILES['fileField']['tmp_name']);
	  }else if(!preg_match("/\.(gif|jpg|png)$/i",$_FILES['fileField']['name'])){
	       $msg = '<p class="error message">Your image was not one of the accepted formats, please try again.</p>';
	       unlink($_FILES['fileField']['tmp_name']);
	}else{
	       $newname = ".jpg";
           include_once("scripts/connect.php");
           $sql2 = mysql_query("INSERT INTO products(name,brand,category,sizes,description,price,quantity,date_added,type) VALUES('$product_name','$product_brand','$product_category','$product_sizes','$product_description','$product_price','$product_quantity',now(),'s')");
           $id = mysql_insert_id();
		   $place_file = move_uploaded_file($_FILES['fileField']['tmp_name'],"products/$id".$newname);
		   $msg = "Your item has been enlisted.You will be contacted via e-mail, as soon as a buyer is found.";
         }
     }
	} 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Sell Items</title>
<meta charset="utf-8">
<meta name ="keywords" content="">
<meta name ="description" content="">
<link rel="stylesheet" type="text/css"  media="screen" href="style/<?php echo $style;?>">
<link rel="stylesheet" type="text/css"  media="screen" href="style/forms.css">
<style type="text/css">
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
					 <section id="main_content">
	 <h2 class="page_title">Sell Your Items</h2>
	 <br/>
	 <form method="post" action="sell.php" enctype="multipart/form-data">
	  <table width="100%" cellpadding="5" cellspacing="5" border="0">
	      <tr>
		       <td align="right" width="150px"><label>Product Name:</label></td>
			 <td align="left"><input type="text" name="product_name" class="text_input" maxlength="100"/></td>
		  </tr>
		  <tr>
		       <td align="right"><label>Product Brand:</label></td>
			 <td align="left"><input type="text" name="product_brand" class="text_input" maxlength="50"/></td>
		  </tr>
		  		  <tr>
		       <td align="right"><label>Category:</label></td>
			   <td align="left">
			    <select name="product_category" class="text_input">
			       
				   <option></option>
				   <option value="t-shirt">T-Shirt</option>
				   <option value="trousers">Trousers</option>
				   <option value="shoes">Shoes</option>
			       <option value="denims">Denims</option>
				   <option value="jackets">Jackets</option>
				   <option value="sweaters">Sweaters</option>
			    </select>
			 </td>
		  </tr>

		  <tr>
		       <td align="right" ><label>Sizes:</label></td>
			 <td align="left"><textarea name="product_sizes" style="width:300px;height:80px;padding:5px;resize:none"></textarea></td>
		  </tr>
		  <tr>
		       <td align="right" ><label>Description:</label></td>
			 <td align="left"><textarea name="product_description" style="width:300px;height:80px;padding:5px;resize"></textarea></td>
		  </tr>
		   <tr>
		       <td align="right" ><label>Price:</label></td>
			 <td align="left"><input type="text" name="product_price" class="text_input" maxlength="10"/>&nbsp;$</td>
		  </tr>
		  <tr>
		       <td align="right" ><label>Quantity:</label></td>
			 <td align="left"><input type="text" name="product_quantity" class="text_input" maxlength="7"/></td>
		  </tr>
		  <tr>
		       <td align="right" ><label>Photo:</label></td>
			 <td align="left">
			      <input name="fileField" type="file" class="formFields" id="fileField"/>
			      <input name="parse_var" type="hidden" value="pho1" />
			 </td>
		  </tr>
		  <tr>
		     <td align="center" colspan="2"><input type="submit" name="submit" id="button" value="Add Product"/></td>
		 
		 </tr>
		 <tr>
		       <td align="center" colspan="2"><?php echo $msg ?></td>
		 </tr>
	  </table>  
	 </form>
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