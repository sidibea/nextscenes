<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$user_fro = $request->n__sc->ua;
$user_type = $request->a__un;
$user_language = $request->a__lan;
$user_password = $request->a__pass;

$response = updateSettings($user_fro, $user_type, $user_language, $user_password);
echo $response;
siteFooter();
?>