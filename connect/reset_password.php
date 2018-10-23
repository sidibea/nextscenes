<?php
include_once('include/webzone.php');

if(session_is_live()) {
	header('Location: ./home.php');
}

$jsOnReady = "$('#email').focus();";
$GLOBALS['require_session'] = 0;
$active_page = '';
include_once('include/presentation/header.php');

?>

<div class="container">	
	
	<h2>Reset my password</h2><hr><br>
	
	<div id="reset_password_msg">
		Please enter the email used for your registration, and a link to reset your password will be sent to your inbox.<br><br>
			
		<form id="login_form" name="login_form" class="form-stacked" style="width:500px;">		
			<div id="notification"></div>
			<p><label>Email:</label>
			<input type="text" id="email" name="email" style="width:100%;"></p>
			<p><input type="submit" value="Send" id="reset_password_btn" class="btn btn-primary"></p>
		</form>
	</div>
	
</div>

<?
include_once('include/presentation/footer.php');
?>