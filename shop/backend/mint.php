<?php
include("include/database.php");
if($db->action() == "login"){
	$db->login($db->clean($_POST['email']), $db->clean(sha1($_POST['password'])));
}
if($db->action() == "new-item"){
	$total = count($_FILES['upload']['name']);
	$image = "0.jpg";
	// Loop through each file
	for($i=0; $i<$total; $i++) {
		//Get the temp file path
		$tmpFilePath = $_FILES['upload']['tmp_name'][$i];	
		//Make sure we have a filepath
	  	if ($tmpFilePath != ""){
			//Setup our new file path
			$newFilePath = "uploads/".time().$_FILES['upload']['name'][$i];
			//Upload the file into the temp dir
			if(move_uploaded_file($tmpFilePath, $newFilePath)) {
				$image = $image.",".$newFilePath;
			}
		}
	}
	$db->newItem($db->clean($_POST['title']), $db->clean($_POST['description']), $db->clean($_POST['stock']), $db->clean($_POST['amount']), $db->clean($_POST['discount']), $image, $db->clean($_POST['author']), $db->clean($_POST['audience']), $db->clean($_POST['format']), $db->clean($_POST['language']), $db->clean($_POST['pages']), $db->clean($_POST['country']), $db->clean($_POST['edition']), $db->clean($_POST['category']));
}
if($db->action() == "edit-item"){
	$db->editItem($db->clean($_POST['title']), $db->clean($_POST['description']), $db->clean($_POST['stock']), $db->clean($_POST['amount']), $db->clean($_POST['discount']), $db->clean($_REQUEST['id']));
}
if($db->action() == "deleteItem"){
	$db->deleteItem($db->clean($_REQUEST['id']));
}
if($db->action() == "edit-profile"){
	$db->editMe($db->clean($_POST['username']),$db->clean($_POST['name']), $db->clean($_POST['location']), $db->clean($_POST['password']), $_FILES);
}
if($db->action() == "new-category"){
	$db->newCategory($db->clean($_POST['name']));
}
if($db->action() == "delete-category"){
	$db->deleteCategory($db->clean($_REQUEST['id']));
}if($db->action() == "new-page"){
	$db->newPage($db->clean($_POST['title']), $db->clean($_POST['content']));
}
if($db->action() == "delete-page"){
	$db->deletePage($db->clean($_REQUEST['id']));
}
if($db->action() == "logout"){
	$db->logOut();
}
if($db->action() == "new-user"){
	$db->newUser($db->clean($_POST['username']), $db->clean($_POST['name']), $db->clean($_POST['email']), $db->clean($_POST['location']), $db->clean(sha1($_POST['password'])));
}
if($db->action() == "rec"){
	$db->recommend($db->clean($_REQUEST['image']), $db->clean($_REQUEST['slug']));
}
if($db->action() == "recs"){
	$db->recommends($db->clean($_REQUEST['image']), $db->clean($_REQUEST['slug']));
}
if($db->action() == "contact-us"){
	
}
if($db->action() == "shop-settings"){
	$db->updateShop($db->clean($_POST['address']), $db->clean($_POST['tel']), $db->clean($_POST['email']), $db->clean($_POST['facebook']), $db->clean($_POST['twitter']), $db->clean($_POST['instagram']), $db->clean($_POST['youtube']));
}
?>