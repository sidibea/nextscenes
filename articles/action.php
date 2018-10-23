<?php
include("../news/xpanel/include/database.php");
$action = $db->action();
if($action == "newpost"){
	$title = $_POST['title'];
	$content = $_POST['content'];
	$cat = $db->clean($_POST['cat']);
	$db->makePost($title, $content, $cat);
}
if($action == "updatePost"){
	$title = $_POST['title'];
	$content = $_POST['content'];
	$id = $db->clean($_REQUEST['id']);
	$db->updatePost($id, $title, $content);
}
if($action == "deletePost"){
	$id = $db->clean($_REQUEST['id']);
	$db->deletePost($id);
}
if($action == "login"){
	$username = $db->clean($_POST['username']);
	$password = sha1($db->clean($_POST['password']));
	$query = $db->query($db->getLogin($username, $password));
	$date = date("d D M Y / h:iA");
	if($db->num_rows($query) >0){
		$row = $db->fetch_array($query);
		$_SESSION['admin'] = true;
		$_SESSION['username'] = $db->username($row);
		$_SESSION['id'] = $db->id($row);
		$db->query("UPDATE membuser SET last_seen=\"$date\" WHERE id=\"".$db->id($row)."\"");
		header("location: xpanel/dashboard");
	}else{
		$_SESSION['incorrectcombination'] = true;
		header("location: xpanel");
	}
}
if($action == "logout"){
	unset($_SESSION['admin']);
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	header("location: xpanel");
	exit;
}
if($action == "newuser"){
	$username = $db->clean($_POST['username']);
	$email = $db->clean($_POST['email']);
	$name = $db->clean($_POST['name']);
	$password = $db->clean($_POST['password']);
	$db->newUser($username, $email, $name, $password);
}
if($action == "edituser"){
	$username = $db->clean($_POST['username']);
	$email = $db->clean($_POST['email']);
	$name = $db->clean($_POST['name']);
	$password = $db->clean($_POST['password']);
	$id = $db->clean($_REQUEST['id']);
	$db->editUser($username, $email, $name, $password, $id);
}
if($action == "deleteUser"){
	$id = $db->clean($_REQUEST['id']);
	$db->deleteUser($id);
}
if($action == "editprofile"){
	$name = $db->clean($_POST['name']);
	$password = $db->clean($_POST['password']);
	$db->editProfile($name, $password);
}
if($action == "like"){
	$slug = $db->clean($_REQUEST['slug']);
	echo $db->lovePost($slug);
}
if($action == "dislike"){
	$slug = $db->clean($_REQUEST['slug']);
	echo $db->dislovePost($slug);
}
?>