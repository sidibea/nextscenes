<?php

function get_session() {
	return $_SESSION['session'];
}

function is_admin() {
	if(session_is_live()) {
		$session = get_session();
		if($session['login']==$GLOBALS['admin_username']) return true;
		else return false;
	}
	else return false;
}

function session_is_live() {
	if($_SESSION['session']['user_id']!='') return true;
	else return false;
}

function start_session($criteria=array()) {
	$user_id = $criteria['user_id'];
	$login = $criteria['login'];
	$privilege = $criteria['privilege'];
	
	if($privilege!=1) {
		$u1 = new MySqlTable();
		$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET last_connect='".date('Y-m-d H:i:s')."' WHERE id='".$user_id."'";
		$u1->executeQuery($sql);		
	}
	
	$_SESSION['session']['user_id'] = $user_id;
	$_SESSION['session']['login'] = $login;
	$_SESSION['session']['privilege'] = $privilege;
}

function kill_session() {
	$_SESSION['session'] = array();
	unset($_SESSION);
}

?>