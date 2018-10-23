<?php

$hostname = "og21315-001.privatesql:35357";
$username = "nextscendidb";
$database = "nextscendidb";
$password = "Sidere852";

$base= mysql_connect("$hostname", "$username", "$password");
mysql_query("SET NAMES 'utf8'");
mysql_select_db ("$database", $base);



?>