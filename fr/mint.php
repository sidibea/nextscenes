<?php
	include("xpanel/include/database.php");
	if($db->action() == "nouvelle-recit"){
		$db->newStoryline($db->clean($_POST['title']), $db->clean($_POST['content']), $db->clean($_POST['forum']));
	}
	if($db->action() == "login"){
		$db->login($db->clean($_POST['username']), $db->clean($_POST['password']));
	}
	if($db->action() == "logout"){
		$db->logout();
	}
	if($db->action() == "new-scene"){
		$db->newScene($db->clean($_POST['id']), $db->clean($_POST['content']));
	}
	if($db->action() == "edit-history"){
		$db->editStoryline($db->clean($_POST['title']), $db->clean($_POST['content']), $db->clean($_POST['forum']), $db->clean($_POST['id']));
	}
	if($db->action() == "deleteHistory"){
		$db->deleteStoryline($db->clean($_REQUEST['id']));
	}
	if($db->action() == "approve"){
		$db->approveScene($db->clean($_REQUEST['id']));
	}
	if($db->action() == "changePix"){
		$db->changeAvatar($_FILES, $_SESSION['uid']);
	}
	if($db->action() == "udata"){
		$db->udata($db->clean($_POST['fname']), $db->clean($_POST['lname']), $_SESSION['uid']);
	}
	if($db->action() == "upass"){
		$db->upass($db->clean($_POST['opass']), $db->clean($_POST['pass']), $_SESSION['uid']);
	}
	if($db->action() == "register"){
		$db->register($db->clean($_POST['username']), $db->clean($_POST['password']), $db->clean($_POST['email']), $db->clean($_POST['fname']), $db->clean($_POST['lname']));
	}

?>