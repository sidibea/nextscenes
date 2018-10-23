<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "propose";
	$id = $_GET['id'];
	$sc = $_GET['sc'];
	$scenes = getLatestVScene($id, $sc);
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
			$response = writeScene($id, $sc, $user['Login'], utf8_encode($_POST['nextscenes']));
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
	}
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
					echo "
                <div class=\"w100p courrier relative this_is_the_text\">
                	<div class=\"c_3mm\"></div>
                	<div class=\"c_2mm\"></div>
                	<div class=\"c_1mm\"></div>
                    <fieldset class=\"relative\">
                        <legend>Last validated scene</legend>";
						$imgstylex = getImgStyle("avatars/".$scenes['avatar']);
						if(!empty($scenes['avatar'])){
							$avatar = "<img src=\"avatars/".$scenes['avatar']."\"/>";
						}
						else{
							$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
						}
                        echo utf8_encode($scenes['Text'])."
						<div class=\"avatar_holder mt10 right\">
							<div class=\"avatar_holder_main\">
								<div class=\"c_avatar ".$imgstylex."\">
									".$avatar."
								</div>
							</div>
							<div class=\"avatar_text\">
								By ".stripslashes(htmlspecialchars_decode($scenes['Login']))."</span>
							</div>
						</div>
						<div class=\"clear\"></div>
                    </fieldset>
                </div>";				
				if($scenes['View'] == 1){
					$views = "1 view";
				}
				else{
					$views = number_format($scenes['View'])." views";
				}
				$the_url = "<a href=\"storylines-".reecUrl($scenes['forum_name'])."-".$scenes['IdForum'].".html\">".$scenes['forum_name']."</a>";
				echo "
				<div class=\"c_view\">
					<span>".$views." | ".$the_url." | Created ".date("jS F Y", strtotime($scenes['Date']))."
				</div>";
				
				if($user['Account'] == 'Power'){
					echo "
				<div class=\"w100p\" id=\"write_your_own_scene\">
					<h3 class=\"h3 clear pt20 pb10\">".$mmsg."</h3>
					<form method=\"post\" action=\"\">
						<textarea name=\"nextscenes\" placeholder=\"Write your next scene\" class=\"write_scene\" ></textarea>
						<p id=\"mon_compteur\">0 words/500</p>
						<input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" class=\"c_btn mt10\">
					</form>
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