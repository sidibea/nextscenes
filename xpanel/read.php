<?php $page = "scenes"; require "functions.php"; isLoggedIn();
	$story = getStory($_REQUEST['id']);
	$proposed = proposedScenes($_REQUEST['id'], "");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || <?php echo $story['sl_name'];?></title>
<?php include("include/head.php");?>
<fieldset>
	<legend><?php echo $story['sl_name'];?></legend>
	<?php
		echo $story['sl_desc'];
	?>
</fieldset>
<div style="height:15px;"></div>
<fieldset>
	<legend>Scenes</legend>
	<?php
	// Proposed Scene
	if($proposed != 0){
		echo "<h3 class=\"h3 mt20 pt20 btg\">Scenes</h3>";
	echo "<div class=\"extra_scenes\">";
	$count = 0;
		foreach($proposed as $proposed_o){
		$count++;
			$title = stripslashes(htmlspecialchars_decode($proposed_o['sl_name']))." - <strong>[".$proposed_o['scene_type']."]</strong> scene ".$proposed_o['ps_scene'];
			if($proposed_o['sl_views'] == 1){
				$views = "1 view";
			}else{
				$views = number_format($proposed_o['sl_views'])." views";
			}
			if($story_o['storylines']=='0'){ 
				$the_url = '<a href="#" class="clickthis multi">Inactive scene</a> ';
			}else{
				if ($proposed_o['scene_status']== 3){
						$the_url = "<a href=\"?restore=".$proposed_o['ps_id']."\">Restore</a> | <a href=\"delete_scene.php?scene=".$proposed_o['ps_id']."&type=".$proposed_o['scene_type']."\" class='warn'>Delete permanently</a>";
					}else{
						if($proposed_o['scene_type'] == "proposed"){
							$the_url = "<a href=\"view_scene.php?scene=".$proposed_o['ps_id']."&type=proposed\">View</a> | <a href=\"?trash=".$proposed_o['ps_id']."\">Ban</a>";
						}else{
							$the_url = "<a href=\"view_scene.php?scene=".$proposed_o['ps_id']."&type=valid\">View</a>";
						}
					}
			}
			echo "<div class=\"col-md-4 col-sm-4 col-xs-12\">
						<div class=\"\"><strong>".$title."</strong></div>
						<span>Created ".date("jS F Y", strtotime($proposed_o['ps_ts']))."<br>By ".stripslashes(htmlspecialchars_decode($proposed_o['u_username']))."</span>
						<p>".utf8_encode(shorten($proposed_o['ps_desc'],90))."</p>
						".$the_url;
					echo "</div>";
				if($count % 3 == 0){
					echo "<div style='clear:both;'></div>";
				}
			}
			echo "<div style='clear:both;'></div>";
		echo "</div>";
	}
	?>
</fieldset>
<?php include("include/foot.php");?>