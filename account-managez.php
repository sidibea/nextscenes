<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "account";
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
           		<ul>
                	<li><a href="account-manage-avatar.php">Change your avatar</a></li>
                	<li><a href="account-manage-user.php">Manage your user profile</a></li>
                	<li><a href="account-manage-pass.php">Manage your password</a></li>
                </ul>
                <div  class="formular">
                <fieldset>
                    <legend><?php
                    if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                        echo "My profile";
                    }
                    else{
                        echo "Mon profil";
                    }
                    ?></legend>
                    <div class="spacer">
                        <div class="c_label">
                             <?php
                            if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                echo "Login";
                            }
                            else{
                                echo "S'identifier";
                            }
                            ?>
                        </div>
                        <div class="c_input">
                            The name
                        </div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                            <?php
                            if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                echo "First name";
                            }
                            else{
                                echo "Prénom";
                            }
                            ?>
                        </div>
                        <div class="c_input">
                            Olusegun
                        </div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                            <?php
                            if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                echo "Last name";
                            }
                            else{
                                echo "Nom de famille";
                            }
                            ?>
                        </div>
                        <div class="c_input">
                            Bright
                        </div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                            <?php
                            if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                echo "Email";
                            }
                            else{
                                echo "Email";
                            }
                            ?>
                        </div>
                        <div class="c_input">
                            bright@ggg.com
                        </div>
                    </div>
                    <div class="spacer">
                        <div class="clear">
                        	<a href="account-manage-user.php" class="c_btn mt20">Manage your user profile</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
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