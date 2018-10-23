<?php
	require "central/functions.php";
	$qq = "SELECT * FROM members WHERE Password != ''";
	$rr = mysql_query($qq, $db_auth);
	while($aa = mysql_fetch_assoc($rr)){
		$qqx = "UPDATE c_users SET u_pass = '".sha1($aa['Password'].salt())."'
			WHERE u_id = '".$aa['IdMembers']."'";
		$rrx = mysql_query($qqx, $db_auth);
		echo sha1($aa['Password'].salt())."<br>";
	}
?>