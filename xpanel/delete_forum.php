<?php $page = "forums"; $subpage = "delete"; require "functions.php"; isLoggedIn(); isPermitted($page); if(isset($_POST['trash'])){ $trash = trashIt("forum",$_POST['cat']); } else if(isset($_POST['cancel'])){ redirectIt("forum"); } else{ $catItems = checkGet("forum", $_GET['cat']);}?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Delete Forums</title>
<?php include("include/head.php");?>
	<?php if(!isset($_POST['trash'])){ ?>
        <div class="alert alert-warning">
        	<?php
			$mssg = "You are about to delete the \"".$catItems['f_name']."\" forum. <br />This means the forum, along with all storylines and scenes belonging to it, will be deleted. Click <span class='alert-danger' style='padding:8px;'>Delete</span> to complete or <span class='alert-success' style='padding:8px;'>Cancel</span> to stop.";
			echo "
				<div class='nom mb10 alert'>".$mssg."</div>";
			?>
        </div>
        	<table class="w50p table nop nom">
            	<tbody>
                	<tr>
                    	<th class="w25p">Name</th><td><?php echo stripslashes($catItems['f_name']); ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Description</th><td><?php echo stripslashes($catItems['f_desc']); ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Adoption</th><td><?php 
						if ($key['story_count']==NULL){
							echo "0 storylines";
						}
						else {
							if($key['story_count'] == 1){
								echo "1 storyline";
							}
							else{
								echo number_format($key['story_count'])." storylines";
							}
						}
						echo "<br />";
						if ($catItems['validated_scenes']==NULL){
							echo "0 validated scenes";
						}
						else {
							if($catItems['validated_scenes'] == 1){
								echo "1 validated scenes";
							}
							else{
								echo number_format($catItems['validated_scenes'])." validated scenes";
							}
						}
						echo "<br />";
						if ($catItems['proposed_scenes']==NULL){
							echo "0 proposed scenes";
						}
						else {
							if($catItems['proposed_scenes'] == 1){
								echo "1 proposed scenes";
							}
							else{
								echo number_format($catItems['proposed_scenes'])." proposed scenes";
							}
						}
						?></td>
                    </tr>
                </tbody>
            </table>
                <form method="post" action="" style="float:left; padding-right:15px;">
                    <input type="hidden" value="<?php echo $catItems['f_id']; ?>" name="cat" />
                    <input type="submit" name="trash" value="Delete" class="btn alert-danger" />
                </form>
                <form method="post" action="" style="float:left;">
                    <input type="submit" name="cancel" value="Cancel" class="btn alert-success" />
                </form>
                <div class="clear"></div>
        <?php } 
		else{
			echo "
			<div class=\"plr10 bbvg pb10\">
				<div class='alert alert-danger'>".$trash."</div>
			</div>";
		}?>
<?php include("include/foot.php");?>