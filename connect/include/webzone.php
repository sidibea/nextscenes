<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

include('config.php');

//functions
include('functions/db_functions.php');
include('functions/functions.php');
include('functions/app_functions.php');
include('functions/display_functions.php');
include('functions/Forms.php');
include('functions/session_functions.php');

//db
include('db/db_class.php');

//FB
include('library/Fb_box/include/webzone.php');

?>