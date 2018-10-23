<?php
include('../include/webzone.php');

$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$login = $_POST['login'];
$token = $_POST['token'];

if($password==$confirm_password && $password!='') {
	
	$user = get_users(array('login'=>$login));
	$user_id = $user[0]['id'];
	$privilege = $user[0]['privilege'];
	$old_password = $user[0]['password'];
	
	$real_token = md5($login.$old_password);
	
	if($token==$real_token) {
		$s1 = new MySqlTable();
		$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET password='".$s1->escape(md5($password))."' WHERE id='".$s1->escape($user_id)."'";
		$s1->executeQuery($sql);
		
		start_session(array('user_id'=>$user_id, 'login'=>$login, 'privilege'=>$privilege));
		
		echo 1;
	}
	else {
		echo 'Your token is incorrect';
	}
}
else {
	echo 'Please enter correctly your new password.';
}

?>