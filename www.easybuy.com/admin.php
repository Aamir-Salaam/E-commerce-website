<?php

session_start();
if(isset($_SESSION['admin'])){
   header("location: admin/index.php");
    exit();
}

$msg = "";
if(isset($_POST['username'])){
      $admin = $_POST['username'];
	  $password = $_POST['password'];
      $admin = stripslashes($admin);
	  $password= stripslashes($password);
	  $admin = strip_tags($admin);
	  $password = strip_tags($password);
	  if((!$admin) || (!$password) ){
	       $msg = "<p style = 'color: #CCO; font-weight: bold;'>Wrong username or password </p>";
	  
	  }
	  else{
	      $admin = mysql_real_escape_string($admin);
		  $password = md5($password);
	      include_once("scripts/connect.php");
		  $sql = mysql_query("SELECT * FROM admin WHERE  name = '$admin' AND password = '$password'");
		  $count = mysql_num_rows($sql);
	       if($count > 0){
		      while($row = mysql_fetch_array($sql)){
			    $s_id = $row['id'];
				$s_name = $row['name'];
				$s_pass = $row['password'];
				$_SESSION['id'] = $s_id;
					$_SESSION['name'] = $s_name;
						$_SESSION['password'] = $s_pass;
						mysql_query("UPDATE admin SET last_log = now()  WHERE name = '$s_name' LIMIT 1");
						}
						header("location: admin/index.php");
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
<title>Admin Log In</title>
<meta charset="utf-8">
<style type="text/css">
body{
background:#330099;
color:#FFFFFF;

}
#main_wrapper{
  width: 400px;
  padding:: 15px;
  margin:: 100px auto;
  background:: #FFFFFF;
  
}
h2{
  color:#FF0033;
  font-family: Tahoma, Geneva,sans-serif;
  font_size: 24px;

}

label{
   color:#FFF;
   font-family:Arial, Helvetica, sans-serif;
   font-weight: bold;

}
.text_input{
     width: 150px;
     padding: 5px;
	 
}
#button{
   padding: 5px 8px 5px;
}
</style>
</head>
<body>
      <div id = "main_wrapper">
	     <form action ="admin.php" method="post"  enctype="multipart/form-data">
		 <table width="100%" cellpadding="5" cellspacing="5" border="0">
		 <tr>
		     <td align="center" colspan="2"><h2>Admin Log In</h2></td>
		 </tr>
		 <tr>
		     <td align="right"><label>Username:</label></td>
			 <td align="left"><input type="text" name="username" class="text_input" maxlength="20"/></td>
			 
		 </tr>
		 <td align="right"><label>Password:</label></td>
			 <td align="left"><input type="password" name="password" class="text_input" maxlength="20"/></td>
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
</body>
</html>