<?php
include('../include/webzone.php');

$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$fb_user_id = $_POST['fb_user_id'];

//get FB user id
$f1 = new Fb_ypbox();
$user_data = $f1->getUserData();
if(count($user_data)>0 && $fb_user_id==$user_data['id']) {
	$fb_user_id = $user_data['id'];
}

if($login!='' && $password!='' && $email!='') {
	
	$result = get_users(array('login'=>$login));
	
	if(count($result)>0) {
		echo 'The username you have chosen is already used.';
	}
	else if(check_email_address($email)===false) {
		echo 'Please enter a valid email address.';
	}
	elseif($login==$GLOBALS['admin_username']) {
		echo 'Your username is cannot be used, please choose another one.';
	}
	else {
		$u1 = new MySqlTable();
		$sql = "INSERT INTO ".$GLOBALS['db_table']['users']." 
		(fb_user_id, login, password, email, first_name, last_name, active, created) 
		VALUES 
		('".$u1->escape($fb_user_id)."', '".$u1->escape($login)."', '".$u1->escape(md5($password))."', '".$u1->escape($email)."', '".$u1->escape($first_name)."', '".$u1->escape($last_name)."', '1', '".date('Y-m-d H:i:s')."')";
		$result = $u1->executeQuery($sql);
		$id = $u1->getLastIsertedId();
		
		if($id>0) {
			start_session(array('user_id'=>$id, 'login'=>$login, 'privilege'=>0));
		}
		else {
			echo 'An error occured creating your account.';
		}
	}
	
}
else {
	echo 'Please complete all the mandatory fields';
}

?>