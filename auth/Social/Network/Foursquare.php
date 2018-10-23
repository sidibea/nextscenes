<?php
class Social_Network_Foursquare extends Social_Protocol_Model_OAuth2 {

    function init() {
        parent::init();

        $this->api->api_base_url  = "https://api.foursquare.com/v2/";
        $this->api->authorize_url = "https://foursquare.com/oauth2/authenticate";
        $this->api->token_url     = "https://foursquare.com/oauth2/access_token";

        $this->api->sign_token_name = "oauth_token";
    }

    function getUserProfile() {
        $data = $this->api->api( "users/self", "GET", array( "v" => "20120610" ) );

        if ( ! isset( $data->response->user->id ) ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an invalid response." );
        }

        $data = $data->response->user;

        $this->user->profile->identifier    = $data->id;
        $this->user->profile->firstName     = $data->firstName;
        $this->user->profile->lastName      = $data->lastName;
        $this->user->profile->displayName   = trim( $this->user->profile->firstName . " " . $this->user->profile->lastName );
        $this->user->profile->photoURL      = $data->photo->prefix . "256x256" . $data->photo->suffix;
        $this->user->profile->profileURL    = "https://www.foursquare.com/user/" . $data->id;
        $this->user->profile->gender        = $data->gender;
        $this->user->profile->city          = $data->homeCity;
        $this->user->profile->email         = $data->contact->email;
        $this->user->profile->emailVerified = $data->contact->email;

        return $this->user->profile;
    }
}