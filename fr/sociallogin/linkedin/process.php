<?php

session_start();

include_once("config.php");

//include_once("includes/db.php");

include_once("../../../central/db_auth.php");

include_once("LinkedIn/http.php");

include_once("LinkedIn/oauth_client.php");



//db class instance

//$db = new DB;



if (isset($_GET["oauth_problem"]) && $_GET["oauth_problem"] <> "") {

  // in case if user cancel the login. redirect back to home page.

  $_SESSION["err_msg"] = $_GET["oauth_problem"];

  header("location: http://nextscenes.com/fr/");

  exit;

}



$client = new oauth_client_class;



$client->debug = false;

$client->debug_http = true;

$client->redirect_uri = $callbackURL;



$client->client_id = $linkedinApiKey;

$application_line = __LINE__;

$client->client_secret = $linkedinApiSecret;



if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)

  die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.

			'create an application, and in the line '.$application_line.

			' set the client_id to Consumer key and client_secret with Consumer secret. '.

			'The Callback URL must be '.$client->redirect_uri).' Make sure you enable the '.

			'necessary permissions to execute the API calls your application needs.';



/* API permissions

 */

$client->scope = $linkedinScope;

if (($success = $client->Initialize())) {

  if (($success = $client->Process())) {

    if (strlen($client->authorization_error)) {

      $client->error = $client->authorization_error;

      $success = false;

    } elseif (strlen($client->access_token)) {

      $success = $client->CallAPI(

					'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 

					'GET', array(

						'format'=>'json'

					), array('FailOnAccessError'=>true), $user);

    }

  }

  $success = $client->Finalize($success);

}

if ($client->exit) exit;

if ($success) {

	

	$fullname = $user->firstName. " ". $user->lastName;

	$username = $user->firstName. ".". $user->lastName;

	$email = $user->emailAddress;

	$account = "2";

	$password = "linkedin_".$user->id;

	$photourl = $user->pictureUrl;

	

	// Proccess Login and Register

	$query = "SELECT * FROM c_users WHERE u_email='".mysql_real_escape_string($email)."'";

	$result = mysql_query($query, $db_auth);

	if(mysql_num_rows($result) == 0) {

		// Register User and Login

		$queryreg = "INSERT INTO c_users (u_fname, u_username,u_email,c_usertypes_ut_id,u_pass,u_avatar) VALUES ('$fullname', '$username', '$email', '$account','$password','$photourl')";

		$res = mysql_query($queryreg, $db_auth) or die("Die:".mysql_error());

		

		// Login

		$query = "SELECT * FROM c_users WHERE u_email='".mysql_real_escape_string($email)."'";

		$result = mysql_query($query, $db_auth);

		$answer = mysql_fetch_assoc($result);

		$idsession = $answer['u_id']."_".md5(microtime().rand());

		$_SESSION['idsession'] = $idsession;
		$_SESSION['uid'] = $answer['u_id'];

	}

	elseif (mysql_num_rows($result) == 1) {

		$answer = mysql_fetch_assoc($result);

		$idsession = $answer['u_id']."_".md5(microtime().rand());

		$_SESSION['idsession'] = $idsession;
		$_SESSION['uid'] = $answer['u_id'];

	}

	$updq = "UPDATE c_users SET u_session='".$idsession."', 

					u_ip= '".$_SERVER['REMOTE_ADDR']."',

					u_lastvisit='".date("Y-m-d H:i:s")."'

					WHERE u_email='".mysql_real_escape_string($email)."'";

	$uodr = mysql_query($updq, $db_auth);

	header('Location: /forums');

	

  	//$user_id = $db->checkUser($user);

	//$_SESSION['loggedin_user_id'] = $user_id;

	//$_SESSION['user'] = $user;

	

} else {

 	 $_SESSION["err_msg"] = $client->error;

}

//header("location:index.php");

//exit;

?>



