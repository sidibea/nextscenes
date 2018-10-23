<?php
//Facebook Application Configuration.
$facebook_appid='App ID';
$facebook_app_secret='App Secret';
$facebook_scope='email,user_birthday'; // Don't modify this

$facebook = new Facebook(array(
'appId'  => $facebook_appid,
'secret' => $facebook_app_secret,
));
?>
