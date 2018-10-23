<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$scene_id = $request->sc__id;
$user_fro = $request->fro__i->ua;

$response = loadScene($scene_id, $user_fro);
echo $response;
siteFooter();
?>