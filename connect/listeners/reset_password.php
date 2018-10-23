<?php
include('../include/webzone.php');

$email = $_POST['email'];

if($GLOBALS['demo_mode']!=1) {
	if($email!='') {
		
		if(check_email_address($email)) {
			
			$from = $GLOBALS['email_from'];
			$subject = $GLOBALS['email_subject'];
			
			$s1 = new MySqlTable();
			$sql = "SELECT * FROM ".$GLOBALS['db_table']['users']." WHERE email='".$s1->escape($email)."'";
			$result = $s1->customQuery($sql);
			
			if(count($result)>0) {
				
				$login = $result[0]['login'];
				$password = $result[0]['password'];
				
				$token = md5($login.$password);
				$reset_link = $GLOBALS['app_url'].'/reset_password2.php?login='.$login.'&token='.$token;
				
				$message = "Hi $login,<br><br>
				You have just requested a reset to your password. Please click on the link bellow to proceed:<br><br>
				<a href=\"$reset_link\">$reset_link</a>
				";
				sendMail($from, $email, $subject, $message);
				
				$display .= '<div class="alert alert-success"><strong>';
				$display .= 'A link to reset your password has just been sent to your email address';
				$display .= '</strong></div>';
				$d['display'] = $display;
				$d['code'] = 1; //success
				echo json_encode($d);
			}
			else {
				$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
				$display .= 'The specified email address is not associated with any account';
				$display .= '</strong></div>';
				$d['display'] = $display;
				$d['code'] = 0;
				echo json_encode($d);
			}
			
		}
		else {
				$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
				$display .= 'The specified email address looks incorrect';
				$display .= '</strong></div>';
				$d['display'] = $display;
				$d['code'] = 0;
				echo json_encode($d);
		}
	}	
}
else {
	$display .= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>';
	$display .= 'This feature is not available in demo mode !';
	$display .= '</strong></div>';
	$d['display'] = $display;
	$d['code'] = 0;
	echo json_encode($d);
}

?>