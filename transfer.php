<?php
	require "central/functions.php"; 
	$query = "SELECT * FROM c_storylines WHERE sl_id NOT IN (SELECT DISTINCT c_storylines_sl_id FROM c_valid_scenes)";
	$result = mysql_query($query, $db_auth);
	$i = 1;
	while($answer = mysql_fetch_assoc($result)){
		$desc = stripslashes(utf8_encode(($answer['sl_desc'])));
		$insq = "INSERT INTO c_valid_scenes (vs_desc,vs_scene, vs_ts,c_storylines_sl_id,c_users_u_id)
			VALUES ('".mysql_real_escape_string($desc)."', '1', '".$answer['sl_ts']."', '".$answer['sl_id']."', '".$answer['c_users_u_id']."')";
		$insr = mysql_query($insq, $db_auth);
		echo $insq."<br>";
		$i++;
	}
?>