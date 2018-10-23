<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$page = $request->p__type;

$response = getPage($page);
echo $response;
siteFooter();
?>