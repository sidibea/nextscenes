<?php
libxml_use_internal_errors(false);
error_reporting(0);
session_start();
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

date_default_timezone_set("Africa/Lagos");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');
//FORCE HTTPS
/*if($_SERVER["HTTPS"] != "on") {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
	exit();
}*/

require "sitebase.php";
require "GCMPushMessage.php";
if(!isset($db_auth)){
	require "central/db_auth.php";
}
if (isset($_GET['doLogout']) == 'true'){
	doLogout();
}
if (isset($_GET['doUnblock'])){
	doUnblock($_GET['doUnblock']);
}
if (isset($_GET['doBlock'])){
	doBlock($_GET['doBlock']);
}
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
$ajaxify = FALSE;
if(isset($_GET['l']) == "y"){
	$ajaxify = TRUE;
}
function cookieSalt(){
	$data = "<5!qk250t*}@]Aj8684K@8$x&G^S'<j8=N,]=T4612F+8I1}xJX0C):7I:7C";
	return $data;
}
function salt(){
	$data = "c_=xPf3PL%2342Qv|=xPf3PL@#&s$^&=xPf3PL%2b342542AoFc=m6s%2AZN";
	return $data;
}
function chatsalt(){
	$data = "bkWPmU~jM9V3-.t`+fev*yMGSF|{";
	return $data;
}
function salttwo(){
	$data = "83*@N@.sd_jL.^V{.m6.Aztz$a}{iM8eEj[r{@Q[kA.x(7;L+j.hd/,|+p/Asdip";
	return $data;
}
function sanitizeData($string, $tags){
	if($tags == FALSE){
		$string = strip_tags($string);
	}
	$string = stripslashes(trim($string));
	$string = mysql_real_escape_string($string);
	return $string;
}
function sanitizeFormData($string){
	$string = htmlspecialchars(strip_tags(trim($string)));
	return $string;
}
function sanitizeEchoData($string){
	$data = stripslashes(htmlspecialchars_decode(trim($string)));
	return $data;
}
function sanitizeHTMLData($string){
	$string = mysql_real_escape_string(trim($string));
	$string = mb_convert_encoding($string, 'UTF-8', mb_detect_encoding($string, 'UTF-8, ISO-8859-1', true));
	$string = htmlspecialchars(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string), ENT_QUOTES);
	return $string;
}
function prettyPrint($a){
	echo "<pre>";
	print_r($a);
	echo "</pre>";
}
function siteName(){
	$data = "Nextscenes";
	return $data;
}
function siteLink(){
	$data = "http://www.nextscenes.com";
	return $data;
}
function siteBase(){
	$data = "nextscenes.com";
	return $data;
}
function siteUrl(){
	$data = "www.nextscenes.com";
	return $data;
}
function siteImg(){
	$data = "http://www.nextscenes.com";
	return $data;
}
function siteInfo(){
	$data = "info@nextscenes.com";
	return $data;
}
function siteLogo(){
	$data = "http://".siteUrl()."/img/MU-01.jpg";
	return $data;
}
function genericError(){
	$data = "Something seems to have gone wrong. Please try again.";
	return $data;
}
function genericPError(){
	$data = "Oops! You do not have the authorization to do that.";
	return $data;
}
function genericSearchError(){
	$data = "There are no results matching your search query.";
	return $data;
}
function genericUploadMssg(){
	$data = "Please select an image file for upload:<br />Supported formats are .jpg, .png and .gif<br />Maximum upload size is 2Mb";
	return $data;
}

