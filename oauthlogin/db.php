<?php
$mysql_hostname = "og21315-001.privatesql:35357";
$mysql_user = "nextscendidb";
$mysql_password = "Sidere852";
$mysql_database = "nextscendidb";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
$base_url='http://nextscenes.com/oauthlogin/';
?>