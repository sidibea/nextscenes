<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$scene_id = $request->sc__id;
$comment = $request->co__m;
$user_fro = $request->fro__i->ua;

$response = addReview($scene_id, $comment, $user_fro);
echo $response;
siteFooter();
?>