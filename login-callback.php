<?php
/*
include'includes/global.inc.php';
require "common/functions.php";
$fb = new Facebook\Facebook([
	'app_id' => '1704390496495535',
	'app_secret' => 'b7d8f95639f53824fc040664e126da01',
	'default_graph_version' => 'v2.5',
	]);
$helper = $fb->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
	//$response = $fb->get('/me?access_token='.$accessToken);
	$response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken);
	$userNode = $response->getGraphUser();
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}
if (!isset($accessToken)) {
	if ($helper->getError()) {
		header('HTTP/1.0 401 Unauthorized');
		echo "Error: " . $helper->getError() . "\n";
		echo "Error Code: " . $helper->getErrorCode() . "\n";
		echo "Error Reason: " . $helper->getErrorReason() . "\n";
		echo "Error Description: " . $helper->getErrorDescription() . "\n";
	}
	else {
		header('HTTP/1.0 400 Bad Request');
		echo 'Bad request';
	}
	exit;
}
else{
	FBLoginUser($userNode['first_name'], $userNode['last_name'], $userNode['id'], $userNode['name'], $userNode['email']);
}*/
?>

<?php
include'includes/global.inc.php';
require "common/functions.php";
$fb = new Facebook\Facebook([
	'app_id' => '197130637356008',
	'app_secret' => 'a9e0c8e000d79a8578e0e3c557e78795',
	'default_graph_version' => 'v2.7',
	]);

try {
	$response = $fb->get('/me?fields=id,name,email,first_name,last_name', '{access-token}');
}catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$userNode = $response->getGraphUser();
FBLoginUsers($userNode['first_name'], $userNode['last_name'], $userNode['id'], $userNode['name'], $userNode['email']);

?>