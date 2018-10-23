<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "manage";
	$me = getUser($page);
	echo common_top($page);
	if(isset($_POST['password_update'])){
		if($_POST['opass'] == "" || $_POST['opass'] == NULL ||
			$_POST['pass'] == "" || $_POST['pass'] == NULL ||
			$_POST['cpass'] == "" || $_POST['cpass'] == NULL
		){
			$mmsg = "All fields are required to update your password";
		}
		else if($_POST['pass'] != $_POST['cpass']){
			$mmsg = "The passwords you entered do not match";
		}
		else{
			$mmsg = c_resetPassword($me, $_POST['opass'], $_POST['pass']);
		}
	}
?>
<body>
<?php
	echo topNav($page);
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
           		<ul class="trio">
                	<li><a href="account-manage-avatar.php">Change your avatar</a></li>
                	<li><a href="account-manage-user.php">Manage your user profile</a></li>
                	<li><a href="account-manage-pass.php">Manage your password</a></li>
                </ul>
                <div class="w100p relative this_is_the_text">
                <?php
                	if($mmsg){
						echo "<div class=\"alert\">".$mmsg."</div>";
					}
				?>
                <form id="formulairecontact" action="" method="post" enctype="multipart/form-data" class="formular">
                    <fieldset>
                        <legend><?php
                        if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                            echo "Update your password";
                        }
                        else{
                            echo "Mettre à jour votre mot de passe";
                        }
                        ?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                    echo "Old password";
                                }
                                else{
                                    echo "Ancien mot de passe";
                                }
                                ?>
                            </div>
                            <div class="c_input">
                                <input name="opass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                    echo "New password";
                                }
                                else{
                                    echo "Nouveau mot de passe";
                                }
                                ?>
                            </div>
                            <div class="c_input">
                                <input name="pass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                    echo "Confirm new password";
                                }
                                else{
                                    echo "Confirmer le nouveau mot de passe";
                                }
                                ?>
                            </div>
                            <div class="c_input">
                                <input name="cpass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="password_update" value="Update password" class="c_btn">
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
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