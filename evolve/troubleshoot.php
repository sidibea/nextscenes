<?php $page = "index"; $subpage = "troubleshoot"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo siteName(); ?></title>
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
			$response = troubleShoot($_POST['subject'], $_POST['message']);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "If you have encountered any challenges using the eVOLVE content management system, you may use the form below to contact us; listing the issues that best describe your situation.";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
		?>
        <form method="post">
        	<div class="spacer">
            	<div class="data">Subject<br /><span class="tiny"><em>e.g. "Images not uploading"</em></span></div>
                <div class="field"><input type="text" name="subject" placeholder="" class="medium"<?php if ($status == FALSE && isset($_POST['subject'])){ echo " value=\"".$_POST['subject']."\""; }?> /></div>
            </div>
        	<div class="spacer">
            	<div class="data mb10">Message</div>
                <div class="field">
                	<div class="holder">
                    	<div class="mw100p m5">
                    	<textarea name="message" placeholder="" class="nop nob nom mw100p w100p tinymce"><?php if ($status == FALSE && isset($_POST['message'])){ echo $_POST['message']; }?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="submit"><input type="submit" value="Submit" name="submit" class="_btn" /></div>
        </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
