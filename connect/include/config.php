<?php
/*
START settings
*/

$GLOBALS['app_domain_url'] = 'http://nextscenes.com'; //ex: http://yougapi.com
$GLOBALS['app_folder'] = '/connect'; //ex: /products/facebook_login
$GLOBALS['app_name'] = 'Facebook login';

//database access
$GLOBALS['db_host'] = 'og21315-001.privatesql:35357';
$GLOBALS['db_name'] = 'nextscendidb';
$GLOBALS['db_user'] = 'nextscendidb';
$GLOBALS['db_password'] = 'Sidere852';

//Facebook app data
$GLOBALS['fb_app_id'] = '104737609922722';
$GLOBALS['fb_app_secret'] = '6341ddeddb19e3530b812ad22e636a9b';

//email
$GLOBALS['email_from'] = 'your_data_here'; //used to send a reset password email
$GLOBALS['email_subject'] = 'Reset your password';

//admin user
$GLOBALS['admin_username'] = 'admin';
$GLOBALS['admin_password'] = 'admin';

/*
System variables
*/

//system
$GLOBALS['require_session'] = 1; //no to be changed
$GLOBALS['demo_mode'] = 0; //possible values: 0 or 1
$GLOBALS['app_url'] = $GLOBALS['app_domain_url'].$GLOBALS['app_folder']; // not to be modified

//Fb
$GLOBALS['fb_ypbox_path'] = 'include/library/Fb_box'; //not to be modified
$GLOBALS['fb_scope'] = 'email';
$GLOBALS['fb_connect_redirect'] = '';
$GLOBALS['fb_logout_redirect'] = '';
$GLOBALS['fb_sdk_lang'] = '';

//db tables
$GLOBALS['db_table']['users'] = 'fb_login_users';

?>