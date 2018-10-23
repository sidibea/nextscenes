<?php $page = "users"; $subpage = "view"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['admin'])){ $trash = adminIt("admin",$_POST['cat']); } else if(isset($_POST['editor'])){ $trash = adminIt("editor",$_POST['cat']); }  else if(isset($_POST['moderator'])){ $trash = adminIt("moderator",$_POST['cat']); } else if(isset($_POST['revoke'])){ $trash = adminIt("revoke",$_POST['cat']); }elseif($_POST['delete']){deleteUser($_POST['cat']);} else if(isset($_POST['cancel'])){ redirectIt("user"); }
$catItems = checkGet("user", $_GET['cat']); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || View User</title>
<style>
.left{
	float:left;
	padding-right:10px;
}
</style>
<?php include("include/head.php");?>
<?php if(!isset($_POST['trash'])){ ?>
	<div class="plr10 bbvg pb10">
		<?php
		if(isset($_POST['cat'])){
			$mssg = $trash;
		}
		else{
			$mssg = "<span class='warning'>You are viewing the user profile belonging to \"".$catItems['u_username']."\"";
			if($catItems['u_fname'] != "" && $catItems['u_fname'] != NULL){
				$mssg .= "(".stripslashes(utf8_encode($catItems['u_fname']))." ".stripslashes(utf8_encode($catItems['u_lastname'])).")";
			}
			$mssg .= ". <br /></span>You can either grant or revoke priviledges to this user using the buttons below.<br /> You can also suspend the user's profile on the site using the \"suspend account\" button below.<br /><strong>* Please not that you are unable to suspend or revoke priviledges on your own account.</strong>";
		}
		echo "
			<div class='nom mb10 alert'>".$mssg."</div>";
		?>
	</div>
	<div class="p10">
		<table class="w50p table nop nom">
			<tbody>
			<?php
				if($catItems['u_mod'] != 0){
			?>
				<tr>
					<th class="w25p">Priviledge</th><td><?php 
					if($catItems['u_mod'] == 1){
						echo "<span class=\"warning\">Administrator</span>";
					}
					else if($catItems['u_mod'] == 2){
						echo "<span class=\"warning\">Editor</span>";
					}
					else if($catItems['u_mod'] == 3){
						echo "<span class=\"warning\">Moderator</span>";
					}
					?></td>
				</tr>
			<?php
				}
			?>
				<tr>
					<th class="w25p">Username</th><td><?php echo stripslashes(utf8_encode($catItems['u_username'])); ?></td>
				</tr>
				<tr>
					<th class="w25p">Full name</th><td><?php echo stripslashes(utf8_encode($catItems['u_fname']))." ".stripslashes(utf8_encode($catItems['u_lastname'])); ?></td>
				</tr>
				<tr>
					<th class="w25p">Email</th><td><?php echo stripslashes($catItems['u_email']); ?></td>
				</tr>
				<tr>
					<th class="w25p">Adoption</th><td><?php 
					if ($catItems['rating_count']==NULL){
						echo "0 ratings";
					}
					else {
						if($catItems['rating_count'] == 1){
							echo "1 rating";
						}
						else{
							echo "<strong>".number_format($catItems['rating_count'])." ratings</strong>";
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
							echo "<strong>".number_format($catItems['review_count'])." reviews</strong>";
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
				<tr>
					<th class="w25p">Joined</th><td><?php echo date("l jS F, Y", strtotime($catItems['u_ts'])); ?></td>
				</tr>
				<tr>
					<th class="w25p">Last login</th><td><?php echo date("l jS F, Y", strtotime($catItems['u_lastvisit'])); ?></td>
				</tr>
			</tbody>
		</table>
		<div  class="mt10 mb20">
			<?php
			if($catItems['u_mod'] == 0){
			?>
			<form method="post" action="" class="left">
				<input type="hidden" value="<?php echo $catItems['u_id']; ?>" name="cat" />
				<input type="submit" name="admin" value="Grant administrator priviledges" class="btn alert-success" />
			</form>
			<form method="post" action="" class="left">
				<input type="hidden" value="<?php echo $catItems['u_id']; ?>" name="cat" />
				<input type="submit" name="editor" value="Grant editor priviledges" class="btn alert-success" />
			</form>
			<form method="post" action="" class="left">
				<input type="hidden" value="<?php echo $catItems['u_id']; ?>" name="cat" />
				<input type="submit" name="moderator" value="Grant moderator priviledges" class="btn alert-success" />
			</form>
			<?php
			}
			else{
				if($catItems['u_mod_session'] != $_SESSION['ev_u_name']){
			?>
			<form method="post" action="" class="left">
				<input type="hidden" value="<?php echo $catItems['u_id']; ?>" name="cat" />
				<input type="submit" name="revoke" value="Revoke all priviledges" class="btn alert-success" />
			</form>
			<?php
				}
			}
			?>
			<div class="clearfix space"></div>
			<form method="post" action="" class="left">
				<input type="hidden" value="<?php echo $catItems['u_id']; ?>" name="cat" />
				<input type="submit" name="delete" value="Delete User" class="btn alert-danger" />
			</form>
			<form method="post" action="" class="left">
				<input type="submit" name="cancel" value="Back to users" class="btn alert-warning" />
			</form>
			<div class="clearfix"></div>
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