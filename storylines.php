<?php
	require "central/functions.php"; 
	$page = "storylines";
	$pager = $_GET['page'];
	$id = $_GET['id'];
	$forumName = forumName($id);
	$cstory = countForumStories($id);
	$story = getForumStories($id, $pager);
	$user = getUser();
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $forumName['f_name']; ?> Storylines</title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $forumName['f_name']; ?> Storylines</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
            	<?php
					foreach ($story as $story_o){
						if(($story_o['sl_img'] != "0") && ($story_o['sl_img'] != "")){ 
							$image = "<img src=\"pictures/".$story_o['sl_img']."\" alt=\"\" class=\"w100p\">";
						}
						else{
							$image = "<img src=\"pictures/avatar.jpg\" alt=\"\" class=\"w100p\">"; 
						}
						
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
						if($story_o['sl_views'] == 1){
							$views = "1 view";
						}
						else{
							$views = number_format($story_o['sl_views'])." views";
						}
						if(empty($_SESSION['idsession'])){
							$the_url = "<a style=\"display:none;\" href=\"login\" class=\"clickthis multi\">&rarr; ";
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
								 $the_url = '<a href="/'.custom_site_base().'read-'.urlThis($story_o['sl_name']).'-'.$story_o['sl_id'].'" class="clickthis multi">&rarr; ';
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$the_url .= "View scenes";
								}
								else{
									$the_url .= "Voir scènes";
								}
								$the_url .= '</a>';
							}
						}
						$imgstylex = getImgStyle("avatars/".$story_o['u_avatar']);
						if(!empty($scene['u_avatar'])){
							$avatar = "<img src=\"avatars/".$story_o['u_avatar']."\"/>";
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
						<a href=\"".custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id']."\"><h3 class=\"h3\">".utf8_encode(stripslashes(htmlspecialchars_decode($story_o['sl_name'])))."</h3></a>
						<div class=\"avatar_holder avatar_small_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By <strong>".stripslashes(htmlspecialchars_decode($story_o['u_username']))."</strong> <font style='color:#F00;'>| ".$vscenes." | ".$pscenes." | ".$views." | Created ".date("jS F Y", strtotime($story_o['sl_ts']))."</font>
							</div>
						</div>
						<div class=\"clear\"></div>";
                            echo utf8_encode($scene['sl_desc']);
							echo "<div>".utf8_encode(shorten($story_o['sl_desc'],180))."</div>".$the_url."</div></div>";
						}
					?></div>
					</div>
				</div>
            </div>
        </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
</body>
</html>