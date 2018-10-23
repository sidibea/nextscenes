<?php $page = "forums"; $subpage = "lang"; require "functions.php"; ?>
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
			$response = createLanguage($_POST['name'], $_POST['desc']);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "You can create a new language using the form below.";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
		?>
        <form method="post" enctype="multipart/form-data">
        	<div class="spacer">
            	<div class="data">Abbreviation<br /><span class="tiny"><em>e.g. "en"</em></span></div>
                <div class="field"><input type="text" name="name" placeholder="" class="medium"<?php if ($status == FALSE && isset($_POST['name'])){ echo " value=\"".$_POST['name']."\""; }?> /></div>
            </div>
        	<div class="spacer">
            	<div class="data">Language name<br /><span class="tiny"><em>e.g. "English"</em></span></div>
                <div class="field"><input type="text" name="desc" placeholder="" class="medium"<?php if ($status == FALSE && isset($_POST['desc'])){ echo " value=\"".$_POST['desc']."\""; }?> /></div>
            </div>
            <div class="submit"><input type="submit" value="Submit" name="submit" class="_btn" /></div>
        </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
