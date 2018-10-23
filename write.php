<?php
session_start();
if(empty($_SESSION['idsession'])) {
		header("Location: login");
}
	require "central/functions.php"; 
	$page = "propose";
	$id = $_GET['id'];
	$scenes = getLatestVScene($id);
	$user = getUser();
	if(isset($_POST['submit'])){
		if($_POST['nextscenes'] == "" || $_POST['nextscenes'] == NULL){
			if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
				$mmsg = "Please write your scene before submitting.";
			}
			else{
				$mmsg = "S'il vous plaît écrire votre scène avant de soumettre.";
			}
		}
		else{
			$response = writeScene($id, $user, nl2br(utf8_encode($_POST['nextscenes'])));
			if($response == 1){
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$mmsg = "Your scene has been successfully submitted";	
				}
				else{
					$mmsg = "Votre scène a été soumis avec succès";
				}
			}
			else{
				if($response == 2){
					if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
						$mmsg = "Your scene has previously been submitted";
					}
					else{
						$mmsg = "Votre scène a déjà été soumis";
					}
				}
				else{
					if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
						$mmsg = "Something seems to have gone wrong.<br>Please try again later.";
					}
					else{
						$mmsg = "Quelque chose semble avoir mal tourné. <br> S'il vous plaît réessayer plus tard";
					}
				}
			}
		}
	}
	else{
		if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$mmsg = "Write your scene";
		}
		else{
			$mmsg = "Écrivez votre scène";
		}
	}?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<!--<meta http-equiv="content-type" content="text/html;charset=UTF-8" />-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Propose The Next Scene</title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Propose The Next Scene</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
            	<?php
				
				if($user['c_usertypes_ut_id'] == '2'){
					echo "
				<div class=\"w100p\" id=\"write_your_own_scene\">
					<h3 class=\"h3 clear pt20 pb10\">".$mmsg."</h3>
					<form method=\"post\" action=\"/".custom_site_base()."write-".$id."#write_your_own_scene\">
						<textarea id=\"nextscenes\"  onKeyUp=\"textCount(this)\" onKeyDown=\"textCount(this)\" name=\"nextscenes\" placeholder=\"Write your next scene\"></textarea>
						<!-- <p id=\"mon_compteur\">0 words/500</p> -->
						<span id=\"countdata\"></span>
						<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" class=\"c_btn mt10\">
					</form>
				</div>";
				}
				
					echo "					
                <div class=\"w100p courrier relative this_is_the_text\">
                	<div class=\"c_3mm\"></div>
                	<div class=\"c_2mm\"></div>
                	<div class=\"c_1mm\"></div>
                    <fieldset class=\"relative\">
                        <legend>Last validated scene</legend>";
						$imgstylex = getImgStyle("avatars/".$scenes['u_avatar']);
						if(!empty($scenes['avatar'])){
							$avatar = "<img src=\"avatars/".$scenes['u_avatar']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}
                        echo utf8_encode($scenes['vs_desc'])."
						<div class=\"avatar_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($scenes['u_username']))."</span>
							</div>
						</div>
						<div class=\"clear\"></div>
                    </fieldset>
                </div>";				
				if($scenes['View'] == 1){
					$views = "1 view";
				}
				else{
					$views = number_format($scenes['sl_views'])." views";
				}
				$the_url = '<a href="/'.custom_site_base().'storylines-'.urlencode(stripslashes(utf8_encode(htmlspecialchars_decode(strtolower($scenes['f_name']))))).'-'.$scenes['f_id'].'">'.stripslashes($scenes['f_name']).'</a>';
				echo "
				<div class=\"c_view\">
					<span>".$views." | ".$the_url." | Created ".date("jS F Y", strtotime($scenes['vs_ts']))."
				</div>";
				
				// Old Write Location
				?></div>
					</div>
				</div></div>
            </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   bkLib.onDomLoaded(function() {
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  }); 
});
function textCount(limitCount) {
		var limitcount;
		limitcount = limitCount.value.length;
		document.getElementById('countdata').innerHTML = limitcount
		
		if (limitcount >= 350) {
			document.getElementById('post').disabled  = false;
		} else {
			document.getElementById('post').disabled  = true;
		}
}
</script>
</body>
</html>