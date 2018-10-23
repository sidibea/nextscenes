<?php
session_start();
// added in v4.0.0
require_once("../../central/db_auth.php"); //Db Connection
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1907672512793214','13989a4df45ff9936b74cf0e46202208' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://www.nextscenes.com/sociallogin/fblogin/fbconfig.php');
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?fields=id,name,email' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fullname = $graphObject->getProperty('name'); // To Get Facebook full name
		$username = str_replace(" ",".",$fullname);
	    $email = $graphObject->getProperty('email');    // To Get Facebook email ID
		$account = "2";
		$password = "fb_".$fbid;
		$photo = "http://graph.facebook.com/".$fbid."/picture?type=album";
		
	/* ---- Session Variables -----*/
	//$_SESSION['FBID'] = $fbid;           
	//$_SESSION['FULLNAME'] = $fbfullname;
	//$_SESSION['EMAIL'] =  $femail;
	
	// Proccess Login and Register
	if($email == NULL || empty($email)){
		header("location: /login");
	}
	$query = mysql_query("SELECT * FROM c_users WHERE u_email=\"".mysql_real_escape_string($email)."\"");
	if(mysql_num_rows($query) == 0){
		// Register User and Login
		$queryreg = mysql_query("INSERT INTO c_users (u_fname,u_username,u_email,c_usertypes_ut_id,u_pass,u_avatar)VALUES(\"$fullname\",\"$username\", \"$email\", \"$account\",\"$password\",\"$photo\")");		
		// Login
		$query2 = mysql_query("SELECT * FROM c_users WHERE u_email=\"".mysql_real_escape_string($email)."\"");
		$answer = mysql_fetch_array($query2);
		$idsession = $answer['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
		$_SESSION['isuser'] = $answer['u_username'];
	}else{
		$answer = mysql_fetch_array($query);
		$idsession = $answer['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
		$_SESSION['isuser'] = $answer['u_username'];
	}
	$updq = mysql_query("UPDATE c_users SET u_session=\"".$idsession."\", 
					u_ip= \"".$_SERVER['REMOTE_ADDR']."\",
					u_lastvisit=\"".date("Y-m-d H:i:s")."\"
					WHERE u_email=\"".mysql_real_escape_string($email)."\"");
	header('Location: /forums');
	}
	
	//header("Location: forum");
	//print_r($_SESSION);
	//die();
    /* ---- header location after session ----*/
 else {
  $loginUrl = $helper->getLoginUrl(array('req_perms' => 'email'));
 header("Location: ".$loginUrl);
}
?>