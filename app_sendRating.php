<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$scene_id = $request->sc__id;
$rating = $request->r__i;
$user_fro = $request->fro__i->ua;

$response = applyRating($scene_id, $rating, $user_fro);
echo $response;
siteFooter();
?>