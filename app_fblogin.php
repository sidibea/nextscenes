<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$userid = $request->a__ui;
$username = $request->a__uu;
$useremail = $request->a__ue;
$usergender = $request->a__ug;

if(!isset($userid)){
	$response['status'] = "5";
	$response = json_encode($response);
}
else{
	$response = FBloginUser($userid, $username, $useremail, $usergender);
}
echo $response;
siteFooter();
?>