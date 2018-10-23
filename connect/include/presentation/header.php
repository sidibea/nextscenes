<?php
if($GLOBALS['require_session']==1 && !session_is_live()) {
	header('Location: '.$GLOBALS['app_url']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<link href="include/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="include/css/style.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>	
    <script src="include/bootstrap-3.3.5/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="include/js/script.js" type="text/javascript"></script>
    
	<script>
	$(document).ready(function() {
		<?php
		echo $jsOnReady;
		?>
	})
	</script>
	
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./"><?php echo $GLOBALS['app_name']; ?></a>
    </div>
    
	<?php
	if(session_is_live()) {
		$session = get_session();
	?>
		<div class="collapse navbar-collapse">
		
	        <ul class="nav navbar-nav">
	        	<?php
				if($active_page=='page1') echo '<li class="active"><a href="./page1.php">Page 1</a></li>';
				else echo '<li><a href="./page1.php">Page 1</a></li>';
				if($active_page=='page2') echo '<li class="active"><a href="./page2.php">Page 2</a></li>';
				else echo '<li><a href="./page2.php">Page 2</a></li>';
				if($active_page=='page3') echo '<li class="active"><a href="./page3.php">Page 3</a></li>';
				else echo '<li><a href="./page3.php">Page 3</a></li>';
				?>
	        </ul>
	        
			<ul class="nav navbar-nav navbar-right">
				<?php
				if($GLOBALS['admin_username']==$session['login']) {
				?>
					<li><a href="./users.php">Manage users</a></li>
				<?php
				}
				?>
				<li class="dropdown">
				<a href="./account.php" class="dropdown-toggle" data-toggle="dropdown"><?php echo $session['login']; ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				    <?php
				    if($GLOBALS['admin_username']!=$session['login']) {
				    	echo '<li><a href="./account.php">My information</a></li>';
				    	echo '<li><a href="./change_password.php">Change password</a></li>';
				    	echo '<li class="divider"></li>';
				    }
				    ?>
				    <li><a href="./listeners/logout.php" id="logout_btn">Logout</a></li>
				</ul>
				</li>
			</ul>
		
		</div>
	<?php
	}
	?>
    
  </div>
</div>

<br><br><br>

<?php
if($GLOBALS['demo_mode']) {
	echo '<div class="container"><div class="alert alert-danger">Please note that some functions are disabled in this demo.
	Use <b>admin</b> // <b>admin</b> to access the admin section :) - 
	<a href="http://codecanyon.net/item/facebook-login-secure-php-area/1520682?ref=yougapi">Download this app</a>
	</div></div>';
}
?>