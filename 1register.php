<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "signup";
	echo common_top($page);
?>
<?php
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
			$date = date("Y-m-d");
			$query = "SELECT * FROM members WHERE Login='".mysql_real_escape_string($_POST['login'])."'";
			$result = mysql_query($query, $db_auth); 
			if(mysql_num_rows($result) == 0){
				$query2 = "SELECT * FROM members WHERE Email='".mysql_real_escape_string($_POST['email'])."'";
				$result2 = mysql_query($query2, $db_auth);
				if(mysql_num_rows($result2) > 0){
					$erreur = "You have already registered on ".siteName()." with this email address: ".$_POST['email'];
				}
				else{
					$insq = 'INSERT INTO members (Date,Login,Password,Email,Account) 
						VALUES
						("'.$date.'", "'.mysql_real_escape_string($_POST['login']).'", "'.mysql_real_escape_string($_POST['password']).'", "'.mysql_real_escape_string($_POST['email']).'", "'.mysql_real_escape_string($_POST['account']).'")'; 
					$result = mysql_query($insq, $db_auth);
					
					$to= $_POST['email'];
					$subj = 'Welcome to Nextscenes.com';
					$msg = '
					<html> 
					<head> 
					<title>WELCOME NEXTSCENES.COM</title> 
					</head> 
					<body> <center> <img src="http://www.nextscenes.com/images/logo.png" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
					
					<div align=left>
					<h3><font color=#698C00> Hi '.$_POST['firstname'].', </font></h3>
					We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
					<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
					</div></body> 
					</html>';
					
					$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
					$headers .='Reply-To: info@nextscenes.com'."\n"; 
					$headers .= "MIME-version: 1.0\n";
					$headers .= "Content-type: text/html; charset= iso-8859-1\n";
					mail($to, $subj, $msg, $headers);		
					$_SESSION['email'] = $_POST['email'];
					redirect_to('myaccount.php');
					exit;
				}
			}
			else{
				$erreur = 'This username is already taken, please enter another username.';
			}
		}
		else{ 
			$erreur = 'The captcha text entered was incorrect';
			$error = $resp->error;
		}
	}
?>
<?php
	echo topNav($page);
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
            	<?php
					if($erreur){
					echo "
				<h2 class=\"c_alert\">".$erreur."</h2>";
					}
				?>
                <form action="" class="formular" id="captchaform" method="post" name="captchaform" onsubmit="return testChamps(this);">
                    <fieldset>
                        <legend><?php
                                     	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
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
                                <input name="email" type="text" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<?php
									if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
										echo "Username";
									}
									else{
										echo "Prenom";
									}
								?>
                            </div>
                            <div class="c_input">
                                <input name="login" type="text" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<?php
									if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
										echo "Select Account";
									}
									else{
										echo "Sélectionnez compte";
									}
								?>
                            </div>
                            <div class="c_input">
                                <select name="account">
                                    <option selected="selected" value="Regular">
                                        Regular User
                                    </option>
                                    <option value="Power">
                                        Power User
                                    </option>
                                </select>
                                <em><font size="1"><font color="#585858">
                                <br><?php 
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									echo "Regular Users can read but not write in forums<br>Power Users can read and write in forums";
								}
								else{
									echo "Les utilisateurs réguliers peuvent lire, mais pas écrire dans les forums<br />Alimentation Les utilisateurs peuvent lire et écrire dans les forums";
								}
								?></font></font></em>
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                Password
                            </div>
                            <div class="c_input">
                                <input id="password" name="password" type="password" value="<?php if (isset($_POST['password'])) echo stripslashes(htmlentities(trim($_POST['password']))); ?>">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            <fieldset>
                                <legend><?php 
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
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
                                <legend><?php echo siteName(); ?> terms</legend> 
                                <input name="agreecheck" onclick="agreesubmit(this)" type="checkbox">I agree to the <?php echo siteName(); ?> <a href="terms.html" target="_blank">terms</a><br>
                            </fieldset>
                            <input disabled name="submit" type="submit" value="Sign up" class="c_btn">
                            </div>
                        </div>
                	</fieldset>
                </form>
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