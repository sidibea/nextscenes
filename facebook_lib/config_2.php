<?php
//Facebook Application Configuration.
//$facebook_appid='1810605669167520';
//$facebook_app_secret='d84d4d38b5f36114a41ec9873d9f45ce';
$facebook_appid='1664552383819052';
$facebook_app_secret='9377d80187f3696087732b6e89d3c83e';
$facebook_scope='email'; // Don't modify this

$facebook = new Facebook(array(
'appId'  => $facebook_appid,
'secret' => $facebook_app_secret,
));
?>
