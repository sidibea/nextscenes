<?php

/*
Last update: 5 Oct 15
*/

class Fb_ypbox
{
	var $fb_app_id;
	var $fb_app_secret;
	var $fb_scope;
	
	function Fb_ypbox($criteria=array()) {
		$this->fb_app_id = $criteria['fb_app_id'];
		$this->fb_app_secret = $criteria['fb_app_secret'];
		$this->fb_scope = $criteria['fb_scope'];
		
		//if no app id and secret given, try to get them globaly
		if($this->fb_app_id=='') $this->fb_app_id = $GLOBALS['fb_app_id'];
		if($this->fb_app_secret=='') $this->fb_app_secret = $GLOBALS['fb_app_secret'];
		if($this->fb_scope=='') $this->fb_scope = $GLOBALS['fb_scope'];
	}
	
	function fb_connect_flow($criteria=array()) {
		$redirect_url = $criteria['redirect_url'];
		
		//Autentication step 1
		if(empty($_REQUEST['code'])) {
			if($redirect_url=='') $redirect_url = $this->currentPageURL();
		 	$_SESSION['ygp_fb_box']['redirect_url'] = $redirect_url; //save redirect URL
		 	$_SESSION['ygp_fb_box']['salt'] = md5(uniqid(rand(), TRUE)); // CSRF protection
		 	
		 	$dialog_url = 'https://www.facebook.com/v2.4/dialog/oauth?client_id='.$this->fb_app_id.'&redirect_uri='.urlencode($redirect_url).'&state='.$_SESSION['ygp_fb_box']['salt'].'&scope='.$this->fb_scope;
		    if($_GET['error']=='access_denied') {
			    echo 'You have denied our app to access your information.<br>You can close this window if you don\'t want to use our app<br><a href="'.$dialog_url.'">Connect again?</a>';
			    exit();
		    }
		    else {
			    echo '<script>window.location="'.$dialog_url.'";</script>';
		    }
		}
		
		//Autentication step 2
		else {
			
			if($_SESSION['ygp_fb_box']['salt'] && ($_SESSION['ygp_fb_box']['salt'] === $_GET['state'])) {
				
		     	$redirect_url = $_SESSION['ygp_fb_box']['redirect_url'];
		     	
		     	if($redirect_url=='') {
			     	echo 'Redirect URL missing (session error)';
			     	exit();
		     	}
		     	
		     	unset($_SESSION['ygp_fb_box']['salt']);
		     	unset($_SESSION['ygp_fb_box']['redirect_url']);
		     	
		     	$token_url = 'https://graph.facebook.com/v2.4/oauth/access_token?client_id='.$this->fb_app_id.'&redirect_uri='.urlencode($redirect_url).'&client_secret='.$this->fb_app_secret.'&code='.$_GET['code'];
		     	$data = $this->getDataFromURL($token_url);
		     	$data = json_decode($data, true);
		     	
		     	if(is_array($data) && $data['error']['message']!='') {
			     	echo $data2['error']['message'].'<br>';
			     	echo '<a href="'.$redirect_url.'">Try again</a>';
			     	exit();
		     	}
		     	else {
			     	$user_data = $this->getUserDataFromApi(array('token'=>$data['access_token']));
			     	$_SESSION['ygp_fb_box']['user'] = $user_data;
					return 1;
		     	}
		    }
		    else {
		    	echo 'An error happened<br>';
		    	echo '<a href="'.$redirect_url.'">Try again</a>';
		    	exit();
		    }
		}
	}
	