function thumbnailSize(){
	$data = "320";
	return $data;
}
function uploadFrom(){
	$data = date("Y")."/".date("m");
	return $data;
}
function theMainTimelineDirectory(){
	$data = "../timeline";
	return $data;
}
function theMainDirectory(){
	$data = "assets";
	return $data;
}
function imageTimelineDirectory(){
	$data = theMainTimelineDirectory()."/".uploadFrom()."/";
	return $data;
}
function thumbnailTimelineDirectory(){
	$data = imageTimelineDirectory()."thumb/";
	return $data;
}
function imageDirectory(){
	$data = theMainDirectory()."/".uploadFrom()."/";
	return $data;
}
function thumbnailDirectory(){
	$data = imageDirectory()."thumb/";
	return $data;
}
function allowedImageTypes(){
	$data = array("image/jpeg","image/jpg","image/png","image/gif");
	return $data;
}
function createTimelineThumbnail($filename){
    if(preg_match('/[.](jpg)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](JPG)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageTimelineDirectory() . $filename); 
    } 
	else if (preg_match('/[.](gif)$/', $filename)) {  
        $im = imagecreatefromgif(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](GIF)$/', $filename)) {  
        $im = imagecreatefromgif(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](png)$/', $filename)) {  
        $im = imagecreatefrompng(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](PNG)$/', $filename)) {  
        $im = imagecreatefrompng(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](jpeg)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageTimelineDirectory() . $filename);  
    } 
	else if (preg_match('/[.](JPEG)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageTimelineDirectory() . $filename);  
    } 
      
    $ox = imagesx($im);  
    $oy = imagesy($im);  
    $nx = thumbnailSize();  
    $ny = floor($oy * (thumbnailSize() / $ox));  
    $nm = imagecreatetruecolor($nx, $ny);  
      
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  
    if(!file_exists(thumbnailTimelineDirectory())){
		if(!mkdir(thumbnailTimelineDirectory(), 0777, true)){}
    }
    imagejpeg($nm, thumbnailTimelineDirectory() . $filename);	
}
function createThumbnail($filename){
    if(preg_match('/[.](jpg)$/', $filename)) {  
        $im = imagecreatefromjpeg($directory . $filename);  
    } 
	else if (preg_match('/[.](JPG)$/', $filename)) {  
        $im = imagecreatefromjpeg($directory . $filename); 
    } 
	else if (preg_match('/[.](gif)$/', $filename)) {  
        $im = imagecreatefromgif($directory . $filename);  
    } 
	else if (preg_match('/[.](GIF)$/', $filename)) {  
        $im = imagecreatefromgif($directory . $filename);  
    } 
	else if (preg_match('/[.](png)$/', $filename)) {  
        $im = imagecreatefrompng($directory . $filename);  
    } 
	else if (preg_match('/[.](PNG)$/', $filename)) {  
        $im = imagecreatefrompng($directory . $filename);  
    } 
	else if (preg_match('/[.](jpeg)$/', $filename)) {  
        $im = imagecreatefromjpeg($directory . $filename);  
    } 
	else if (preg_match('/[.](JPEG)$/', $filename)) {  
        $im = imagecreatefromjpeg($directory . $filename);  
    } 
      
    $ox = imagesx($im);  
    $oy = imagesy($im);  
    $nx = thumbnailSize();  
    $ny = floor($oy * (thumbnailSize() / $ox));  
    $nm = imagecreatetruecolor($nx, $ny);  
      
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  
    if(!file_exists($directory."/thumbs")){
		if(!mkdir($directory."/thumbs", 0777, true)){}
    }
    imagejpeg($nm, $directory."/thumbs" . $filename);	
}
function uploadTimelineImage($file_name, $file_tmp){
	if(!file_exists(imageTimelineDirectory())) {  
	  if(!mkdir(thumbnailTimelineDirectory(), 0777, true)){}  
	}
	
	$imgFile = preg_replace('#[^a-z.0-9]#i', '', $file_name);
	$kaboom = explode(".", $imgFile);
	$fileExt = end($kaboom);
	
	$filename = md5(date('Ymd').time().'-'.$imgFile).".".strtolower($fileExt);
	
	$source = $file_tmp;
	$target = imageTimelineDirectory().$filename;
	
	$exists = file_exists($target);
	if(!$exists){
		move_uploaded_file($source, $target);
	}
	else{
		// Return here
	}
	//echo "The filename is $filename, The Source is $source and The Target is $target!<br />";
	return $filename;
}
function uploadImage($upload){
	$directory = "assets";
	if(!file_exists($directory)) {  
	  if(!mkdir($directory."/thumbs", 0777, true)){}  
	}
	
	if($upload['type'] == "image/jpeg"){
		$fileExt = "jpg";
	}
	else if($upload['type'] == "image/png"){
		$fileExt = "png";
	}
	else if($upload['type'] == "image/gif"){
		$fileExt = "gif";
	}
	else{
		$imgFile = preg_replace('#[^a-z.0-9]#i', '', $upload['name']);
		$kaboom = explode(".", $imgFile);
		$fileExt = end($kaboom);
	}
	
	$filename = md5(date('Ymd').time().'-'.$imgFile).".".strtolower($fileExt);
	
	$source = $upload['tmp_name'];
	$target = $directory.$filename;
	
	$exists = file_exists($target);
	if(!$exists){
		move_uploaded_file($source, $target);
	}
	else{
		// Return here
	}
	//echo "The filename is $filename, The Source is $source and The Target is $target!<br />";
	return $filename;
}
function checkuserHash($userhash){
	global $db_auth;
	if (($userhash['u_login_type_aid']) != (base64_encode ($userhash['u_auth'].":".md5($userhash['u_auth'].cookieSalt()).":".$userhash['u_login_type'].":0"))){
		$data = "0x5";
	}
	else{
		if($userhash['u_login_type'] == "tradp"){
			$chkq = "SELECT * FROM users
					WHERE md5(u_phone) ='".mysql_real_escape_string($userhash['u_auth'])."'";
			$chkr = mysql_query($chkq, $db_auth);
		}
		if(mysql_num_rows($chkr) == 0){
			//Account does not exist
			$data = "0x6";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$data = $chk;
		}
	}	
	return $data;
}
function FBloginUser($userid, $username, $useremail, $usergender){
	global $db_auth;
	$loginq = "SELECT * FROM c_users
			LEFT JOIN c_socials ON c_socials.c_users_u_id = c_users.u_id
			WHERE so_unique ='".sanitizeData($userid)."'";
	$loginr = mysql_query($loginq, $db_auth);
	if (mysql_num_rows($loginr) > 0){
		//User is signed up
		$loginc = mysql_fetch_assoc($loginr);
		
		$idsession = $loginc['u_id']."_".md5(microtime().rand());
		$updq = "UPDATE c_users SET u_session='".$idsession."', 
				u_ip= '".$_SERVER['REMOTE_ADDR']."',
				u_lastvisit='".date("Y-m-d H:i:s")."'
				WHERE u_id ='".mysql_real_escape_string($loginc['u_id'])."'";
		$updr = mysql_query($updq, $db_auth);
		$data['status'] = "1";
		$data['k___yc'] = base64_encode ($loginc['u_id'].":".md5($loginc['u_id'].cookieSalt()));
	}
	else{
		$slug = uslugify($username);
		$slug = slugCheck($slug, "username");
		$insq = "INSERT INTO c_users (u_email,u_username,c_usertypes_ut_id) 
			VALUES ('".mysql_real_escape_string($useremail)."', '".$slug."', '2')";
		$insr = mysql_query($insq, $db_auth);
		$theid = mysql_insert_id($db_auth);
		if($insr){
			$insqx = "INSERT INTO c_socials (so_type, so_unique, c_users_u_id)
				VALUES ('1', '".mysql_real_escape_string($userid)."', '".$theid."')";
			$insrx = mysql_query($insqx, $db_auth);
			$data['status'] = "1";
			$data['k___yc'] = base64_encode ($theid.":".md5($theid.cookieSalt()));
		}
		else{
			$data['status'] = "2";
		}
	}
	$data = json_encode($data);
	return $data;
}
function forgotPassword($email){
	global $db_auth;
	$password=sha1($password.salt());
	$fq = "SELECT * FROM c_users
		WHERE u_email ='".sanitizeData($email)."'"; 
	$fr = mysql_query($fq, $db_auth);
	if(mysql_num_rows($fr) == 0){
		$data['status'] = 0;
	}
	else{
		$f = mysql_fetch_assoc($fr);
		$verCode = sha1(mt_rand(10000,90000).mt_rand(11,121));
		$updq = "UPDATE c_users SET u_reset_key ='".$verCode."'
					WHERE u_id='".$f['u_id']."'";
		$updr = mysql_query($updq, $db_auth);
		
		$to = $f['u_email'];
		$emailx = siteName()." Password Reset <noreply@nextscenes.com>";
		$subject = "Password reset on your ".siteName()." account";
		$message = "You have requested us to reset your ".siteName()." password. 
							
To do so, please click the following link:
".siteLink()."/recover?i=".$verCode."&j=".md5(mt_rand(10000,90000).mt_rand(11,121))."&k=".$f['u_id']."

Thank you.


***NOTE*** This is a post-only mailing.  Replies to this message are not monitored or answered.";	
		$headers = "From:".$emailx."\r\n" .
		'Reply-To: noreply@nextscenes.com'."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		$data['status'] = 1;
	}
	$data = json_encode($data);
	return $data;
}
function loginUser($email, $password, $bdc){
	global $db_auth;
	$password=sha1($password.salt());
	$loginq = "SELECT * FROM c_users
		WHERE u_username ='".sanitizeData($email)."'
		AND u_pass='".sanitizeData($password)."'"; 
	$loginr = mysql_query($loginq, $db_auth);
	$loginc = mysql_num_rows($loginr);
	if ($loginc > 0){
		$login_v = mysql_fetch_assoc($loginr);
		$idsession = $login_v['u_id']."_".md5(microtime().rand());
		$updq = "UPDATE c_users SET u_session='".$idsession."', 
				u_ip= '".$_SERVER['REMOTE_ADDR']."',
				u_lastvisit='".date("Y-m-d H:i:s")."'
				WHERE u_username='".mysql_real_escape_string($email)."'";
		$updr = mysql_query($updq, $db_auth);
		//User is signed up
		$data['status'] = "1";
		$data['k___yc'] = base64_encode ($login_v['u_id'].":".md5($login_v['u_id'].cookieSalt()));
	}
	else{
		//Wrong login credentials
		$data['status'] = "0";
	}
	$data = json_encode($data);
	return $data;
}
function signUpUser($email, $pass, $username, $account){
	global $db_auth;
	$pass = sha1($pass.salt());
	$six_digit_random_number = mt_rand(100000, 999999);
	
	$cpq = "SELECT u_id FROM c_users WHERE u_email = '".sanitizeData($email)."'";
	$cp = mysql_query($cpq, $db_auth);
	$numofrows = mysql_num_rows($cp);
	if($numofrows > 0){
		// User is already signed up and verified, advise to login
		$data['status'] = "4";
	}
	else{
		$ucq = "SELECT * FROM c_users WHERE u_username = '".sanitizeData($username)."'";
		$ucr = mysql_query($ucq, $db_auth);
		if(mysql_num_rows($ucr) > 0){
			$data['status'] = "44";
		}
		else{
			$query = "INSERT INTO c_users (u_email,u_pass,u_username,c_usertypes_ut_id) 
					VALUES ('".sanitizeData($email)."', '".sanitizeData($pass)."', '".sanitizeData($username)."', '".sanitizeData($account)."')";
			$result = mysql_query($query, $db_auth);
			$the_id = mysql_insert_id($db_auth);
			if(!$result){
				//Something went wrong somewhere
				$data['status'] = "0";
			}
			else{
				//Everything's A-OK. Time to verify the email address
				// Send welcome email
				
				$to= $email;
				$subj = 'Welcome to '.siteName();
				$msg = '
				<html> 
				<head> 
				<title>Welcome to '.siteName().'</title> 
				</head> 
				<body> <center> <img src="http://nextscenes.com/central/next-scenes_logo.jpg" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
				
				<div align=left>
				<h3><font color=#698C00> Hi '.$username.', </font></h3>
				We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
				<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
				</div></body> 
				</html>';
				
				$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
				$headers .='Reply-To: info@nextscenes.com'."\n"; 
				$headers .= "MIME-version: 1.0\n";
				$headers .= "Content-type: text/html; charset= iso-8859-1\n";
				mail($to, $subj, $msg, $headers);	
				
				$data['status'] = "1";
				$data['k___yc'] = base64_encode ($the_id.":".md5($the_id.cookieSalt()));
			}
		}
	}
	$data = json_encode($data);
	return $data;
}
function validate_alphanumeric_underscore($str){
    return preg_match('/^[a-zA-Z0-9_]+$/',$str);
}
function slugify($title){
	$slug = utf8_encode($title);
	$slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
	$slug = strtolower(trim($slug, '_'));
	$slug = preg_replace("/[\/_|+ -]+/","_", $slug);
	return $slug;
}
function uslugify($title){
	$slug = utf8_encode($title);
	$slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
	$slug = trim($slug, '_');
	$slug = preg_replace("/[\/_|+ -]+/","_", $slug);
	return $slug;
}
function slugCheck($title, $type, $id){
	global $db_auth;
	$slug = uslugify($title);
	if ($type == "username"){
		$i = 1;
		$thenumber = 1;
		$oslug = $slug;
		do {
			$slugq = "SELECT u_id FROM c_users
					WHERE u_username='".$slug."'";
			$slugr = mysql_query($slugq, $db_auth);
			if (mysql_num_rows($slugr) > 0){
				$theslug = mysql_fetch_assoc($slugr);
				if($theslug['u_id'] != $id){
					$slug = $oslug.$thenumber;
					$thenumber++;
					$i++;
				}
				else{
					$i = 0;
				}
			}
			else{
				$i= 0;
			}
		} while ($i > 0);
	}
	return $slug;
}
function calcAge($dob){
	$dob = date("m/d/Y", strtotime($dob));
	$dob = explode("/", $dob);
	$dob = (date("md", date("U", mktime(0, 0, 0, $dob[0], $dob[1], $dob[2]))) > date("md")
	? ((date("Y") - $dob[2]) - 1)
	: (date("Y") - $dob[2]));
  return $dob;
}
function time_elapsed_string($ptime){
    $etime = time() - $ptime;
    if ($etime < 1){
        return '0 seconds';
    }
    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second');
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds');
    foreach ($a as $secs => $str){
        $d = $etime / $secs;
        if ($d >= 1){
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
function getCurrencies(){
	global $db_auth;
	$query = "SELECT cuid AS id, cuname AS currency, cusym AS abbreviation, cugsym AS symbol, cupop AS popular FROM currencies
		ORDER BY cuname ASC";
	$result = mysql_query($query, $db_auth);
	while($answer = mysql_fetch_assoc($result)){
		$answer['symbol'] = html_entity_decode($answer['symbol']);
		$data[] = $answer;
	}
	$data = json_encode($data);
	return $data;
}
function rehash($userid, $useridhash){
	if($useridhash = base64_encode ($userid.":".md5($userid.cookieSalt()))){
		return TRUE;
	}
	else{
		return FALSE;
	}
}
function getidfromUsername($username){
	global $db_auth;
	$query = "SELECT * FROM users
			WHERE uuname = '".mysql_real_escape_string($username)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function updateNotifs($userhash, $ionicid, $deviceid){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$chkq = "SELECT * FROM c_users_devices
		WHERE users_u_id = '".mysql_real_escape_string($userid)."'
		AND ud_idid = '".mysql_real_escape_string($ionicid)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) == 0){
			$insq = "INSERT INTO c_users_devices
			(ud_id, ud_idid, users_u_id)  VALUES ('".mysql_real_escape_string($deviceid)."', '".mysql_real_escape_string($ionicid)."', '".mysql_real_escape_string($userid)."')";
			$insr = mysql_query($insq, $db_auth);
			$data['status'] = "1";
		}
		else{
			$updq = "UPDATE c_users_devices SET ud_id = '".mysql_real_escape_string($deviceid)."'
				WHERE users_u_id = '".mysql_real_escape_string($userid)."'";
			$updr = mysql_query($updq, $db_auth);
			$data['status'] = "1";
		}
	}
	else{
		$data['status'] = "55";
	}
	$data = json_encode($data);
	return $data;
}
function siteFooter(){
	if(isset($db_auth)){
		mysql_close($db_auth);
	}
}
function getImgStyle($img){
	list($width, $height) = getimagesize($img);
	//echo $img."+++++".$width."----".$height;
	$ar = $width/$height;
	if($ar == 1){
		$data = "img_is_square";
	}
	else{
		if($ar > 1){
			$data = "img_is_wide";
		}
		else{
			$data = "img_is_long";
		}
	}
	return $data;
}
/*function addUserImagex($userhash, $filename){
	global $db_auth;
	$userhash = $userhash['ua'];
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$updq = "UPDATE users SET uform = '".mysql_real_escape_string(uploadFrom())."', 
				usrc = '".mysql_real_escape_string($filename)."'
				WHERE uid ='".mysql_real_escape_string($userid)."'";
		$updr = mysql_query($updq, $db_auth);
		if($updr){
			$img_loc_check = siteLink()."/assets/".uploadFrom()."/thumb/".$filename;
			$img_style = getImgStyle($img_loc_check);
			$data = $img_loc_check.",".$img_style;
		}
		else{
			$data = 2;
		}
	}
	else{
		$data = 55;
	}
	return $data;
}*/
function shorten($text,$chars) { 
    $length = strlen($text); 
    $text = strip_tags(htmlspecialchars_decode($text));  
    $text = substr($text,0,$chars); 
    if($length > $chars) { $text = $text."..."; } 
    return $text; 

}
function getForums(){
	global $db_auth;
	$query = "SELECT * FROM c_forums
LEFT JOIN (SELECT COUNT(sl_id) AS story_count, c_forums_f_id FROM c_storylines
GROUP BY c_forums_f_id) dd ON dd.c_forums_f_id = c_forums.f_id
WHERE c_languages_l_id='1'
ORDER BY f_name ASC";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		while($answer = mysql_fetch_assoc($result)){
			$answerx['id'] = $answer['f_id'];
			$answerx['name'] = $answer['f_name'];
			$answerx['summary'] = shorten($answer['f_desc'],90);
			
			$imgstyle = getImgStyle("pictures/".$answer['f_img']);
			if(!empty($answer['f_img'])){
				$image = "pictures/".$answer['f_img'];
			}
			else{
				$image = "pictures/avatar.jpg";
			}
			
			$answerx['image'] = siteLink()."/".$image;
			$answerx['imagestyle'] = $imgstyle;
			$data['info'][] = $answerx;
		}
	}
	$data = json_encode($data);
	return $data;
}
function getStorylines($id, $page){
	global $db_auth;
	if(!$page || !is_numeric($page)){
		$pager = 1;
	}
	else{
		$pager = $page;
	}
	$query = "SELECT * FROM c_storylines
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		INNER JOIN (
			SELECT MIN(vs_id) AS min_vs_id, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id) idd 
				ON idd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN (
			SELECT COUNT(vs_id) AS validated_scenes_count, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id
			) iddd ON iddd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN (
			SELECT COUNT(ps_id) AS proposed_scenes_count, c_storylines_sl_id FROM c_proposed_scenes
			GROUP BY c_storylines_sl_id
			) idx ON idx.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
		WHERE c_forums_f_id = '".mysql_real_escape_string($id)."'";
	$query .= "
	ORDER BY sl_id DESC";
	
	if($pager > 1){
		$query .= "
	LIMIT ".(($pager*10)-10).", 10";
	}
	else{
		$query .= "
	LIMIT 10";
	}
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		while($answer = mysql_fetch_assoc($result)){
			$answerx['id'] = $answer['sl_id'];
			$answerx['name'] = $answer['sl_name'];
			$answerx['summary'] = utf8_encode(shorten($answer['sl_desc'],180));
			
			if($answer['sl_form'] != ""){
				$iurl = $answer['sl_form']."/".$answer['sl_img'];
			}
			else{
				$iurl = "pictures/".$answer['sl_img'];
			}
			$imgstyle = getImgStyle($iurl);
			if(!empty($answer['sl_img'])){
				$image = $iurl;
			}
			else{
				$image = "pictures/avatar.jpg";
			}
			$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
			
			if(!empty($answer['u_avatar'])){
				$avatar = "avatars/".$answer['u_avatar'];
			}
			else{
				$avatar = "avatars/default.png";
			}
			
			
			$answerx['image'] = siteLink()."/".$image;
			$answerx['imagestyle'] = $imgstyle;
			$answerx['imagestylex'] = $imgstylex;
			$answerx['avatar'] = siteLink()."/".$avatar;
			$answerx['moderator'] = $answer['u_username'];
			$answerx['forumID'] = $answer['f_id'];
			$answerx['forumName'] = $answer['f_name'];
			
			if($answer['validated_scenes_count'] == 1){
				$vscenes = "1 scene";
			}
			else{
				$vscenes = number_format($answer['validated_scenes_count'])." scenes";
			}
			if($answer['proposed_scenes_count'] == 1){
				$pscenes = "1 proposed scene";
			}
			else{
				$pscenes = number_format($answer['proposed_scenes_count'])." proposed scenes";
			}
			if($v['sl_views'] == 1){
				$views = "1 view";
			}
			else{
				$views = number_format($answer['sl_views'])." views";
			}		
			$answerx['scenes'] = $vscenes;
			$answerx['proposed_scenes'] = $pscenes;
			$answerx['views'] = $views;
			$answerx['created'] = "Created ".date("jS F Y", strtotime($answer['sl_ts']));
			$data['info'][] = $answerx;
		}
	}
	$data = json_encode($data);
	return $data;
}
function getPage($page){
	global $db_auth;
	if($page == "principle"){
		$id = "1";
	}
	else if($page == "how"){
		$id = "2";
	}
	else if($page == "faq"){
		$id = "3";
	}
	$query = "SELECT * FROM data WHERE Iddata='".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		$answer = mysql_fetch_assoc($result);
		$answerx['title'] = $answer['Title'];
		$answerx['body'] = html_entity_decode($answer['Descriptions']);
		$data['info'] = $answerx;
	}
	$data = json_encode($data);
	return $data;
}
function updateStorylineViews($id){
	global $db_auth;
	$query = "UPDATE c_storylines SET sl_views = sl_views+1
		WHERE sl_id = '".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
}
function getVScenes($story_id, $scene_id){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type FROM c_valid_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_valid_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		WHERE c_storylines_sl_id = '".mysql_real_escape_string($story_id)."'
		AND vs_id IN (
			SELECT vs_id FROM c_valid_scenes
			WHERE c_storylines_sl_id = '".mysql_real_escape_string($story_id)."'
			ORDER BY vs_scene DESC
		)
		ORDER BY c_valid_scenes.vs_scene ASC
		LIMIT 5";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		while($answer = mysql_fetch_assoc($result)){
			$answerx['name'] = html_entity_decode($answer['sl_name']);
			$answerx['scene'] = html_entity_decode($answer['vs_scene']);
			$answerx['body'] = html_entity_decode(utf8_encode($answer['vs_desc']));
			$answerx['author'] = html_entity_decode($answer['u_username']);
			$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
			
			if(!empty($answer['u_avatar'])){
				$avatar = "avatars/".$answer['u_avatar'];
			}
			else{
				$avatar = "avatars/default.png";
			}
			if($answer['scene_type'] == 'valid'){
				$answerx['title'] = utf8_encode($answer['sl_name'])." - Scene ".$answer['vs_scene'];
			}
			else{
				$answerx['title'] = utf8_encode($answer['sl_name'])." - <strong>[Proposed]</strong> scene ".$answer['vs_scene'];
			}
			$answerx['imgstylex'] = $imgstylex;
			$answerx['avatar'] = siteLink()."/".$avatar;
			$data['info'][] = $answerx;
		}
	}
	$data = json_encode($data);
	return $data;
}
function getStory($id){
	global $db_auth;
	$query = "SELECT * FROM c_storylines
	LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	LEFT JOIN (SELECT (MAX(vs_scene)+1) AS latest_scene, c_storylines_sl_id
		FROM c_valid_scenes
		WHERE c_storylines_sl_id ='".mysql_real_escape_string($id)."'
		) mss ON mss.c_storylines_sl_id = c_storylines.sl_id
	WHERE sl_id ='".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		$answer = mysql_fetch_assoc($result);
		if($answer['sl_views'] == 1){
			$answerx['views'] = "1 view";
		}
		else{
			$answerx['views'] = number_format($answer['sl_views'])." views";
		}
		$answerx['forumid'] = $answer['f_id'];
		$answerx['forumname'] = $answer['f_name'];
		$answerx['date'] = "Created ".date("jS F Y", strtotime($answer['sl_ts']));
		$data['info'] = $answerx;
	}
	$data = json_encode($data);
	return $data;
}
function proposedScenes($story_id, $scene_id){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type FROM c_proposed_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_proposed_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		WHERE c_storylines_sl_id = '".mysql_real_escape_string($story_id)."'
		ORDER BY ps_id DESC";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		while($answer = mysql_fetch_assoc($result)){
			$answerx['title'] = stripslashes(htmlspecialchars_decode(utf8_encode($answer['sl_name'])));
			$answerx['scene'] = $answer['ps_scene'];
			if($answer['sl_views'] == 1){
				$answerx['views'] = "1 view";
			}
			else{
				$answerx['views'] = number_format($answer['sl_views'])." views";
			}
			$answerx['date'] = "Created ".date("jS F Y", strtotime($answer['ps_ts']));
			$answerx['author'] = utf8_encode($answer['u_username']);
			$answerx['preview'] = utf8_encode(shorten($answer['ps_desc'],90));
			$answerx['id'] = $answer['ps_id'];
			$data['info'][] = $answerx;
		}
	}
	$data = json_encode($data);
	return $data;
}
function loadScene($scene_id, $userhash){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$query = "SELECT * FROM c_proposed_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_proposed_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		LEFT JOIN (
			SELECT AVG(ra_rating) AS scene_rating, COUNT(ra_rating) AS scene_votes, c_proposed_scenes_ps_id 
			FROM c_ratings 
			GROUP BY c_proposed_scenes_ps_id
		) ratata ON ratata.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		LEFT JOIN (SELECT COUNT(ra_id) AS user_self_reviews, c_proposed_scenes_ps_id, ra_comment FROM c_ratings
			WHERE c_users_u_id = '".mysql_real_escape_string($userid)."'
			GROUP BY c_proposed_scenes_ps_id) ppsid ON ppsid.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		LEFT JOIN (SELECT ra_rating AS my_rating, ra_comment AS my_comment, c_proposed_scenes_ps_id FROM c_ratings
			WHERE c_users_u_id = '".mysql_real_escape_string($userid)."'
			GROUP BY c_proposed_scenes_ps_id) pxsid ON pxsid.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		WHERE ps_id = '".mysql_real_escape_string($scene_id)."'";
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			$data['status'] = 0;
		}
		else{
			$data['status'] = 1;
			while($answer = mysql_fetch_assoc($result)){
				if($answer['scene_rating'] == NULL){
					$rating_score = "0";
				}
				else{
					$rating_score = number_format(($answer['scene_rating']/2), 2, '.', '');
				}
				if($answer['scene_votes'] == NULL){
					$rating_count = "0 votes";
				}
				else{
					$rating_count = $answer['scene_votes'];
					if($rating_count == 1){
						$rating_count = "1 vote";
					}
					else{
						$rating_count = number_format($rating_count)." votes";
					}
				}
				if($answer['user_self_reviews'] == 0){
					$self_rated = 0;
				}
				else{
					$self_rated = $answer['user_self_reviews'];
				}
				
				
				$answerx['name'] = html_entity_decode($answer['sl_name']);
				$answerx['scene'] = html_entity_decode($answer['ps_scene']);
				$answerx['id'] = html_entity_decode($answer['ps_id']);
				$answerx['body'] = html_entity_decode(utf8_encode($answer['ps_desc']));
				$answerx['author'] = html_entity_decode($answer['u_username']);
				$answerx['rating'] = $rating_score;
				$answerx['rating_count'] = $rating_count;
				$answerx['rating_you'] = $self_rated;
				$answerx['myrating'] = $answer['my_rating'];
				$answerx['myreview'] = $answer['my_comment'];
				
				$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
				
				if(!empty($answer['u_avatar'])){
					$avatar = "avatars/".$answer['u_avatar'];
				}
				else{
					$avatar = "avatars/default.png";
				}
				if($answer['scene_type'] == 'valid'){
					$answerx['title'] = utf8_encode($answer['sl_name'])." - Scene ".$answer['ps_scene'];
				}
				else{
					$answerx['title'] = utf8_encode($answer['sl_name'])." - <strong>[Proposed]</strong> scene ".$answer['ps_scene'];
				}
				$answerx['imgstylex'] = $imgstylex;
				$answerx['avatar'] = siteLink()."/".$avatar;
				$data['info'] = $answerx;
			}
		}
	}
	else{
		$data['status'] = 0;
	}
	$data = json_encode($data);
	return $data;
}
function applyRating($scene, $score, $userhash){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$chkq = "SELECT * FROM c_ratings
		WHERE c_users_u_id = '".mysql_real_escape_string($userid)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) > 0){
			$updq = "UPDATE c_ratings SET ra_rating = '".mysql_real_escape_string($score)."'
		WHERE c_users_u_id = '".mysql_real_escape_string($userid)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
			$updr = mysql_query($updq, $db_auth);
			if(!$updr){
				$data['status'] = 0;
			}
			else{
				$data['status'] = 1;
			}
		}
		else{
			$insq = "INSERT INTO c_ratings (ra_rating, c_users_u_id, c_proposed_scenes_ps_id)
				VALUES ('".mysql_real_escape_string($score)."', '".mysql_real_escape_string($userid)."', '".mysql_real_escape_string($scene)."')";
			$insr = mysql_query($insq, $db_auth);
			if(!$insr){
				$data['status'] = 0;
			}
			else{
				$data['status'] = 1;
			}
		}
	}
	else{
		$data['status'] = 0;
	}
	$data = json_encode($data);
	return $data;
}
function addReview($scene_id, $comment, $userhash){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$updq = "UPDATE c_ratings SET ra_comment = '".mysql_real_escape_string($comment)."'
		WHERE c_users_u_id = '".mysql_real_escape_string($userid)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene_id)."'";
		$updr = mysql_query($updq, $db_auth);
		if(!$updr){
			$data['status'] = 0;
		}
		else{
			$data['status'] = 1;
		}
	}
	else{
		$data['status'] = 0;
	}
	$data = json_encode($data);
	return $data;
}
function proposeScene($storyline, $text, $userhash){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$text = nl2br(strip_tags($text));
		$chkq = "SELECT * FROM c_proposed_scenes
				WHERE ps_desc = '".mysql_real_escape_string($text)."'
				AND c_users_u_id = '".mysql_real_escape_string($userid)."'
				AND c_storylines_sl_id = '".mysql_real_escape_string($storyline)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) == 0){
			$qq = "SELECT (MAX(vs_scene)+1) AS latest_scene, c_storylines_sl_id
				FROM c_valid_scenes
				WHERE c_storylines_sl_id ='".mysql_real_escape_string($storyline)."'";
			$rr = mysql_query($qq, $db_auth);
			if(mysql_num_rows($rr) > 0){
				$aa = mysql_fetch_assoc($rr);
				$insq = "INSERT INTO c_proposed_scenes (ps_desc, ps_scene, c_users_u_id, c_storylines_sl_id)
						VALUES ('".$text."', '".$aa['latest_scene']."', '".$userid."','".$storyline."')";
				$insr = mysql_query($insq, $db_auth);
				if(!$insr){
					$data['status'] = 3;
				}
				else{
					$data['status'] = 1;
				}
			}
			else{
				$data['status'] = 22;
			}
		}
		else{
			$data['status'] = 2;
		}
	}
	else{
		$data['status'] = 0;
	}
	$data = json_encode($data);
	return $data;
}
function getPosts($userhash, $pager){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$lang = TRUE;
		$chkq = "SELECT c_languages_l_id FROM users
			WHERE u_id='".$userid."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) == 0){
			$lang = 1;
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$lang = $chk['c_languages_l_id'];
		}
	}
	else{
		$lang = 1;
	}
	if(!$the_page || !is_numeric($the_page)){
		$pager = 1;
	}
	else{
		$pager = $the_page;
	}
	$chkq = "SELECT COUNT(the_main_id) FROM
		(
			(SELECT ps_id AS the_main_id FROM c_proposed_scenes
			INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
			INNER JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id
				INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
				WHERE c_forums.c_languages_l_id = '".mysql_real_escape_string($lang)."'
			)
			
			UNION
			
			(SELECT vs_id AS the_main_id FROM c_valid_scenes
			INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
			INNER JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id
				INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
				WHERE c_forums.c_languages_l_id = '".mysql_real_escape_string($lang)."'
			)
		) oxox";
	$chkr = mysql_query($chkq, $db_auth);
	$chk = mysql_fetch_assoc($chkr);
	$post_count = $chk['COUNT(the_main_id)'];
	
	$nofpages = ceil($post_count/20);
	if($pager < $nofpages){
		$data['more'] = 1;
	}
	else{
		$data['more'] = 0;
	}

	$query = "(SELECT ps_id AS the_main_id, ps_ts, ps_desc, ps_scene, ps_status, c_proposed_scenes.c_users_u_id, c_storylines_sl_id, f_id, f_name, u_avatar, u_username, sl_id, sl_name, sl_form, sl_img, sl_views, 'yes' AS proposed_or_not FROM c_proposed_scenes
INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
INNER JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '".mysql_real_escape_string($lang)."'
)

UNION

(SELECT vs_id AS the_main_id, vs_ts, vs_desc, vs_scene, '1' AS vs_status, c_valid_scenes.c_users_u_id, c_storylines_sl_id, f_id, f_name, u_avatar, u_username, sl_id, sl_name, sl_form, sl_img, sl_views, 'no' AS proposed_or_not FROM c_valid_scenes
INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
INNER JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '".mysql_real_escape_string($lang)."'
)
	ORDER BY the_main_id DESC";
	
	if($pager > 1){
		$query .= "
	LIMIT ".(($pager*20)-20).", 20";
	}
	else{
		$query .= "
	LIMIT 20";
	} 
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data['status'] = 0;
	}
	else{
		$data['status'] = 1;
		while($answer = mysql_fetch_assoc($result)){
			if($answer['sl_form'] != ""){
				$iurl = $answer['sl_form']."/".$answer['sl_img'];
			}
			else{
				$iurl = "pictures/".$answer['sl_img'];
			}
			$imgstyle = getImgStyle($iurl);
			if(!empty($answer['sl_img'])){
				$image = $iurl;
			}
			else{
				$image = "pictures/avatar.jpg";
			}
			$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
			if(!empty($answer['avatar'])){
				$avatar = "avatars/".$answer['u_avatar'];
			}
			else{
				$avatar = "avatars/default.png";
			}
			if($answer['scene_type'] == "valid"){
				$intro = "Scene ".number_format($answer['ps_scene']);
			}
			else{
				$intro = "<strong>[Proposed]</strong> scene ".number_format($answer['ps_scene']);
			}				
			if($answer['sl_views'] == 1){
				$views = "1 view";
			}
			else{
				$views = number_format($answer['sl_views'])." views";
			}
			$answerx['scene_id'] = $answer['the_main_id'];
			$answerx['date'] = "Created ".date("jS F Y", strtotime($answer['ps_ts']));
			$answerx['summary'] = utf8_encode(shorten($answer['ps_desc'],180));
			$answerx['scene_number'] = $answer['ps_scene'];
			$answerx['scene_status'] = $answer['ps_status'];
			$answerx['forum_name'] = $answer['f_name'];
			$answerx['forum_id'] = $answer['f_id'];
			$answerx['picture'] = siteLink()."/".$image;
			$answerx['avatar'] = siteLink()."/".$avatar;
			$answerx['avatar_style'] = $imgstylex;
			$answerx['user'] = $answer['u_username'];
			$answerx['story_id'] = $answer['sl_id'];
			$answerx['story_name'] = $answer['sl_name'];
			$answerx['views'] = $views;
			$answerx['proposed'] = $answer['proposed_or_not'];
			$answerx['description'] = $intro;
			$data['info'][] = $answerx;
		}
	}
	$data = json_encode($data);
	return $data;
}
function getSettings($userhash){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$query = "SELECT * FROM c_users
			WHERE u_id = '".mysql_real_escape_string($userid)."'";
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			$data['status'] = 0;
		}
		else{
			$answer = mysql_fetch_assoc($result);		
			$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
			if(!empty($answer['u_avatar'])){
				$avatar = "avatars/".$answer['u_avatar'];
			}
			else{
				$avatar = "avatars/default.png";
			}
			$data['status'] = 1;
			$answerx['username'] = $answer['u_username'];
			$answerx['type'] = $answer['c_usertypes_ut_id'];
			$answerx['language'] = $answer['c_languages_l_id'];
			$answerx['userImageStyle'] = $imgstylex;
			$answerx['avatar'] = siteLink()."/".$avatar;
			$data['info'] = $answerx;
		}
	}
	else{
		$data['status'] = 55;
	}
	$data = json_encode($data);
	return $data;
}
function updateSettings($userhash, $user_type, $user_language, $user_password){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$query = "SELECT * FROM c_users
			WHERE u_id = '".mysql_real_escape_string($userid)."'";
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			$data['status'] = 0;
		}
		else{
			$answer = mysql_fetch_assoc($result);		
			if($user_password){
				$fieldextra = ",
				u_pass = '".sha1($user_password.salt())."'";
			}
			$insq = "UPDATE c_users SET c_usertypes_ut_id = '".mysql_real_escape_string($user_type)."',
				c_languages_l_id = '".mysql_real_escape_string($user_language)."'".$fieldextra;
			$insr = mysql_query($insq, $db_auth);
			if(!$insr){
				$data['status'] = 2;
			}
			else{
				$data['status'] = 1;
			}
		}
	}
	else{
		$data['status'] = 55;
	}
	$data = json_encode($data);
	return $data;
}
function addUserImagex($userhash, $filename){
	global $db_auth;
	$exploded = explode(':', base64_decode($userhash));
	$userid = $exploded[0];
	$useridhash = $exploded[1];
	if(rehash($userid, $useridhash)){
		$updq = "UPDATE c_users SET u_avatar = '".mysql_real_escape_string($filename)."'
				WHERE u_id ='".mysql_real_escape_string($userid)."'";
		$updr = mysql_query($updq, $db_auth);
		if($updr){
			$img_loc_check = siteLink()."/avatar/thumb/".$filename;
			$img_style = getImgStyle($img_loc_check);
			$data = $img_loc_check.",".$img_style;
		}
		else{
			$data = 2;
		}
	}
	else{
		$data = 55;
	}
	return $data;
}
?>