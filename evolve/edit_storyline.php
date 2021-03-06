<?php $page = "storylines"; $subpage = "edit"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<?php
if(isset($_POST['submit'])){
	$response = updateStoryline($_POST['name'], $_POST['mssg'],$_POST['forum'], $_FILES["upload"], $_POST['cat']);
	$mssg = $response[0];
	$status = $response[1];
}
?>
<?php 
$catItems = checkGet("storyline", $_GET['cat']);
$user = getUsername($_SESSION['ev_u_name']);
if($catItems['c_users_u_id'] != $user['u_id']){
	header("Location: my_storylines.php");
}
?>
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
            	<div class="data">Name<br /><span class="tiny"><em>e.g. "The Long Road Home"</em></span></div>
                <div class="field"><input type="text" name="name" placeholder="" class="medium" value="<?php if($status == TRUE){ echo $_POST['name'];} else{echo $catItems['sl_name'];} ?>" /></div>
            </div>
            <div class="spacer">
            	<div class="data">Forum</div>
                <div class="field">
                	<div class="left bg c2">
                	<select name="forum" class="mw350">
                        <?php 
							$lang = getForums();
							foreach ($lang as $scat=>$skey){
								echo "
								<option value=\"".$skey['f_id']."\""; if($skey['f_id']==$catItems['c_forums_f_id']){ echo " selected=\"selected\"";} echo">".stripslashes(utf8_encode($skey['f_name']))." [Language: ".$skey['l_name']."]</option>";
							}
						?>
                    </select>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="spacer">
            	<div class="data">Image</div>
            	<div class="left w450">
                    <div class="bg c5 vlgreybg h100 noverflow p10 w420">
                    <?php
						$catImage = findImage("storyline", $_GET["cat"]);
						if ($catImage != 0){
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
                    	<textarea name="mssg" placeholder="" class="nop nob nom mw100p w100p tinymce"><?php if($status == TRUE){ echo $_POST['mssg'];} else{echo stripslashes(utf8_encode($catItems['sl_desc']));} ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="cat" value="<?php echo $catItems['sl_id'];?>" />
            <div class="submit"><input type="submit" value="Update" name="submit" class="_btn" /></div>
        </form>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
