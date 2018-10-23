<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$story_id = $request->s__id;
$scene_id = $request->sc__id;

$response = proposedScenes($story_id, $scene_id);
echo $response;
siteFooter();
?>