<?php
include('../include/webzone.php');

$session = get_session();
$user_id = $session['user_id'];

if($user_id!='') {

	$user = get_users(array('id'=>$user_id));
	
	if(count($user)>0) {
		$db_password = $user[0]['password'];
		
		$existing_password = $_POST['existing_password'];
		$new_password = $_POST['new_password'];
		$new_password2 = $_POST['new_password2'];
		
		if($existing_password!='' && $new_password!='' && $new_password2!='') {
			
			if($new_password!=$new_password2) {
				$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
				$display .= 'The 2 passwords you have set are not identical';
				$display .= '</strong></div>';
				$d['display'] = $display;
				$d['code'] = 0;
				echo json_encode($d);
			}
			else {
				$existing_password = md5($existing_password);
				$new_password = md5($new_password);
				
				if($existing_password!=$db_password) {
					$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
					$display .= 'Your existing password is incorrect';
					$display .= '</strong></div>';
					$d['display'] = $display;
					$d['code'] = 0;
					echo json_encode($d);
				}
				else {
					update_posted_data(array('password'=>$new_password), $user_id, $GLOBALS['db_table']['users']);
					$display .= '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
					$display .= 'Your password has been successfully updated :)';
					$display .= '</strong></div>';
					$d['display'] = $display;
					$d['code'] = 1; //success
					echo json_encode($d);
				}
			}
		}
		else {
			$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
			$display .= 'All the fields are required';
			$display .= '</strong></div>';
			$d['display'] = $display;
			$d['code'] = 0;
			echo json_encode($d);
		}		
	}

}

?>