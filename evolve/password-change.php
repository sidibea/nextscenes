<?php $page = "settings"; $subpage = "password"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo siteName($page, $subpage); ?></title>
<link href="stylee/stylee.css" type="text/css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php require "plugins/tinymce_simple.php"; ?>
</head>

<body>

<div class="main">
    <div class="nav">
        <div class="pt10">
        	<?php echo siteVersion(); ?>
        </div>
        <div class="clear ptb10"></div>
        <?php echo generateMenu($page, $subpage); ?>
    </div>
    <div class="content">
    	<?php echo generateHeader(); ?>
    	<div class="clear"></div>
        
        <div class="p10">
        <?php
		if(isset($_POST['submit'])){
			$response = updatePassword($_SESSION['ev_u_name'],$_POST['opass'], $_POST['npass'],$_POST['cnpass']);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "You can update your evolve user settings by using the form below.";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
		$theUser = getUserdetails($_SESSION['ev_u_name']);
		?>
        <form method="post">
        	<div class="spacer">
            	<div class="data">Old password<br /></span></div>
                <div class="field"><input type="password" name="opass" placeholder="" class="medium" value="" /></div>
            </div>
        	<div class="spacer">
            	<div class="data">New password<br /></span></div>
                <div class="field"><input type="password" name="npass" placeholder="" class="medium" value="" /></div>
            </div>
        	<div class="spacer">
            	<div class="data">Confirm new password<br /></span></div>
                <div class="field"><input type="password" name="cnpass" placeholder="" class="medium" value="" /></div>
            </div>
            <div class="submit"><input type="submit" value="Update" name="submit" class="_btn" /></div>
        </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
