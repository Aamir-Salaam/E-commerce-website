<?php
$style = "";
include_once("scripts/connect.php");

$sql = mysql_query("SELECT * FROM site_style WHERE status='1' LIMIT 1");
while($row = mysql_fetch_array($sql)){
     $style = $row["name"];

}
//////////////////////////////////////////////////



?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Success</title>
<meta charset="utf-8">
<meta name ="keywords" content="">
<meta name ="description" content="">
<link rel="stylesheet" type="text/css"  media="screen" href="style/<?php echo $style;?>">
<link rel="stylesheet" type="text/css"  media="screen" href="style/forms.css">
<link rel="stylesheet" href="style/main.css" media="screen">

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
						    <h2 class="page_title">Success!!</h2>
							<br/>
							<p>Your account was registered, you will shortly recieve an e-mail confirming your account activation!</p>
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