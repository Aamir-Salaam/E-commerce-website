<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "easy_db";

mysql_connect("$host","$user","$pass") or die (mysql_error());
mysql_select_db("$db_name") or die (mysql_error());

?>