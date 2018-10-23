<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$forum_id = $request->f__id;
$forum_page = $request->f__page;

$response = getStorylines($forum_id, $forum_page);
echo $response;
siteFooter();
?>