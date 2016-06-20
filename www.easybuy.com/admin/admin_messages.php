<?php
session_start();
if(!isset($_SESSION['name'])){
   header("location: ../index.php");
    exit();
}
/////////////////////////////
$messages = "";
include_once("../scripts/connect.php");
$sql=mysql_query("SELECT * FROM messages ORDER BY msg_date DESC");
$count=mysql_num_rows($sql);
if($count > 0){
         
    while($row=mysql_fetch_array($sql)){
	
	     $msg_name= $row["msg_name"];
		 $msg_email= $row["msg_email"];
		 $msg_subject= $row["msg_subject"];
		 $msg_date= $row["msg_date"];
		 $messages .='
		     <tr>
			 
			    <td align="center">' . $msg_name . '</td>
			    <td align="center">' . $msg_email . '</td>
				<td align="center">' . $msg_subject . '</td>
				<td align="center">' . $msg_date . '</td>
				<td align="center"><a href="#">Reply</a>&nbsp;<b>/</b>&nbsp;<a href="#">Delete</a></td>
			 
			 </tr>
		 ';
	
	
	}


}else{

  $messages="No Messages To Display Right Now";
}

?>


<!DOCTYPE html > 
<html lang="en">
<head>
<title>Admin Messages</title>
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
	 <h2 class="page_title">Messages</h2>
	 <br/>
	 <table width="730" cellspacing="0" cellpadding="3" border="1">
	     <tr>
		    <td align="center" width="100">From</td>
			<td align="center" width="300">Email</td>
			<td align="center" width="300">Subject</td>
			<td align="center" width="100">Date</td>
			<td align="center" width="100">Actions</td>
		 </tr>
	     <?php echo $messages; ?>
         	 
	 </table>
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
