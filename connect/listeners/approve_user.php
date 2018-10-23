<?php
include('../include/webzone.php');

$id = $_POST['id'];
$t = $_POST['t'];

$session = get_session();
$user_id = $session['user_id'];
$login = $session['login'];
$user_privilege = $session['privilege'];

if($GLOBALS['demo_mode']==1) {
	echo 'Sorry, this action cannot be executed in the demo mode.';
}
else {
	if($id!='' && $user_id!='' && $login==$GLOBALS['admin_username']) {
		
		//approve
		if($t==1) {
			$s1 = new MySqlTable();
			$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET active=1 WHERE id='".$s1->escape($id)."'";
			$s1->executeQuery($sql);
		}
		//unapprove
		else if($t==2) {
			$s1 = new MySqlTable();
			$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET active=0 WHERE id='".$s1->escape($id)."'";
			$s1->executeQuery($sql);
		}
	}	
}

?>