<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$story_id = $request->s__id;

$response = updateStorylineViews($story_id);
echo $response;
siteFooter();
?>