<?php
session_start(); 
if(!empty($_SESSION['idsession'])) {
		header("Location: forum");
}
	require "central/fr_functions.php"; 
	$page = "signup";
	require_once('lib/recaptchalib.php');
	$publickey = "6Lf7xAsTAAAAAJjD4eU4cBMh1RgTo6RG1UShxbND";
	if (isset($_POST['submit'])) {
		$privatekey = "6Lf7xAsTAAAAALsIW37MWU4omEqoITpHUwpXk_ag";
		$resp = null;
		$error = null;
		$resp = recaptcha_check_answer (
			$privatekey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]
		);
	
		if($resp->is_valid) {
			if($_POST['login'] == "" || $_POST['login'] == NULL ||
			$_POST['password'] == "" || $_POST['password'] == NULL){
				$erreur = 'The username and password fields cannot be empty.';
			}
			else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])){
				$erreur = "Please enter a valid email address";
			}
			else{
				$pass= sha1($_POST['password'].salt());
				$date = date("Y-m-d");
				$query = "SELECT * FROM c_users WHERE u_username='".mysql_real_escape_string($_POST['login'])."'";
				$result = mysql_query($query, $db_auth); 
				if(mysql_num_rows($result) == 0){
					$query2 = "SELECT * FROM c_users WHERE u_email='".mysql_real_escape_string($_POST['email'])."'";
					$result2 = mysql_query($query2, $db_auth);
					if(mysql_num_rows($result2) > 0){
						$erreur = "You have already registered on ".siteName()." with this email address: ".$_POST['email'];
					}
					else{
						$insq = 'INSERT INTO c_users (u_email,u_pass,u_username,c_usertypes_ut_id,u_avatar, u_fname, u_lastname) 
							VALUES
							("'.mysql_real_escape_string($_POST['email']).'", "'.mysql_real_escape_string($pass).'", "'.mysql_real_escape_string($_POST['login']).'", "'.mysql_real_escape_string($_POST['account']).'", "'.mysql_real_escape_string('avatars/default.png').'", "'.mysql_real_escape_string($_POST['firstname']).'", "'.mysql_real_escape_string($_POST['lastname']).'")'; 
						$insr = mysql_query($insq, $db_auth);
						if(!$insr){
							$erreur = 'Sorry, something seems to have gone wrong.<br>Please try again later.<br>'.$insq;
						}
						else{
							$to= $_POST['email'];
							$subj = 'Welcome to Nextscenes.com';
							$msg = '
							<html> 
							<head> 
							<title>WELCOME NEXTSCENES.COM</title> 
							</head> 
							<body> <center> <img src="http://nextscenes.com/central/next-scenes_logo.jpg" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
							
							<div align=left>
							<h3><font color=#698C00> Hi '.$_POST['login'].', </font></h3>
							We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
							<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
							</div></body> 
							</html>';
							
							$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
							$headers .='Reply-To: info@nextscenes.com'."\n"; 
							$headers .= "MIME-version: 1.0\n";
							$headers .= "Content-type: text/html; charset= iso-8859-1\n";
							mail($to, $subj, $msg, $headers);
							$_SESSION['reg'] = "success";
							header('Location: /login1.php');
							exit;
						}
					}
				}
				else{
					$erreur = 'This username is already taken, please enter another username.';
				}
			}
		}
		else{ 
			$erreur = 'The captcha text entered was incorrect';
			$error = $resp->error;
		}
	}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[18][$lang.'_title']; ?></title>
<?php include("fr_head.php");?> 
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[18][$lang.'_title']; ?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
            	<?php
					if($erreur){
					echo "
				<h2 class=\"c_alert\">".$erreur."</h2>";
					}
				?>
				<fieldset>
				<legend>
					<?php echo $result3[19][$lang.'_title']; ?>
				</legend>
				
				<br />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo  "Login with:";
								}
								else{
									echo  "Connectez-vous avec:";
								}?>
				
				<div class="c_label">
					<input name="submit" type="button" value="Facebook" onclick="FBLogin();" class="c_btn_fb">
				</div>
				<div class="c_label">
					<input name="submit" type="button" value="Google+" onclick="GoogleLogin();" class="c_btn_google">
				</div>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div class="c_label">
					<input name="submit" onclick="LinkedInLogin();" type="button" value="LinkedIn" class="c_btn_linkedin">
				</div>
				<br />
				<br />
				</fieldset>
				
                <form action="" class="formular" id="captchaform" method="post" name="captchaform">
                    <fieldset>
                        <legend><?php
							if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
								echo "Your account information";
							}
							else{
								echo "Vos informations de compte";
							}
						?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                 Email
                            </div>
                            <div class="c_input">
                                <input name="email" type="email" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>" required />
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<?php
									if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
										echo "Username";
									}
									else{
										echo "Nom d'utilisateur";
									}
								?>
                            </div>
                            <div class="c_input">
                                <input name="login" type="text" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>" required />
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label"><?php echo $result3[20][$lang.'_title']; ?></div>
                            <div class="c_input">
                                <em><font size="1"><font color="#585858">
								<select name="account" class="selectpicker" id="mySelect">
									<option value="1"><?php echo $result3[21][$lang.'_title']; ?></option>
									<option value="2"><?php echo $result3[22][$lang.'_title']; ?></option>
								</select>
                                <br><?php echo $result3[23][$lang.'_title']; ?><br><?php echo $result3[24][$lang.'_title']; ?></font></font></em>
								<br />
                            </div>
                        </div>
						<div id="super">
							
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
                            <div class="c_input">
                                <input id="password" name="password" type="password" required/>
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="">
                            <fieldset>
                                <legend><?php 
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Enter what you see in the form - Captcha security";
								}
								else{
									echo "Entrez ce que vous voyez dans la forme - Captcha security";
								}
								?></legend>
                                <?php
                                    echo recaptcha_get_html($publickey);
                                ?>
                            </fieldset>
                            <fieldset>
								<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){?>
									<legend><?php echo siteName(); ?> terms</legend> 
                                By signing up, I agree to <?php echo siteName(); ?> <a href="/terms" target="_blank">terms</a><br>
								<?php }
								else{ ?>
										<legend><?php echo siteName(); ?> conditions</legend> 
                                En vous inscrivant, vous acceptez les <a href="/terms1" target="_blank"> conditions</a> de <?php echo siteName(); ?><br>
								<?php } ?>
                                
                            </fieldset>
							<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){?>
									<input name="submit" type="submit" value="Sign up" class="c_btn">
								<?php }
								else{ ?>
								<input name="submit" type="submit" value="Soumettre" class="c_btn">
								<?php } ?>
                            
                            </div>
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
<script>
$(document).ready(function(e) {
	$('#mySelect').on('change', function() {
	  var value = $(this).val();
	  if(value == 1){
		$('#super').html('');
	  }else{
		$('#super').html('<div class="spacer"><div class="c_label">First Name</div><div class="c_input"><input name="firstname" type="text" required /></div></div><div class="spacer"><div class="c_label">Last Name</div><div class="c_input"><input name="lastname" type="text" required /></div></div>');
	  }
	});
});
</script>
</body>
</html>