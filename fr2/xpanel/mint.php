<?php
include("include/database.php");
if($db->action() == "deleteForum"){
	$db->deleteForum($db->clean($_REQUEST['id']));
}
if($db->action() == "new-forum"){
	$db->newForum($db->clean($_POST['title']), $db->clean($_POST['description']), $_FILES);
}
if($db->action() == "edit-forum"){
	$db->editForum($db->clean($_POST['title']), $db->clean($_POST['description']), $db->clean($_POST['id']), $_FILES);
}
if($db->action() == "new-story"){
	$db->newStoryline($db->clean($_POST['title']), $db->clean($_POST['description']), $db->clean($_POST['cat']), $_FILES, 1);
}
if($db->action() == "edit-history"){
	$db->editStoryline($db->clean($_POST['title']), $db->clean($_POST['content']), $db->clean($_POST['forum']), $db->clean($_POST['id']), $_FILES, 1);
}
if($db->action() == "deleteHistory"){
	$db->deleteStoryline($db->clean($_REQUEST['id']));
}
if($db->action() == "deleteScene"){
	$db->deleteScene($db->clean($_REQUEST['id']));
}
if($db->action() == "edit-scene"){
	$db->editScene($db->clean($_POST['content']), $db->clean($_POST['id']));
}
if($db->action() == "approve"){
	$db->approveScene($db->clean($_REQUEST['id']));
}
?>