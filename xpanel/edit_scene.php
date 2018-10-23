<?php $page = "scenes"; $subpage = "edit_scene"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['edit'])){ $edit = editScene($_POST['scene'],$_POST['type'], $_POST['content']); } else if(isset($_POST['cancel'])){ redirectIt("scene"); } else{ $catItems = checkGet("scene", $_GET['scene'], $_GET['type']); } if($catItems['sl_id'] == ""){redirectIt("scene");} ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Scene</title>
<?php include("include/head.php");?> 
	<div class="alert alert-warning">
		<?php
			$mssg = "<span class='warning'>You are about to edit the scene written by \"".$catItems['u_username']."\". <br />This means the scene, the scene will not be as it was posted originally.</span> Click 'Delete' to complete or 'Cancel' to stop.";
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
                        <th class="w25p">Story</th><td class="justify">
						<form method="post" action="">
							<input type="hidden" value="<?php echo $_GET['scene']; ?>" name="scene" />
							<input type="hidden" value="<?php echo $_GET['type']; ?>" name="type" />
							<textarea name="content"><?php echo $catItems['scene_desc'];?></textarea>
							<input type="submit" name="edit" value="Edit Scene" class="alert alert-success" />
						</form>
						</td>
                	</tr>
                </tbody>
            </table>
        </div>
<?php include("include/foot.php");?>