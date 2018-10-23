<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "scene";
	$id = $_GET['id'];
	$sc = $_GET['sc'];
	updateStorylineViews($id);
	$story = getStory($id);
	$scenes = getVScenes($id, $sc);
	$user = getUser();
	$tscene = getScene($id, $sc);
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
				foreach($scenes as $scene){
					echo "
                <div class=\"w100p courrier relative this_is_the_text\">
                	<div class=\"c_3mm\"></div>
                	<div class=\"c_2mm\"></div>
                	<div class=\"c_1mm\"></div>
                    <fieldset class=\"relative\">
                        <legend>";
							if($scene['scene_type'] == 'valid'){
								echo "".utf8_encode($scene['Title'])." - Scene ".$scene['scene_number'];
							}
							else{
								echo "".utf8_encode($scene['Title'])." - <strong>[Proposed]</strong> scene ".$scene['scene_number'];
							}							
						echo "
						</legend>";
						$imgstylex = getImgStyle("avatars/".$scene['avatar']);
						if(!empty($scene['avatar'])){
							$avatar = "<img src=\"avatars/".$scene['avatar']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}
                        echo utf8_encode($scene['Text'])."
						<div class=\"avatar_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($scene['Login']))."
							</div>
						</div>
						<div class=\"clear\"></div>
                    </fieldset>
                </div>";				
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
				}
				
				echo "
				<div class=\"read_proposed_posts clear\" id=\"read\">
					<div class=\"w100p courrier relative this_is_the_text\">
						<div class=\"c_3mm\"></div>
						<div class=\"c_2mm\"></div>
						<div class=\"c_1mm\"></div>
						<fieldset class=\"relative\">
							<legend>"; 
								if($tscene['scene_type'] == 'valid'){
									echo "".$tscene['Title']." - Scene ".$tscene['scene_number'];
								}
								else{
									echo "".$tscene['Title']." - <strong>[Proposed]</strong> scene ".$tscene['scene_number'];
								}							
							echo "
							</legend>";
							$imgstylex = getImgStyle("avatars/".$tscene['avatar']);
							if(!empty($tscene['avatar'])){
								$avatar = "<img src=\"avatars/".$tscene['avatar']."\"/>";
							}
							else{
								$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
							}
							echo utf8_encode(htmlspecialchars_decode($tscene['Text']))."
							<div class=\"avatar_holder mt10 right\">
								<div class=\"avatar_holder_main\">
									<div class=\"c_avatar ".$imgstylex."\">
										".$avatar."
									</div>
								</div>
								<div class=\"avatar_text\">
									By ".stripslashes(htmlspecialchars_decode($tscene['Login']))."</span>
								</div>
							</div>
							<div class=\"clear\"></div>
						</fieldset>
					</div>
				</div>
				<div class=\"addthis_sharing_toolbox\" addthis:title=\"".utf8_encode($story['Title'])."\"></div>
				";
				
				$proposed = proposedScenes($id, $sc);
				if($proposed != 0){
					echo "
				<h3 class=\"h3 mt20 pt20 btg\">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					echo "Proposed scenes";
				}
				else{
					echo "Scènes proposées";
				}
				echo "</h3>
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
								$the_url = '<a href="scenes-'.$proposed_o['id'].'-'.reecUrl($proposed_o['Title']).'-'.$proposed_o['idstory'].'.html#read" class="clickthis multi click_to_read_this" rel="'.$proposed_o['id'].'">&rarr;';
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$the_url .= "Read scene";
								}
								else{
									$the_url .= "Lire la scène";
								}
								$the_url .= '</a>';
							}
						}
						echo "
					<div class=\"one_scene\">
						<span class=\"one_scene_inner\">
							<h3 class=\"h3\">".$title."</h3>
							<span>Created ".date("jS F Y", strtotime($proposed_o['DateCreate']))."<br>By ".stripslashes(htmlspecialchars_decode($proposed_o['scene_writer']))."</span>
							<p>".utf8_encode(shorten($proposed_o['Text'],90))."</p>
							".$the_url."
						</span>
					</div>";
					}
					echo "
				</div>";
				}
				
				if($user['Account'] == 'Power'){
					echo "
				<div class=\"w100p txtcenter\">
					<a href=\"propose-your-nextscenes-".$story['latest_scene']."-".reecUrl($story['Title'])."-".$id.".html\" class=\"clickthis multi block\">&rarr; ";
					if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
						echo "Propose your scene";
					}
					else{
						echo "Proposer votre scène";
					}
					echo "
					</a>
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