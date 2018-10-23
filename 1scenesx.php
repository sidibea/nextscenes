<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "scene";
	$id = $_GET['id'];
	$sc = $_GET['sc'];
	updateStorylineViews($id);
	$story = getStory($id);
	$scene = getScene($id, $sc);
	echo common_top($page);
?>
<body>
<?php
	echo topNav($page);
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
            	<?php
					if($scene['scene_number'] > 1){
						$scene1preview = scene1Preview($scene['id']);
						if($scene1preview != 0){
							echo "
				<fieldset class=\"relative\">
					<legend>";
						if($scene1preview['scene_type'] == 'valid'){
							echo "".$scene1preview['Title']." - Scene ".$scene1preview['scene_number'];
						}
						else{
							echo "".$scene1preview['Title']." - <strong>[Proposed]</strong> scene ".$scene1preview['scene_number'];
						}							
					echo "
					</legend>
					".shortenEnd($scene1preview['Text'],180)."
				</fieldset>";
						}
					}
				?>
                <div class="w100p courrier relative this_is_the_text">
                	<div class="c_3mm"></div>
                	<div class="c_2mm"></div>
                	<div class="c_1mm"></div>
                    <fieldset class="relative">
                        <legend><?php 
							if($scene['scene_type'] == 'valid'){
								echo "".$scene['Title']." - Scene ".$scene['scene_number'];
							}
							else{
								echo "".$scene['Title']." - <strong>[Proposed]</strong> scene ".$scene['scene_number'];
							}							
						?></legend>
                        <?php
						$imgstylex = getImgStyle("avatars/".$scene['avatar']);
						if(!empty($scene['avatar'])){
							$avatar = "<img src=\"avatars/".$scene['avatar']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}
                            echo $scene['Text']."
						<div class=\"avatar_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($scene['Login']))."</span>
							</div>
						</div>
						<div class=\"clear\"></div>";
                        ?>
                    </fieldset>
                </div>
                <?php					
					if($scene['View'] == 1){
						$views = "1 view";
					}
					else{
						$views = number_format($scene['View'])." views";
					}
					$the_url = "<a href=\"storylines-".reecUrl($scene['forum_name'])."-".$scene['IdForum'].".html\">".$scene['forum_name']."</a>";
					echo "
					<div class=\"c_view\">
						<span>".$views." | ".$the_url." | Created ".date("jS F Y", strtotime($scene['Date']))."
					</div>";
					
					$proposed = proposedScenes($id, $sc);
					if($proposed != 0){
						echo "
					<h3 class=\"h3 mt20 pt20 btg\">Proposed scenes</h3>
					<div class=\"extra_scenes\">";
						foreach($proposed as $proposed_o){
							$title = stripslashes(htmlspecialchars_decode($proposed_o['Title']))." - <strong>[Proposed]</strong> scene ".$proposed_o['scene_number'];
							if($proposed_o['View'] == 1){
								$views = "1 view";
							}
							else{
								$views = number_format($proposed_o['View'])." views";
							}
							if(empty($_SESSION['idsession'])){
								$the_url = " <a href=\"connect.html\" class=\"clickthis multi\">&rarr; Enter forum</a>";
							}
							else {
								if($story_o['storylines']=='0'){ 
									$the_url = '<a href="#" class="clickthis multi">Inactive Storyline</a> ';
								}
								else {
									$the_url = '<a href="scenes-'.$proposed_o['id'].'-'.reecUrl($proposed_o['Title']).'-'.$proposed_o['idstory'].'.html" class="clickthis multi">&rarr; Read scene</a>';
								}
							}
							echo "
						<div class=\"one_scene\">
							<span class=\"one_scene_inner\">
								<h3 class=\"h3\">".$title."</h3>
								<span>Created ".date("jS F Y", strtotime($proposed_o['DateCreate']))."<br>By ".stripslashes(htmlspecialchars_decode($proposed_o['Login']))."</span>
								<p>".shorten($proposed_o['Text'],90)."</p>
								".$the_url."
							</span>
						</div>";
						}
						echo "
					</div>";
					}
					
					$validated = validatedScenes($id, $sc);
					if($validated != 0){
						echo "
					<h3 class=\"h3 mt20 pt20 btg\">Validated scenes</h3>
					<div class=\"extra_scenes\">";
						foreach($validated as $validated_o){
							$title = stripslashes(htmlspecialchars_decode($validated_o['Title']))." - Scene ".$validated_o['scene_number'];
							if($validated_o['View'] == 1){
								$views = "1 view";
							}
							else{
								$views = number_format($validated_o['View'])." views";
							}
							if(empty($_SESSION['idsession'])){
								$the_url = " <a href=\"connect.html\" class=\"clickthis multi\">&rarr; Enter forum</a>";
							}
							else {
								if($story_o['storylines']=='0'){ 
									$the_url = '<a href="#" class="clickthis multi">Inactive Storyline</a> ';
								}
								else {
									$the_url = '<a href="scenes-'.$validated_o['id'].'-'.reecUrl($validated_o['Title']).'-'.$validated_o['idstory'].'.html" class="clickthis multi">&rarr; Read scene</a>';
								}
							}
							echo "
						<div class=\"one_scene\">
							<span class=\"one_scene_inner\">
								<h3 class=\"h3\">".$title."</h3>
								<span>Created ".date("jS F Y", strtotime($validated_o['DateCreate']))."<br>By ".stripslashes(htmlspecialchars_decode($validated_o['Login']))."</span>
								<p>".shorten(utf8_encode($validated_o['Text'],90))."</p>
								".$the_url."
							</span>
						</div>";
						}
						echo "
					</div>";
					}
				?>
            </div>
        </div>
    	<div class="main_right">
        	<?php
			echo side($page);
			?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php echo footer($page); ?>
</body>
</html>