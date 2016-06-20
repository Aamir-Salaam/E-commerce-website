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
$msg_error="";
if(isset($_POST['msg_name'])){

   $msg_name = $_POST['msg_name'];
   $msg_email = $_POST['msg_email'];
   $msg_subject = $_POST['msg_subject'];
   $msg_message = $_POST['msg_message'];
   ////////////////////////////////////////////////// 
   $msg_name = strip_tags($msg_name);
   $msg_email = strip_tags($msg_email);
   $msg_subject = strip_tags($msg_subject);
   $msg_message = strip_tags($msg_message);
   ///////////////////////////////////////////////////
   $msg_name = stripslashes($msg_name);
   $msg_email = mysql_real_escape_string($msg_email);
   $msg_subject = stripslashes($msg_subject);
   $msg_message = stripslashes($msg_message);
   ///////////////////////////////////////////////////
   if((!$msg_name) || (!$msg_email) || (!$msg_subject) || (!$msg_message)){
   
     $msg_error = "<p style='color: #C00; font-weight: bold; font-size= 18px;'>Please Enter All The Input Data!!</p>";
	    
   }else{
   
           include_once("scripts/connect.php");
           $sql = mysql_query("INSERT INTO messages(msg_name,msg_email,msg_subject,msg_message,msg_date) VALUES('$msg_name','$msg_email','$msg_subject','$msg_message',now())");
		   
		   $msg_error = "<p style='color: #0C0; font-weight: bold; font-size= 18px;'>Your message has been successfully delivered.We will contact you soon!!</p>";
   
   
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact Us</title>
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
					 <section id ="main_content">
						   <h2 class="page_title">Contact Us</h2>
						   <br/>
						   <form action="contact.php" method="post" enctype="multipart/form-data">
						     <table width="100%" cellpadding="5" cellspacing="5" border="0">
	      <tr>
		       <td align="right" width="150px"><label>Full Name:</label></td>
			 <td align="left"><input type="text" name="msg_name" class="text_input" maxlength="100"/></td>
		  </tr>
		  <tr>
		       <td align="right"><label>Email Address:</label></td>
			 <td align="left"><input type="email" name="msg_email" class="text_input" maxlength="80"/></td>
		  </tr>
		  		  <tr>
		           <td align="right" ><label>Subject:</label></td>
			       <td align="left"><input type="text" name="msg_subject" class="text_input" maxlength="50"/></td>
		         </tr>
		  <tr>
		      <td align="right" ><label>Message:</label></td>
			 <td align="left"><textarea name="msg_message" style="width:300px;height:100px;padding:5px;resize"></textarea></td>
		 </tr>
		 <tr>
		     <td align="center" colspan="2"><input type="submit" name="submit" id="button" value="Send Message"/></td>
		 
		 </tr>
		 <tr>
		       <td align="center" colspan="2"><?php echo $msg_error; ?></td>
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