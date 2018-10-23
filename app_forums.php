<?php
require "appcalls.php";
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$response = getForums();
echo $response;
siteFooter();
?>