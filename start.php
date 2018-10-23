<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "start";
	if(empty($_SESSION['idsession']) || !isset($_SESSION['idsession'])){
		header("Location: /connect.html");
	}
	$user = getUser($page); 
	echo common_top($page);
?>
<?php
	if (isset($_POST['submit'])) {
		if($_POST['login'] == "" || $_POST['login'] == NULL){
			$erreur = 'Please enter a username.';
		}
		else if($_POST['password'] == "" || $_POST['password'] == NULL){
			$erreur = 'Please enter a password which you can use to access NextScenes.';
		}
		else{
			$query = "SELECT * FROM members WHERE Login='".mysql_real_escape_string($_POST['login'])."'";
			$result = mysql_query($query, $db_auth); 
			if(mysql_num_rows($result) == 0){
				$insq = "UPDATE members SET Login = '".mysql_real_escape_string($_POST['login'])."',
				Password = '".mysql_real_escape_string($_POST['password'])."',
				Account = '".mysql_real_escape_string($_POST['account'])."'"; 
				$result = mysql_query($insq, $db_auth);
				
				$to= $user['email'];
				$subj = 'Welcome to Nextscenes.com';
				$msg = '
				<html> 
				<head> 
				<title>WELCOME NEXTSCENES.COM</title> 
				</head> 
				<body> <center> <img src="http://www.nextscenes.com/images/logo.png" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
				
				<div align=left>
				<h3><font color=#698C00> Hi '.$user['firstname'].', </font></h3>
				We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
				<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
				</div></body> 
				</html>';
				
				$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
				$headers .='Reply-To: info@nextscenes.com'."\n"; 
				$headers .= "MIME-version: 1.0\n";
				$headers .= "Content-type: text/html; charset= iso-8859-1\n";
				mail($to, $subj, $msg, $headers);
				header("Location: /forums.html");
				exit;
			}
			else{
				$erreur = 'This username is already taken, please enter another username.';
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
					if($erreur){
					echo "
				<h2 class=\"c_alert\">".$erreur."</h2>";
					}
				?>
                <form action="" class="formular" id="captchaform" method="post" name="captchaform" onsubmit="return testChamps(this);">
                    <fieldset>
                        <legend><?php
                                     	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
											echo $user['FirstName'].", please update your account information";
										}
										else{
											echo $user['FirstName'].", s'il vous plaît mettre à jour les informations de votre compte";
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
                                <legend><?php echo siteName(); ?> terms</legend> 
                                <input name="agreecheck" onclick="agreesubmit(this)" type="checkbox">I agree to the <?php echo siteName(); ?> <a href="terms.html" target="_blank">terms</a><br>
                            </fieldset>
                            <input disabled name="submit" type="submit" value="Complete Sign up" class="c_btn">
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