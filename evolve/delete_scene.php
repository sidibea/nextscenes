<?php $page = "scenes"; $subpage = "delete"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['trash'])){ $trash = trashIt("scene",$_POST['scene'],$_POST['type']); } else if(isset($_POST['cancel'])){ redirectIt("scene"); } else{ $catItems = checkGet("scene", $_GET['scene'], $_GET['type']); } ?>
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
        
		<?php if(!isset($_POST['trash'])){ ?>
        <div class="plr10 bbvg pb10">
        	<?php
			$mssg = "<span class='warning'>You are about to delete the scene written by \"".$catItems['u_username']."\". <br />This means the scene, along with all ratings and reviews belonging to it, will be deleted.</span> Click 'Delete' to complete or 'Cancel' to stop.";
			echo "
				<div class='nom mb10 alert'>".$mssg."</div>";
			?>
        </div>
        <div class="p10">
        	<table class="w50p table nop nom">
            	<tbody>
                	<tr>
                    	<th class="w25p">Storyline name</th><td><?php echo "<a href=\"edit_storyline.php?cat=".stripslashes($catItems['sl_id'])."\">".stripslashes($catItems['sl_name'])."</a>"; ?></td>
                	</tr>
                    <tr>
                    	<th class="w25p">Forum</th><td><?php echo "<a href=\"edit_forum.php?cat=".stripslashes($catItems['f_id'])."\">".stripslashes($catItems['f_name'])."</a>"; ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Scene</th><td><?php 
						if($catItems['scene_type'] == "proposed"){
							echo "<strong>Proposed</strong> scene ";
						}
						echo stripslashes($catItems['scene_number']);
						?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Story</th><td class="justify"><?php echo (stripslashes(utf8_encode(htmlspecialchars_decode($catItems['scene_desc'])))); ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Adoption</th><td><?php 
						if ($key['rating_count']==NULL){
							echo "0 ratings";
						}
						else {
							if($key['rating_count'] == 1){
								echo "1 rating";
							}
							else{
								echo number_format($key['rating_count'])." ratings";
							}
						}
						echo "<br />";
						if ($catItems['review_count']==NULL){
							echo "0 reviews";
						}
						else {
							if($catItems['review_count'] == 1){
								echo "1 review";
							}
							else{
								echo number_format($catItems['review_count'])." reviews";
							}
						}
						?></td>
                    </tr>
                </tbody>
            </table>
            <div  class="mt10 mb20">
                <form method="post" action="" class="left">
                    <input type="hidden" value="<?php echo $_GET['scene']; ?>" name="scene" />
                    <input type="hidden" value="<?php echo $_GET['type']; ?>" name="type" />
                    <input type="submit" name="trash" value="Delete" class="_btn" />
                </form>
                <form method="post" action="" class="left">
                    <input type="submit" name="cancel" value="Cancel" class="_btn" />
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <?php } 
		else{
			echo "
			<div class=\"plr10 bbvg pb10\">
				<div class='nom mb10 alert'>".$trash."</div>
			</div>";
		}?>
        
    </div>
</div>
<?php ?>
</body>
</html>