	function getUserDataFromApi($criteria=array()) {
		$token = $criteria['token'];
		
		$fields = 'id,name,first_name,last_name,link,location,bio,relationship_status,birthday,gender,email,timezone,locale,updated_time,verified';
		
		$fb = array();
		
		if($token!='') {
			$url = 'https://graph.facebook.com/v2.4/me?fields='.$fields.'&access_token='.$token;
			$data = $this->getDataFromUrl($url);
			$data = json_decode($data, true);
			
			//No error
			if(count($data)>0) {
				if($data['id']!='') {
					$fb['id'] = $data['id'];
					$fb['name'] = $data['name'];
					$fb['first_name'] = $data['first_name'];
					$fb['last_name'] = $data['last_name'];
					$fb['link'] = $data['link'];
					if(!empty($data['location']['name'])) $fb['location'] = $data['location']['name'];
					if(!empty($data['bio'])) $fb['bio'] = $data['bio'];
					if(!empty($data['relationship_status'])) $fb['relationship_status'] = $data['relationship_status'];
					if(!empty($data['birthday'])) $fb['birthday'] = $data['birthday'];
					$fb['gender'] = $data['gender'];
					$fb['email'] = $data['email'];
					$fb['timezone'] = $data['timezone'];
					$fb['locale'] = $data['locale'];
					$fb['updated_time'] = $data['updated_time'];
					if(!empty($data['verified'])) $fb['verified'] = $data['verified'];
					$fb['picture'] = 'http://graph.facebook.com/'.$data['id'].'/picture';
					$fb['picture_large'] = 'http://graph.facebook.com/'.$data['id'].'/picture?type=large';
					$fb['token'] = $token;			
				}
			}
		}
		
		return $fb;
	}
	
