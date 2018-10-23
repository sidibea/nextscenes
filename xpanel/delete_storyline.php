<?php $page = "storylines"; $subpage = "delete"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['trash'])){ $trash = trashIt("storyline",$_POST['cat']); } else if(isset($_POST['cancel'])){ redirectIt("storyline"); } else{ $catItems = checkGet("storyline", $_GET['cat']); } ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Delete Storyline</title>
<?php include("include/head.php");?>
<?php if(!isset($_POST['trash'])){ ?>
	<div class="alert alert-warning">
		<?php
		$mssg = "You are about to delete the \"<strong>".$catItems['sl_name']."</strong>\" storyline. <br />This means the storyline, along with all scenes belonging to it, will be deleted. Click <span class='alert alert-danger' style='padding:5px 5px;'>Delete</span> to complete or <span class='alert alert-success' style='padding:5px 5px;'>Cancel</span> to stop.";
		echo "
			<div class='nom mb10 alert'>".$mssg."</div>";
		?>
	</div>
	<div class="p10">
		<table class="w50p table nop nom">
			<tbody>
				<tr>
					<th class="w25p">Name</th><td><?php echo stripslashes($catItems['sl_name']); ?></td>
				</tr>
				<tr>
					<th class="w25p">Description</th><td><?php echo strip_tags($catItems['sl_desc']); ?></td>
				</tr>
				<tr>
					<th class="w25p">Adoption</th><td><?php 
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
		<div  class="mt10 mb20">
			<form method="post" action="" style="float:left; padding-right:30px;">
				<input type="hidden" value="<?php echo $catItems['sl_id']; ?>" name="cat" />
				<input type="submit" name="trash" value="Delete" class="btn alert-danger" />
			</form>
			<form method="post" action="" class="left">
				<input type="submit" name="cancel" value="Cancel" class="btn alert-success" />
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
<?php include("include/foot.php");?>