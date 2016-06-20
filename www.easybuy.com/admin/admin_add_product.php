<?php
session_start();
if(!isset($_SESSION['name'])){
   header("location: ../index.php");
    exit();
}

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
           include_once("../scripts/connect.php");
           $sql = mysql_query("INSERT INTO products(name,brand,category,sizes,description,price,quantity,date_added,type) VALUES('$product_name','$product_brand','$product_category','$product_sizes','$product_description','$product_price','$product_quantity',now(),'n')");
           $id = mysql_insert_id();
		   $place_file = move_uploaded_file($_FILES['fileField']['tmp_name'],"../products/$id".$newname);
		   $msg = "Success!";
         }
     }
	} 
}
?>


<!DOCTYPE html > 
<html lang="en">
<head>
<title>Admin Add Product</title>
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
	 <h2 class="page_title">Add A New Product To Store</h2>
	 <br/>
	 <form method="post" action="admin_add_product.php" enctype="multipart/form-data">
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
