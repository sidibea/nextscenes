<?php
	require "central/fr_functions.php"; 
	$page = "recover";
	echo common_top($page);
?>
<?php
	$allow_update = FALSE;
	if(isset($_POST['submit'])){
		$query = "SELECT * FROM c_users
			WHERE u_reset_key ='".mysql_real_escape_string($_POST['i'])."'
			AND u_id = '".mysql_real_escape_string($_POST['k'])."'";
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			$erreur = 'Sorry, you followed an invalid reset link.<br />Please use the <a href=\"/reset\">reset tool</a> to reset your account.';
		}
		else{
			$answer = mysql_fetch_assoc($result);
			if($_POST['password'] != $_POST['cpassword']){
				$erreur = "The passwords you entered do not match.";
				$allow_update = TRUE;
			}
			else{
				$update_username = FALSE;
				$update_username_false = FALSE;
				if($_POST['username'] != "" && $_POST['username'] != NULL){
					$chkq = "SELECT * FROM c_users
						WHERE u_username = '".mysql_real_escape_string($_POST['username'])."'";
					$chkr = mysql_query($chkq, $db_auth);
					if(mysql_num_rows($chkr) == 0){
						$update_username = TRUE;
						$update_username_false = TRUE;
					}
					else{
						$update_username = TRUE;
						$update_username_false = FALSE;
					}
				}
				if($update_username == TRUE){
					if($update_username_false == FALSE){
						$erreur = "Sorry, that username is already taken.";
						$allow_update = TRUE;
					}
					else{
						$updq = "UPDATE c_users 
							SET u_username = '".mysql_real_escape_string($_POST['username'])."',
							u_pass = '".sha1($_POST['password'].salt())."'
							WHERE u_id = '".mysql_real_escape_string($answer['u_id'])."'";
						$updr = mysql_query($updq, $db_auth);
						if(!$updr){
							$erreur = "Something seems to have gone wrong. Please try again later";
							$allow_update = TRUE;
						}
						else{
							$erreur = "Congratulations! You have successfully recovered your account.<br />You may now <a href=\"/login\">login</a> to your ".siteName()." account.";
						}
					}
				}
				else{
					$updq = "UPDATE c_users 
						SET u_pass = '".sha1($_POST['password'].salt())."'
						WHERE u_id = '".mysql_real_escape_string($answer['u_id'])."'";
					$updr = mysql_query($updq, $db_auth);
					if(!$updr){
						$erreur = "Something seems to have gone wrong. Please try again later";
						$allow_update = TRUE;
					}
					else{
						$erreur = "Congratulations! You have successfully recovered your account.<br />You may now <a href=\"/login\">login</a> to your ".siteName()." account.";
					}
				}
			}
		}
	}
	else{
		if(!isset($_GET['i']) || !isset($_GET['j']) || !isset($_GET['k'])){
			$erreur = 'Sorry, you do not have the permission to do that.<br />Please use the <a href=\'/reset\'>reset tool</a> to reset your account.';
		}
		else{
			$query = "SELECT * FROM c_users
				WHERE u_reset_key ='".mysql_real_escape_string($_GET['i'])."'
				AND u_id = '".mysql_real_escape_string($_GET['k'])."'";
			$result = mysql_query($query, $db_auth);
			if(mysql_num_rows($result) == 0){
				$erreur = 'Sorry, you followed an invalid reset link.<br />Please use the <a href=\'/reset\'>reset tool</a> to reset your account.';
			}
			else{
				$answer = mysql_fetch_assoc($result);
				$allow_update = TRUE;
			}
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
					if($_GET['reg'] == "success"){
						$erreur = "You have successfully registered on ".siteName().".<br />Please log in below to get started:";
					}
					if($erreur){
					echo "
				<h2 class=\"c_alert\">".$erreur."</h2>";
					}
				
				if($allow_update == TRUE){
				?>
                <form action="" class="formular" id="captchaform" method="post" name="captchaform">
                    <fieldset>
                        <legend><?php
						if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
							echo "Recover your account";
						}
						else{
							echo "Récupérez votre compte";
						}
						?></legend>
                        <?php
							if($answer['u_username'] == "" || $answer['u_username'] == NULL){
						?>
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
                                <input name="username" type="text" value="<?php if (isset($_POST['username'])) echo stripslashes(htmlentities(trim($_POST['username']))); ?>">
                            </div>
                        </div>
                        <?php
							}
						?>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "New password";
								}
								else{
									echo "Nouveau mot de passe";
								}
								?>
                            </div>
                            <div class="c_input">
                                <input name="password" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "Confirm password";
								}
								else{
									echo "Confirmez le mot de passe";
								}
								?>
                            </div>
                            <div class="c_input">
                                <input name="cpassword" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<input type="hidden"  name="i" value="<?php echo $_GET['i']; ?>">
                            	<input type="hidden"  name="j" value="<?php echo $_GET['j']; ?>">
                            	<input type="hidden"  name="k" value="<?php echo $_GET['k']; ?>">
                                <input name="submit" type="submit" value="Update" class="c_btn">
                            </div>
                        </div>
                	</fieldset>
                </form>
                <?php
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
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>