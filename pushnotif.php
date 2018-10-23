<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$userhash = $request->a__li->ua;
$ionicid = $request->u__u;
$deviceid = $request->u__d;

if(!isset($userhash)){
	$response['status'] = "5";
	$response = json_encode($response);
}
else{
	$response = updateNotifs($userhash, $ionicid, $deviceid);
}
echo $response;
siteFooter();
?>