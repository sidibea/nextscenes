<?php
session_start();
function clean($str){
	$string = mysql_real_escape_string($str);
	$string = str_replace("&nbsp;", " ", $string);
	return $string;
}
if(empty($_SESSION['idsession'])) {
	header("Location: login1");
}
	require "central/fr_functions.php"; 
	$slug = clean($_REQUEST['slug']);
	updateSelfStory($slug);
	$row = getSinglePosts($slug);
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $row['topic'];?></title>
<link rel="stylesheet" href="unslider/dist/css/unslider.css" />
<link rel="stylesheet" href="unslider/dist/css/unslider-dots.css" />
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">
				<fieldset>
					<legend><?php echo $result3[52][$lang.'_title']; ?></legend>
					<?php 
						$data = is_array($row['author']) ? implode(',', $row['author']) : $row['author'];
						$mk = "SELECT * FROM c_users WHERE u_id IN (".$data.")";
						$query1 = query($mk);
						while($row1 = fetch_array($query1)){
							echo "&bull; ".$row1['u_fname']." ".$row1['u_lastname']."<br />";
						}
					?>
				</fieldset>
            	<fieldset>
					<legend><?php echo $row['topic'];?></legend>
					<?php echo $row['content'];?>
					<div style="height:15px;"></div>
				</fieldset>
				<?php
					$cimp = $row['id'];
					$sql = query("SELECT * FROM c_topic_scenes WHERE c_id=\"$cimp\"");
					if(num_rows($sql)>0){
						while($rows = fetch_array($sql)){?>
							<fieldset>
								<legend>Scene <?php echo $rows['scene'];?></legend>
								<?php echo str_replace("&nbsp;", " ", $rows['content']);?>
							</fieldset>
						<?php }
					}
				?>
				<?php $HiddenProducts = explode(',', $row['author']);
						if (in_array($id, $HiddenProducts) && $row['status'] == 1) {?>
				<fieldset id="commentbox">
					<legend><?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Write Or Request Your NextScene";
					}
				else{
					echo "Ecrivez ou demandez votre prochaine scène";
				}?></legend>
					<?php required(); failed(); success(); length();?>
					<form action="mint.php?action=newscene&id=<?php echo $row['id'];?>" method="post" class="e-form">
						<textarea name="content"></textarea>
						<div style="height:5px;"></div>
						<input type="hidden" name="line" value="<?php echo $slug;?>" />
						<input type="submit" name="submitPost" class="c_btn mt10" value="Publish Your NextScene" /><?php if($row['mode'] == 2){}else{?> Need help from other users? <a href="mint.php?action=requestcontribute&id=<?php echo $row['id'];?>" data-toggle="tooltip" data-placement="auto" title="Note that by clicking this link, you approve that other users can contribute to your story but would be active only if you approve it as your next scene">Request here</a><?php }?>
					</form>
				</fieldset>
				<?php if($row['edit'] == 1){?>
				<fieldset id="commentbox">
					<legend><?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Contributions For The NextScene";
					}
				else{
					echo "Contributions pour la scène suivante";
				}?></legend>
					<div class="my-slider">
						<ul>
							<li>
								<?php $query = query("SELECT * FROM c_contribute WHERE tid=\"".$row['id']."\" && status=0");
									if($query){
									$s = 1;
										while($cont = fetch_array($query)){
										echo "<div class='col-md-4 col-sm-4 col-xs-12'><strong data-target=\"#myModal".$s."\" data-toggle=\"modal\" data-backdrop=\"false\" style=\"cursor:pointer;\">".substr($cont['content'],0,150)."</strong></div>";?>
										<div id="myModal<?php echo $s;?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Contribution</h4>
													</div>
													<div class="modal-body">
														<p><?php echo str_replace("&nbsp;", " ", $cont['content']);?></p>
													</div>
													<div class="modal-footer">
														<a href="mint.php?action=approvescene&id=<?php echo $cont['id'];?>&tid=<?php echo $row['id'];?>&author=<?php echo $cont['credit'];?>&link=<?php echo $slug;?>">Approve As NextScene</a> &bull; 
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<?php if($s % 3 == 0){?>
										<div class="clearfix"></div>
											</li><li>
										<?php }
										$s++;
										}
									}
								?>	
							</li>
						</ul>
						<div style="clear:both;"></div>
					</div>
				</fieldset>
				<?php } }elseif($row['edit'] == 1){?>
				<fieldset id="commentbox">
					<legend<?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Contributions For The NextScene";
					}
				else{
					echo "Contributions pour la scène suivante";
				}?></legend>
					<div class="my-slider">
						<ul>
							<li>
								<?php $query = query("SELECT * FROM c_contribute WHERE tid=\"".$row['id']."\" && status=0");
									if($query){
									$s = 1;
										while($cont = fetch_array($query)){
										echo "<div class='col-md-4 col-sm-4 col-xs-12'><strong data-target=\"#myModal".$s."\" data-toggle=\"modal\" data-backdrop=\"false\" style=\"cursor:pointer;\">".substr($cont['content'],0,150)."</strong></div>";?>
										<div id="myModal<?php echo $s;?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Contribution</h4>
													</div>
													<div class="modal-body">
														<p><?php echo str_replace("&nbsp;", " ", $cont['content']);?></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										<?php if($s % 3 == 0){?>
										<div class="clearfix"></div>
											</li><li>
										<?php }
										$s++;
										}
									}
								?>	
							</li>
						</ul>
						<div style="clear:both;"></div>
					</div>
				</fieldset>
				<fieldset id="commentbox">
					<legend><?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Write Your Contribution Below";
					}
				else{
					echo "Écrivez votre contribution ci-dessous";
				}?></legend>
					<?php required(); failed(); success(); length();?>
					<form action="mint.php?action=newcontribution" method="post" class="e-form">
						<div class="c_label"><?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Write Your Contribution Here:";
					}
				else{
					echo "Écrivez votre contribution ici:";
				}?></div>
						<div style="height:5px;"></div>
						<textarea name="content" id="ccont"><?php echo $_SESSION['content']; $_SESSION['content'] = false;?></textarea>
						<div style="height:5px;"></div>
						<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
						<input type="hidden" name="url" value="story-<?php echo $slug;?>" />
						<input type="submit" name="submitPost" class="c_btn mt10" value="Contribute" />
					</form>
				</fieldset>
				<?php }?>
				<fieldset>
					<legend><?php	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
						echo "Share With Your Friends By Clicking On The Share Buttons";
					}
				else{
					echo "Partagez avec vos amis en cliquant sur les boutons de partage";
				}?></legend>
						<div id="fb-root"></div>
					  <script>(function(d, s, id) {
					  var js, fjs =  d.getElementsByTagName(s)[0];
					  if  (d.getElementById(id)) return;
					  js =  d.createElement(s); js.id = id;
					  js.src =  "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
					  fjs.parentNode.insertBefore(js, fjs);
					  }(document, 'script', 'facebook-jssdk'));</script>
					  <script type="text/javascript">var switchTo5x=true;</script>
						<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "3fb9af65-2b85-4da7-a395-bff81db19307", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_googleplus_hcount' displayText='Google +'></span>
						<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
						<span class='st_instagram_hcount' displayText='Instagram Badge'></span>
						<span class='st_netlog_hcount' displayText='Netlog'></span>
						<span class='st_plusone_hcount' displayText='Google +1'></span>
						<span class='st_fblike_hcount' displayText='Facebook Like'></span>
						<span class='st_print_hcount' displayText='Print'></span>
						<span class='st_messenger_hcount' displayText='Messenger'></span>
						<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						<span class='st_google_hcount' displayText='Google'></span>
						<span class='st_email_hcount' displayText='Email'></span>
						<div class="fb-comments"  data-href="<?php echo "http://www.nextscenes.com/story1-".$slug;?>" data-width="740" data-numposts="5"></div>
				</fieldset>
			</div>
			</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
<script type="text/javascript" src="nicEdit.js"></script>
<script src="unslider/src/js/unslider.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   bkLib.onDomLoaded(function() {
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  });
	$('.my-slider').unslider({
		animation: 'vertical',
		infinite: true
	});
});
</script>
</body>
</html>