	//load JS file + ajax URL path
	function load_js_functions($criteria=array()) {
		$timeline_js = $criteria['timeline_js'];
		$prettydate_js = $criteria['prettydate_js'];
		
		$userData = $this->getUserData();
		echo "\n\n".'<script type=\'text/javascript\'>/* <![CDATA[ */ var Fb_ypbox = {
		ajaxurl: "'.$GLOBALS['fb_ypbox_path'].'", scope: "'.$GLOBALS['fb_scope'].'", 
		connect_redirect: "'.$GLOBALS['fb_connect_redirect'].'",
		logout_redirect: "'.$GLOBALS['fb_logout_redirect'].'", token: "'.$this->getAccessToken().'",
		user_id: "'.$userData['id'].'", name: "'.$userData['name'].'"
		}; /* ]]> */ </script>'."\n\n";
		echo '<script type="text/javascript" src="'.$GLOBALS['fb_ypbox_path'].'/include/js/script.js"></script>'."\n\n";
		if($timeline_js) echo '<script type="text/javascript" src="'.$GLOBALS['fb_ypbox_path'].'/include/js/timeline.js"></script>'."\n\n";
		if($prettydate_js) echo '<script type="text/javascript" src="'.$GLOBALS['fb_ypbox_path'].'/include/js/jquery.prettydate.js"></script>'."\n\n";
	}
	
	//Load the Facebook JS SDK
	function loadJsSDK($criteria=array()) {
		
		$fb_sdk_js_callback = $criteria['fb_sdk_js_callback'];
		$fb_sdk_lang = $criteria['fb_sdk_lang'];
		
		if($fb_sdk_js_callback=='') $fb_sdk_js_callback = $GLOBALS['fb_sdk_js_callback'];
		if($fb_sdk_lang=='') $fb_sdk_lang = $GLOBALS['fb_sdk_lang'];
		if($fb_sdk_lang=='') $fb_sdk_lang = 'en_US'; 
		
		echo '<div id="fb-root"></div>';
		echo '<script>';
		
		echo 'window.fbAsyncInit = function() {';
		echo 'FB.init({appId: '.$this->fb_app_id.', version: \'v2.4\', status: true, cookie: true, xfbml: true, oauth: true});';
		echo 'onFbSdkCallbackFB_box();';
		echo $fb_sdk_js_callback;
		echo '};';
		
		?>
		(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/<?php echo $fb_sdk_lang; ?>/sdk.js";
			ref.parentNode.insertBefore(js, ref);
		}(document));
		<?php
		
		echo '</script>';
	}
	
	function getUserid() {
		return $_SESSION['ygp_fb_box']['user']['id'];
	}
	
	function getUserData() {
		return $_SESSION['ygp_fb_box']['user'];
	}
	
	function getAccessToken() {
		return $_SESSION['ygp_fb_box']['user']['token'];
	}
	
	function getLongLivedToken($criteria=array()) {
		$token = $criteria['token'];
		
		if($token=='') $token = $this->getAccessToken();
		
		if($token!='') {
			//get longer-lived token
			$url = 'https://graph.facebook.com/v2.4/oauth/access_token?client_id='.$this->fb_app_id.'&client_secret='.$this->fb_app_secret.'&grant_type=fb_exchange_token&fb_exchange_token='.$token;
			//echo '<a href="'.$url.'" target="_blank">'.$url.'</a><br>';
			$response = $this->getDataFromUrl($url);
			//print_r($url);
			$response = json_decode($response, true);
			$token = $response['access_token'];
			if($response['expires']!='') $expires = $response['expires'];
		}
		
		$data['token'] = $token;
		$data['expires'] = $expires;
		return $data;
	}
	
	//Facebook API basic call
	function get_fb_api_results($criteria=array()) {
		$object = $criteria['object'];
		$connection = $criteria['connection'];
		$token = $criteria['token'];
		$limit = $criteria['limit'];
		
		$pos = strrpos($connection, "?");
		if($pos>0) $tokenRel='&'; //if ? detected in $connection
		else $tokenRel='?'; //default
		
		if($object=='') $object = 'me';
		if($token=='') $token = $this->getAccessToken();
		
		$url = 'https://graph.facebook.com/v2.4/'.$object;
		if($connection!='') $url .= '/'.$connection;
		if($token!='') $url .= $tokenRel.'access_token='.$token;
		if($limit!='') $url .= '&limit='.$limit;
		
		//echo $url.'<br>';
		$content = $this->getDataFromUrl($url);
		//print_r($content);
		//echo '<br><br>';
		$content = json_decode($content,true);
		
		return $content;
	}
	
	function getGrantedPermissions() {
		$data = $this->get_fb_api_results(array('object'=>'me', 'connection'=>'permissions'));
		$data = $data['data'][0];
		return $data;
	}
	
	//Get Facebook pages
	function getFacebookPages($criteria=array()) {
		$token = $criteria['token'];
		
		if($token=='') $token = $this->getAccessToken();
		
		$accounts = $this->getFacebookAccounts(array('token'=>$token));
		
		$k=0;
		for($i=0; $i<count($accounts['data']); $i++) {
			if($accounts['data'][$i]['category']!='Application') {
				$pages[$k] = $accounts['data'][$i];
				$k++;
			}
		}
		return $pages;
	}
	
	//Get Facebook accounts (including pages and apps)
	function getFacebookAccounts($criteria=array()) {
		$token = $criteria['token'];
		
		if($token=='') $token = $this->getAccessToken();
		
		$accounts = $this->get_fb_api_results(array('connection'=>'accounts', 'token'=>$token));
		return $accounts;
	}
	
	//get taggable friends
	function getTaggableFriends($criteria=array()) {
		$token = $criteria['token'];
		
		if($token=='') $token = $this->getAccessToken();
		
		$friends = $this->get_fb_api_results(array('connection'=>'taggable_friends', 'token'=>$token));
		return $friends;
	}
	
	//Getting data fron a remote URL
	function getDataFromUrl($url) {
		$ch = curl_init();
		$timeout = 5;
		//echo $url.'<br><br>';
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //to make it support SSL calls on some servers
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	//Posting data to a remote URL using POST
	function postDataToURL($url, $postParms) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //to make it support SSL calls on some servers
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postParms);
		$results = curl_exec($ch);
		curl_close($ch);
		return $results;
	}
	
	function currentPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pos = strpos($pageURL, '?');
		if($pos!==FALSE) {
			$pageURL = substr($pageURL, 0, $pos);
		}
		return $pageURL;
	}
	
	//This function enable the posting of a status
	function updateFacebookStatus($criteria, $token='') {
		$fb_id = $criteria['fb_id'];
		$message = $criteria['message'];
		$link = $criteria['link'];
		$picture = $criteria['picture'];
		$name = $criteria['name'];
		$caption = $criteria['caption'];
		$description = $criteria['description'];
		$source = $criteria['source'];
		
		if($fb_id=='') $fb_id = 'me';
		if($token=='') $token = $this->getAccessToken();
		
		$criteriaString = '&message='.$message;
		if($link!='') $criteriaString .= '&link='.$link;
		if($picture!='') $criteriaString .= '&picture='.$picture;
		if($name!='') $criteriaString .= '&name='.$name;
		if($caption!='') $criteriaString .= '&caption='.$caption;
		if($description!='') $criteriaString .= '&description='.$description;
		if($source!='') $criteriaString .= '&source='.$source;
		
		$postParms = "access_token=".$token.$criteriaString;
		
		$url = 'https://graph.facebook.com/v2.4/'.$fb_id.'/feed';
		
		$results = $this->postDataToURL($url, $postParms);
		
		return $results;
	}
}

?>