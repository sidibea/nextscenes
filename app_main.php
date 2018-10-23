<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$pager = $request->p__ge;
$user_fro = $request->fro__i->ua;

$response = getPosts($user_fro, $pager);
echo $response;
siteFooter();
?>