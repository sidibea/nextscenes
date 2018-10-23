<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$storyline = $request->s__l;
$text = $request->p__sc;
$user_fro = $request->fro__i->ua;

$response = proposeScene($storyline, $text, $user_fro);
echo $response;
siteFooter();
?>