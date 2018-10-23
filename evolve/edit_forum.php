<?php $page = "forums"; $subpage = "edit"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<?php
if(isset($_POST['submit'])){
	$response = updateForum($_POST['name'], $_POST['mssg'],$_POST['language'], $_FILES["upload"], $_POST['cat']);
	$mssg = $response[0];
	$status = $response[1];
}
?>
<?php $catItems = checkGet("forum", $_GET['cat']); ?>
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
			echo "<p class='nom mb20 alert'>".$mssg."<p>";
		?>
        <form method="post" enctype="multipart/form-data">
        	<div class="spacer">
            	<div class="data">Name<br /><span class="tiny"><em>e.g. "Entertainment"</em></span></div>
                <div class="field"><input type="text" name="name" placeholder="" class="medium" value="<?php if($status == TRUE){ echo $_POST['name'];} else{echo $catItems['f_name'];} ?>" /></div>
            </div>
            <div class="spacer">
            	<div class="data">Forum language</div>
                <div class="field">
                	<div class="left bg c2">
                	<select name="language" class="mw350">
                        <?php 
							$lang = languages();
							foreach ($lang as $scat=>$skey){
								echo "
								<option value=\"".$skey['l_id']."\""; if($skey['l_id']==$catItems['c_languages_l_id']){ echo " selected=\"selected\"";} echo">".stripslashes($skey['l_name'])."</option>";
							}
						?>
                    </select>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="spacer">
            	<div class="data">Forum image</div>
            	<div class="left w450">
                    <div class="bg c5 vlgreybg h100 noverflow p10 w420">
                    <?php
						$catImage = findImage("forum", $_GET["cat"]);
						if ($catImage){
							echo "
							<div class=\"left w100 h100 noverflow mr10\">
								<img src=\"".$catImage."\" class=\"w100\" />
							</div>";
						}
					?>
                    	<div class="">
                        	<input type="file" name="upload" class="_btn" />
                            <p class="nop nom _t"><?php echo genericUploadMssg(); ?></p>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        	<div class="spacer">
            	<div class="data mb10">Description</div>
                <div class="field">
                	<div class="holder">
                    	<div class="mw100p m5">
                    	<textarea name="mssg" placeholder="" class="nop nob nom mw100p w100p tinymce"><?php if($status == TRUE){ echo $_POST['mssg'];} else{echo $catItems['f_desc'];} ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="cat" value="<?php echo $catItems['f_id'];?>" />
            <div class="submit"><input type="submit" value="Update" name="submit" class="_btn" /></div>
        </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
