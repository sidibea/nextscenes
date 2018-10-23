<?php $page = "forgot"; require "functions.php"; ?>
<?php 
if(isset($_POST['email'])){
	$mmsg = resetPassword($_POST['email']);
}
else{
	$mmsg ="";
}
?>
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
        <div class="w300 center mt20 mb20">
        	<?php 
				if($mmsg != "" && $mmsg != NULL){
					echo "<p class='alert txtcenter'>".$mmsg."</p>";
				}
			?>
            <form action="" name="login_form" class="login_form" method="POST">
                <div>
                	<p>Email address</p>
                	<input class="login_input" type="text" name="email"/>       
                </div>
                <input type="submit" value="Request password" name="login_site" class="_btn center" />
            </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
