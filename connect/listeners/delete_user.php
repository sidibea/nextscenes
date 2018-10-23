<?php
include('../include/webzone.php');

$id = $_POST['id'];

$session = get_session();
$user_id = $session['user_id'];
$login = $session['login'];
$user_privilege = $session['privilege'];

if($GLOBALS['demo_mode']==1) {
	echo 'Sorry, this action cannot be executed in the demo mode.';
}
else {
	if($id!='' && $user_id!='' && $login==$GLOBALS['admin_username']) {
		
		$users = get_users(array('id'=>$id));
		
		if(count($users)>0) {
			$s1 = new MySqlTable();
			$sql = "DELETE FROM ".$GLOBALS['db_table']['users']." WHERE id='".$s1->escape($id)."'";
			$s1->executeQuery($sql);
		}
	}	
}

?>