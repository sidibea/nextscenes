<?php
include_once('include/webzone.php');

$active_page = '';
include_once('include/presentation/header.php');
?>

<div class="container">	
	
	<h2>Account information</h2><hr><br>
	
	<?php
	$session = get_session();
	$user_id = $session['user_id'];
	if($user_id!='') $user = get_users(array('id'=>$user_id));
	
	$criteria['fields'][] = array('name'=>'first_name', 'title'=>'First name:', 'value'=>$user[0]['first_name']);
	$criteria['fields'][] = array('name'=>'last_name', 'title'=>'Last name:', 'value'=>$user[0]['last_name']);
	$criteria['fields'][] = array('name'=>'email', 'title'=>'Email:', 'value'=>$user[0]['email']);
	$criteria['submit'] = array('name'=>'edit', 'value'=>$GLOBALS['lang']['edit']);
	
	if($_POST[$criteria['submit']['name']]) {
		
		$values = get_post_values($criteria['fields'], $_POST);
		
		update_posted_data($values, $user_id, $GLOBALS['db_table']['users']);
		
		echo '<script>';
		echo 'window.location="./account.php";';
		echo '</script>';
	}
	
	else {
		echo '<div class="row">';
			
			echo '<div class="col-md-8">';
				
				if($user[0]['fb_user_id']!='') {
					$link = 'http://www.facebook.com/profile.php?id='.$user[0]['fb_user_id'];
					
					$img_link = 'http://graph.facebook.com/'.$user[0]['fb_user_id'].'/picture';
					echo '<p><a href="'.$link.'"><img src="'.$img_link.'" style="vertical-align:middle; width:50px; margin-right:10px; margin-bottom:10px;"></a></p>';
					//echo '<p>Your Facebook id is: <a href="http://www.facebook.com/profile.php?id='.$user[0]['fb_user_id'].'">'.$user[0]['fb_user_id'].'</a></p><br>';
				}
				
				display_forms($criteria);
				
			echo '</div>';
			
			echo '<div class="col-md-3 offset1 pull-right">';
				echo 'Change your password from <a href="./change_password.php">here</a>';
			echo '</div>';
			
		echo '</div>';
	}

	?>
	
	
</div>

<?
include_once('include/presentation/footer.php');
?>