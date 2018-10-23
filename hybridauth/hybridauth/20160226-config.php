<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
		array(
			"base_url" => "http://nextscenes.com/hybridauth/hybridauth/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => true
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "1087208862494-stgn7ieqld1tqitt4p336llhi2k08d5s.apps.googleusercontent.com", "secret" => "R_B4yyd7TeN8be-SaGQz21Vl"),
					"scope" => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"   , // optional
          "access_type"     => "offline",   // optional
          "approval_prompt" => "force"     // optional
          //"hd"              => "nextscenes.com" // optional
					
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "1724101217812004", "secret" => "b28d86ce8cc9353e64bd1a2aebeb7df9"),
					"scope" => "email" , // optional
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "5A8WsJq4h5IoL7D1gwQDesBFj", "secret" => "iZcCcunnOZhGxw6QDhOR6jrnVrSggMGkA6gptEYQCEtCzWCdV3"),
					"includeEmail" => false
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => "")
				),
				"Foursquare" => array(
					"enabled" => true,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => false,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "",
);

require_once( "/hybridauth/hybridauth/Hybrid/Auth.php" );
 
    $hybridauth = new Hybrid_Auth( $config );
 
    $adapter = $hybridauth->authenticate( "Google" );
 
    $user_profile = $adapter->getUserProfile();
