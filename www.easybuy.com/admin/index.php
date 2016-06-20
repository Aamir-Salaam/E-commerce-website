<?php
session_start();
if(!isset($_SESSION['name'])){
   header("location: ../index.php");
    exit();
}



?>


<!DOCTYPE html > 
<html lang="en">
<head>
<title>Admin Home</title>
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
	 <h2 class="page_title">Admin Home</h2>
	 <br/>
	 
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
