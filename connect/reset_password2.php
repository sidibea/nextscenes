<?php
include_once('include/webzone.php');

$login = $_GET['login'];
$token = $_GET['token'];

if(session_is_live()) {
	header('Location: ./home.php');
}

$jsOnReady = "$('#password').focus();";
$GLOBALS['require_session'] = 0;
$active_page = '';
include_once('include/presentation/header.php');

?>

<div class="container">	
	
	<h2>Reset my password</h2><hr><br>
	
	<?php
	
	$flag=0;
	
	if($login!='' && $token!='') {
		$user = get_users(array('login'=>$login));
		
		$old_password = $user[0]['password'];
		
		$real_token = md5($login.$old_password);
		
		if($real_token==$token) {
			?>
			
			<div id="reset_password_msg">
				Please enter your new password bellow and click on the submit button. Then you can use your new password right away from the login page.<br><br>
				
				<div class="span-18">
					
					<form id="reset_form" name="reset_form" class="form-stacked">
						
						<input type="hidden" id="login" name="login" value="<?php echo $login; ?>">
						<input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
						
						<div id="login_notification"></div>
						<p><label>New password</label><input type="password" id="password" name="password"></p>
						<p><label>Confirm new password</label><input type="password" id="confirm_password" name="confirm_password"></p>
						<p><input type="submit" value="Update" id="update_new_password_btn" class="btn default"></p>
					</form>
				</div>
			</div>
			
			<?php
		}
		else {
			$flag=1;
		}
	}
	else {
		$flag=1;
	}
	
	if($flag) {
		echo 'The specified login and/or token are invalid';
	}
	
	?>
	
</div>

<?
include_once('include/presentation/footer.php');
?>