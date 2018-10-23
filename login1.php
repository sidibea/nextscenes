<?php
session_start(); 
if(!empty($_SESSION['idsession'])) {
		header("Location: forum");
}
	require "central/fr_functions.php"; 
	$page = "login";
	
	$fb = new Facebook\Facebook([
		'app_id' => '1704390496495535', // Replace {app-id} with your app id
		'app_secret' => 'b7d8f95639f53824fc040664e126da01',
		'default_graph_version' => 'v2.5',
	]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['public_profile, email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('https://nextscenes.com/login-callback.php', $permissions);
	
	if (isset($_POST['submit']) && !empty($_POST['username']) and !empty($_POST['password'])) {	
		$pass= sha1($_POST['password'].salt());	
		$query = "SELECT * FROM c_users WHERE (u_username='".mysql_real_escape_string($_POST['username'])."'
			OR u_email='$_POST[username]') AND u_pass = '".mysql_real_escape_string($pass)."'";
		//echo $query;
		//die();
		$ref = $_POST['ref'];
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			if($_SESSION['language'] == "en"){
				$erreur = 'The username or password you entered is incorrect';
			} else {
				$erreur = 'Le nom d\'utilisateur ou le mot de passe que vous avez tapé est incorrect';
			}
			
		}
		else { 
			$answer = mysql_fetch_assoc($result);
			$idsession = $answer['u_id']."_".md5(microtime().rand());
			$_SESSION['idsession'] = $idsession;
			$_SESSION['isuser'] = $answer['u_username'];
			if($answer['c_languages_l_id'] == 1){
				$_SESSION['language_session'] = "en";
			}
			else{
				$_SESSION['language_session'] = "fr";
			}
			$updq = "UPDATE c_users SET u_session='".$idsession."', 
					u_ip= '".$_SERVER['REMOTE_ADDR']."',
					u_lastvisit='".date("Y-m-d H:i:s")."'
					WHERE u_username='".mysql_real_escape_string($_POST['username'])."' or u_email='$_POST[username]'";
			$uodr = mysql_query($updq, $db_auth);
			if(empty($ref)){
				header('Location: /forum');
			}else{
				header("location: $ref");
			}
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[17][$lang.'_title']; ?></title>
<?php include("fr_head.php");?> 
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2"> 
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[17][$lang.'_title']; ?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
            	<?php
					if($_SESSION['reg'] == "success"){
						$erreur = "You have successfully registered on ".siteName().".<br />Please log in below to get started:";
						unset($_SESSION['reg']);
					}
					if($erreur != ""){
						echo "<h2 class=\"c_alert\">".$erreur."</h2>";
						$erreur = "";  
					}
				?>
				
                <form action="" class="formular" id="captchaform" method="post" name="captchaform">
                    <fieldset>
                        <legend><?php
						if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
							echo "Login to your account";
						}
						else{
							echo "Connectez-vous à votre compte";
						}
						?></legend>
						<p><h4>
						 <?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Enter Username/Email and Password";
								}
								else{
									echo "Entrer votre Nom d'utilisateur/Email et Mot de passe";
								}
								?>
						
						</h4></p>
						<br />
                        <div class="spacer">
                            <div class="c_label">
                                 <?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Username/Email <br />";
								}
								else{
									echo "Nom d'utilisateur/Email";
								}
								?>
                            </div>
							<br />
                            <div class="c_input">
                                <input name="username" type="text" value="<?php if (isset($_POST['username'])) echo stripslashes(htmlentities(trim($_POST['username']))); ?>" required />
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Password";
								}
								else{
									echo "Mot de passe";
								}
								?>
                            </div>
							<br />
                            <div class="c_input">
                                <input name="password" type="password" required />
                            </div>
                        </div>
                        <div class="spacer">
							<?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
									 <div class="c_label">
										<input type="hidden" name="ref" value="<?php echo $_SERVER['HTTP_REFERER'];?>">
										<input name="submit" type="submit" value="Login" class="c_btn">
									</div>
								<?php }
								else{ ?>
									<div class="c_label">
										<input type="hidden" name="ref" value="<?php echo $_SERVER['HTTP_REFERER'];?>">
										<input name="submit" type="submit" value="Connexion" class="c_btn">
									</div>
								<?php }
								?>
                           
							<br />
							<br />
							<p>
							<?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Login with: ";
								}
								else{
									echo "Se connecter avec:";
								}
								?>
							<br />
                            <div style="dsiplay: none;" class="c_label">
								<input name="submit" type="button" value="Facebook" onclick="FBLogin();" class="c_btn_fb">
								<!--<a href="login-callback.php" class="c_btn_fb">Facebook</a>-->
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="c_label">
								<input name="submit" type="button" value="Google+" onclick="GoogleLogin();" class="c_btn_google">
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="c_label">
								<input name="submit" onclick="LinkedInLogin();" type="button" value="LinkedIn" class="c_btn_linkedin">
							</div>
							
							</p>
                        </div>
                        <div class="mt10 pt10 btg">
                        	<p>
							<?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
								<a href="/reset1"> <?php
									echo "Forgot Password ?"; ?>
									</a>
								<?php }
								else{ ?>
									<a href="/reset1"> <?php
									echo "Mot de passe oublié ?"; ?>
									</a>
								<?php }
								?>
							</p>
							<br />&nbsp;&nbsp;&nbsp;
							<p>
							<?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "New Member ? ";
								}
								else{
									echo "Nouveau membre ?";
								}
								?>
							
							
							&nbsp;&nbsp;
							<?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
								<a href="/register"> <?php
									echo "Sign Up Here ? "; ?>
									</a>
								<?php }
								else{ ?>
									<a href="/register1"> <?php
									echo "Créer un compte"; ?>
									</a>
								<?php }
								?>
							</p>
                        	<?php
							echo "
							<!--<a href='".htmlspecialchars($loginUrl)."' class=\"c_btn\">Log in with Facebook</a>-->";
							?>
                        </div>
                	</fieldset>
                </form></div>
					</div>
				</div>
            </div>
        </div>
			<?php echo side2();?>
		</div>
	</div>
		
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>