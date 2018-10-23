<?php return array(
    'base_url' => 'http://localhost/socialauth/',
    'networks' =>
        array(
            'facebook' =>
                array(
                    'name' => 'Facebook',
                    'icon_class' => 'fa fa-facebook fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'twitter' =>
                array(
                    'name' => 'Twitter',
                    'icon_class' => 'fa fa-twitter fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'linkedin' =>
                array(
                    'name' => 'Linkedin',
                    'icon_class' => 'fa fa-linkedin fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'yahoo' =>
                array(
                    'name' => 'Yahoo',
                    'icon_class' => 'fa fa-smile-o fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'google' =>
                array(
                    'name' => 'Google',
                    'icon_class' => 'fa fa-google-plus fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'foursquare' =>
                array(
                    'name' => 'Foursquare',
                    'icon_class' => 'fa fa-foursquare fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'github' =>
                array(
                    'name' => 'Github',
                    'icon_class' => 'fa fa-github fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'vkontakte' =>
                array(
                    'name' => 'VKontakte',
                    'icon_class' => 'fa fa-vk fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'instagram' =>
                array(
                    'name' => 'Instagram',
                    'icon_class' => 'fa fa-instagram fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                ),
            'tumblr' =>
                array(
                    'name' => 'Tumblr',
                    'icon_class' => 'fa fa-tumblr fa-lg',
                    'enabled' => false,
                    'keys' =>
                        array(
                            'key' => '',
                            'secret' => '',
                        ),
                )
        ),
    'debug_enabled' => false,
    'log_file' => '',
    'db' =>
        array(
            'enabled' => false,
            'host' => 'localhost',
            'username' => '',
            'password' => '',
            'dbname' => 'socialauth',
            'tbl_users' => 'sa_users',
            'clmn_user_username' => 'username',
            'clmn_user_email' => 'email',
            'clmn_user_password' => 'password',
        ),
);