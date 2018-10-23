<?php
include_once('include/webzone.php');

$jsOnReady = "$('#existing_password').focus();";
$active_page = '';
include_once('include/presentation/header.php');
?>

<div class="container">
	
	<h2>Change password</h2><hr><br>
	
	<div class="row">
		
		<?php
		$session = get_session();
		$user_id = $session['user_id'];
		if($user_id!='') $user = get_users(array('id'=>$user_id));
		
		$criteria['fields'][] = array('name'=>'existing_password', 'type'=>'password', 'title'=>'Please enter your existing password:');
		$criteria['fields'][] = array('name'=>'new_password', 'type'=>'password', 'title'=>'New password:');
		$criteria['fields'][] = array('name'=>'new_password2', 'type'=>'password', 'title'=>'Confirm the new password:');
		
		$criteria['form'] = array('name'=>'change_password_form');
		$criteria['submit'] = array('name'=>'change_password_btn');
		
		echo '<div class="col-md-8">';
			
			echo '<div id="notification"></div>';
			display_forms($criteria);
			
		echo '</div>';
		
		?>
		
		<div class="col-md-3 offset1 pull-right" style="text-align:right;">
			Back to the <a href="./account.php">Account page</a>
		</div>
	
	</div>
</div>

<?
include_once('include/presentation/footer.php');
?>