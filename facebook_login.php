<?php
include 'header.php';
require 'facebook_lib/facebook.php';
require 'facebook_lib/config.php';

// Connection...
$user = $facebook->getUser();
if ($user)
{
$logoutUrl = $facebook->getLogoutUrl();
try {
$userData = $facebook->api('/me');
} catch (FacebookApiException $e) {
error_log($e);
$user = null;
}
//$_SESSION['facebook']=$_SESSION;
$result=$OauthLogin->userSignup($userData,'facebook');
require 'redirect.php';
}
else
{ 
$loginUrl = $facebook->getLoginUrl(array( 'scope' => $facebook_scope));
header("Location:$loginUrl");
}
?>
