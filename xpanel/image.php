<?php
include("include/database.php");
if(isset($_FILES['image'])){
	$img = $_FILES['image'];
	$path = "uploads/".rand().$img['name'];
	move_uploaded_file($img['tmp_name'], $path);
	$data = getimagesize($path);
	$links = $db->dlink()."/xpanel/".$path;
	$res = array("upload" => array("links" => array("original" => $links), "image" => array("width" => $data[0], "height" => $data[1])));
	echo json_encode($res);
}
?>