<?php
	require "central/functions.php"; 
	$page = "reset";

	if (isset($_POST['submit']) && !empty($_POST['email'])){
		$query = "SELECT * FROM c_users WHERE u_email ='".mysql_real_escape_string($_POST['email'])."'";
		$result = mysql_query($query, $db_auth);
		if(mysql_num_rows($result) == 0){
			$erreur = 'Sorry, the email address you entered does not exist in our records.';
		}
		else{ 
			$answer = mysql_fetch_assoc($result);
			$idsession = md5(microtime().rand());
			$updq = "UPDATE c_users SET u_reset_key ='".$idsession."'
					WHERE u_id='".$answer['u_id']."'";
			$uodr = mysql_query($updq, $db_auth);
			
			
			$to = $answer['u_email'];
			$emailx = siteName()." Password Reset <noreply@nextscenes.com>";
			$subject = "Password reset on your ".siteName()." account";
			$message = "You have requested us to reset your ".siteName()." password. 
								
To do so, please click the following link:
".siteLink()."/recover?i=".$idsession."&j=".md5(mt_rand(10000,90000).mt_rand(11,121))."&k=".$answer['u_id']."

Thank you.


***NOTE*** This is a post-only mailing.  Replies to this message are not monitored or answered.";	
			$headers = "From:".$emailx."\r\n" .
			'Reply-To: noreply@nextscenes.com'."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			$completed = TRUE;
						
			$erreur = 'A reset link has been created for you.<br />Please check your e-mail ('.$to.') for the link and complete the process.<br />Thank you for using our account reset tool.';
		}
	}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Reset Password</title>
<?php include("head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Reset Password</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
            	<?php
					if($_GET['reg'] == "success"){
						$erreur = "You have successfully registered on ".siteName().".<br />Please log in below to get started:";
					}
					if($erreur){
					echo "
				<h2 class=\"c_alert\">".$erreur."</h2>";
					}
				?>
                <form action="" class="formular" id="captchaform" method="post" name="captchaform" onsubmit="return testChamps(this);">
                    <fieldset>
                        <legend><?php
						if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
							echo "Reset your account";
						}
						else{
							echo "Réinitialiser votre compte";
						}
						?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                 <?php
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									echo "Email address";
								}
								else{
									echo "Adresse e-mail";
								}
								?>
                            </div>
                            <div class="c_input">
                                <input name="email" type="text" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                            	<input name="submit" type="submit" value="Reset" class="c_btn">
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
<?php echo footer($page); ?>
</body>
</html>