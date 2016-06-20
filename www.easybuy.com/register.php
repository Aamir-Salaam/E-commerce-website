<?php
$style = "";
include_once("scripts/connect.php");
/*
$sql = mysql_query("SELECT * FROM site_style WHERE status='1' LIMIT 1");
while($row = mysql_fetch_array($sql)){
     $style = $row["name"];

}
*/
//////////////////////////////////////////////////

$full_name = "";
$country = "";
$city = "";
$state = "";
$phone = "";
$email = "";
$signup = "";
$password = "";
$address = "";
$ip = "";
$msg = "";
if(isset($_POST['full_name'])){
  
   $full_name=$_POST['full_name'];
   $country=$_POST['country'];
   $city=$_POST['city'];
   $state=$_POST['state'];
   $phone=$_POST['phone'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $address=$_POST['address'];
   ///////////////////////////////
   $full_name=preg_replace('#[^A-Za-z]#i','',$full_name);
   $country=preg_replace('#[^A-Za-z]#i','',$country);
   $city=preg_replace('#[^A-Za-z]#i','',$city);
   $state=preg_replace('#[^A-Za-z]#i','',$state);
   $phone=preg_replace('#[^0-9]#i','',$phone);
   $password=preg_replace('#[^A-Za-z0-9]#i','',$password);
   $address=preg_replace('#[^A-Za-z0-9]#i','',$address);
   /////////////////////////////////////
   $full_name=strip_tags($full_name);
   $country=strip_tags($country);
   $city=strip_tags($city);
   $state=strip_tags($state);
   $phone=strip_tags($phone);
   $password=strip_tags($password);
   $address=strip_tags($address);
   /////////////////////////////////////
   $full_name=stripslashes($full_name);
   $country=stripslashes($country);
   $city=stripslashes($city);
   $state=stripslashes($state);
   $phone=stripslashes($phone);
   $password=stripslashes($password);
   $address=stripslashes($address);
   ////////////////////////////////////////
   $email=mysql_real_escape_string($email);
   ///////////////////////////////////////
   if((!$full_name) || (!$country) || (!$city) || (!$phone) || (!$password) || (!$email) || (!$address)){
   
      $msg .="Fill All The * Marked Fields!!<br/>";
	   
  
   }else{
   
   include_once("scripts/connect.php");
   $email_check = mysql_query("SELECT email FROM users WHERE email='$email' LIMIT 1");
   $count_email = mysql_num_rows($email_check);
    if(strlen($phone) < 9){
   
   $msg .="Please insert a valid phone number<br/>";
   
   
   }else if(strlen($password) < 6){
   
   $msg .="Please insert a password having atleast six characters<br/>";
   
   
   }else if($count_email==1){
   
   $msg .="That email address already exists, please enter a different one.<br/>";
   
   }
   else{
   
   
   $password = md5($password);
   $ip = $_SERVER['REMOTE_ADDR'];
   $sql2 = mysql_query("INSERT INTO users(full_name, country, city, state, phone, email, password, address, ip, signup) VALUES('$full_name','$country','$city','$state','$phone','$email','$password','$address','$ip',now())");
   header("location: success_register.php");
   exit();
   }

}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Registration</title>
<meta charset="utf-8">
<meta name ="keywords" content="">
<meta name ="description" content="">

<style type="text/css">

  @font-face{
    font-family:extraornamentalimport;
	src:url("http://localhost/www.easybuy.com/custom_fonts/extraornamental.ttf") format(truetype);
 }	
 
body{
background:url(images/b8.jpg);


}
#main_wrapper{
  width: 600px;
  height:600px;
  padding:: 15px;
  margin:: 100px auto;
  background:url(images/bb8.jpg);
  
}
h2{
  color: #FFFFFF;
  font-family: extraornamentalimport;
  font_size: 32px;

}

label{
   color:#000000;
   font-family:extraornamentalimport;
   font-weight: bold;

}
.text_input{
     width: 150px;
     padding: 5px;
	 
}
#button{
   padding: 5px 8px 5px;
}
#right_side{
     width: 150px;
	 height: 80px;
	 margin-left: 15px;
	 margin-right: 15px;
	 margin-top:20px;

}

#cart_wrap{
   width: 150px;
   height: 80px;
   margin-top: 5px;
}

#cart_header{
width: 130px;
height: 80px;
font-family:extraornamentalimport;
font-size:36px;
padding: 10px;
text-align: center;
color:#FFFFFF;
background:url(images/b1.jpg)
 
}
#cart_header:hover{
   color:#000000;
   background: url(images/b18.jpg);
}
#content_wrapper{
    width: 1000px;
}
#main_content{
    float: left;
	width: 780px;
}	
</style>

</head>
<body>
      <div id = "main_wrapper">
		 <div id="content_wrapper">
		     <table cellpadding="0" cellspacing"0" border="0" width="1000">
			     <tr>
				     <td valign="top">
		                
					 </td>
					 <td valign="top">
					 <section id ="main_content">
						    <h2 class="page_title">Create An Account</h2>
							<br/>
							<form method="post" action="register.php" enctype="multipart/form-data">
	 <table width="100%" cellpadding="5" cellspacing="5" border="0">
	 
	   <tr>
		     <td align="right" width="150px"><label>Full Name*:</label></td>
			 <td align="left"><input type="text" name="full_name" class="text_input" maxlength="100"/></td>
	   </tr>
	   <tr>
		     <td align="right" width="150px"><label>Country*:</label></td>
			 <td align="left"><select name="country" class="text_input">
			       
				   <option value=""></option>
				    <?php include_once("countries.txt"); ?>
			    </select>
			    </td>
	   </tr>
	  <tr>
		     <td align="right" ><label>City*:</label></td>
			 <td align="left"><input type="text" name="city" class="text_input" maxlength="100"/></td>
	 </tr>
	  <tr>
		     <td align="right" ><label>State:</label></td>
			 <td align="left"><input type="text" name="state" class="text_input" maxlength="100"/></td>
	 </tr>
	 <tr>
		     <td align="right" ><label>Phone Number*:</label></td>
			 <td align="left"><input type="tel" name="phone" class="text_input" maxlength="30"/></td>
	 </tr>
	 <tr>
		       <td align="right"><label>Email Address*:</label></td>
			 <td align="left"><input type="email" name="email" class="text_input" maxlength="80"/></td>
		  </tr>
		  <tr>
		       <td align="right"><label>Password*:</label></td>
			 <td align="left"><input type="password" name="password" class="text_input" maxlength="40"/></td>
		  </tr>

	  <tr>
		     <td align="right" ><label>Address*:</label></td>
			 <td align="left"><textarea name="address" style="width:300px;height:80px;padding:5px;resize"></textarea></td>
	 </tr>
	  <tr>
		     <td><input type="submit" name="submit" id="button" value="Create Account"/></td>
		     <td><a style="color:#FFFFFF; font-size:24px" href="user_login.php">Cancel</a></td>
		 </tr>
		 <tr>
		       <td align="center" colspan="2" style="color:#FFFFFF"><?php echo $msg ?></td>
		 </tr>
	 
	 </table>
	 </form>
						 </section>
		                 
					 </td>
					 <td valign="top">            
					 </td>
				</tr>
			</table>	
		 </div>
		
	  </div>
</body>
</html>