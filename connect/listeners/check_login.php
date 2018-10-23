<?php
include('../include/webzone.php');

$login = $_POST['login'];
$password = $_POST['password'];

if($login=='' || $password=='') {
	$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>';
	$display .= 'Missing login and/or password';
	$display .= '</div>';
	$d['display'] = $display;
	$d['code'] = 0;
	echo json_encode($d);
}
else {
	if($login!='' && $password!='') $result = get_users(array('login'=>$login, 'password'=>md5($password)));
	
	if(count($result)>0) {
		if($result[0]['active']==1) {
			start_session(array('user_id'=>$result[0]['id'], 'login'=>$result[0]['login'], 'privilege'=>$result[0]['privilege']));
			
			$u1 = new MySqlTable();
			$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET last_connect='".date('Y-m-d H:i:s')."' WHERE id='".$result[0]['id']."'";
			$u1->executeQuery($sql);
			
			$d['code'] = 1; //success
			echo json_encode($d);
		}
		else {
			$display .= '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Account disabled</strong>';
			$display .= ' Your account has been disabled by the system administrator.';
			$display .= '</div>';
			$d['display'] = $display;
			$d['code'] = 0;
			echo json_encode($d);
		}
	}
	else if( ($login==$GLOBALS['admin_username']) AND ($password==$GLOBALS['admin_password']) ) {
		start_session(array('user_id'=>'99999', 'login'=>$login, 'privilege'=>1));
		
		$u1 = new MySqlTable();
		$sql = "UPDATE ".$GLOBALS['db_table']['users']." SET last_connect='".date('Y-m-d H:i:s')."' WHERE id='".$result[0]['id']."'";
		$u1->executeQuery($sql);
		
		$d['code'] = 1; //success
		echo json_encode($d);
	}
	else {
		$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		$display .= 'Login and/or password are incorrect.';
		$display .= '</div>';
		$d['display'] = $display;
		$d['code'] = 0;
		echo json_encode($d);
	}	
}

?>