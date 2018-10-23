<?php
include_once('include/webzone.php');

$active_page = 'home'; //defined in "include/presentation/header.php"
include_once('include/presentation/header.php');

$session = get_session();
$user_id = $session['user_id'];
$user_privilege = $session['privilege'];

?>

<div class="container">	
	
	<h2>Home</h2><hr>
	
	<h3>Welcome in the backend !</h3>
	You are currently securely connected and only connected user are able to access this page.
	<br>
	
	Please navigate through the menu to get a look. 
	
	
</div>

<?
include_once('include/presentation/footer.php');
?>