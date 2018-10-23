<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "login";
	
	$fb = new Facebook\Facebook([
		'app_id' => '1704390496495535', // Replace {app-id} with your app id
		'app_secret' => 'b7d8f95639f53824fc040664e126da01',
		'default_graph_version' => 'v2.5',
	]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['public_profile, email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('https://nextscenes.com/login-callback.php', $permissions);
	
	echo common_top($page);
?>
<?php
	if (isset($_POST['submit']) && !empty($_POST['username']) and !empty($_POST['password'])) {
		$date = date("Y-m-d");
		$query = "SELECT * FROM members WHERE Login='".mysql_real_escape_string($_POST['username'])."'
			AND password = '".mysql_real_escape_string($_POST['password'])."'";
		$result = mysql_query($query, $db_auth); 
		if(mysql_num_rows($result) == 0){
			$erreur = 'The username or password you entered is incorrect';
		}
		else{ 
			@$idsession = outils::gen_key();
			$_SESSION['idsession'] = $idsession;
			$updq = "UPDATE members SET Idsession='".$idsession."', 
					Ip= '".$_SERVER['REMOTE_ADDR']."',
					Lastvisite='".date("Y-m-d H:i:s")."'
					WHERE login='".mysql_clean($_POST['username'])."'";
			$uodr = mysql_query($updq, $db_auth);
			redirect_to('forums.html');
			exit;
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
							echo "Login to your account";
						}
						else{
							echo "Connectez-vous à votre compte";
						}
						?></legend>
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
                                <input name="username" type="text" value="<?php if (isset($_POST['username'])) echo stripslashes(htmlentities(trim($_POST['username']))); ?>">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                Password
                            </div>
                            <div class="c_input">
                                <input name="password" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<input name="submit" type="submit" value="Login" class="c_btn">
                            </div>
                        </div>
                        <div class="mt10 pt10 btg">
                        	<?php
							echo "
							<a href='".htmlspecialchars($loginUrl)."' class=\"c_btn\">Log in with Facebook</a>";
							?>
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