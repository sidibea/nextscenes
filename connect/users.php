<?php
include_once('include/webzone.php');
if(!is_admin()) header('Location: ./');

include_once('include/presentation/header.php');

$session = get_session();
$login = $session['login'];

$id = $_GET['id'];

?>

<div class="container">	
	
	<h2>Users</h2><hr><br>
	
	<?php
	
	if($id!='') {
		$user = get_users(array('id'=>$id));
		
		if(count($user)>0) {
			if($user[0]['fb_user_id']!='') {
				$img_link = 'http://graph.facebook.com/'.$user[0]['fb_user_id'].'/picture';
				echo '<p><img src="'.$img_link.'" style="vertical-align:middle; width:50px; margin-right:10px;">'.$user[0]['login'].'</p><br>';
				echo '<p><b>Facebook id:</b> <a href="http://www.facebook.com/profile.php?id='.$user[0]['fb_user_id'].'">'.$user[0]['fb_user_id'].'</a></p>';
			}
			else {
				echo '<p><b>Login:</b> '.$user[0]['login'].'</p>';
			}
			echo '<p><b>First name:</b> '.$user[0]['first_name'].'</p>';
			echo '<p><b>Last name:</b> '.$user[0]['last_name'].'</p>';
			echo '<p><b>Email:</b> '.$user[0]['email'].'</p>';
			echo '<p><b>Created:</b> '.$user[0]['created'].'</p>';
			echo '<p><b>Last connect:</b> '.$user[0]['last_connect'].'</p>';
		}
		
		echo '<br><p><a href="./users.php">Back to users list</a></p>';
	}
	
	else {
		$users = get_users();
		
		for($i=0; $i<count($users); $i++) {
			$id = $users[$i]['id'];
			$login = $users[$i]['login'];
			$active = $users[$i]['active'];
			
			echo '<div class="boxHover" style="padding:10px; position:relative;">';
				
				echo '<div style="width:660px;"><a href="./users.php?id='.$id.'">'.$login.'</a></div>';
				
				echo '<div style="position:absolute; right:10px; top:10px;">';
					
					if($active==1) {
						echo '<a href="#" class="unapprove_user_btn" id="'.$id.'"><font color="green">Active</font></a>';
					}
					else {
						echo '<a href="#" class="approve_user_btn" id="'.$id.'"><font color="orange">Inactive</font></a>';
					}
					
					echo ' - <a href="#" id="'.$id.'" class="delete_user_btn delete">Delete</a>';
				echo '</div>';
				
			echo '</div>';
		}
		
		if(count($users)==0) {
			echo 'No results.';
		}
	}
	
	?>
	
</div>

<?
include_once('include/presentation/footer.php');
?>