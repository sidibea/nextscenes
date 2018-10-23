<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = $request->a__e;
$pass = $request->a__p;
$username = $request->a__u;
$account = $request->a__a;
if(!isset($email) || !isset($pass) || !isset($username) || !isset($account)){
	$response['status'] = "5";
	$response = json_encode($response);
}
else{
	$response = signUpUser($email, $pass, $username, $account);
}
echo $response;
siteFooter();
?>