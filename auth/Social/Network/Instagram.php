<?php
class Social_Network_Instagram extends Social_Protocol_Model_OAuth2 {

    public $scope = "basic";

    function init() {
        parent::init();
        $this->api->api_base_url  = "https://api.instagram.com/v1/";
        $this->api->authorize_url = "https://api.instagram.com/oauth/authorize/";
        $this->api->token_url     = "https://api.instagram.com/oauth/access_token";
    }

    function finishLogin() {
        parent::finishLogin();
        $instagramUser = $this->getUserProfile();
        $instagramUserDb = Social_Auth::dao()->getUserByIdentifierAndNetwork($instagramUser->identifier, $this->network_name);
        if (!$instagramUserDb) {
            $social_auth_base_url = Social_Auth::$config["base_url"];
            $email_verify_url = $social_auth_base_url . 'callback-email.php' .( strpos( $social_auth_base_url, '?' ) ? '&' : '?' ) . "sa_login_email_verify={$this->network_name}&sa_callback=" . Social_Auth::session()->get( "sa_session.{$this->network_name}.sa_callback" );
            Social_Auth::redirect($email_verify_url);
        }
    }

    function getUserProfile() {
        $data = $this->api->api("users/self/" );

        if ( $data->meta->code != 200 ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an invalid response." );
        }

        $this->user->profile->identifier  = $data->data->id;
        $this->user->profile->displayName = $data->data->full_name ? $data->data->full_name : $data->data->username;
        $this->user->profile->description = $data->data->bio;
        $this->user->profile->photoURL    = $data->data->profile_picture;

        $this->user->profile->webSiteURL  = $data->data->website;

        $this->user->profile->username    = $data->data->username;

        return $this->user->profile;
    }
}