<?php require "functions.php"; isLoggedIn();
function clean($str){
	$string = mysql_real_escape_string($str);
	$string = str_replace("&nbsp;", " ", $string);
	return $string;
}
$action = clean($_REQUEST['action']);
if($action == "approve"){
	$id = mysql_real_escape_string($_REQUEST['id']);
	personalApprove($id);
}
if($action == "decline"){
	$id = mysql_real_escape_string($_REQUEST['id']);
	personalDecline($id);
}
if($action == "restore"){
	$id = mysql_real_escape_string($_REQUEST['id']);
	personalRestore($id);
}
if($action == "edit-personal-story"){
	$id = clean($_REQUEST['id']);
	$category = clean($_POST['category']);
	$content = clean($_POST['content']);
	adminEditPersonal($category, $content, $id);
}
if($action == "delete-personal-story"){
	$id = clean($_REQUEST['id']);
	adminDeletePersonal($id);
}
if($action == "newpost"){
	$title = clean($_POST['title']);
	$content = clean($_POST['content']);
	makePost($title, $content);
}
if($action == "deletePost"){
	$id = clean($_REQUEST['id']);
	deletePost($id);
}
if($action == "editpost"){
	$title = clean($_POST['title']);
	$content = clean($_POST['content']);
	$id = clean($_POST['id']);
	editPost($title, $content, $id);
}
?>