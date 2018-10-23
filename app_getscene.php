<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$story_id = $request->s__id;
$scene_id = $request->s__id;

$response = getVScenes($story_id, $scene_id);
echo $response;
siteFooter();
?>