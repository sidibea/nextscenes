<?php
class Social_Network_Github extends Social_Protocol_Model_OAuth2 {

    public $scope = ""; // public user profile info, public repo info, and gists

    function init() {
        parent::init();
        $this->api->api_base_url  = "https://api.github.com/";
        $this->api->authorize_url = "https://github.com/login/oauth/authorize";
        $this->api->token_url     = "https://github.com/login/oauth/access_token";
    }

    function getUserProfile() {
        $data = $this->api->api( "user" );

        if ( ! isset( $data->id ) ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an invalid response." );
        }

        $this->user->profile->identifier  = @ $data->id;
        $this->user->profile->displayName = @ $data->name;
        $this->user->profile->description = @ $data->bio;
        $this->user->profile->photoURL    = @ $data->avatar_url;
        $this->user->profile->profileURL  = @ $data->html_url;
        $this->user->profile->email       = @ $data->email;
        $this->user->profile->webSiteURL  = @ $data->blog;
        $this->user->profile->region      = @ $data->location;

        if( ! $this->user->profile->displayName ){
            $this->user->profile->displayName = @ $data->login;
        }

        if( ! $data->email ) {
            try {
                $emails = $this->api->api("user/emails");
                if (is_array($emails) && !empty($emails[0]->email))
                {
                    $this->user->profile->email = $emails[0]->email;
                }
            } catch( GithubApiException $e ) {
                throw new Social_Exception( "User email request failed! {$this->network_name} returned an error: $e" );
            }
        }

        return $this->user->profile;
    }
}