<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = $request->a__e;
$pass = $request->a__p;
if(!isset($email) || !isset($pass)){
	$response['status'] = "5";
	$response = json_encode($response);
}
else{
	$response = loginUser($email, $pass);
}
echo $response;
siteFooter();
?>