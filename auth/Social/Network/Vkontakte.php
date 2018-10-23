<?php
class Social_Network_Vkontakte extends Social_Protocol_Model_OAuth2 {

    public $scope = "";

    function init() {
        parent::init();
        $this->api->authorize_url  = "http://api.vk.com/oauth/authorize";
        $this->api->token_url      = "https://api.vk.com/oauth/token";
    }

    function finishLogin() {
        $error = (array_key_exists('error', $_REQUEST))? $_REQUEST['error']: "";

        if ( $error ){
            throw new Social_Exception( "Authentication failed! {$this->network_name} returned an error: $error" );
        }

        $code = (array_key_exists('code', $_REQUEST))? $_REQUEST['code']: "";

        try {
            $response = $this->api->authenticate( $code );
        } catch( Exception $e ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an error: $e" );
        }

        if ( !property_exists($response, 'user_id') || ! $this->api->access_token ){
            throw new Social_Exception( "Authentication failed! {$this->network_name} returned an invalid access token." );
        }

        $this->setToken( "access_token" , $this->api->access_token  );
        $this->setToken( "refresh_token", $this->api->refresh_token );
        $this->setToken( "expires_in"   , $this->api->access_token_expires_in );
        $this->setToken( "expires_at"   , $this->api->access_token_expires_at );

        Social_Auth::session()->set( "sa_session.{$this->network_name}.user_id", $response->user_id );

        $this->connectUser();
    }

    function getUserProfile() {

        $this->refreshToken();

        $params['uid'] = Social_Auth::session()->get( "sa_session.{$this->network_name}.user_id" );
        $params['fields'] = 'first_name,last_name,nickname,screen_name,sex,bdate,timezone,photo_rec,photo_big';
        $response = $this->api->api( "https://api.vk.com/method/getProfiles" , 'GET', $params);


        if (!isset( $response->response[0] ) || !isset( $response->response[0]->uid ) || isset( $response->error ) ){
            throw new Social_Exception( "User profile request failed! {$this->network_name} returned an invalid response." );
        }

        $response = $response->response[0];
        $this->user->profile->identifier    = (property_exists($response,'uid'))?$response->uid:"";
        $this->user->profile->firstName     = (property_exists($response,'first_name'))?$response->first_name:"";
        $this->user->profile->lastName      = (property_exists($response,'last_name'))?$response->last_name:"";
        $this->user->profile->displayName   = (property_exists($response,'screen_name'))?$response->screen_name:"";
        $this->user->profile->photoURL      = (property_exists($response,'photo_big'))?$response->photo_big:"";
        $this->user->profile->profileURL    = (property_exists($response,'screen_name'))?"http://vk.com/" . $response->screen_name:"";

        if(property_exists($response, 'sex')) {
            switch ($response->sex) {
                case 1: $this->user->profile->gender = 'female'; break;
                case 2: $this->user->profile->gender = 'male'; break;
                default: $this->user->profile->gender = ''; break;
            }
        }

        if( property_exists($response,'bdate') ){

            $birthday = explode('.', $response->bdate);

            if (count($birthday) === 3) {
                list($birthday_year, $birthday_month, $birthday_day) = $birthday;
            } else {
                $birthday_year = date('Y');
                list($birthday_month, $birthday_day) = $birthday;
            }

            $this->user->profile->birthDay   = (int) $birthday_day;
            $this->user->profile->birthMonth = (int) $birthday_month;
            $this->user->profile->birthYear  = (int) $birthday_year;
        }

        return $this->user->profile;
    }

    function getUserContacts() {
        $params = array(
            'fields' => 'nickname, domain, sex, bdate, city, country, timezone, photo_200_orig'
        );

        $response = $this->api->api('https://api.vk.com/method/friends.get','GET',$params);

        if(!$response || !count($response->response)){
            return array();
        }

        $contacts = array();
        foreach( $response->response as $item ){
            $uc = new Social_User_Contact();
            $uc->identifier  = $item->uid;
            $uc->displayName = $item->first_name.' '.$item->last_name;
            $uc->profileURL  = 'http://vk.com/'.$item->domain;
            $uc->photoURL    = $item->photo_200_orig;
            $contacts[] = $uc;
        }

        return $contacts;
    }
}