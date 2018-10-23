<?php
class Social_Network_Tumblr extends Social_Protocol_Model_OAuth {

    function init() {
        parent::init();
        $this->api->api_base_url      = "http://api.tumblr.com/v2/";
        $this->api->authorize_url     = "http://www.tumblr.com/oauth/authorize";
        $this->api->request_token_url = "http://www.tumblr.com/oauth/request_token";
        $this->api->access_token_url  = "http://www.tumblr.com/oauth/access_token";

        $this->api->curl_auth_header  = false;
    }

    function finishLogin() {
        parent::finishLogin();
        $tumblrUser = $this->getUserProfile();
        $tumblrUserDb = Social_Auth::dao()->getUserByIdentifierAndNetwork($tumblrUser->identifier, $this->network_name);
        if (!$tumblrUserDb) {
            $social_auth_base_url = Social_Auth::$config["base_url"];
            $email_verify_url = $social_auth_base_url . 'callback-email.php' .( strpos( $social_auth_base_url, '?' ) ? '&' : '?' ) . "sa_login_email_verify={$this->network_name}&sa_callback=" . Social_Auth::session()->get( "sa_session.{$this->network_name}.sa_callback" );
            Social_Auth::redirect($email_verify_url);
        }
    }

    function getUserProfile() {
        try {
            $profile = $this->api->get( 'user/info' );

            foreach ( $profile->response->user->blogs as $blog ){
                if( $blog->primary ){
                    $bloghostname = explode( '://', $blog->url );
                    $bloghostname = substr( $bloghostname[1], 0, -1);

                    $this->setToken( "primary_blog" , $bloghostname );

                    $this->user->profile->identifier 	= $blog->url;
                    $this->user->profile->displayName	= $profile->response->user->name;
                    $this->user->profile->profileURL	= $blog->url;
                    $this->user->profile->webSiteURL	= $blog->url;
                    $this->user->profile->description	= strip_tags( $blog->description );

                    $avatar = $this->api->get( 'blog/'. $this->getToken( "primary_blog" ) .'/avatar' );

                    $this->user->profile->photoURL 		= $avatar->response->avatar_url;

                    break;
                }
            }
        } catch( Exception $e ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an error while requesting the user profile." );
        }

        return $this->user->profile;
    }

    function setUserStatus( $status ) {
        $parameters = array( 'type' => "text", 'body' => $status );
        $response  = $this->api->post( "blog/" . $this->getToken( "primary_blog" ) . '/post', $parameters );

        if ( $response->meta->status != 201 ){
            throw new Social_Exception( "Update user status failed! {$this->network_name} returned an error. " . $this->errorMessageByStatus( $response->meta->status ) );
        }

        return $response;
    }
}