<?php $page = "storylines"; $subpage = "new"; require "functions.php"; ?>
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
			$response = createStoryline($_POST['name'], $_POST['mssg'], $_POST['forum'],$_FILES["upload"], $_POST['owner']);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "You can create a new storyline using the form below.";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
		?>
        <form method="post" enctype="multipart/form-data">
        	<div class="spacer">
            	<div class="data">Name<br /><span class="tiny"><em>e.g. "The Lost Zanga"</em></span></div>
                <div class="field"><input type="text" name="name" placeholder="" class="medium"<?php if ($status == FALSE && isset($_POST['name'])){ echo " value=\"".$_POST['name']."\""; }?> /></div>
            </div>
            <?php
			$user = getUsername($_SESSION['ev_u_name']);
			if($user['u_mod'] == 1){
				echo "
            <div class=\"spacer\">
            	<div class=\"data\">Author/Writer</div>
                <div class=\"field\">
                	<div class=\"left bg c2\">
                	<select name=\"owner\" class=\"mw350\">";
						$mods = getModerators();  
						foreach ($mods as $mods=>$smods){
							$othernames = "";
							if($smods['u_fname'] != "" || $smods['u_lastname'] != ""){
								$othernames = " [".$smods['u_fname']." ".$smods['u_lastname']."]";
							}
							echo "
							<option value=\"".$smods['u_id']."\">".stripslashes(utf8_encode($smods['u_username'])).$othernames."</option>";
						}
						echo "
                    </select>
                    </div>
                    <div class=\"clear\"></div>
                </div>
            </div>";
			}
			?>
            <div class="spacer">
            	<div class="data">Forum</div>
                <div class="field">
                	<div class="left bg c2">
                	<select name="forum" class="mw350">
                        <?php 
							$lang = getForums();  
							foreach ($lang as $scat=>$skey){
								echo "
								<option value=\"".$skey['f_id']."\">".stripslashes(utf8_encode($skey['f_name']))." [Language: ".$skey['l_name']."]</option>";
							}
						?>
                    </select>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="spacer">
            	<div class="data">Image</div>
                <div class="field"><input type="file" name="upload" class="medium" /></div>
            </div>
        	<div class="spacer">
            	<div class="data mb10">Text</div>
                <div class="field">
                	<div class="holder">
                    	<div class="mw100p m5">
                    	<textarea name="mssg" placeholder="" class="nop nob nom mw100p w100p tinymce"><?php if ($status == FALSE && isset($_POST['mssg'])){ echo $_POST['mssg']; }?></textarea>
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
