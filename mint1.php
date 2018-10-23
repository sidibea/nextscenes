<?php
include("central/fr_functions.php");
function clean($str){
	$string = mysql_real_escape_string($str);
	$string = str_replace("&nbsp;", " ", $string);
	return $string;
}
$action = clean($_REQUEST['action']);
$cid = $_SESSION['idsession'];
$cu = explode('_',$cid);
$id = $cu[0];
if($action == "savepost"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$title = "";
	$content = "";
	$mode = "";
	$title = clean($_REQUEST['title']);
	$content = clean($_REQUEST['content']);
	$mode = clean($_REQUEST['mode']);
	$links = clean($_REQUEST['links']);
	$category = clean($_REQUEST['cat']);
	echo savePost($content, $id, $mode, $links, $category);
}
if($action == "newpost"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$title = clean($_REQUEST['title']);
	$content = clean($_REQUEST['content']);
	$mode = clean($_REQUEST['mode']);
	$cat = clean($_REQUEST['category']);
	$links = clean($_REQUEST['links']);
	makePost($content, $id, $mode, $cat, $links);
}
if($action == "upatepost"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$content = clean($_REQUEST['content']);
	$dir = clean($_REQUEST['dir']);
	updatePost($content, $id, $dir);
}
if($action == "newscene"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$eid = $cu[0];
	$story = clean($_REQUEST['id']);
	$content = clean($_REQUEST['content']);
	$line = clean($_REQUEST['line']);
	newscene($story, $content, $line, $eid);
}
if($action == "publish"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$uid = clean($_REQUEST['id']);
	publishStory($uid, $id);
}
if($action == "sendMail"){
	$content = clean($_POST['content']);
	$to = 0;
	sendMail($content);
}
if($action == "requestcontribute"){
	$id = clean($_REQUEST['id']);
	$url = clean($_REQUEST['url']);
	requestcontribute($id, $url);
}
if($action == "newcontribution"){
	$content = clean($_REQUEST['content']);
	$url = clean($_REQUEST['url']);
	$tid = clean($_REQUEST['id']);
	newcontribution($content, $url, $tid);
}
if($action == "approvescene"){
	$id = clean($_REQUEST['id']);
	$tid = clean($_REQUEST['tid']);
	$links = clean($_REQUEST['link']);
	$author = clean($_REQUEST['author']);
	$find = query("SELECT * FROM c_users WHERE u_id=\"$author\"");
	$na = fetch_array($find);
	$name = $na['u_fname']." ".$na['u_lastname'];
	$eid = $na['u_id'];
	approvesceneContribute($id, $tid, $name, $links, $eid);
}
if($action == "deleteOneLine"){
	$id = clean($_REQUEST['id']);
	deleteOneLine($id);
}
if($action == "cover"){
	$name = clean($_POST['written']);
	$title = clean($_POST['title']);
	$pattern = clean($_POST['pattern']);
	$desc = clean($_POST['desc']);
	cover($name, $title, $pattern, $desc);
}
if($action == "contributorEmail"){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$email = "";
	$email = clean($_REQUEST['email']);
	$links = clean($_REQUEST['link']);
	echo contributorEmail($email, $id, $links);
}
?>