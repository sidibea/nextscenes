<?php $page = "scenes"; $subpage = "delete"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['trash'])){ $trash = trashIt("scene",$_POST['scene'],$_POST['type']); } else if(isset($_POST['cancel'])){ redirectIt("scene"); } else{ $catItems = checkGet("scene", $_GET['scene'], $_GET['type']); } if($catItems['sl_id'] == ""){redirectIt("scene");} ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Delete Scene</title>
<?php include("include/head.php");?>
	<div class="alert alert-warning">
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
<?php include("include/foot.php");?>