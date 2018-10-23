<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$user_fro = $request->n__sc->ua;

$response = getSettings($user_fro);
echo $response;
siteFooter();
?>