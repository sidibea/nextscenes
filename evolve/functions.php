<?php
// STANDARD SET OF FIRST CALLS
session_start();
libxml_use_internal_errors(false);
error_reporting(0);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
if (!$db_auth_evolve){
	require "plug/db_connect.php";
}
if (isset($_GET['doLogout']) == 'true'){
	doLogout();
}


// ACTIVATE GLOBAL VARIABLES
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
$username= $_SESSION['MM_Username'];



// WEBSITE FUNCTIONS LIST

// ****************************************************************************************************************************** ENTER SITE NAME HERE ***** 
function siteName(){
	$data = "Unit1Networks Content Management System";
	return $data;
}
function contactEmail(){
	$data = "info@unit1networks.com";
	return $data;
}
function clientName(){
	$data = "";
	return $data;
}
function clientSite(){
	$data = "http://www.nextscenes.com";
	return $data;
}
function clientEmail(){
	$data = "info@nextscenes.com";
	return $data;
}
function siteVersion(){
	$data = "<h1><a href='index.php'>Unit1Networks </a></h1><h2>Content Management System</h2><h3>Version 3.0</h3><h3>Developed by <a href=\"http://www.unit1networks.com\" target=\"_blank\">Unit1Networks</a></h3><h3>All rights reserved ".date("Y")."</h3>";
	return $data;
}
function genericError($mssg){
	$data = "Something seems to have gone wrong. Please try again.";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
	return $data;
}
function genericDbError($mssg){
	$data = "Could not complete the database request.";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
	return $data;
}
function genericSearchError($mssg){
	$data = "There are no results matching your search query.";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
	return $data;
}
function genericAuthError($mssg){
	$data = "You are not authorized to complete the requested action.";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
	return $data;
}
function genericTimeError($mssg){
	$data = "Sorry, the request has expired.";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
	return $data;
}
function genericUploadMssg($mssg){
	$data = "Please select an image file for upload:<br />Supported formats are .jpg, .png and .gif<br />Maximum upload size is 2Mb";
	if($mssg != ""){
		$data .= ": ".$mssg;
	}
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
function imageDirectory(){
	$data = "../".uploadFrom()."/";
	return $data;
}
function thumbnailDirectory(){
	$data = "../".uploadFrom()."/thumb/";
	return $data;
}
function pricify($title){
	$slug = utf8_encode($title);
	$slug = preg_replace("/[^0-9]/", '', $slug);
	return $slug;
}
function slugify($title){
	$slug = utf8_encode($title);
	$slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
	$slug = strtolower(trim($slug, '-'));
	$slug = preg_replace("/[\/_|+ -]+/","-", $slug);
	return $slug;
}
// *********************************************************************************************************************************************************
function doLogout(){
	$_SESSION['ev_u_name'] = NULL;
	$_SESSION['ev_u_auth'] = NULL;
	unset($_SESSION['ev_u_name']);
	unset($_SESSION['ev_u_auth']);
	header("Location: login.php");
	exit;
}
function saltIt(){
	$salt = "c_=xPf3PL%2342Qv|=xPf3PL@#&s$^&=xPf3PL%2b342542AoFc=m6s%2AZN";
	return $salt;
}
function sanitizeFormData($string, $tags){
	$string = trim($string);
	if($tags != TRUE){
		$string = strip_tags($string);
	}
	$string = htmlspecialchars($string);
	return $string;
}
function loginUser($username, $password){
	global $db_auth_evolve;
	$password=sha1($password.saltIt());
	//echo $password;
	//die();
	$loginq= "SELECT * FROM c_users
		WHERE u_username = '".mysql_real_escape_string($username)."'
		AND u_pass = '".$password."'
		AND u_mod != 0";
	$loginr = mysql_query($loginq, $db_auth_evolve);
	if(mysql_num_rows($loginr) == 0){
		if (isset($_SESSION['ev_u_name'])){
			$_SESSION['ev_u_name'] = NULL;
			$_SESSION['ev_u_auth'] = NULL;
			unset($_SESSION['ev_u_name']);
			unset($_SESSION['ev_u_auth']);
		}
		header("Location: login.php?login=fail");
		exit;
	}
	else{
		$login_v = mysql_fetch_assoc($loginr);
		$idsession = $login_v['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
		$_SESSION['ev_u_name'] = $idsession;
		$_SESSION['ev_u_auth'] = $login_v['u_mod'];
		
		$updq = "UPDATE c_users SET u_mod_session = '".$idsession."'
			WHERE u_id = '".$login_v['u_id']."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		header("Location: index.php");
		exit;
	}
}
function isLoggedIn(){
	if (!isset($_SESSION['ev_u_auth']) || $_SESSION['ev_u_auth'] == NULL ||  $_SESSION['ev_u_auth'] == "" ||  $_SESSION['ev_u_name'] == NULL ||  $_SESSION['ev_u_auth'] == ""){
		header("Location: login.php");
		exit;
	}
}
function isAdmin(){
	$user = getUsername($_SESSION['ev_u_name']);
	if ($user['u_mod'] != 1){
		header("Location: index.php");
		exit;
	}
}
function getUserauthId($user){
	global $db_auth_evolve;
	$uq = "SELECT auth_a_id FROM users LEFT JOIN auth ON users.auth_a_id = auth.a_id WHERE user_key='".mysql_real_escape_string($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$u = mysql_fetch_assoc($ur);
	$data = stripslashes($u['auth_a_id']);
	return $data;	
}
function getPermissions($auth){
	global $db_auth_evolve;
	$query = "SELECT * FROM permissions
			LEFT JOIN pages ON pages.pa_id = permissions.pages_pa_id
			WHERE auth_a_id = '".$auth."'";
	$result = mysql_query($query, $db_auth_evolve);
	$i = 1;
	while($answer = mysql_fetch_assoc($result)){
		if($i != 1){
			$data .= ", ";
		}
		$data .= $answer['pa_name'];
		$i++;
	}	
	return $data;
}
function getPagePermissions($auth){
	global $db_auth_evolve;
	$query = "SELECT pa_id FROM permissions
			LEFT JOIN pages ON pages.pa_id = permissions.pages_pa_id
			WHERE auth_a_id = '".$auth."'";
	$result = mysql_query($query, $db_auth_evolve);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer['pa_id'];
	}	
	return $data;
}
function getPageId($page){
	global $db_auth_evolve;
	$query = "SELECT pa_id FROM pages WHERE pa_slug = '$page'";
	$result = mysql_query($query, $db_auth_evolve);
	$answer = mysql_fetch_assoc($result);
	$data = $answer["pa_id"];
	
	return $data;
}
function isPermitted($page){
	global $db_auth_evolve;
	$page = ucwords($page);
	$auth = getUserauthId($_SESSION["ev_u_name"]);
	$query = "SELECT * FROM permissions WHERE auth_a_id = '".$auth."'";
	$result = mysql_query($query, $db_auth_evolve);
	$answer = mysql_fetch_assoc($result);
	$pages = explode(",", $answer["pages"]);
	if($auth == 1 || in_array($page, $pages)){
		$data = TRUE;
	}
	else{
		$data = FALSE;
		//header("Location: index.php");
	}
	return $data;
}
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
  if (PHP_VERSION < 6) {
	$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
  switch ($theType) {
	case "text":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;    
	case "long":
	case "int":
	  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
	  break;
	case "double":
	  $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
	  break;
	case "date":
	  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
	  break;
	case "defined":
	  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
	  break;
  }
  return $theValue;
}

function slugCheck($title, $type, $id){
	global $db_auth_evolve;
	$slug = utf8_encode($title);
	$slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
	$slug = strtolower(trim($slug, '-'));
	$slug = preg_replace("/[\/_|+ -]+/","-", $slug);	
	
	if ($type == "users"){
		$i = 1;
		do {
			$slugq = "SELECT u_id FROM c_users
					WHERE u_username='".$slug."'";
			$slugr = mysql_query($slugq, $db_auth_evolve);
			if (mysql_num_rows($slugr) > 0){
				$theslug = mysql_fetch_assoc($slugr);
				if($theslug['u_id'] != $id){
					$slug = $slug."-".$i;
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
function generateMenu($page, $subpage){
	global $logoutAction;
	if ($page == "login"){
		$data = "
		<div class=\"menu\">
			<ul>
				<li class=\"active\"><a href=\"forgot_password.php\">Forgot your password?</a></li>
			</ul>
		</div>";
	}
	else if ($page == "forgot"){
		$data = "
		<div class=\"menu\">
			<ul>
				<li class=\"active\"><a href=\"login.php\">Return to Login</a></li>
			</ul>
		</div>";
	}
	else{
		$data = "
		<div class=\"menu\">
            <ul>
                <li"; if($page == "index"){ $data .= " class=\"active\""; } $data .= "><a href=\"index.php\">Dashboard</a>
                	<div class=\"drop\">
                    	<ul>";
						if($_SESSION['ev_u_auth'] == 1){
							$data .= "
                        	<li><a href=\"https://www.google.com/analytics/web/\" target=\"_blank\">Google Analytics</a></li>";
						}
							$data .= "
                            <li"; if($page == "index" && $subpage == "troubleshoot"){ $data .= " class=\"active\""; } $data .= "><a href=\"troubleshoot.php\">Troubleshoot</a></li>
                        </ul>
                    </div>
                </li>";
				if($_SESSION['ev_u_auth'] == 1){
					$data .="
				<li"; if($page == "forums"){ $data .= " class=\"active\""; } $data .= "><a href=\"forums.php\">Forums</a>
					<ul>
						 <li"; if($page == "forums" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"forums.php\">All forums</a></li>
						 <li"; if($page == "forums" && $subpage == "new"){ $data .= " class=\"active\""; } $data .= "><a href=\"new_forum.php\">Add new</a></li>
						 <li"; if($page == "forums" && $subpage == "lang"){ $data .= " class=\"active\""; } $data .= "><a href=\"languages.php\">Languages</a></li>
					</ul>
				</li>";
				}
				if($_SESSION['ev_u_auth'] == 1){
					$data .= "
				<li"; if($page == "storylines"){ $data .= " class=\"active\""; } $data .= "><a href=\"storylines.php\">Storylines</a>";
				}
				else{
					$data .= "
				<li"; if($page == "storylines"){ $data .= " class=\"active\""; } $data .= "><a href=\"my_storylines.php\">Storylines</a>";
				}
					$data .= "
					<ul>";
					if($_SESSION['ev_u_auth'] == 1){
						$data .= "
						 <li"; if($page == "storylines" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"storylines.php\">All storylines</a></li>";
					}
					else{
						$data .= "
						 <li"; if($page == "storylines" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"my_storylines.php\">My storylines</a></li>";
					}
					$data .= "
						 <li"; if($page == "storylines" && $subpage == "new"){ $data .= " class=\"active\""; } $data .= "><a href=\"new_storyline.php\">Add new</a></li>
					</ul>
				</li>";
				if($_SESSION['ev_u_auth'] == 1){
					$data .= "
				<li"; if($page == "scenes"){ $data .= " class=\"active\""; } $data .= "><a href=\"scenes.php\">Scenes</a>";
				}
				else{
					$data .= "
				<li"; if($page == "scenes"){ $data .= " class=\"active\""; } $data .= "><a href=\"my_scenes.php\">Scenes</a>";
				}
				$data .= "
					<ul>";
					if($_SESSION['ev_u_auth'] == 1){
						$data .= "
						 <li"; if($page == "scenes" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"scenes.php\">All scenes</a></li>";
					}
					else{
						$data .= "
						 <li"; if($page == "scenes" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"my_scenes.php\">My scenes</a></li>";
					}
					$data .= "
					</ul>
				</li>
				<!--<li"; if($page == "pages"){ $data .= " class=\"active\""; } $data .= "><a href=\"pages.php\">Pages</a>
					<ul>
						 <li"; if($page == "pages" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"pages.php\">All pages</a></li>
						 <li"; if($page == "pages" && $subpage == "new"){ $data .= " class=\"active\""; } $data .= "><a href=\"new_page.php\">Add new</a></li>
						 
					</ul>
				</li>-->";
				if($_SESSION['ev_u_auth'] == 1){
					$data .= "
				<li"; if($page == "moderators"){ $data .= " class=\"active\""; } $data .= "><a href=\"moderators.php\">Moderators</a>
					<ul>
						 <li"; if($page == "moderators" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"moderators.php\">All moderators</a></li>
						 <li"; if($page == "moderators" && $subpage == "new"){ $data .= " class=\"active\""; } $data .= "><a href=\"new_moderator.php\">Add new</a></li>
						 
					</ul>
				</li>
				<li"; if($page == "users"){ $data .= " class=\"active\""; } $data .= "><a href=\"users.php\">Users</a>
					<ul>
						 <li"; if($page == "users" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"users.php\">All users</a></li>
						 
					</ul>
				</li>";
				}
				$data .= "
				<li"; if($page == "settings"){ $data .= " class=\"active\""; } $data .= "><a href=\"settings.php\">Settings</a>
					<ul>
						 <li"; if($page == "settings" && $subpage == "all"){ $data .= " class=\"active\""; } $data .= "><a href=\"settings.php\">Profile</a></li>
						 <li"; if($page == "settings" && $subpage == "password"){ $data .= " class=\"active\""; } $data .= "><a href=\"password-change.php\">Change password</a></li>
						 
					</ul>
				</li>
                <li><a href=\"".$logoutAction."\">Logout</a></li>
            </ul>
        </div>";
	}
		return $data;
}
function generateHeader(){
	global $logoutAction;
	$name = getUsername($_SESSION['ev_u_name']);
	$data = "
	<div class='header h50 p10 bbvg mb20'>
		<div class='left txtleft'>
			<h4>".clientName()."</h4>
			<p>".date("l, jS F Y")."</p>
		</div>
		<div class='right txtright'>
			<h4>".$name['u_username']."</h4>
			<p><a href='settings.php'>Settings</a></p>
			<p><a href=\"".$logoutAction."\">Logout</a></p>
		</div>
	</div>";
	return $data;
}
function parseNewsInfo($num){
	$Parser 	= new FeedParser();
	$Parser->parse('http://feedstitch.com/11248/latest');
	$channels  	= $Parser->getChannels();     
	$items     	= $Parser->getItems();
	$i = 0;
	$newsList;
	$limit = $num;
	foreach($items as $item){
		$newsList .= "<li><a href=\"".$item['ID']."\" target=\"_blank\">".$item['TITLE']."</a></li>";
		$i++;
		if ($i == $limit){
			break;
		}
	}
	return $newsList;
}
function getUsername($user){
	global $db_auth_evolve;
	$uq = "SELECT u_id, u_username, u_fname, u_lastname, u_mod FROM c_users WHERE u_mod_session='".mysql_real_escape_string($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$u = mysql_fetch_assoc($ur);
	$data = $u;
	return $data;
}
function getUserId($user){
	global $db_auth_evolve;
	$uq = "SELECT user_id FROM users WHERE user_key='".sanitizeData($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$u = mysql_fetch_assoc($ur);
	$data = stripslashes($u['user_id']);
	return $data;	
}
function getUserdetails($user){
	global $db_auth_evolve;
	$uq = "SELECT * FROM users WHERE user_key='".mysql_real_escape_string($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$data = mysql_fetch_assoc($ur);
	return $data;
}
function getUseremail($user){
	global $db_auth_evolve;
	$uq = "SELECT user_email FROM users WHERE user_key='".mysql_real_escape_string($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$u = mysql_fetch_assoc($ur);
	$data = stripslashes($u['user_email']);
	return $data;	
}
function getUserauth($user){
	global $db_auth_evolve;
	$uq = "SELECT user_authorization FROM users WHERE user_key='".mysql_real_escape_string($user)."'";
	$ur = mysql_query($uq, $db_auth_evolve);
	$u = mysql_fetch_assoc($ur);
	$data = stripslashes($u['user_authorization']);
	return $data;	
}
function adScripts(){
	$data = "
<script src=\"plugins/jquery.datePicker.js\" type=\"text/javascript\" language=\"javascript\"></script>
<script type=\"text/javascript\"> 
 
    $(document).ready(function(){
		var theNum = 1;
		$('.thedateselect').change(function(){
			var valuu = $('.thedateselect').val();
			if (valuu == \"temp\"){
				$('.type_date').fadeIn(\"slow\");						
				$('.dateselect-s').datePicker();
				$('.dateselect-e').datePicker();
			}
			else{
				$('.type_date').hide();
			}
		});
		$('.j_more').click(function(){
			theNum= theNum + 1;
			$('.j_input').append('<div class=\"spacer\"><div class=\"data\">Slide #'+theNum+' title<br /><span class=\"tiny\"><em>e.g. \"Coming soon\"</em></span></div><div class=\"field\"><input type=\"text\" name=\"j_name[]\" placeholder=\"\" class=\"medium\" /></div></div><div class=\"spacer\"><div class=\"data\">Slide #'+theNum+' image</div><div class=\"field\"><input type=\"file\" name=\"j_file[]\" placeholder=\"\" class=\"medium\" /></div></div>');
		});
		$('.theadselect').change(function() {
			var valuu = $('.theadselect').val();
			if (valuu == \"1\"){
				$('.hidden_type').hide();
				$('.type_j').hide();
				$('.type_image').hide();
				$('.type_flash').fadeIn(\"slow\");
			}
			else if (valuu == \"2\"){
				$('.hidden_type').hide();
				$('.type_j').hide();
				$('.type_flash').hide();
				$('.type_image').fadeIn(\"slow\");
			}
			else if (valuu == \"7\"){
				$('.hidden_type').hide();
				$('.type_image').hide();
				$('.type_flash').hide();
				$('.type_j').fadeIn(\"slow\");
			}
			else{
				$('.hidden_type').hide();
				$('.type_j').hide();
				$('.type_flash').hide();
				$('.type_image').hide();
			}
		});
    });  
</script>
<link href=\"stylee/datePicker.css\" rel=\"stylesheet\" />";
	return $data;
}
function searchAllItems($type,$keyword, $num,$sort,$pager,$group,$tags,$statt){
	global $db_auth_evolve;
	$searchstring = mysql_real_escape_string($keyword);
	$wordChunksLimited = explode(" ", $searchstring, 4);
	$numberofwords =  count($wordChunksLimited);
	$i = 0;
	if($type== "forum"){
		$itemq= "SELECT * FROM c_forums WHERE f_name LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR f_name LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
		$itemq .= "
		LEFT JOIN (
			SELECT COUNT(sl_id) AS story_count, c_forums_f_id FROM c_storylines
			GROUP BY c_forums_f_id
		) ff ON ff.c_forums_f_id = c_forums.f_id
		LEFT JOIN (
			SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id, c_forums_f_id FROM c_valid_scenes 
			LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
			GROUP BY c_forums_f_id
		) fff ON fff.c_forums_f_id = c_forums.f_id
		LEFT JOIN (
			SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id, c_forums_f_id FROM c_proposed_scenes 
			LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
			GROUP BY c_forums_f_id
		) ffff ON ffff.c_forums_f_id = c_forums.f_id";
	}
	else if($type== "storyline"){
		$itemq= "SELECT * FROM c_storylines 
				LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id FROM c_valid_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) fff ON fff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id FROM c_proposed_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) ffff ON ffff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
			WHERE sl_name LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
	}
	else if($type== "mystoryline"){
		$user = getUsername($_SESSION['ev_u_name']);
		$itemq= "SELECT * FROM c_storylines 
				LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id FROM c_valid_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) fff ON fff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id FROM c_proposed_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) ffff ON ffff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
			WHERE sl_name LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
		$itemq .= "
		AND c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'";
	}
	else if($type== "moderator"){
		$itemq= "SELECT * FROM c_users
		LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
				GROUP BY c_users_u_id
			) ff ON ff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) fff ON fff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) ffff ON ffff.c_users_u_id = c_users.u_id
		WHERE u_mod != 0
		AND (u_username LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR u_username LIKE '%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
		$itemq .= ")";
	}
	else if($type== "user"){
		$itemq= "SELECT * FROM c_users
			LEFT JOIN (
				SELECT COUNT(ra_id) AS rating_count, c_users_u_id FROM c_ratings
				GROUP BY c_users_u_id
			) cc ON cc.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS review_count, c_users_u_id FROM c_ratings
				WHERE ra_comment != ''
				GROUP BY c_users_u_id
			) ccc ON ccc.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
				GROUP BY c_users_u_id
			) ff ON ff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) fff ON fff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) ffff ON ffff.c_users_u_id = c_users.u_id
		WHERE (u_username LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR u_username LIKE '%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
		$itemq .= ")";
	}
	else if($type== "page"){
		$itemq= "SELECT * FROM data
			WHERE Title LIKE ";
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR Title LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
	}
	else if($type == "scene"){
		$sngl = "scene";
		$plur = "scenes";
		$itemq = "SELECT * FROM (
				SELECT vs_id AS scene_id, vs_ts AS scene_ts, vs_desc AS scene_desc, vs_scene AS scene_number, '0'  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'valid' AS scene_type FROM c_valid_scenes
				UNION 
				SELECT ps_id, ps_ts, ps_desc, ps_scene, ps_status, c_users_u_id, c_storylines_sl_id, 'proposed' AS scene_type FROM c_proposed_scenes
			) pdp
			LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
			LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
			LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS rating_count, c_proposed_scenes_ps_id FROM c_ratings
				GROUP BY c_proposed_scenes_ps_id
			) cc ON cc.c_proposed_scenes_ps_id = pdp.scene_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS review_count, c_proposed_scenes_ps_id FROM c_ratings
				WHERE ra_comment != ''
				GROUP BY c_proposed_scenes_ps_id
			) ccc ON ccc.c_proposed_scenes_ps_id = pdp.scene_id";
		if($statt != NULL || $stat !=""){
			if ($statt != "all"){
			$stattExists = TRUE;
			}
		}
		if ($cat != NULL && $cat !=""){
			if ($cat != "all"){
				$catExists = TRUE;
				$itemq .= " INNER JOIN (SELECT f_id AS forum_id FROM c_forums) fora ON fora.forum_id = c_storylines.c_forums_f_id";
			}
		}
		if ($catExists == TRUE){
			$itemq .= " WHERE c_storylines.c_forums_f_id = '".mysql_real_escape_string($cat)."'";
			if ($stattExists == TRUE){
				if($statt == 1){
					$itemq .= " AND scene_id IN (SELECT vs_id FROM c_valid_scenes)";
				}
				else if($statt == 2){
					$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes)";
				}
				else if($statt == 3){
					$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
				}
			}
		}
		else{			
			if ($stattExists == TRUE){
				if($statt == 1){
					$itemq .= " WHERE scene_id IN (SELECT vs_id FROM c_valid_scenes)
							AND scene_type = 'valid'";
				}
				else if($statt == 2){
					$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes)
							AND scene_type = 'proposed'";
				}
				else if($statt == 3){
					$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')
							AND scene_type = 'proposed'";
				}
			}
		}
		if ($catExists == TRUE || $stattExists == TRUE){
			$itemq .= " AND (sl_name LIKE ";
		}
		else{
			$itemq .= " WHERE (sl_name LIKE ";
		}
		while ($i <= ($numberofwords-1)){
			if ($i == 0){
				$itemq .= "'%".$wordChunksLimited[$i]."%'";
			}
			else {
				$itemq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
			}
			$i++;
		}
		$itemq .= ")";
	}
	if($pager == "" || $pager == NULL){
		if ($num && $num != NULL && $num !=""){
			$itemq .= " LIMIT ".$num."";
		}
	}
	else{
		if ($pager == 1){
			$itemq .= " LIMIT ".$num."";
		}
		else{
			$pagerx = $pager*20;
			$pagery = ($pager*20)-20;
			$itemq .= " LIMIT ".$pagery.", 20";		
		}
	}
	$itemr = mysql_query($itemq, $db_auth_evolve);
	if(mysql_num_rows($itemr) > 0){
		while($item = mysql_fetch_assoc($itemr)){
			$data[] = $item;
		}
	}
	return $data;
}
function getAllItems($type,$num,$sort,$pager,$group,$tags,$statt,$author){
	global $db_auth_evolve;
	if($type== "forum"){
		$itemq = "SELECT * FROM c_forums
			LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_forums_f_id FROM c_storylines
				GROUP BY c_forums_f_id
			) ff ON ff.c_forums_f_id = c_forums.f_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id, c_forums_f_id FROM c_valid_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
				GROUP BY c_forums_f_id
			) fff ON fff.c_forums_f_id = c_forums.f_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id, c_forums_f_id FROM c_proposed_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
				GROUP BY c_forums_f_id
			) ffff ON ffff.c_forums_f_id = c_forums.f_id";
		if($sort == "recent"){
			$itemq .= " ORDER BY f_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY f_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY f_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY f_id ASC";
		}
		else{
			$itemq .= " ORDER BY f_id DESC";
		}
	}
	else if($type== "language"){
		$itemq = "SELECT * FROM c_languages";
		if($sort == "recent"){
			$itemq .= " ORDER BY l_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY l_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY l_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY l_id ASC";
		}
		else{
			$itemq .= " ORDER BY l_id DESC";
		}
	}
	else if($type== "storyline"){
		$itemq = "SELECT * FROM c_storylines
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id FROM c_valid_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) fff ON fff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id FROM c_proposed_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) ffff ON ffff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id";
		if($sort == "recent"){
			$itemq .= " ORDER BY sl_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY sl_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY sl_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY sl_id ASC";
		}
		else{
			$itemq .= " ORDER BY sl_id DESC";
		}
	}
	else if($type== "mystoryline"){
		$user = getUsername($_SESSION['ev_u_name']);
		$itemq = "SELECT * FROM c_storylines
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id FROM c_valid_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) fff ON fff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id FROM c_proposed_scenes 
				LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
				GROUP BY c_storylines_sl_id
			) ffff ON ffff.c_storylines_sl_id = c_storylines.sl_id
			LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
			WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'";
		if($sort == "recent"){
			$itemq .= " ORDER BY sl_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY sl_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY sl_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY sl_id ASC";
		}
		else{
			$itemq .= " ORDER BY sl_id DESC";
		}
	}
	else if($type== "moderator"){
		$itemq = "SELECT * FROM c_users
			LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
				GROUP BY c_users_u_id
			) ff ON ff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) fff ON fff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) ffff ON ffff.c_users_u_id = c_users.u_id
		WHERE u_mod != 0";
		if($sort == "recent"){
			$itemq .= " ORDER BY u_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY u_username ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY u_username DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY u_id ASC";
		}
		else{
			$itemq .= " ORDER BY u_id DESC";
		}
	}
	else if($type== "user"){
		$itemq = "SELECT * FROM c_users
			LEFT JOIN (
				SELECT COUNT(ra_id) AS rating_count, c_users_u_id FROM c_ratings
				GROUP BY c_users_u_id
			) cc ON cc.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS review_count, c_users_u_id FROM c_ratings
				WHERE ra_comment != ''
				GROUP BY c_users_u_id
			) ccc ON ccc.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
				GROUP BY c_users_u_id
			) ff ON ff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) fff ON fff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) ffff ON ffff.c_users_u_id = c_users.u_id";
		if($sort == "recent"){
			$itemq .= " ORDER BY u_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY u_username ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY u_username DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY u_id ASC";
		}
		else{
			$itemq .= " ORDER BY u_id DESC";
		} 
	}
	else if($type== "page"){
		$itemq = "SELECT * FROM data";
		if($sort == "recent"){
			$itemq .= " ORDER BY Iddata DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY Title ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY Title DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY Iddata ASC";
		}
		else{
			$itemq .= " ORDER BY Iddata DESC";
		}
	}
	else if($type== "scene"){
		$itemq = "SELECT * FROM (
					SELECT vs_id AS scene_id, vs_ts AS scene_ts, vs_desc AS scene_desc, vs_scene AS scene_number, '0'  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'valid' AS scene_type FROM c_valid_scenes
					UNION 
					SELECT ps_id, ps_ts, ps_desc, ps_scene, ps_status, c_users_u_id, c_storylines_sl_id, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
				LEFT JOIN (
					SELECT COUNT(ra_id) AS rating_count, c_proposed_scenes_ps_id FROM c_ratings
					GROUP BY c_proposed_scenes_ps_id
				) cc ON cc.c_proposed_scenes_ps_id = pdp.scene_id
				LEFT JOIN (
					SELECT COUNT(ra_id) AS review_count, c_proposed_scenes_ps_id FROM c_ratings
					WHERE ra_comment != ''
					GROUP BY c_proposed_scenes_ps_id
				) ccc ON ccc.c_proposed_scenes_ps_id = pdp.scene_id";
		if($statt != NULL || $stat !=""){
			if ($statt != "all"){
			$stattExists = TRUE;
			}
		}	
		if($author != NULL || $author !=""){
			$authorExists = TRUE;
		}
		if ($group != NULL && $group !=""){
			if ($group != "all"){
				$groupExists = TRUE;
				$itemq .= " INNER JOIN (SELECT f_id AS forum_id FROM c_forums) fora ON fora.forum_id = c_storylines.c_forums_f_id";
			}
		}
			if ($groupExists == TRUE){
				$itemq .= " WHERE c_storylines.c_forums_f_id = '".mysql_real_escape_string($group)."'";
				if ($stattExists == TRUE){
					if($statt == 1){
						$itemq .= " AND scene_id IN (SELECT vs_id FROM c_valid_scenes)";
					}
					else if($statt == 2){
						$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes)";
					}
					else if($statt == 3){
						$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
				if($authorExists == TRUE){
					$itemq .= " AND u_id = '".mysql_real_escape_string($author)."'";
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 1){
						$itemq .= " WHERE scene_id IN (SELECT vs_id FROM c_valid_scenes)";
					}
					else if($statt == 2){
						$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes)";
					}
					else if($statt == 3){
						$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
					if($authorExists == TRUE){
						$itemq .= " AND u_id = '".mysql_real_escape_string($author)."'";
					}
				}
				else{
					if($authorExists == TRUE){
						$itemq .= " WHERE u_id = '".mysql_real_escape_string($author)."'";
					}
				}
			}
			
		if($sort == "recent"){
			$itemq .= " ORDER BY scene_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY sl_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY sl_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY scene_id ASC";
		}
		else{
			$itemq .= " ORDER BY scene_id DESC";
		}
	}
	else if($type== "myscenes"){
		$user = getUsername($_SESSION['ev_u_name']);
		$itemq = "SELECT * FROM (
					SELECT ps_id AS scene_id, ps_ts AS scene_ts, ps_desc AS scene_desc, ps_scene AS scene_number, ps_status  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
				LEFT JOIN (
					SELECT COUNT(ra_id) AS rating_count, c_proposed_scenes_ps_id FROM c_ratings
					GROUP BY c_proposed_scenes_ps_id
				) cc ON cc.c_proposed_scenes_ps_id = pdp.scene_id
				LEFT JOIN (
					SELECT COUNT(ra_id) AS review_count, c_proposed_scenes_ps_id FROM c_ratings
					WHERE ra_comment != ''
					GROUP BY c_proposed_scenes_ps_id
				) ccc ON ccc.c_proposed_scenes_ps_id = pdp.scene_id";
		if($statt != NULL || $stat !=""){
			if ($statt != "all"){
			$stattExists = TRUE;
			}
		}	
		if($author != NULL || $author !=""){
			$authorExists = TRUE;
		}
		if ($group != NULL && $group !=""){
			if ($group != "all"){
				$groupExists = TRUE;
				$itemq .= " INNER JOIN (SELECT sl_id AS storyline_id FROM c_storylines) fora ON fora.storyline_id = c_storylines.sl_id";
			}
		}
			if ($groupExists == TRUE){
				$itemq .= " WHERE c_storylines.sl_id = '".mysql_real_escape_string($group)."'";
				if ($stattExists == TRUE){
					if($statt == 2){
						$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '2')";
					}
					else if($statt == 3){
						$itemq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 2){
						$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '2')";
					}
					else if($statt == 3){
						$itemq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
		
		if($groupExists == TRUE || $stattExists == TRUE){
			$itemq .= "
		AND ";
		}
		else{
			$itemq .= "
		WHERE ";
		}
		$itemq .= " c_storylines.sl_id IN (
			SELECT sl_id FROM c_storylines
			WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
		)"; 
			
		if($sort == "recent"){
			$itemq .= " ORDER BY scene_id DESC";
		}
		else if($sort == "a-z"){
			$itemq .= " ORDER BY sl_name ASC";
		}
		else if($sort == "z-a"){
			$itemq .= " ORDER BY sl_name DESC";
		}
		else if($sort == "older"){
			$itemq .= " ORDER BY scene_id ASC";
		}
		else{
			$itemq .= " ORDER BY scene_id DESC";
		}
	}
	if($pager == "" || $pager == NULL){
		if ($num && $num != NULL && $num !=""){
			$itemq .= " LIMIT ".$num."";
		}
	}
	else{
		if ($pager == 1){
			$itemq .= " LIMIT ".$num."";
		}
		else{
			$pagerx = $pager*20;
			$pagery = ($pager*20)-20;
			$itemq .= " LIMIT ".$pagery.", 20";		
		}
	}
	$itemr = mysql_query($itemq, $db_auth_evolve);
	if(mysql_num_rows($itemr) > 0){
		while($item = mysql_fetch_assoc($itemr)){
			$data[] = $item;
		}
	}
	return $data;
}
function troubleShoot($subject, $message){
	if (($subject =="") || ($message == "")){
		$response = "Both the subject and message fields are required.";
		$status = FALSE;
	}
	else{	
		$subject = htmlspecialchars(strip_tags($subject));
		$message = htmlspecialchars(($message));
		$dets = getUsername($_SESSION['ev_u_name']);
		$name = $dets['u_username'];
		$email = getUseremail($_SESSION['ev_u_name']);
		$subject = clientName()." | ".$subject;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";
		mail(contactEmail(), $subject, $message, $headers);
		$response = "Thank you. We have received your enquiry and will contact you shortly";
		$status = TRUE;
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateLanguage($name, $desc, $cat){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a language abbreviation such as \"en\" for english.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$desc = htmlspecialchars($desc);
		$cat = htmlspecialchars(strip_tags($cat));
		
		$insq = "UPDATE c_languages 
				SET l_name = '".mysql_real_escape_string($name)."',
				l_desc = '".mysql_real_escape_string($desc)."'
				WHERE l_id = '".mysql_real_escape_string($cat)."'";
		$insr = mysql_query($insq, $db_auth_evolve);
		if ($insr){
			$response = "You have successsfully updated the language \"".stripslashes($name)."\".";
			$status = TRUE;
		}
		else{
			$response = genericError();
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateModerator($name, $fname, $lname, $language, $siteuser, $email, $permission, $upload, $cat){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a moderator username.";
		$status = FALSE;
	}
	else{
		$name = htmlspecialchars(strip_tags($name));
		//check if category name exists
		$chkq = "SELECT * FROM c_users
				WHERE u_id = '".mysql_real_escape_string($cat)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr) > 0){
			$updq = "UPDATE c_users SET u_username = '".mysql_real_escape_string($name)."',
				u_fname = '".mysql_real_escape_string($fname)."',
				u_lastname = '".mysql_real_escape_string($lname)."',
				u_email='".mysql_real_escape_string($email)."',
				c_usertypes_ut_id= '".mysql_real_escape_string($siteuser)."',
				c_languages_l_id='".mysql_real_escape_string($language)."',
				u_mod = '".mysql_real_escape_string($permission)."'
				WHERE u_id = '".mysql_real_escape_string($cat)."'";
			$updr = mysql_query($updq, $db_auth_evolve);
			if ($updr){
				if($upload["name"] != ""){
					$id = mysql_insert_id();
					$filename = uploadImage($upload);
					createThumbnail($filename);
					$insi = "UPDATE c_users SET u_avatar = '".$filename."',
						u_form = '".uploadFrom()."'
						WHERE u_id = '".mysql_real_escape_string($cat)."'";
					$insir = mysql_query($insi, $db_auth_evolve);
				}
				$response = "You have successsfully updated the moderator \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "Sorry, the profile you selected could not be found.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateStoryline($name, $message, $forum, $upload, $cat){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a storyline name.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$message = htmlspecialchars($message);
		$cat = htmlspecialchars(strip_tags($cat));
		
		$insq = "UPDATE c_storylines
				SET sl_name = '".mysql_real_escape_string($name)."',
				sl_desc = '".mysql_real_escape_string($message)."', 
				c_forums_f_id = '".mysql_real_escape_string($forum)."'
				WHERE sl_id = '".mysql_real_escape_string($cat)."'";
		$insr = mysql_query($insq, $db_auth_evolve);
		if ($insr){
			if($upload["name"] != ""){
				$filename = uploadImage($upload);
				createThumbnail($filename);
				$insi = "UPDATE c_storylines SET sl_img = '".$filename."',
					sl_form = '".uploadFrom()."'
					WHERE sl_id = '".mysql_real_escape_string($cat)."'";
				$insir = mysql_query($insi, $db_auth_evolve);
			}
			$response = "You have successsfully updated the storyline \"".stripslashes($name)."\".";
			$status = TRUE;
		}
		else{
			$response = genericError();
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateForum($name, $message, $parent, $upload, $cat){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a forum name.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$message = htmlspecialchars($message);
		$parent = htmlspecialchars(strip_tags($parent));
		$cat = htmlspecialchars(strip_tags($cat));
		
		$insq = "UPDATE c_forums 
				SET f_name = '".mysql_real_escape_string($name)."',
				f_desc = '".mysql_real_escape_string($message)."', 
				c_languages_l_id = '".mysql_real_escape_string($parent)."'
				WHERE f_id = '".mysql_real_escape_string($cat)."'";
		$insr = mysql_query($insq, $db_auth_evolve);
		if ($insr){
			if($upload["name"] != ""){
				$filename = uploadImage($upload);
				createThumbnail($filename);
				$insi = "UPDATE c_forums SET f_img = '".$filename."',
					f_form = '".uploadFrom()."'
					WHERE f_id = '".mysql_real_escape_string($cat)."'";
				$insir = mysql_query($insi, $db_auth_evolve);
			}
			$response = "You have successsfully updated the forum \"".stripslashes($name)."\".";
			$status = TRUE;
		}
		else{
			$response = genericError();
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function getAct($act){
	if ($act == "publish"){
		$act = "1";
	}
	else if ($act == "draft"){
		$act = "2";
	}
	else if ($act == "trash"){
		$act = "3";
	}
	else if ($act == "private"){
		$act = "4";
	}
	return $act;
}
function createPost($name, $upload, $cat, $tags, $message, $act){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a title for the post.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$message = htmlspecialchars(strip_tags($message));
		
		//check if post name exists
		$chkq = "SELECT * FROM posts
				WHERE po_title = '".mysql_real_escape_string($name)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);		
		
		if (mysql_num_rows($chkr)== 0){
			if ($upload['size'] != 0){
				$file_type = $upload['type']; //returns the mimetype
				$allowed = array("image/jpeg","image/jpg","image/png","image/gif");
				if(!in_array($file_type, $allowed)) {
				  $error = 'Only jpg, gif, and png files are allowed.';
				}
				else{
					$forUpload = TRUE;
					$filename = uploadImage($upload);
					createThumbnail($filename);
				}
			}
						
			$slug = slugCheck($name, "post");
			$act = getAct($act);
			$insq = "INSERT INTO posts (po_title,po_slug,po_body,status_s_id)
					VALUES ('".mysql_real_escape_string($name)."','".$slug."', '".mysql_real_escape_string($message)."','".mysql_real_escape_string($act)."')";
			$insr = mysql_query($insq, $db_auth_evolve);
			$post_id = mysql_insert_id();			
			
			if ($insr){
				// insert image
				if ($forUpload == TRUE){
					$fileInfo = pathinfo($upload['name']);
					$fileInfo =  basename($upload['name'],'.'.$fileInfo['extension']);
					$imgq = "INSERT INTO media (m_name, m_form, m_src, attr_a_id)
							VALUES ('".mysql_real_escape_string($fileInfo)."', '".uploadFrom()."', '".$filename."', '7')";
					$imgr = mysql_query($imgq, $db_auth_evolve);
					$media_id = mysql_insert_id();
					if (!$imgr){
						$error = "The image was not stored in the database. Please try again";
					}
					else{
						$mepoq = "INSERT INTO post_media (media_m_id, posts_po_id, attr_a_id)
								VALUES ('".$media_id."', '".$post_id."','1')";
						$mepor = mysql_query($mepoq, $db_auth_evolve);
					}
				}
				// insert categories
				if ($cat != "" || $cat != NULL){
					foreach ($cat as $key){
						if (is_numeric($key)){
						$catq = "INSERT INTO post_category (posts_po_id, categories_c_id)
								VALUES ('".$post_id."', '".$key."')";
						$catr = mysql_query($catq, $db_auth_evolve);
						}
					}
				}
				
				//insert tags
				if($tags != "" || $tags != NULL){
					$tags = strip_tags($tags);
					$tags = utf8_encode($tags);
					$tags = preg_replace("/[^a-zA-Z0-9 ,]+/", "", $tags);
					$tags = preg_replace('/\s\s+/', ' ', $tags);
					$tags = str_replace(', ', ',', $tags);
					$tags = strtolower($tags);
					$tags_original = explode(",", $tags);
					$tag_after = implode("', '", $tags_original);
					// get list of existing tags
					$tagq = "SELECT t_id, t_name FROM tags
							WHERE t_name IN ('".$tag_after."')";
					$tagr = mysql_query($tagq, $db_auth_evolve);
					if (mysql_num_rows($tagr) > 0){
						$tagsExist = TRUE;
						$tags = $tags_original;
						while($tag = mysql_fetch_assoc($tagr)){
							$tag0[] = $tag['t_id'];
							$tag1[] = $tag['t_name'];
						}
						$tags = array_diff($tags, $tag1);
					}
					else{
						$tagsExist = FALSE;
						$tags = $tags_original;
					}
					foreach ($tags as $tags_o){
						if ($tags_o != "" || $tags_o!= NULL){
						$slug = slugCheck($tags_o, "tags");
						$tagsinsq = "INSERT INTO tags (t_name, t_slug)
									VALUES ('".$tags_o."','".$slug."')";
						$tagsinsr = mysql_query($tagsinsq, $db_auth_evolve);
						$tag_id[] = mysql_insert_id();
						}
					}
					if ($tagsExist == TRUE){
						$theTags = array_merge($tag_id, $tag0);
					}
					else{
						$theTags = $tag_id;
					}
					foreach($theTags as $tagKey => $tagKeyValue){
						$tagiq = "INSERT INTO post_tag (posts_po_id, tags_t_id)
								VALUES ('".$post_id."', '".$tagKeyValue."')";
						$tagir = mysql_query($tagiq, $db_auth_evolve);
					}
				}
				
				$response = "You have successsfully created the post \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A post with that title already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}

function updatePosts($post, $name, $upload, $cat, $tags, $message, $act){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a title for the post.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$message = htmlspecialchars(strip_tags($message));
		
		//check if post name exists
		$chkq = "SELECT * FROM posts
				WHERE po_title = '".mysql_real_escape_string($name)."'
				AND po_id != '".mysql_real_escape_string($post)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);		
		
		if (mysql_num_rows($chkr) == 0){
			if ($upload['size'] != 0){
				$file_type = $upload['type']; //returns the mimetype
				$allowed = array("image/jpeg","image/jpg","image/png","image/gif");
				if(!in_array($file_type, $allowed)) {
				  $error = 'Only jpg, gif, and png files are allowed.';
				}
				else{
					$forUpload = TRUE;
					$filename = uploadImage($upload);
					createThumbnail($filename);
				}
			}
						
			$slug = slugCheck($name, "post", $post);
			$act = getAct($act);
			$insq = "UPDATE posts 
					SET po_title = '".mysql_real_escape_string($name)."',
					po_slug = '".$slug."',
					po_body = '".mysql_real_escape_string($message)."',
					status_s_id = '".mysql_real_escape_string($act)."'
					WHERE po_id = '".mysql_real_escape_string($post)."'";
			$insr = mysql_query($insq, $db_auth_evolve);
			
			if ($insr){
				// insert image
				if ($forUpload == TRUE){
					$fileInfo = pathinfo($upload['name']);
					$fileInfo =  basename($upload['name'],'.'.$fileInfo['extension']);
					$imgq = "INSERT INTO media (m_name, m_form, m_src, attr_a_id)
							VALUES ('".mysql_real_escape_string($fileInfo)."', '".uploadFrom()."', '".$filename."', '7')";
					$imgr = mysql_query($imgq, $db_auth_evolve);
					$media_id = mysql_insert_id();
					if (!$imgr){
						$error = "The image was not stored in the database. Please try again";
					}
					else{
						$delmeq = "DELETE FROM post_media
								WHERE posts_po_id = '".$post."'
								AND attr_a_id = '1'";
						$delmer = mysql_query($delmeq, $db_auth_evolve);
						
						$mepoq = "INSERT INTO post_media (media_m_id, posts_po_id, attr_a_id)
								VALUES ('".$media_id."', '".$post."', '1')";
						$mepor = mysql_query($mepoq, $db_auth_evolve);
					}
				}
				// insert categories
				if ($cat != "" || $cat != NULL){
					$delq = "DELETE FROM post_category
							WHERE posts_po_id ='".mysql_real_escape_string($post)."'";
					$delr = mysql_query($delq, $db_auth_evolve);
					foreach ($cat as $key){
						if (is_numeric($key)){
						$catq = "INSERT INTO post_category (posts_po_id, categories_c_id)
								VALUES ('".$post."', '".$key."')";
						$catr = mysql_query($catq, $db_auth_evolve);
						}
					}
				}
				
				//insert tags
				if($tags != "" || $tags != NULL){
					$tags = strip_tags($tags);
					$tags = utf8_encode($tags);
					$tags = preg_replace("/[^a-zA-Z0-9 ,]+/", "", $tags);
					$tags = preg_replace('/\s\s+/', ' ', $tags);
					$tags = str_replace(', ', ',', $tags);
					$tags = strtolower($tags);
					$tags_original = explode(",", $tags);
					$tag_after = implode("', '", $tags_original);
					// get list of existing tags
					$tagq = "SELECT t_id, t_name FROM tags
							WHERE t_name IN ('".$tag_after."')";
					$tagr = mysql_query($tagq, $db_auth_evolve);
					if (mysql_num_rows($tagr) > 0){
						$tagsExist = TRUE;
						$tags = $tags_original;
						while($tag = mysql_fetch_assoc($tagr)){
							$tag0[] = $tag['t_id']; // existing tag ids
							$tag1[] = $tag['t_name']; // existing tag names
						}
						$tags = array_diff($tags, $tag1); // New tags
					}
					else{
						$tagsExist = FALSE;
						$tags = $tags_original; // All new tags
					}
					foreach ($tags as $tags_o){
						if ($tags_o != "" || $tags_o!= NULL){
						$slug = slugCheck($tags_o, "tags");
						$tagsinsq = "INSERT INTO tags (t_name, t_slug)
									VALUES ('".$tags_o."', '".$slug."')";
						$tagsinsr = mysql_query($tagsinsq, $db_auth_evolve);
						$tag_id[] = mysql_insert_id(); // new tag ids
						}
					}
					if ($tagsExist == TRUE){
						if (is_array($tag_id)){
							$theTags = array_merge($tag_id, $tag0);
						}
						else{
							$theTags = $tag0;
						}
					}
					else{
						$theTags = $tag0;
					}
					$deltq = "DELETE FROM post_tag
							WHERE posts_po_id ='".mysql_real_escape_string($post)."'";
					$deltr = mysql_query($deltq, $db_auth_evolve);
					
					foreach($theTags as $tagKey => $tagKeyValue){
						$tagiq = "INSERT INTO post_tag (posts_po_id, tags_t_id)
								VALUES ('".$post."', '".$tagKeyValue."')";
						$tagir = mysql_query($tagiq, $db_auth_evolve);
					}
				}
				
				$response = "You have successsfully updated the post \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A post with that title already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function countIt($type, $cat, $tags, $statt, $author){
	global $db_auth_evolve;
		if($type == "forum"){
			$sngl = "forum";
			$plur = "forums";
			$coq = "SELECT COUNT(f_id) AS count FROM c_forums";
		}
		else if($type == "language"){
			$sngl = "language";
			$plur = "languages";
			$coq = "SELECT COUNT(l_id) AS count FROM c_languages";
		}
		else if($type == "storyline"){
			$sngl = "storyline";
			$plur = "storylines";
			$coq = "SELECT COUNT(sl_id) AS count FROM c_storylines";
		}
		else if($type == "mystoryline"){
			$user = getUsername($_SESSION['ev_u_name']);
			$sngl = "storyline";
			$plur = "storylines";
			$coq = "SELECT COUNT(sl_id) AS count FROM c_storylines
			WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'";
		}
		else if($type == "moderator"){
			$sngl = "moderator";
			$plur = "moderators";
			$coq = "SELECT COUNT(u_id) AS count FROM c_users
			WHERE u_mod != 0";
		}
		else if($type == "user"){
			$sngl = "user";
			$plur = "users";
			$coq = "SELECT COUNT(u_id) AS count FROM c_users";
		}
		else if($type == "page"){
			$sngl = "page";
			$plur = "pages";
			$coq = "SELECT COUNT(Iddata) AS count FROM data";
		}
		else if($type == "scene"){
			$sngl = "scene";
			$plur = "scenes";
			$coq = "SELECT COUNT(scene_id) AS count FROM (
					SELECT vs_id AS scene_id, vs_ts AS scene_ts, vs_desc AS scene_desc, vs_scene AS scene_number, '0'  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'valid' AS scene_type FROM c_valid_scenes
					UNION 
					SELECT ps_id, ps_ts, ps_desc, ps_scene, ps_status, c_users_u_id, c_storylines_sl_id, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id";
			if($statt != NULL || $stat !=""){
				if ($statt != "all"){
				$stattExists = TRUE;
				}
			}
			if($author != NULL || $author !=""){
				$authorExists = TRUE;
			}
			if ($cat != NULL && $cat !=""){
				if ($cat != "all"){
					$catExists = TRUE;
					$coq .= " INNER JOIN (SELECT f_id AS forum_id FROM c_forums) fora ON fora.forum_id = c_storylines.c_forums_f_id";
				}
			}
			if ($catExists == TRUE){
				$coq .= " WHERE c_storylines.c_forums_f_id = '".mysql_real_escape_string($cat)."'";
				if ($stattExists == TRUE){
					if($statt == 1){
						$coq .= " AND scene_id IN (SELECT vs_id FROM c_valid_scenes)";
					}
					else if($statt == 2){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes)";
					}
					else if($statt == 3){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
				if ($authorExists == TRUE){
					$coq .= " AND u_id = '".mysql_real_escape_string($author)."'";
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 1){
						$coq .= " WHERE scene_id IN (SELECT vs_id FROM c_valid_scenes)
								AND scene_type = 'valid'";
					}
					else if($statt == 2){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes)
								AND scene_type = 'proposed'";
					}
					else if($statt == 3){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')
								AND scene_type = 'proposed'";
					}
					if ($authorExists == TRUE){
						$coq .= " AND u_id = '".mysql_real_escape_string($author)."'";
					}
				}
				else{
					if ($authorExists == TRUE){
						$coq .= " WHERE u_id = '".mysql_real_escape_string($author)."'";
					}
				}
			}
		}
		else if($type == "myscenes"){
			$user = getUsername($_SESSION['ev_u_name']);
			$sngl = "scene";
			$plur = "scenes";
			$coq = "SELECT COUNT(scene_id) AS count FROM (
					SELECT ps_id AS scene_id, ps_ts AS scene_ts, ps_desc AS scene_desc, ps_scene AS scene_number, ps_status  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id";
			if($statt != NULL || $stat !=""){
				if ($statt != "all"){
				$stattExists = TRUE;
				}
			}
			if ($cat != NULL && $cat !=""){
				if ($cat != "all"){
					$catExists = TRUE;
					$coq .= " INNER JOIN (SELECT sl_id AS storyline_id FROM c_storylines) fora ON fora.storyline_id = c_storylines.sl_id";
				}
			}
			if ($catExists == TRUE){
				$coq .= " WHERE c_storylines.sl_id = '".mysql_real_escape_string($cat)."'";
				if ($stattExists == TRUE){
					if($statt == 2){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '0')";
					}
					else if($statt == 3){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 2){
						$coq .= " WHERE  scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '0')";
					}
					else if($statt == 3){
						$coq .= " WHERE  scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			if($catExists == TRUE || $stattExists == TRUE){
				$coq .= "
			AND ";
			}
			else{
				$coq .= "
			WHERE ";
			}
			$coq .= " pdp.scene_storyline IN (
				SELECT sl_id FROM c_storylines
				WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
			)"; 
		}
		$cor = mysql_query($coq, $db_auth_evolve);
		$co = mysql_fetch_assoc($cor);
		$datax = $co['count'];
		if($datax == "" || $datax == NULL){
			$datay = "0 ".$plur;
		}
		else if ($datax == 1){
			$datay = $datax." ".$sngl;
		}
		else{
			$datay = $datax." ".$plur;
		}
		$data[] = $datax;
		$data[] = $datay;
	return $data;
}
function searchit($type, $keyword){
	global $db_auth_evolve;
	$searchstring = mysql_real_escape_string($keyword);
	$wordChunksLimited = explode(" ", $searchstring, 4);
	$numberofwords =  count($wordChunksLimited);
	$ext = " for your search: \"".$keyword."\"";
	$i = 0;
		if($type == "forum"){
			$sngl = "forum found".$ext;
			$plur = "forums found".$ext;
			$coq= "SELECT COUNT(f_id) AS count FROM c_forums WHERE f_name LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR f_name LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= " ORDER BY f_name ASC";
		}
		else if($type == "storyline"){
			$sngl = "storyline found".$ext;
			$plur = "storylines found".$ext;
			$coq= "SELECT COUNT(sl_id) AS count FROM c_storylines WHERE sl_name LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= " ORDER BY sl_name ASC";
		}
		else if($type == "mystoryline"){
			$user = getUsername($_SESSION['ev_u_name']);
			$sngl = "storyline found".$ext;
			$plur = "storylines found".$ext;
			$coq= "SELECT COUNT(sl_id) AS count FROM c_storylines WHERE sl_name LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= "
			AND c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
			ORDER BY sl_name ASC";
		}
		else if($type == "moderator"){
			$sngl = "moderator found".$ext;
			$plur = "moderators found".$ext;
			$coq= "SELECT COUNT(u_id) AS count FROM c_users WHERE (u_username LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR u_username LIKE '%".$wordChunksLimited[$i]."%'  OR u_fname LIKE '%".$wordChunksLimited[$i]."%'  OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= ")
			AND u_mod != 0
			ORDER BY u_username ASC";
		}
		else if($type == "user"){
			$sngl = "user found".$ext;
			$plur = "users found".$ext;
			$coq= "SELECT COUNT(u_id) AS count FROM c_users WHERE (u_username LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%' OR u_fname LIKE '%".$wordChunksLimited[$i]."%' OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR u_username LIKE '%".$wordChunksLimited[$i]."%'  OR u_fname LIKE '%".$wordChunksLimited[$i]."%'  OR u_lastname LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= ")
			ORDER BY u_username ASC";
		}
		else if($type == "page"){
			$sngl = "page found".$ext;
			$plur = "pages found".$ext;
			$coq= "SELECT COUNT(Iddata) AS count FROM data WHERE (Title LIKE ";
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR Title LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= ")
			ORDER BY Title ASC";
		}
		else if($type == "scene"){
			$sngl = "scene found";
			$plur = "scenes found";
			$coq = "SELECT COUNT(scene_id) AS count FROM (
					SELECT vs_id AS scene_id, vs_ts AS scene_ts, vs_desc AS scene_desc, vs_scene AS scene_number, '0'  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'valid' AS scene_type FROM c_valid_scenes
					UNION 
					SELECT ps_id, ps_ts, ps_desc, ps_scene, ps_status, c_users_u_id, c_storylines_sl_id, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id";
			if($statt != NULL || $stat !=""){
				if ($statt != "all"){
				$stattExists = TRUE;
				}
			}
			if ($cat != NULL && $cat !=""){
				if ($cat != "all"){
					$catExists = TRUE;
					$coq .= " INNER JOIN (SELECT f_id AS forum_id FROM c_forums) fora ON fora.forum_id = c_storylines.c_forums_f_id";
				}
			}
			if ($catExists == TRUE){
				$coq .= " WHERE c_storylines.c_forums_f_id = '".mysql_real_escape_string($cat)."'";
				if ($stattExists == TRUE){
					if($statt == 1){
						$coq .= " AND scene_id IN (SELECT vs_id FROM c_valid_scenes)";
					}
					else if($statt == 2){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes)";
					}
					else if($statt == 3){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 1){
						$coq .= " WHERE scene_id IN (SELECT vs_id FROM c_valid_scenes)
								AND scene_type = 'valid'";
					}
					else if($statt == 2){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes)
								AND scene_type = 'proposed'";
					}
					else if($statt == 3){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')
								AND scene_type = 'proposed'";
					}
				}
			}
			if ($catExists == TRUE || $stattExists == TRUE){
				$coq .= " AND (sl_name LIKE ";
			}
			else{
				$coq .= " WHERE (sl_name LIKE ";
			}
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= ")";
		}
		else if($type == "myscenes"){
			$user = getUsername($_SESSION['ev_u_name']);
			$sngl = "scene found";
			$plur = "scenes found";
			$coq = "SELECT COUNT(scene_id) AS count FROM (
					SELECT ps_id AS scene_id, ps_ts AS scene_ts, ps_desc AS scene_desc, ps_scene AS scene_number, ps_status  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'proposed' AS scene_type FROM c_proposed_scenes
				) pdp
				LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
				LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
				LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id";
			if($statt != NULL || $stat !=""){
				if ($statt != "all"){
				$stattExists = TRUE;
				}
			}
			if ($cat != NULL && $cat !=""){
				if ($cat != "all"){
					$catExists = TRUE;
					$coq .= " INNER JOIN (SELECT sl_id AS storyline_id FROM c_storylines) fora ON fora.storyline_id = c_storylines.sl_id";
				}
			}
			if ($catExists == TRUE){
				$coq .= " WHERE c_storylines.sl_id = '".mysql_real_escape_string($cat)."'";
				if ($stattExists == TRUE){
					if($statt == 2){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '0')";
					}
					else if($statt == 3){
						$coq .= " AND scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			else{			
				if ($stattExists == TRUE){
					if($statt == 2){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '0')";
					}
					else if($statt == 3){
						$coq .= " WHERE scene_id IN (SELECT ps_id FROM c_proposed_scenes WHERE ps_status = '3')";
					}
				}
			}
			if ($catExists == TRUE || $stattExists == TRUE){
				$coq .= " AND (sl_name LIKE ";
			}
			else{
				$coq .= " WHERE (sl_name LIKE ";
			}
			while ($i <= ($numberofwords-1)){
				if ($i == 0){
					$coq .= "'%".$wordChunksLimited[$i]."%'";
				}
				else {
					$coq .= " OR sl_name LIKE '%".$wordChunksLimited[$i]."%'";
				}
				$i++;
			}
			$coq .= ")
			AND c_storylines_sl_id IN (
				SELECT sl_id FROM c_storylines
				WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
			)";
		}
		$cor = mysql_query($coq, $db_auth_evolve);
		$co = mysql_fetch_assoc($cor);
		$datax = $co['count'];
		if($datax == "" || $datax == NULL){
			$datay = "0 ".$plur;
		}
		else if ($datax == 1){
			$datay = $datax." ".$sngl;
		}
		else{
			$datay = $datax." ".$plur;
		}
		$data[] = $datax;
		$data[] = $datay;
	return $data;
}
function statusCount(){
	global $db_auth_evolve;
	$query = "SELECT (
				SELECT SUM(scene_count) FROM (
				SELECT COUNT(vs_id) AS scene_count FROM c_valid_scenes
				UNION
				SELECT COUNT(ps_id) AS scene_count FROM c_proposed_scenes) sscc
			) AS all_scenes,
			(SELECT COUNT(vs_id) FROM c_valid_scenes) AS valid_scenes,
			(SELECT COUNT(ps_id) FROM c_proposed_scenes) AS proposed_scenes,
			(SELECT COUNT(ps_id) FROM c_proposed_scenes WHERE ps_status = '3') AS banned_scenes";
	$result = mysql_query($query, $db_auth_evolve);
	$answer = mysql_fetch_assoc($result);
	$data = "<a href='?status=all'>All (".$answer['all_scenes'].")</a> | <a href='?status=1'>Valid (".$answer['valid_scenes'].")</a> | <a href='?status=2'>Proposed (".$answer['proposed_scenes'].")</a> | <a href='?status=3'>Banned(".$answer['banned_scenes'].")</a>";
	return $data;
}
function mystatusCount(){
	global $db_auth_evolve;
	$user = getUsername($_SESSION['ev_u_name']);
	$query = "SELECT (
				SELECT SUM(scene_count) FROM (
					SELECT COUNT(ps_id) AS scene_count FROM c_proposed_scenes
					WHERE c_storylines_sl_id IN (
						SELECT sl_id FROM c_storylines
						WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
					)
				) sscc
			) AS all_scenes,
			(SELECT COUNT(ps_id) FROM c_proposed_scenes
				WHERE ps_status = '0'
				AND c_storylines_sl_id IN (
					SELECT sl_id FROM c_storylines
					WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
				)
			) AS proposed_scenes,
			(SELECT COUNT(ps_id) FROM c_proposed_scenes
			WHERE ps_status = '3'
				AND c_storylines_sl_id IN (
					SELECT sl_id FROM c_storylines
					WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
				)
			) AS banned_scenes";
	$result = mysql_query($query, $db_auth_evolve);
	$answer = mysql_fetch_assoc($result);
	$data = "<a href='?status=all'>All (".$answer['all_scenes'].")</a> | <a href='?status=2'>Allowed (".$answer['proposed_scenes'].")</a> | <a href='?status=3'>Banned(".$answer['banned_scenes'].")</a>";
	return $data;
}
function commentCount(){
	global $db_auth_evolve;
	$query = "SELECT (SELECT COUNT(posts_po_id) FROM comments) AS all_comments,
			(SELECT COUNT(posts_po_id) FROM comments
			WHERE status_s_id = '5') AS approved,
			(SELECT COUNT(posts_po_id) FROM comments
			WHERE status_s_id = '6') AS disapproved,
			(SELECT COUNT(posts_po_id) FROM comments
			WHERE status_s_id = '3') AS trash,
			(SELECT COUNT(posts_po_id) FROM comments
			WHERE status_s_id = '7') AS pending";
	$result = mysql_query($query, $db_auth_evolve);
	$answer = mysql_fetch_assoc($result);
	$data = "<a href='?status=all'>All(".$answer['all_comments'].")</a> | <a href='?status=5'>Approved(".$answer['approved'].")</a> | <a href='?status=6'>Disapproved(".$answer['disapproved'].")</a> | <a href='?status=3'>Blocked(".$answer['trash'].")</a> | <a href='?status=7'>Pending(".$answer['pending'].")</a>";
	return $data;
}
function checkGet($type, $value, $subtype){
	global $db_auth_evolve;
	$value = htmlspecialchars(strip_tags($value));
	if($type == "forum"){
		if ($value == "" || $value == NULL){
			header ("Location: forums.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_forums
					LEFT JOIN (
						SELECT COUNT(sl_id) AS story_count, c_forums_f_id FROM c_storylines
						GROUP BY c_forums_f_id
					) ff ON ff.c_forums_f_id = c_forums.f_id
					LEFT JOIN (
						SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id, c_forums_f_id FROM c_valid_scenes 
						LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
						GROUP BY c_forums_f_id
					) fff ON fff.c_forums_f_id = c_forums.f_id
					LEFT JOIN (
						SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id, c_forums_f_id FROM c_proposed_scenes 
						LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
						GROUP BY c_forums_f_id
					) ffff ON ffff.c_forums_f_id = c_forums.f_id
					WHERE f_id = '".mysql_real_escape_string($value)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: forums.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "language"){
		if ($value == "" || $value == NULL){
			header ("Location: languages.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_languages
					WHERE l_id = '".mysql_real_escape_string($value)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: languages.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "storyline"){
		if ($value == "" || $value == NULL){
			header ("Location: storylines.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_storylines
					LEFT JOIN (
						SELECT COUNT(vs_id) AS validated_scenes, c_storylines_sl_id FROM c_valid_scenes 
						LEFT JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id 
						GROUP BY c_storylines_sl_id
					) fff ON fff.c_storylines_sl_id = c_storylines.sl_id
					LEFT JOIN (
						SELECT COUNT(ps_id) AS proposed_scenes, c_storylines_sl_id FROM c_proposed_scenes 
						LEFT JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id 
						GROUP BY c_storylines_sl_id
					) ffff ON ffff.c_storylines_sl_id = c_storylines.sl_id
					WHERE sl_id = '".mysql_real_escape_string($value)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: storylines.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "settings"){
		$user = getUsername($_SESSION['ev_u_name']);
		if ($value == "" || $value == NULL){
			header ("Location: home.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_users
					LEFT JOIN c_users_socials ON c_users_socials.c_users_u_id = c_users.u_id
					WHERE u_id = '".mysql_real_escape_string($user['u_id'])."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: home.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "moderator"){
		if ($value == "" || $value == NULL){
			header ("Location: moderators.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_users
					LEFT JOIN c_users_socials ON c_users_socials.c_users_u_id = c_users.u_id
					WHERE u_id = '".mysql_real_escape_string($value)."'
					AND u_mod != 0";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: moderators.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "user"){
		if ($value == "" || $value == NULL){
			header ("Location: users.php");
			exit;
		}
		else{
			$chkq = "SELECT * 
					FROM c_users
					LEFT JOIN c_users_socials ON c_users_socials.c_users_u_id = c_users.u_id
					LEFT JOIN (
						SELECT COUNT(ra_id) AS rating_count, c_users_u_id FROM c_ratings
						GROUP BY c_users_u_id
					) cc ON cc.c_users_u_id = c_users.u_id
					LEFT JOIN (
						SELECT COUNT(ra_id) AS review_count, c_users_u_id FROM c_ratings
						WHERE ra_comment != ''
						GROUP BY c_users_u_id
					) ccc ON ccc.c_users_u_id = c_users.u_id
					LEFT JOIN (
						SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
						GROUP BY c_users_u_id
					) ff ON ff.c_users_u_id = c_users.u_id
					LEFT JOIN (
						SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
						LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
						GROUP BY c_users_u_id
					) fff ON fff.c_users_u_id = c_users.u_id
					LEFT JOIN (
						SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
						LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
						GROUP BY c_users_u_id
					) ffff ON ffff.c_users_u_id = c_users.u_id
					WHERE u_id = '".mysql_real_escape_string($value)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: users.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	else if($type == "scene"){
		if ($value == "" || $value == NULL){
			header ("Location: scenes.php");
			exit;
		}
		else{
			if($subtype == "proposed"){
				$chkq = "SELECT * FROM (
				SELECT ps_id AS scene_id, ps_ts AS scene_ts, ps_desc AS scene_desc, ps_scene AS scene_number, ps_status AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'proposed' AS scene_type FROM c_proposed_scenes
			) pdp";
			}
			else{
				$chkq = "SELECT * FROM (
				SELECT vs_id AS scene_id, vs_ts AS scene_ts, vs_desc AS scene_desc, vs_scene AS scene_number, '0'  AS scene_status, c_users_u_id AS scene_user_id, c_storylines_sl_id AS scene_storyline, 'valid' AS scene_type FROM c_valid_scenes
			) pdp";	
			}
			$chkq .= "
			LEFT JOIN c_storylines ON c_storylines.sl_id = pdp.scene_storyline
			LEFT JOIN c_users ON c_users.u_id = pdp.scene_user_id
			LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS rating_count, c_proposed_scenes_ps_id FROM c_ratings
				GROUP BY c_proposed_scenes_ps_id
			) cc ON cc.c_proposed_scenes_ps_id = pdp.scene_id
			LEFT JOIN (
				SELECT COUNT(ra_id) AS review_count, c_proposed_scenes_ps_id FROM c_ratings
				WHERE ra_comment != ''
				GROUP BY c_proposed_scenes_ps_id
			) ccc ON ccc.c_proposed_scenes_ps_id = pdp.scene_id
			WHERE scene_id = '".mysql_real_escape_string($value)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				header ("Location: scenes.php");
				exit;
			}
			else{
				$chk = mysql_fetch_assoc($chkr);
				$data = $chk;
			}
		}
	}
	return $data;
}
function validateIt($type, $value,$subtype){
	global $db_auth_evolve;
	if($type == "scene"){
		if ($value == "" || $value == NULL){
			header ("Location: scenes.php");
			exit;
		}
		else{
			if($subtype == "proposed"){
				$chkq = "SELECT * FROM c_proposed_scenes
					WHERE ps_id = '".mysql_real_escape_string($value)."'";
				$chkr = mysql_query($chkq, $db_auth_evolve);
				if(mysql_num_rows($chkr) == 0){
					header ("Location: scenes.php");
					exit;
				}
				else{
					$user = getUsername($_SESSION['ev_u_name']);
					$chk = mysql_fetch_assoc($chkr);
					if($user['u_mod'] != 1){
						if($chk['c_users_u_id'] != $user['u_id']){
							header("Location: my_scenes.php");
							exit;
						}
					}
					$chkqx = "SELECT * FROM c_valid_scenes
							WHERE vs_scene = '".$chk['ps_scene']."'
							AND c_storylines_sl_id = '".$chk['c_storylines_sl_id']."'";
					$chkrx = mysql_query($chkqx, $db_auth_evolve);
					$chkcount = mysql_num_rows($chkrx);
					$chkx = mysql_fetch_assoc($chkrx);
					
					$insq = "INSERT INTO c_valid_scenes (vs_desc, vs_scene, c_storylines_sl_id, c_users_u_id)
							VALUES ('".$chk['ps_desc']."', '".$chk['ps_scene']."', '".$chk['c_storylines_sl_id']."', '".$chk['c_users_u_id']."')";
					$insr = mysql_query($insq, $db_auth_evolve);
					$scene_id = mysql_insert_id();
					if($insr){
						if($chkcount > 0){
							$insqx = "INSERT INTO c_proposed_scenes (ps_id, ps_desc, ps_scene, c_storylines_sl_id, c_users_u_id)
									VALUES ('".$chkx['ps_id']."', '".$chkx['vs_desc']."', '".$chk['vs_scene']."', '".$chk['c_storylines_sl_id']."', '".$chk['c_users_u_id']."')";
							$insrx = mysql_query($insqx, $db_auth_evolve);
							$delqx = "DELETE FROM c_valid_scenes
								WHERE ps_id = '".$chkx['vs_id']."'";
							$delrx = mysql_query($delqx, $db_auth_evolve);
						}
						$delq = "DELETE FROM c_proposed_scenes
							WHERE ps_id = '".$chk['ps_id']."'";
						$delr = mysql_query($delq, $db_auth_evolve);
						header ("Location: view_scene.php?scene=".$scene_id."&type=valid&alert=success");
						exit;
					}
				}
			}
		}
	}
}
function redirectIt($type){
	if ($type == "forum"){
		header ("Location: forums.php");
		exit;
	}
	else if ($type == "language"){
		header ("Location: languages.php");
		exit;
	}
	else if ($type == "storyline"){
		header ("Location: storylines.php");
		exit;
	}
	else if ($type == "user"){
		header ("Location: users.php");
		exit;
	}
	else if ($type == "scene"){
		header ("Location: scenes.php");
		exit;
	}
}
function restorethis($type, $value){
	global $db_auth_evolve;
	if ($type == "scene"){
		$user = getUsername($_SESSION['ev_u_name']);
		$chkq = "SELECT * FROM c_proposed_scenes
		LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id
				WHERE ps_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected scene has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if($user['u_mod'] != 1){
				if($chk['c_users_u_id'] != $user['u_id']){
					header("Location: my_scenes.php");
					exit;
				}
			}
			if ($chk['ps_status'] == '0'){
				$data = "The scene by \"".stripslashes($chk['u_username'])."\" has already been restored.";
			}
			else{
				$delq = "UPDATE c_proposed_scenes SET ps_status = '0'
						WHERE ps_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "The scene by \"".stripslashes($chk['u_username'])."\" has been successfully restored.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	return $data;
}
function trashthis($type, $value){
	global $db_auth_evolve;
	if ($type == "post"){
		$chkq = "SELECT * FROM posts
				WHERE po_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected post has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if ($chk['status_s_id'] == '3'){
				$data = "The post \"".stripslashes($chk['po_title'])."\" is already in the trash.";
			}
			else{
				$delq = "UPDATE posts SET status_s_id = '3'
						WHERE po_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "The post \"".stripslashes($chk['po_title'])."\" has been moved to the trash.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	else if ($type == "comment"){
		$chkq = "SELECT * FROM comments
				WHERE co_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected comment has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if ($chk['status_s_id'] == '3'){
				$data = "All comments from \"".($chk['co_email'])."\" have already been blocked.";
			}
			else{
				$delq = "UPDATE comments SET status_s_id = '3'
						WHERE co_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "All comments from \"".($chk['co_email'])."\" have been blocked.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	else if ($type == "scene"){
		$user = getUsername($_SESSION['ev_u_name']);
		$chkq = "SELECT * FROM c_proposed_scenes
		LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id
				WHERE ps_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected scene has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if($user['u_mod'] != 1){
				if($chk['c_users_u_id'] != $user['u_id']){
					header("Location: my_scenes.php");
					exit;
				}
			}
			if ($chk['ps_status'] == '3'){
				$data = "The selected scene by \"".($chk['u_username'])."\" has already been banned.";
			}
			else{
				$delq = "UPDATE c_proposed_scenes SET ps_status = '3'
						WHERE ps_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
					$data = "The selected scene by \"".($chk['u_username'])."\" has been banned.";
				}
					else{
					$data = genericError();
				}
			}
		}
	}
	return $data;
}
function unblockthis($type, $value){
	global $db_auth_evolve;
	if ($type == "comment"){
		$chkq = "SELECT * FROM comments
				WHERE co_email = (SELECT co_email FROM comments WHERE co_id ='".mysql_real_escape_string($value)."')
				AND status_s_id = '3'
				LIMIT 1";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "No comments from the selected user are blocked.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if ($chk['status_s_id'] == '7'){
				$data = "All comments from \"".($chk['co_email'])."\" have already been unblocked.";
			}
			else{
				$delq = "UPDATE comments SET status_s_id = '7'
						WHERE status_s_id = '3'
						AND co_email = '".($chk['co_email'])."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "All comments from \"".($chk['co_email'])."\" have been successfully unblocked.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	return $data;
}
function approvethis($type, $value){
	global $db_auth_evolve;
	if ($type == "comment"){
		$chkq = "SELECT * FROM comments
				WHERE co_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected comment has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if ($chk['status_s_id'] == '5'){
				$data = "The comment \"".($chk['co_body'])."\" has already been approved.";
			}
			else{
				$delq = "UPDATE comments SET status_s_id = '5'
						WHERE co_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "The comment \"".($chk['co_body'])."\" has been successfully approved.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	return $data;
}
function disapprovethis($type, $value){
	global $db_auth_evolve;
	if ($type == "comment"){
		$chkq = "SELECT * FROM comments
				WHERE co_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected comment has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if ($chk['status_s_id'] == '6'){
				$data = "The comment \"".($chk['co_body'])."\" has already been disapproved.";
			}
			else{
				$delq = "UPDATE comments SET status_s_id = '6'
						WHERE co_id = '".mysql_real_escape_string($value)."'";
				$delr = mysql_query($delq, $db_auth_evolve);
				if ($delr){
				$data = "The comment \"".($chk['co_body'])."\" has been successfully disapproved.";
			}
				else{
				$data = genericError();
			}
			}
		}
	}
	return $data;
}
function trashIt($type, $value, $subtype){
	global $db_auth_evolve;
	if($type == "forum"){
		$chkq = "SELECT * FROM c_forums
				WHERE f_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected forum has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$delq = "DELETE FROM c_forums WHERE f_id = '".mysql_real_escape_string($value)."'";
			$delr = mysql_query($delq, $db_auth_evolve);
			if ($delr){
				$data = "The forum \"".stripslashes($chk['f_name'])."\" has been deleted.";
			}
			else{
				$data = genericError();
			}
		}
		$data .= "<br /><em><a href='forums.php'>Return to the forums page</a></em>";
	}
	else if($type == "language"){
		$chkq = "SELECT * FROM c_languages
				WHERE l_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected language has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$delq = "DELETE FROM c_languages WHERE l_id = '".mysql_real_escape_string($value)."'";
			$delr = mysql_query($delq, $db_auth_evolve);
			if ($delr){
				$data = "The language \"".stripslashes($chk['l_name'])."\" has been deleted.";
			}
			else{
				$data = genericError();
			}
		}
		$data .= "<br /><em><a href='forums.php'>Return to the language page</a></em>";
	}
	else if($type == "storyline"){
		$chkq = "SELECT * FROM c_storylines
				WHERE sl_id = '".mysql_real_escape_string($value)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected storyline has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$delq = "DELETE FROM c_storylines WHERE sl_id = '".mysql_real_escape_string($value)."'";
			$delr = mysql_query($delq, $db_auth_evolve);
			if ($delr){
				$data = "The storyline \"".stripslashes($chk['sl_name'])."\" has been deleted.";
			}
			else{
				$data = genericError();
			}
		}
		$data .= "<br /><em><a href='storylines.php'>Return to the storylines page</a></em>";
	}
	else if($type == "scene"){
		if($subtype == "proposed"){
			$chkq = "SELECT * FROM c_proposed_scenes
			LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id
				WHERE ps_id = '".mysql_real_escape_string($value)."'";	
		}
		else{
			$chkq = "SELECT * FROM c_valid_scenes
			LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id
				WHERE vs_id = '".mysql_real_escape_string($value)."'";
		}
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if (mysql_num_rows($chkr) == 0){
			$data = "The selected scene has either been deleted or does not exist.";
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			if($subtype == "proposed"){
				$delq = "DELETE FROM c_proposed_scenes WHERE ps_id = '".mysql_real_escape_string($value)."'";
			}
			else{
				$delq = "DELETE FROM c_valid_scenes WHERE vs_id = '".mysql_real_escape_string($value)."'";
			}
			$delr = mysql_query($delq, $db_auth_evolve);
			if ($delr){
				$data = "The scene written by \"".stripslashes($chk['u_username'])."\" has been deleted.";
			}
			else{
				$data = genericError();
			}
		}
		$data .= "<br /><em><a href='scenes.php'>Return to the scenes page</a></em>";
	}
	return $data;
}
function adminIt($type, $value){
	global $db_auth_evolve;
	$chkq = "SELECT * FROM c_users
			WHERE u_id = '".mysql_real_escape_string($value)."'";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	if (mysql_num_rows($chkr) == 0){
		$data = "The selected user has either been deleted or does not exist.";
	}
	if($type == "admin"){
		$chk = mysql_fetch_assoc($chkr);
		$updq = "UPDATE c_users SET u_mod = '1'
			WHERE u_id = '".mysql_real_escape_string($value)."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		if ($updr){
			$data = "The user \"".stripslashes($chk['u_username'])."\" has been granted administrator priviledges.";
		}
		else{
			$data = genericError();
		}
	}
	else if($type == "editor"){
		$chk = mysql_fetch_assoc($chkr);
		$updq = "UPDATE c_users SET u_mod = '2'
			WHERE u_id = '".mysql_real_escape_string($value)."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		if ($updr){
			$data = "The user \"".stripslashes($chk['u_username'])."\" has been granted editor priviledges.";
		}
		else{
			$data = genericError();
		}
	}
	else if($type == "moderator"){
		$chk = mysql_fetch_assoc($chkr);
		$updq = "UPDATE c_users SET u_mod = '3'
			WHERE u_id = '".mysql_real_escape_string($value)."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		if ($updr){
			$data = "The user \"".stripslashes($chk['u_username'])."\" has been granted moderator priviledges.";
		}
		else{
			$data = genericError();
		}
	}
	else if($type == "revoke"){
		$chk = mysql_fetch_assoc($chkr);
		$updq = "UPDATE c_users SET u_mod = '0'
			WHERE u_id = '".mysql_real_escape_string($value)."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		if ($updr){
			$data = "The user \"".stripslashes($chk['u_username'])."\" has had all extended priviledges revoked.<br />If this was done in error, you can add extended priviledges back to this user at any time.";
		}
		else{
			$data = genericError();
		}
	}
	return $data;
}
function createThumbnail($filename){ 
    
    if(preg_match('/[.](jpg)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](JPG)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageDirectory() . $filename); 
    } 
	else if (preg_match('/[.](gif)$/', $filename)) {  
        $im = imagecreatefromgif(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](GIF)$/', $filename)) {  
        $im = imagecreatefromgif(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](png)$/', $filename)) {  
        $im = imagecreatefrompng(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](PNG)$/', $filename)) {  
        $im = imagecreatefrompng(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](jpeg)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageDirectory() . $filename);  
    } 
	else if (preg_match('/[.](JPEG)$/', $filename)) {  
        $im = imagecreatefromjpeg(imageDirectory() . $filename);  
    } 
      
    $ox = imagesx($im);  
    $oy = imagesy($im);  
    $nx = thumbnailSize();  
    $ny = floor($oy * (thumbnailSize() / $ox));  
    $nm = imagecreatetruecolor($nx, $ny);  
      
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);  
    if(!file_exists(thumbnailDirectory())){
		if(!mkdir(thumbnailDirectory(), 0777, true)){}
    }
    imagejpeg($nm, thumbnailDirectory() . $filename);	
}
function uploadImage($upload){
	// upload the image
	if(!file_exists(imageDirectory())) {  
	  if(!mkdir(thumbnailDirectory(), 0777, true)){}  
	}
	
	$imgFile = preg_replace('#[^a-z.0-9]#i', '', $upload['name']);
	$kaboom = explode(".", $imgFile);
	$fileExt = end($kaboom);
	
	$filename = md5(date('Ymd').time().'-'.$file).".".$fileExt;
	
	$source = $upload['tmp_name'];
	$target = imageDirectory().$filename;
	
	$exists = file_exists($target);
	if(!$exists){
		move_uploaded_file($source, $target);
	}
	else{
		// Return here
	}
	return $filename;
}
function getRaw($type, $value){
	global $db_auth_evolve;
	if ($type == "tags"){
		$query = "SELECT t_name AS value FROM tags
				LEFT JOIN post_tag ON tags_t_id = t_id
				WHERE posts_po_id = '".mysql_real_escape_string($value)."'";
	}
	else if ($type == "cat"){
		$query = "SELECT categories_c_id AS value FROM post_category
				WHERE posts_po_id = '".mysql_real_escape_string($value)."'";
	}
	$result = mysql_query($query, $db_auth_evolve);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer['value']; 
	}
	
	return $data;
}
function getStatii(){
	global $db_auth_evolve;
	$query = "SELECT s_name, s_id FROM status";
	$result = mysql_query($query, $db_auth_evolve);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer;
	}
	return $data;
}
function findImage($type, $value){
	global $db_auth_evolve;
	if ($type == "forum"){
		$query = "SELECT f_form, f_img FROM c_forums
				WHERE f_id = '".mysql_real_escape_string($value)."'";
		$result = mysql_query($query, $db_auth_evolve);
		if (mysql_num_rows($result)==0){
			$data = 0;
		}
		else{
			$answer = mysql_fetch_assoc($result);
			if($answer['f_form'] == "" || $answer['f_form'] == NULL){
				$data = "../pictures/".stripslashes($answer['f_img']);
			}
			else{
				$data = "../".stripslashes($answer['f_form'])."/".stripslashes($answer['f_img']);
			}
		}
	}
	else if ($type == "storyline"){
		$query = "SELECT sl_form, sl_img FROM c_storylines
				WHERE sl_id = '".mysql_real_escape_string($value)."'";
		$result = mysql_query($query, $db_auth_evolve);
		if (mysql_num_rows($result)==0){
			$data = 0;
		}
		else{
			$answer = mysql_fetch_assoc($result);
			if($answer['sl_form'] == "" || $answer['sl_form'] == NULL){
				$data = "../pictures/".stripslashes($answer['sl_img']);
			}
			else{
				$data = "../".stripslashes($answer['sl_form'])."/".stripslashes($answer['sl_img']);
			}
		}
	}
	else if ($type == "moderator"){
		$query = "SELECT u_form, u_avatar FROM c_users
				WHERE u_id = '".mysql_real_escape_string($value)."'";
		$result = mysql_query($query, $db_auth_evolve);
		if (mysql_num_rows($result)==0){
			$data = 0;
		}
		else{
			$answer = mysql_fetch_assoc($result);
			if($answer['u_form'] == "" || $answer['u_form'] == NULL){
				$data = "../avatars/".stripslashes($answer['u_avatar']);
			}
			else{
				$data = "../".stripslashes($answer['u_form'])."/".stripslashes($answer['u_avatar']);
			}
		}
	}
	return $data;
}
function listItems($type, $value){
	global $db_auth_evolve;
	$data;
	if($type == "cat"){
		$liq = "SELECT c_name AS name, c_id AS id FROM categories
				LEFT JOIN post_category ON categories_c_id = c_id
				WHERE posts_po_id = '".mysql_real_escape_string($value)."'";
	}
	else if($type == "tags"){
		$liq = "SELECT t_name AS name, t_id AS id FROM tags
				LEFT JOIN post_tag ON tags_t_id = t_id
				WHERE posts_po_id = '".mysql_real_escape_string($value)."'";
	}
	$lir = mysql_query($liq, $db_auth_evolve);
	if (mysql_num_rows($lir) == 0){
		$data .= "...";
	}
	else{
		$i =1;
		while($li = mysql_fetch_assoc($lir)){
			if ($i != 1){
				$data .= ", ";
			}
			$data .= "<a href='?";
			
			if($type == "cat"){
				$data .= "cat=";
			}
			else if($type == "tags"){
				$data .= "tag=";
			}
			
			$data .= $li['id']."'>".stripslashes($li['name'])."</a>";
			$i++;
		}
	}
	return $data;
}
function resetPassword($email){
	global $db_auth_evolve;
	if($email != "" && $email != NULL){
		$query = "SELECT user_id, user_email, uf_key FROM users
				LEFT JOIN users_forgot ON users_forgot.users_user_id = users.user_id
				WHERE user_email = '".mysql_real_escape_string($email)."'";
		$result = mysql_query($query, $db_auth_evolve) or die(genericDbError()." - 102");
		if(mysql_num_rows($result) == 0){
			$data = "The email address you entered does not exist in our database";
		}
		else{
			$answer = mysql_fetch_assoc($result);
			$verCode = sha1(mt_rand(10000,90000).mt_rand(11,121));
			
			if($answer['uf_key'] != "" && $answer['uf_key'] != NULL){
				$updq = "UPDATE users_forgot
						SET uf_key= '".$verCode."'
						WHERE users_user_id = '".$answer['user_id']."'";
				$updrr = mysql_query($updq, $db_auth_evolve);
			}
			else{
				$insq = "INSERT INTO users_forgot
						(users_user_id, uf_key) VALUES 
						('".$answer['user_id']."', '".$verCode."')";
				$insr = mysql_query($insq, $db_auth_evolve);
			}
			
			$subject = "Password reset on your eVOLVE account";
			$message = "You have requested us to reset your eVOLVE password. 
								
	To do so, please click the following link:
	".clientSite()."/evolve/reset-password.php?i=".$verCode."&j=".md5(mt_rand(10000,90000).mt_rand(11,121))."&k=".$chk['u_id']."
	
	Thank you.
	
	
	***NOTE*** This is a post-only mailing.  Replies to this message are not monitored or answered.";	
			$headers = "From:".clientEmail()."\r\n" .
			"Reply-To: ".clientEmail()."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			mail($email, $subject, $message, $headers);
			$completed = TRUE;
			$data = "A reset link has been created for you.<br />Please check your e-mail (".$email.") for the link and complete the process.";
		}
	}
	else{
		$data = "Please enter your email address in the field provided.";
	}
	return $data;
}
function verifyResetCode($code, $id){
	global $db_auth_evolve;
	$chkq = "SELECT users_user_id, thecount FROM users_forgot
	LEFT JOIN (SELECT COUNT(uf_key) AS thecount, users_user_id AS cud FROM users_forgot
		WHERE uf_key = '".mysql_real_escape_string($code)."'
		AND users_user_id = '".mysql_real_escape_string($id)."'
		AND uf_ts BETWEEN (NOW() - INTERVAL 6 HOUR) AND NOW()) cff ON cff.cud = users_forgot.users_user_id
			WHERE uf_key = '".mysql_real_escape_string($code)."'
			AND users_user_id = '".mysql_real_escape_string($id)."'";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	if (mysql_num_rows($chkr) == 0){
		$data = "0";
	}
	else{
		$chk = mysql_fetch_assoc($chkr);
		if ($chk['thecount'] == 0 || $chk['thecount']== NULL){
			$query = "DELETE FROM users_forgot WHERE users_user_id = '".mysql_real_escape_string($chk['users_user_id'])."'";
			$result = mysql_query($query, $db_auth_evolve);
			$data = 5;
		}
		else{
			$data = 1;
		}
	}
	return $data;
}
function changePassword($pass, $id, $code){
	global $db_auth_evolve;
	$chkq = "SELECT users_user_id, thecount FROM users_forgot
	LEFT JOIN (SELECT COUNT(uf_key) AS thecount, users_user_id AS cud FROM users_forgot
		WHERE uf_key = '".mysql_real_escape_string($code)."'
		AND users_user_id = '".mysql_real_escape_string($id)."'
		AND uf_ts BETWEEN (NOW() - INTERVAL 6 HOUR) AND NOW()) cff ON cff.cud = users_forgot.users_user_id
			WHERE uf_key = '".mysql_real_escape_string($code)."'
			AND users_user_id = '".mysql_real_escape_string($id)."'";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	if (mysql_num_rows($chkr) == 0){
		$data = "0";
	}
	else{
		$chk = mysql_fetch_assoc($chkr);
		if ($chk['thecount'] == 0 || $chk['thecount']== NULL){
			$query = "DELETE FROM users_forgot WHERE users_user_id = '".mysql_real_escape_string($chk['users_user_id'])."'";
			$result = mysql_query($query, $db_auth_evolve);
			$data = 5;
		}
		else{
			$query = "UPDATE users SET user_password='".sha1($pass.saltIt())."'
				WHERE user_id = '".mysql_real_escape_string($id)."'";
			$result = mysql_query($query, $db_auth_evolve);
			if(!$result){
				$data = 2;
			}
			else{
				$query = "DELETE FROM users_forgot WHERE users_user_id = '".mysql_real_escape_string($id)."'";
				$result = mysql_query($query, $db_auth_evolve);
				$data = 1;
			}
		}
	}
	return $data;
}
function createUser($fname, $lname, $uname, $email, $position, $auth, $pass, $cpass){
	global $db_auth_evolve;
	if ($fname ==""){
		$response = "Please enter the user's first name in the field provided.";
		$status = FALSE;
	}
	else if ($lname ==""){
		$response = "Please enter the user's last name in the field provided.";
		$status = FALSE;
	}
	else if ($email ==""){
		$response = "Please enter the user's email address in the field provided (required for password retrieval).";
		$status = FALSE;
	}
	else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ 
		$response = "Please enter a valid email address.";
		$status = FALSE;
	}
	else if ($position ==""){
		$response = "Please enter the user's position in the field provided.";
		$status = FALSE;
	}
	else if ($uname ==""){
		$response = "Please enter the user's username in the field provided.";
		$status = FALSE;
	}
	else if ($pass ==""){
		$response = "Please enter the user's password in the field provided.";
		$status = FALSE;
	}
	else if ($pass != $cpass){
		$response = "The passwords you entered do not match.";
		$status = FALSE;
	}
	else if ($auth ==""){
		$response = "Please select the user's authorization level from the dropdown list below.";
		$status = FALSE;
	}
	else{	
		$fname = sanitizeFormData($fname);
		$lname = sanitizeFormData($lname);
		$uname = sanitizeFormData($uname);
		$email= sanitizeFormData($email);
		$position = sanitizeFormData($position);
		$auth = sanitizeFormData($auth);
		$pass = sanitizeFormData($pass);
		$cpass = sanitizeFormData($cpass);
		$pass=sha1($pass.saltIt());
		$key = sha1($email.$uname.saltIt());
		
		//check if username exists
		$uname = slugify($uname);
		$chkq = "SELECT * FROM users
				WHERE user_name = '".mysql_real_escape_string($uname)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr)== 0){
			$insq = "INSERT INTO users (user_firstname, user_lastname, user_name, user_email, user_position, auth_a_id, user_password, user_key)
					VALUES ('".mysql_real_escape_string($fname)."', '".mysql_real_escape_string($lname)."','".mysql_real_escape_string($uname)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($position)."',".mysql_real_escape_string($auth).",'".mysql_real_escape_string($pass)."','".mysql_real_escape_string($key)."')";
			$insr = mysql_query($insq, $db_auth_evolve);
			if ($insr){
				$response = "You have successsfully created the user \"".stripslashes($lname)." ".stripslashes($fname)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A user with that name already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updatePassword($user,$opass, $npass, $cnpass){
	global $db_auth_evolve;
	if ($opass =="" && $npass!= "" && $cnpass != ""){
		$response = "Please enter your old password in the field provided";
		$status = FALSE;
	}
	else if ($npass!=$cnpass){
		$response = "The new passwords you typed do not match";
		$status = FALSE;
	}
	else{	
		$user = sanitizeFormData($user);
		$opass = sanitizeFormData($opass);
		$npass = sanitizeFormData($npass);
		$cnpass = sanitizeFormData($cnpass);
		$opass=sha1($opass.saltIt());
		$npass=sha1($npass.saltIt());
		
		//check if category name exists
		$chkq = "SELECT * FROM c_users WHERE u_mod_session='".mysql_real_escape_string($user)."' AND u_pass = '".$opass."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr) == 0){
			$response = "Sorry, the old password you entered is incorrect.";
			$status = FALSE;
		}
		else{
			$insq = "UPDATE c_users SET u_pass = '".$npass."'
					WHERE u_mod_session = '".$user."'";
			$insr = mysql_query($insq, $db_auth_evolve);
			if ($insr){
				$response = "You have successsfully updated your password.";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateUsers($fname, $lname, $uname, $email, $position, $auth, $user){
	global $db_auth_evolve;
	if ($fname ==""){
		$response = "Please enter the user's first name in the field provided.";
		$status = FALSE;
	}
	else if ($lname ==""){
		$response = "Please enter the user's last name in the field provided.";
		$status = FALSE;
	}
	else if ($email ==""){
		$response = "Please enter the user's email address in the field provided (required for password retrieval).";
		$status = FALSE;
	}
	else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ 
		$response = "Please enter a valid email address.";
		$status = FALSE;
	}
	else if ($position ==""){
		$response = "Please enter the user's position in the field provided.";
		$status = FALSE;
	}
	else if ($uname ==""){
		$response = "Please enter the user's username in the field provided.";
		$status = FALSE;
	}
	else if ($auth == ""){
		$response = "Please select the user's authorization level from the dropdown list below.";
		$status = FALSE;
	}
	else{
		$fname = sanitizeFormData($fname);
		$lname = sanitizeFormData($lname);
		$uname = sanitizeFormData($uname);
		$email= sanitizeFormData($email);
		$position = sanitizeFormData($position);
		$auth = sanitizeFormData($auth);
		$user = sanitizeFormData($user);
		$uname = slugify($uname);
		$uname = slugCheck($uname, "users", $user);
		$insq = "UPDATE c_users 
				SET u_username = '".mysql_real_escape_string($uname)."',
				u_fname = '".mysql_real_escape_string($fname)."', 
				u_lastname = '".mysql_real_escape_string($lname)."', 
				u_email ='".mysql_real_escape_string($email)."'
				WHERE u_id = '".mysql_real_escape_string($user)."'";
		$insr = mysql_query($insq, $db_auth_evolve);
		
		$updq = "UPDATE c_users_socials
				SET u_fb = '".mysql_real_escape_string($fb)."',
				u_ig = '".mysql_real_escape_string($ig)."', 
				u_li = '".mysql_real_escape_string($li)."', 
				u_tw ='".mysql_real_escape_string($tw)."'
				WHERE c_users_u_id = '".mysql_real_escape_string($user)."'";
		$updr = mysql_query($updq, $db_auth_evolve);
		
		if ($insr){
			$response = "You have successsfully updated your user profile.";
			$status = TRUE;
		}
		else{
			$response = genericError();
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updateSelf($fname, $lname, $uname, $email, $fb, $ig, $li, $tw){
	global $db_auth_evolve;
	if ($fname ==""){
		$response = "Please enter your first name in the field provided.";
		$status = FALSE;
	}
	else if ($lname ==""){
		$response = "Please enter the your last name in the field provided.";
		$status = FALSE;
	}
	else if ($email ==""){
		$response = "Please enter your email address in the field provided (required for password retrieval).";
		$status = FALSE;
	}
	else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){ 
		$response = "Please enter a valid email address.";
		$status = FALSE;
	}
	else if ($uname ==""){
		$response = "Please enter your username in the field provided.";
		$status = FALSE;
	}
	else{
		$fname = sanitizeFormData($fname);
		$lname = sanitizeFormData($lname);
		$uname = sanitizeFormData($uname);
		$email= sanitizeFormData($email);
		$user = getUsername($_SESSION['ev_u_name']);
		$uname = slugify($uname);
		$uname = slugCheck($uname, "users", $user['u_id']);
		$insq = "UPDATE c_users 
				SET u_username = '".mysql_real_escape_string($uname)."',
				u_fname = '".mysql_real_escape_string($fname)."',
				u_lastname = '".mysql_real_escape_string($lname)."',
				u_email ='".mysql_real_escape_string($email)."'
				WHERE u_id = '".mysql_real_escape_string($user['u_id'])."'";
		$insr = mysql_query($insq, $db_auth_evolve);
		if ($insr){
			$chkq = "SELECT * FROM c_users_socials
				WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) ==0){
				$updq = "INSERT INTO c_users_socials (us_fb, us_ig, us_tw, us_li, c_users_u_id)
						VALUES ('".mysql_real_escape_string($fb)."', '".mysql_real_escape_string($ig)."', '".mysql_real_escape_string($tw)."', '".mysql_real_escape_string($li)."', '".mysql_real_escape_string($user['u_id'])."')";
				$updr = mysql_query($updq, $db_auth_evolve);
			}
			else{
				$updq = "UPDATE c_users_socials
						SET us_fb = '".mysql_real_escape_string($fb)."',
						us_ig = '".mysql_real_escape_string($ig)."', 
						us_li = '".mysql_real_escape_string($li)."', 
						us_tw ='".mysql_real_escape_string($tw)."'
						WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'";
				$updr = mysql_query($updq, $db_auth_evolve);
			}
			$response = "You have successsfully updated your profile.";
			$status = TRUE;
		}
		else{
			$response = genericError();
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function createPermission($name, $desc, $pages){
	global $db_auth_evolve;
	if ($name == ""){
		$response = "Please enter a title for the authorization level.";
		$status = FALSE;
	}
	else{
		if (count($pages) != 0){
			$chkq = "SELECT * FROM auth
					WHERE a_name = '".mysql_real_escape_string($name)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				$query = "INSERT INTO auth (a_name, a_desc)
						VALUES ('".mysql_real_escape_string($name)."','".mysql_real_escape_string($desc)."')";
				$result = mysql_query($query, $db_auth_evolve);
				$auth= mysql_insert_id();
				if(!$result){
					$response = genericError();
					$status = FALSE;
				}
				else{
					foreach($pages as $pages_o){
						$pagesq = "INSERT INTO permissions (auth_a_id, pages_pa_id)
									VALUES ('".mysql_real_escape_string($auth)."', '".mysql_real_escape_string($pages_o)."')";
						$pagesr = mysql_query($pagesq, $db_auth_evolve);
					}
					if($pagesr){
						$response = "Permissions Created Successfully.";
						$status = TRUE;
					}
					else{
						$response = genericError();
						$status = FALSE;
					}
				}
			}
			else{
				$response = "An authorization level with that title already exists.";
				$status = FALSE;
			}
		}
		else{
			$response = "Please choose at least one page to grant permission.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function updatePermission($auth, $name, $desc, $pages){
	global $db_auth_evolve;
	if ($name == ""){
		$response = "Please enter a title for the authorization level.";
		$status = FALSE;
	}
	else{
		if (count($pages) != 0){
			$chkq = "SELECT * FROM auth
					WHERE a_name = '".mysql_real_escape_string($name)."'
					AND a_id != '".mysql_real_escape_string($auth)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			if(mysql_num_rows($chkr) == 0){
				$query = "UPDATE auth 
					SET a_name= '".mysql_real_escape_string($name)."', 
					a_desc = '".mysql_real_escape_string($desc)."'
					WHERE a_id = '".mysql_real_escape_string($auth)."'";
				$result = mysql_query($query, $db_auth_evolve);
				if(!$result){
					$response = genericError();
					$status = FALSE;
				}
				else{
					$query = "DELETE FROM permissions
								WHERE auth_a_id = '".mysql_real_escape_string($auth)."'";
					$result = mysql_query($query, $db_auth_evolve);
					if(!$result){
						$response = "The page permissions could not be updated. Please try again";
						$status = FALSE;
					}
					else{
						foreach($pages as $pages_o){
							$pagesq = "INSERT INTO permissions (auth_a_id, pages_pa_id)
										VALUES ('".mysql_real_escape_string($auth)."', '".mysql_real_escape_string($pages_o)."')";
							$pagesr = mysql_query($pagesq, $db_auth_evolve);
						}
						if($pagesr){
							$response = "Permissions Created Successfully.";
							$status = TRUE;
						}
						else{
							$response = genericError();
							$status = FALSE;
						}
					}
				}
			}
			else{
				$response = "An authorization level with that title already exists.";
				$status = FALSE;
			}
		}
		else{
			$response = "Please choose at least one page to grant permission.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function createLanguage($name, $desc){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a language name.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$desc = htmlspecialchars($desc);
		
		//check if category name exists
		$chkq = "SELECT * FROM c_languages
				WHERE l_name = '".mysql_real_escape_string($name)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr)== 0){
			$insq = "INSERT INTO c_languages (l_name, l_desc)
					VALUES ('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($desc)."')";
			$insr = mysql_query($insq, $db_auth_evolve);
			if ($insr){
				$response = "You have successsfully created the language \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A language with that abbreviation already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function createStoryline($name, $mssg, $forum,$upload, $owner){
	global $db_auth_evolve;
	$user = getUsername($_SESSION['ev_u_name']);
	
	if ($name ==""){
		$response = "Please enter a storyline name.";
		$status = FALSE;
	}
	else if ($mssg ==""){
		$response = "Sorry, you cannot enter blank storyline text.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$mssg = htmlspecialchars($mssg);
		
		//check if category name exists
		$chkq = "SELECT * FROM c_storylines
				WHERE sl_name = '".mysql_real_escape_string($name)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr)== 0){
			if($user['u_mod'] == 1){
				if(!$owner || $owner == NULL || $owner == "" || !is_numeric($owner)){
					$ownerid = mysql_real_escape_string($user['u_id']);
				}
				else{
					$ownerid = $owner;
				}
			}
			else{
				$ownerid = mysql_real_escape_string($user['u_id']);
			}
			$insq = "INSERT INTO c_storylines (sl_name, sl_desc, c_forums_f_id, c_users_u_id)
					VALUES ('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($mssg)."','".mysql_real_escape_string($forum)."','".$ownerid."')";
			$insr = mysql_query($insq, $db_auth_evolve);
			$forumID = mysql_insert_id($db_auth_evolve);
			if ($insr){
					$insqx = "INSERT INTO c_valid_scenes (vs_desc,vs_scene,c_storylines_sl_id,c_users_u_id)
							VALUES ('".mysql_real_escape_string($mssg)."', '1', '".$forumID."', '".$ownerid."')";
					$insrx = mysql_query($insqx, $db_auth_evolve);
				if($upload["name"] != ""){
					$id = mysql_insert_id();
					$filename = uploadImage($upload);
					createThumbnail($filename);
					$insi = "UPDATE c_storylines SET sl_img = '".$filename."',
						sl_form = '".uploadFrom()."'
						WHERE sl_id = '".$forumID."'";
					$insir = mysql_query($insi, $db_auth_evolve);
				}
				$response = "You have successsfully created the storyline \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A storyline with that name already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function createModerator($name, $fname, $lname, $language, $siteuser, $pass, $cpass, $email, $permission,$upload){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a moderator username.";
		$status = FALSE;
	}
	else{
		if($pass != $cpass){
			$response = "The passwords you entered do not match.";
			$status = FALSE;
		}
		else{
			$name = htmlspecialchars(strip_tags($name));
			//check if category name exists
			$chkq = "SELECT * FROM c_users
					WHERE u_username = '".mysql_real_escape_string($name)."'
					OR u_email = '".mysql_real_escape_string($email)."'";
			$chkr = mysql_query($chkq, $db_auth_evolve);
			
			if (mysql_num_rows($chkr)== 0){
				$pass=sha1($pass.saltIt());
				//echo $pass;
				//die();
				$insq = "INSERT INTO c_users (u_username, u_fname, u_lastname, u_pass, u_email, c_usertypes_ut_id, c_languages_l_id, u_mod)
						VALUES ('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($fname)."','".mysql_real_escape_string($lname)."', '".mysql_real_escape_string($pass)."', '".mysql_real_escape_string($email)."', '".mysql_real_escape_string($siteuser)."', '".mysql_real_escape_string($language)."', '".mysql_real_escape_string($permission)."')";
				$insr = mysql_query($insq, $db_auth_evolve);
				$forumID = mysql_insert_id($db_auth_evolve);
				if ($insr){
					if($upload["name"] != ""){
						$id = mysql_insert_id();
						$filename = uploadImage($upload);
						createThumbnail($filename);
						$insi = "UPDATE c_users SET u_avatar = '".$filename."',
							u_form = '".uploadFrom()."'
							WHERE u_id = '".$forumID."'";
						$insir = mysql_query($insi, $db_auth_evolve);
					}
					$response = "You have successsfully created the moderator \"".stripslashes($name)."\".";
					$status = TRUE;
				}
				else{
					$response = genericError();
					$status = FALSE;
				}
			}
			else{
				$response = "A site user with that username or email address already exists.";
				$status = FALSE;
			}
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function createForum($name, $mssg, $language, $upload){
	global $db_auth_evolve;
	if ($name ==""){
		$response = "Please enter a category name.";
		$status = FALSE;
	}
	else{	
		$name = htmlspecialchars(strip_tags($name));
		$message = htmlspecialchars($message);
		
		//check if category name exists
		$chkq = "SELECT * FROM c_forums
				WHERE f_name = '".mysql_real_escape_string($name)."'";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		
		if (mysql_num_rows($chkr)== 0){
			$insq = "INSERT INTO c_forums (f_name, f_desc, c_languages_l_id)
					VALUES ('".mysql_real_escape_string($name)."', '".mysql_real_escape_string($mssg)."','".mysql_real_escape_string($language)."')";
			$insr = mysql_query($insq, $db_auth_evolve);
			$forumID = mysql_insert_id($db_auth_evolve);
			if ($insr){
				if($upload["name"] != ""){
					$id = mysql_insert_id();
					$filename = uploadImage($upload);
					createThumbnail($filename);
					$insi = "UPDATE c_forums SET f_img = '".$filename."',
						f_form = '".uploadFrom()."'
						WHERE f_id = '".$forumID."'";
					$insir = mysql_query($insi, $db_auth_evolve);
				}
				$response = "You have successsfully created the forum \"".stripslashes($name)."\".";
				$status = TRUE;
			}
			else{
				$response = genericError();
				$status = FALSE;
			}
		}
		else{
			$response = "A forum with that name already exists.";
			$status = FALSE;
		}
	}
	$data[] = $response;
	$data[] = $status;
	return $data;
}
function languages(){
	global $db_auth_evolve;
	//check if category name exists
	$chkq = "SELECT * FROM c_languages";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	while($chk = mysql_fetch_assoc($chkr)){
		$data[] = $chk;
	}
	return $data;
}
function getForums(){
	global $db_auth_evolve;
	$chkq = "SELECT * FROM c_forums
		LEFT JOIN c_languages ON c_languages.l_id = c_forums.c_languages_l_id
		ORDER BY f_name ASC";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	while($chk = mysql_fetch_assoc($chkr)){
		$data[] = $chk;
	}
	return $data;
}
function getmyStorylines(){
	global $db_auth_evolve;
	$user = getUsername($_SESSION['ev_u_name']);
	$chkq = "SELECT * FROM c_storylines
		WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
		ORDER BY sl_name ASC";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	while($chk = mysql_fetch_assoc($chkr)){
		$data[] = $chk;
	}
	return $data;
}
function isScenePermitted($scene){
	global $db_auth_evolve;	
	$user = getUsername($_SESSION['ev_u_name']);
	if($user['u_mod'] != 1){
		$chkq = "SELECT * FROM c_proposed_scenes
			WHERE ps_id = '".mysql_real_escape_string($scene)."'
			AND c_storylines_sl_id IN (
				SELECT sl_id FROM c_storylines
				WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
			)";
		$chkr = mysql_query($chkq, $db_auth_evolve);
		if(mysql_num_rows($chkr) == 0){
			header("Location: my_scenes.php");
			exit;
		}
	}
}
function getModerators(){
	global $db_auth_evolve;
	$chkq = "SELECT * FROM c_users
			LEFT JOIN (
				SELECT COUNT(sl_id) AS story_count, c_users_u_id FROM c_storylines
				GROUP BY c_users_u_id
			) ff ON ff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(vs_id) AS validated_scenes, c_users_u_id FROM c_valid_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) fff ON fff.c_users_u_id = c_users.u_id
			LEFT JOIN (
				SELECT COUNT(ps_id) AS proposed_scenes, c_users_u_id FROM c_proposed_scenes 
				LEFT JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id 
				GROUP BY c_users_u_id
			) ffff ON ffff.c_users_u_id = c_users.u_id
		WHERE u_mod != 0
		ORDER BY u_username ASC";
	$chkr = mysql_query($chkq, $db_auth_evolve);
	while($chk = mysql_fetch_assoc($chkr)){
		$data[] = $chk;
	}
	return $data;
}
function paging($pages, $page, $per_page, $dlink, $tbname){
	$url = $dlink."/".$pages."?page";
	$query = "SELECT COUNT(*) as `num` FROM {$tbname}";
	$row = mysql_fetch_array(mysql_query($query));
	$total = $row['num'];
	$adjacents = "2"; 

	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;								
	
	$prev = $page - 1;							
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;
	if($page > 1){
	$pagination = "<a href='".$url."=$prev'>[prev]</a>";
	}
	if($lastpage > 1)
	{	
		$pagination .= "";
				$pagination .= "";
		if ($lastpage < 7 + ($adjacents * 2))
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "[$counter]";
				else
					$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "[<a class='current'>$counter]</a>";
					else
						$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
				$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href='".$url."=1'>[1]</a>";
				$pagination.= "<a href='".$url."=2'>[2]</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class='current'>[$counter]</a>";
					else
				 $pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
				$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
			}
			else
			{
				$pagination.= "<a href='".$url."=1'>[1]</a>";
				$pagination.= "<a href='".$url."=2'>[2]</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class='current'>[$counter]</a>";
					else
						$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
			}
		}
		
		if ($page < $counter - 1){ 
			$pagination.= "<a href='".$url."=$next'>[Next]</a>";
			$pagination.= "<a href='".$url."=$lastpage'>[Last]</a>";
		}else{
			$pagination.= "<a class='current'>[Next]</a>";
			$pagination.= "<a class='current'>[Last]</a>";
		}
		$pagination.= "\n";		
	}
	 return $pagination;
}
function sendMail($to, $content){
	$cu = explode('_',$_SESSION['idsession']);
	$from = $cu[0];
	$date = date("d D M Y h:iA");
	if(empty($to) || empty($from)){
		$_SESSION['f'] = true;
		header("location: messaging");
		exit;
	}
	$ql = mysql_query("SELECT * FROM messaging WHERE ((mfrom=\"$from\" && mto=\"$to\") || (mfrom=\"$to\" && mto=\"$from\"))");
	if(mysql_num_rows($q1)>0){
		$row = mysql_fetch_array($q1);
		$msid = $row['msid'];
		$query = mysql_query("UPDATE messaging SET mfrom=\"$from\", mto=\"$to\", date=\"$date\", status=0 WHERE id=\"$msid\"");
		$sql = mysql_query("INSERT INTO mreply(mfrom, mto, date, content)VALUES(\"$from\", \"$to\", \"$date\", \"$content\")");
	}else{
		$query = mysql_query("INSERT INTO messaging(mfrom, mto, date)VALUES(\"$from\", \"$to\", \"$date\")");
		$sql = mysql_query("INSERT INTO mreply(mfrom, mto, date, content)VALUES(\"$from\", \"$to\", \"$date\", \"$content\")");
	}
	if($query){
		$_SESSION['s'] = true;
		header("location: messaging");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: messaging");
		exit;
	}
}
?>