<?php
require "appcalls.php";
if(!isset($_FILES['file']) || ($_FILES['file']['tmp_name'] == '')){
	//No files were uploaded
	$response = "0x0";
}
else{
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detectedType = exif_imagetype($_FILES["file"]['tmp_name']);
	$error = !in_array($detectedType, $allowedTypes);
	if($error == TRUE){
		//Wrong format picture
		$response = "0x3";
	}
	else{
		$filename = uploadImage($_FILES["file"]);
		//Check to see thumbnails are working
		createThumbnail($filename);
		$userhash = json_decode(stripslashes($_POST['a__li']),true);
		$response = addUserImagex($userhash, $filename);
	}
}
echo $response;
siteFooter();
?>