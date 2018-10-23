<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = $request->a__e;
if(!isset($email)){
	$response['status'] = "5";
	$response = json_encode($response);
}
else{
	$response = forgotPassword($email);
}
echo $response;
siteFooter();
?>