<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "storylines";
	echo common_top($page);
?>
<?php
	$id = $_GET['id'];
	$page = $_GET['page'];
	$forumName = forumName($id);
	$cstory = countForumStories($id);
	$story = getForumStories($id, $page);
	$user = getUser();
?>
<?php
	echo topNav($page);
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
            	<h3 class="h3"><?php echo $forumName['Title']; ?> Storylines</h3>
            	<?php
					foreach ($story as $story_o){
						$image = "<img src=\"pictures/avatar.jpg\" alt=\"\" class=\"w100p\">";
						if($story_o['validated_scenes_count'] == 1){
							$vscenes = "1 scene";
						}
						else{
							$vscenes = number_format($story_o['validated_scenes_count'])." scenes";
						}
						if($story_o['proposed_scenes_count'] == 1){
							$pscenes = "1 proposed scene";
						}
						else{
							$pscenes = number_format($story_o['proposed_scenes_count'])." proposed scenes";
						}
						if($story_o['View'] == 1){
							$views = "1 view";
						}
						else{
							$views = number_format($story_o['View'])." views";
						}
						if(empty($_SESSION['idsession'])){
							$the_url = " <a href=\"connect.html\" class=\"clickthis multi\">&rarr; ";
							if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
								$the_url .= "Enter Forum";
							}
							else{
								$the_url .= "Entrez Forum";
							}
							$the_url .= "</a>";
						}
						else {
							if($story_o['storylines']=='0'){ 
								$the_url = '<a href="#" class="clickthis multi">';
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$the_url .= "Inactive Storyline";
								}
								else{
									$the_url .= "Inactif Histoire";
								}
								$the_url .= '</a> ';
							}
							else {
								$the_url = '<a href="vscenes-'.$story_o['id'].'-'.reecUrl($story_o['Title']).'-'.$story_o['idstory'].'.html" class="clickthis multi mr5">&rarr; ';
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$the_url .= "View scenes";
								}
								else{
									$the_url .= "Voir scènes";
								}
								$the_url .= '</a>';
							}
						}
						$imgstylex = getImgStyle("avatars/".$story_o['avatarr']);
						if(!empty($scene['avatarr'])){
							$avatar = "<img src=\"avatars/".$story_o['avatarr']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}

						echo "
				<div class=\"c_post\">
					<div class=\"img\">
						".$image."
					</div>
					<div class=\"c_view\">
						<h3 class=\"h3\">".utf8_encode(stripslashes(htmlspecialchars_decode($story_o['Title'])))."</h3>
						<div class=\"avatar_holder avatar_small_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($story_o['Login']))."</span>
							</div>
						</div>
						<div class=\"clear\"></div>";
                            echo utf8_encode($scene['Text']);
						
						echo "
						<span>".$vscenes." | ".$pscenes." | ".$views."<br />Created ".date("jS F Y", strtotime($story_o['DateCreate']))."</span>
						<p>".utf8_encode(shorten($story_o['Description'],180))."</p>
						".$the_url."
					</div>
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