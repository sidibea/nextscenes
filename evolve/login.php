<?php $page = "login"; require "functions.php"; ?>
<?php if(isset($_POST['login_site'])){ loginUser($_POST['username'], $_POST['password']); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo siteName(); ?></title>
<link href="stylee/stylee.css" type="text/css" rel="stylesheet" />
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
    	<div class="w100p h250 blackbg e_img">
        </div>
        
    	<div class="clear"></div>
        <div class="w300 center mt20">
        	<?php if (isset($_GET['login']) && $_GET['login'] == "fail"){ echo "<p class='alert txtcenter'>Please enter valid login credentials</p>";} ?>
            <form action="" name="login_form" class="login_form" method="POST">
                <div>
                	<p>username</p>
                	<input class="login_input" type="text" name="username" autocomplete="off"/>       
                </div>
                <div>
                	<p>password</p>
                	<input class="login_input" type="password" name="password" autocomplete="off"/>
                </div>
                <input type="hidden" name="login_attempt" value="1" />
                <input type="submit" value="Login" name="login_site" class="_btn" />
            </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
