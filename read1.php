<?php
session_start();
if(empty($_SESSION['idsession'])) {
	header("Location: login1");
}
	require "central/fr_functions.php"; 
	include('Encoding.php');
	$page = "scene";
	$id = $_GET['id'];
	$sc = $_GET['sc'];
	updateStorylineViews($id);
	$story = getStory($id);
	$forumName = forumName($story['c_forums_f_id']);
	$scenes = getVScenes($id, $sc);
	$user = getUser();
	$prop= getProposedScene($_GET['sc'], $user);
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo utf8_encode($prop['sl_name']); echo utf8_encode($story['sl_name']); echo $scene['f_name'];?></title>
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			
							<div class="herald-mod-wrap">
			<div class="herald-mod-head herald-cat-2"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $forumName['f_name']; ?></h2></div></div></div>
			
			<div class="row">
            	<?php
				// Proposed Scene
				if(isset($_GET['sc']) && is_numeric($_GET['sc'])){
					$proposed = getProposedScene($_GET['sc'], $user);
					$data = "
					<div class=\"w100p courrier relative this_is_the_text\">
						<div class=\"c_3mm\"></div>
						<div class=\"c_2mm\"></div>
						<div class=\"c_1mm\"></div>
						<fieldset class=\"relative\">
							<legend>";
								$data .= utf8_encode($proposed['sl_name'])." - <strong>[Proposed]</strong> scene ".$proposed['ps_scene'];
							$data .= "
							</legend>";
							$imgstylex = getImgStyle("avatars/".$proposed['u_avatar']);
							if($proposed['scene_rating'] == NULL){
								$rating_score = "0";
							}
							else{
								$rating_score = number_format(($proposed['scene_rating']/2), 2, '.', '');
							}
							if($proposed['scene_votes'] == NULL){
								$rating_count = "<span class=\"the_scene_rating_figure\">0</span> votes";
							}
							else{
								$rating_count = $proposed['scene_votes'];
								if($rating_count == 1){
									$rating_count = "<span class=\"the_scene_rating_figure\">1</span> vote";
								}
								else{
									$rating_count = "<span class=\"the_scene_rating_figure\">".number_format($rating_count)."</span> votes";
								}
							}
							if(!empty($proposed['u_avatar'])){
								$avatar = "<img src=\"".$proposed['u_avatar']."\"/>";
							}
							else{
								$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
							}
							if($proposed['user_self_reviews'] == 0){
								$self_rated = 0;
							}
							else{
								$self_rated = $proposed['user_self_reviews'];
							}
							$data .= utf8_encode($proposed['ps_desc'])."
							<div class=\"avatar_holder mt10 right\">
								<div class=\"avatar_holder_main\">
									<div class=\"c_avatar ".$imgstylex."\">
										".$avatar."
									</div>
								</div>
								<div class=\"avatar_text\">
									By ".stripslashes(htmlspecialchars_decode($proposed['u_username']))."
								</div>
							</div>
						</fieldset>
						<!-- Rate Block -->
					</div>";
					$comments = getPostComments($_GET['sc'], $user['u_id']);
					
					if(isset($_POST['sendrate']) && $_POST['sendrate'] == "yes") {
						$rate = $_POST['rate'];
						$url = $_SERVER['REQUEST_URI'];
						$user = $user['u_id'];
						$q = "INSERT INTO `proposedrating` (`rateval`,`url`,`user`) VALUES ('$rate','$url','$user')";
						$qry = mysql_query($q, $db_auth) or die("MYSQL ERROR: ". mysql_error($db_auth));
					} 
					
					// Get Rating
					$ratingsql = "SELECT SUM(*) total FROM `proposedrating`";
					$getqry = mysql_query($ratingsql, $db_auth);
					$rating = $getqry['total'] / 5;
					
					// Check Rating
					$csql = "SELECT id FROM `proposedrating`";
						$ee = explode('_', mysql_real_escape_string($user['u_id']));
						$data .= "
						<div class=\"note\" id=\"note\"></div>
					<div class='movie_choice'>
						Rate: ".utf8_encode($proposed['sl_name'])." - <strong>[Proposed]</strong> scene ".$proposed['ps_scene']."<span> <a href=\"how-nextscenes-works#howto\" target=\"_blank\">How Rating Works?</a></span>
						<div id=\"r1\" class=\"rate_widget\">
							<div class=\"star_1 ratings_stars\" id=\"1\"></div>
							<div class=\"star_2 ratings_stars\" id=\"2\"></div>
							<div class=\"star_3 ratings_stars\" id=\"3\"></div>
							<div class=\"star_4 ratings_stars\" id=\"4\"></div>
							<div class=\"star_5 ratings_stars\" id=\"5\"></div>
							<input type=\"hidden\" class=\"rscene\" value=\"".$id."\" />
							<input type=\"hidden\" class=\"usrID\" value=\"".$ee[0]."\" />
							<input type=\"hidden\" class=\"pscene\" value=\"".$sc."\" />
							<div class=\"total_votes\">".getUnit1Rating($id, $sc)."</div>
						</div>
					</div>
					<div class=\"proposed_scene_comments\">";
					
					if($comments != 0){
						$data .=" 
						
					<h1 class=\"comments_h1\">Comments</h1>";
						foreach($comments as $comments_o){
							if($comments_o['ra_rating'] == 0 || $comments_o['ra_rating'] == NULL){
								$comment_rating_score = 0;
							}
							else{
								$comment_rating_score = $comments_o['ra_rating'];
							}
							$imgstylex = getImgStyle("avatars/".$comments_o['u_avatar']);
							if(!empty($comments_o['u_avatar'])){
								$avatar = "<img src=\"avatars/".$comments_o['u_avatar']."\"/>";
							}
							else{
								$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
							}
						$data .= "
						<div class=\"contributor_comment"; if($comments_o['comment_owner'] == "self"){$data .= " contributor_is_self";} $data .= "\">
							<div class=\"t\">
								<div class=\"tc\">
									<div class=\"rate_widget_display\">
										<div class=\"clear mtb5\">";
										$i = 0;
										if($comment_rating_score != 0){
											for ($x = 1; $x <= $comment_rating_score; $x++) {
												if($i == 0){
													$data .= "
											<div class=\"max35\">
												<svg class=\"icon\" viewBox=\"0 0 35 35\">
													<g id=\"half-star\">";
													$there_open_tag = TRUE;
												}
													if($x%2){
														$odd = TRUE;
													}
													else{
														$odd = FALSE;
													}
													if($odd == 1){
														$data .= "
														<polygon fill=\"#ff9511\" points=\"11.547,10.918 0,12.118 8.822,19.867 6.127,31.4 16,25.325 16,0.66\"/>											";
														if($x == $comment_rating_score){
															$data .= "
														<polygon fill=\"#d3d3d3\" points=\"32,12.118 20.389,10.918 16.026,0.6 16,0.66 16,25.325 16.021,25.312 25.914,31.4 23.266,19.867\"/>";
														}
													}
													else{
														$data .= "
														<polygon fill=\"#ff9511\" points=\"32,12.118 20.389,10.918 16.026,0.6 16,0.66 16,25.325 16.021,25.312 25.914,31.4 23.266,19.867\"/>";
													}
												if($i != 0 && $i%2){
													$data .= "
													</g>
												</svg>
											</div>";
													$there_open_tag = FALSE;
												}
												if($x != $comment_rating_score){
													if($i%2){
														$there_open_tag = TRUE;
														$data .= "
											<div class=\"max35\">
												<svg class=\"icon\" viewBox=\"0 0 35 35\">
													<g id=\"half-star\">";
													}
												}
												$i++;
											}
										}
										if($there_open_tag == TRUE){
											$data .= "
													</g>
												</svg>
											</div>";
										}
										$data .= "	
											<div class=\"clear\"></div>
										</div>
										<div class=\"avatar_holder mt5\">
											<div class=\"avatar_holder_main\">
												<div class=\"c_avatar ".$imgstylex."\">
													".$avatar."
												</div>
											</div>
											<div class=\"avatar_text\">
												".stripslashes(htmlspecialchars_decode($comments_o['comment_writer']))."
											</div>
										</div>
										<div class=\"clear\"></div>
									</div>
								</div>
								<div class=\"tc\">
									<div class=\"comment_body\">
										".stripslashes(utf8_encode(htmlspecialchars_decode($comments_o['ra_comment'])))."
									</div>
								</div>
							</div>
						</div>";
						}
					}
						$data .= "
					</div>";
				}
				
				
				echo "
				<div class=\"read_proposed_posts clear\" id=\"proposed_scenes_loader\">".$data."</div>
				<div class=\"addthis_sharing_toolbox\" addthis:title=\"".utf8_encode($story['sl_name'])."\"></div>
				";
				
				// Original Scene
				foreach($scenes as $scene) {
					 //echo '<a href="/'.custom_site_base().'storylines-'.urlThis($scene['f_name']).'-'.$scene['f_id'].'">' . ">" . utf8_encode($scene['sl_name']);
					 echo '<br />';
					 echo "<p><h2>".utf8_encode($scene['sl_name'])."</h2></p>"; // Story Title
				?>
				<br />
				<br />
				<?php $pageurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
				<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
								echo "Share on: ";
							}
							else{
								echo "Partager sur:";
							}
					
				?>
				
				<a class="social social_fb" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1907672512793214&amp;display=popup&amp;caption=<?php echo $scene['sl_name']; ?>&amp;link=<?php echo urlencode($pageurl) ?>&amp;redirect_uri=<?php echo urlencode($pageurl) ?>" title="Share on Facebook">Facebook</a>
				
				<a class="social social_tw" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $scene['sl_name']; ?>&url=<?php echo urlencode($pageurl) ?>&via=nextscenes" title="Share on Twitter">Twitter</a>
				
				<a class="social social_gp" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($pageurl) ?>" title="Share on Gplus">Google+</a>
				
				<a class="social social_li" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageurl) ?>&title=Nextscenes&summary=&source=" title="Network with us on Linkedin">Linkedin</a>
				
				
				<?php
				   
					echo "
                <div class=\"w100p courrier relative this_is_the_text\">
                    <fieldset class=\"relative noselect\">
                        <legend>";
							if($scene['scene_type'] == 'valid'){
								echo " Scene ".$scene['vs_scene'];
							}
							else{
								echo "".utf8_encode($scene['sl_name'])." - <strong>[Proposed]</strong> scene ".$scene['vs_scene'];
							}							
						echo "
						</legend>";
						$imgstylex = getImgStyle("".$scene['u_avatar']);
						if(!empty($scene['u_avatar'])){
							$avatar = "<img src=\"".$scene['u_avatar']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}
                        echo Encoding::fixUTF8($scene['vs_desc'])." 
						<div class=\"avatar_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($scene['u_username']))."
							</div>
						</div>
						<div class=\"clear\"></div>
                    </fieldset>
                </div>";				
				if($scene['sl_views'] == 1){
					$views = "1 view";
				}
				else{
					$views = number_format($scene['sl_views'])." views";
				}
				$the_url = '<a href="/'.custom_site_base().'storylines-'.urlThis($scene['f_name']).'-'.$scene['f_id'].'">'.stripslashes($scene['f_name']).'</a>';
				echo "
				<div class=\"c_view\">
					<span>".$views." | ".$the_url." | Created ".date("jS F Y", strtotime($scene['vs_ts']))."
				</div>";
				?>
				<a class="social social_fb" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1907672512793214&amp;display=popup&amp;caption=<?php echo $scene['sl_name']; ?>&amp;link=<?php echo urlencode($pageurl) ?>&amp;redirect_uri=<?php echo urlencode($pageurl) ?>" title="Share on Facebook">Facebook</a>
				<a class="social social_tw" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $scene['sl_name']; ?>&url=<?php echo urlencode($pageurl) ?>&via=nextscenes" title="Share on Twitter">Twitter</a>
				<a class="social social_gp" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($pageurl) ?>" title="Share on Gplus">Google+</a>
				<a class="social social_li" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageurl) ?>&title=Nextscenes&summary=&source=" title="Network with us on Linkedin">Linkedin</a>
				<div class="fb-comments" data-href="<?php echo $pageurl; ?>" data-numposts="6"></div>
				<?php
				}
				// Proposed Scene
				$proposed = proposedScenes($id, $sc);
				if($proposed != 0){
					if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
							 echo "<h3 class=\"h3 mt20 pt20 btg\">Proposed scenes</h3>";
							}
							else{
								echo "<h3 class=\"h3 mt20 pt20 btg\">scènes proposées</h3>";
							}
					
				echo "<div class=\"extra_scenes\">";
				$count = 0;
					foreach($proposed as $proposed_o){
					$count++;
						$title = stripslashes(htmlspecialchars_decode($proposed_o['sl_name']))." - <strong>[Proposed]</strong> scene ".$proposed_o['ps_scene'];
						if($proposed_o['sl_views'] == 1){
							$views = "1 view";
						}else{
							$views = number_format($proposed_o['sl_views'])." views";
						}
						if(empty($_SESSION['idsession'])){
							$the_url = " <a href=\"login\" class=\"clickthis multi\">&rarr; Enter forum</a>";
						}else{
							if($story_o['storylines']=='0'){ 
								$the_url = '<a href="#" class="clickthis multi">Inactive scene</a> ';
							}else{
								$the_url = '<a href="/'.custom_site_base().'readscene1-'.urlThis($proposed_o['sl_name']).'-'.$proposed_o['sl_id'].'-'.$proposed_o['ps_id'].'" class="clickthis multi" rel="'.$proposed_o['ps_id'].'">&rarr;'.$result3[9][$lang."_title"].'</a>';
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
				if($user['c_usertypes_ut_id'] == 2){
					if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
								echo "
				<div class=\"w100p txtcenter\">
					<a href=\"write1-".$story['sl_id']."\" class=\"clickthis multi block\">&rarr; Propose your scene</a></div>";
							}
							else{
								echo "
				<div class=\"w100p txtcenter\">
					<a href=\"write1-".$story['sl_id']."\" class=\"clickthis multi block\">&rarr; Proposez votre scène</a></div>";
							}
					
				}?></div>
				</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" />
<script>
$(document).ready(function(e){
	$('.bxslider').bxSlider({
	  mode: 'slide'
});
});
</script>
</body>
</html>