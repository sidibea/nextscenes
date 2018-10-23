<?php $page = "scenes"; $subpage = "view"; require "functions.php";?>
<?php isLoggedIn(); //isPermitted($page); isScenePermitted($_GET['scene']); ?>
<?php if(isset($_POST['validate'])){ $mssg = validateIt("scene",$_POST['scene'],$_POST['type']); } else if(isset($_POST['cancel'])){ redirectIt("scene"); } else{ $catItems = checkGet("scene", $_GET['scene'], $_GET['type']); } ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Read Scenes</title>
<?php include("include/head.php");?>
<?php if(!isset($_POST['trash'])){ ?>
	<div class="plr10 bbvg pb10">
		<?php
		if($mssg){
		echo "
			<div class='alert alert-warning'>".$mssg."</div>";
		}
		?>
	</div>
	<div class="p10">
		<div class="nom mb10 vlgreybg">
			<div class="col-md-3 col-sm-3 col-xs-6">
				<strong>Storyline</strong><br /><?php echo stripslashes($catItems['sl_name']); ?>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<strong>Forum</strong><br /><?php echo stripslashes($catItems['f_name']); ?>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<strong>Scene</strong><br /><?php 
				if($catItems['scene_type'] == "proposed"){
					echo "<strong>Proposed</strong> ";
				}
				echo stripslashes($catItems['scene_number']); 
				?>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<strong>Adoption</strong><br /><?php 
					echo "<strong>".getRatingForScene($catItems['scene_id'])." ratings</strong>";
				echo "<br />";
				if ($catItems['review_count']==NULL){
					echo "0 reviews";
				}
				else {
					if($catItems['review_count'] == 1){
						echo "1 review";
					}
					else{
						echo "<strong>".number_format($catItems['review_count'])." reviews</strong>";
					}
				}
				?>
			</div>
			<div class="clearfix"></div>
				<div class="left w70p whitebg">
				<div class="p10">
					<?php echo (stripslashes(utf8_encode(htmlspecialchars_decode($catItems['scene_desc'])))); ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div  class="mt10 mb20">
			<?php
			if($catItems['scene_type'] == "proposed"){
			?>
			<form method="post" action="" style="float:left; padding-right:30px;">
				<input type="hidden" value="<?php echo $catItems['scene_id']; ?>" name="scene" />
				<input type="hidden" value="<?php echo $catItems['scene_type']; ?>" name="type" />
				<input type="submit" name="validate" value="Validate Scene" class="btn alert-success" />
			</form>
			<form method="post" action="" class="left">
				<input type="submit" name="cancel" value="Cancel" class="btn alert-warning" />
			</form>
			<?php
			}
			?>
			<div align="right">
				<a href="edit_scene.php?scene=<?php echo $catItems['scene_id']; ?>&type=<?php echo $catItems['scene_type']; ?>"><button class="alert alert-success">Edit Scene</button></a>
				<a href="delete_scene.php?scene=<?php echo $catItems['scene_id']; ?>&type=<?php echo $catItems['scene_type']; ?>"><button class="alert alert-danger">Delete Scene</button></a>
			</div>
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