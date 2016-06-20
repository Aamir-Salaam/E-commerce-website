<?php

session_start();
if(isset($_SESSION['email'])){
   header("location: index.php");
    exit();
}
$email = "";
$password = "";
$msg = "";
if(isset($_POST['email'])){
      $email = $_POST['email'];
	  $password = $_POST['password'];
      $email = stripslashes($email);
	  $password= stripslashes($password);
	  $email = strip_tags($email);
	  $password = strip_tags($password);
	  if((!$email) || (!$password) ){
	       $msg = "<p style = 'color: #CCO; font-weight: bold;'>Wrong username or password </p>";
	  
	  }
	  else{
	      $email = mysql_real_escape_string($email);
		  $password = md5($password);
	      include_once("scripts/connect.php");
		  $sql = mysql_query("SELECT * FROM users WHERE  email = '$email' AND password = '$password'");
		  $count = mysql_num_rows($sql);
	       if($count > 0){
		      while($row = mysql_fetch_array($sql)){
			    $s_id = $row['id'];
				$s_email = $row['email'];
				$s_pass = $row['password'];
				$_SESSION['id'] = $s_id;
					$_SESSION['email'] = $s_email;
						$_SESSION['password'] = $s_pass;
						mysql_query("UPDATE users SET last_log = now()  WHERE email = '$s_email' LIMIT 1");
						}
						header("location: index.php");
						exit();
			  
		   }else{
		   $msg = "<p style = 'color: #C00; font-weight: bold;'>Wrong username or password </p>";
		   } 
	  
	  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>User Log In</title>
<meta charset="utf-8">
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
  height:490px;
  padding:: 15px;
  margin:: 100px auto;
  background:url(images/b5.jpg);
  
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
      <div id = "main_wrapper" align="center">
	     <form action ="user_login.php" method="post"  enctype="multipart/form-data">
		 <table width="100%" cellpadding="5" cellspacing="5" border="0">
		 <tr>
		     <td align="left" colspan="2"><h2>User Log In</h2></td>
		 </tr>
		 <tr>
		     <td align="right"><label>E-mail Id:</label></td>
			 <td align="left"><input type="text" name="email" class="text_input" maxlength="50"/></td>
			 
		 </tr>
		 <td align="right"><label>Password:</label></td>
			 <td align="left"><input type="password" name="password" class="text_input" maxlength="40"/></td>
<tr></tr>
<tr></tr>
		 <tr>
		     <td align="center" colspan="2"><input type="submit" name="submit
			 " id="button" value="Log In"/></td>
		 
		 </tr>
		   <tr>
		       <td align="center" colspan="2"><?php echo $msg ?>
			   
			   </td>
		   </tr>
		 
		 </table>
		 </form>

		 </div>
		 		     <div align="right" id="right_side">
   				    <div id="cart_wrap">
							    <div id ="cart_header">
								  <a style="color:#FF0000" href="register.php">Register</a>
								</div>

							</div>
							
	</div>

</body>
</html>