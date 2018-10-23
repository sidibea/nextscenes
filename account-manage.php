<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "scene";
	$me = getUser($page);
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
           		<ul class="trio">
                	<li><a href="account-manage-avatar.php">Change your avatar</a></li>
                	<li><a href="account-manage-user.php">Manage your user profile</a></li>
                	<li><a href="account-manage-pass.php">Manage your password</a></li>
                </ul>
                <div class="w100p relative this_is_the_text">
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
                    	<div class="c_label"></div>
                        <div class="c_input">
                        	<img src="/image.php?width=100&height=100&cropratio=2:2&image=/avatars/<?php echo $me['avatar']; ?>" alt="" width="100" height="100">
                        </div>
                    </div>
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
                            <strong><?php echo $me['Login']; ?></strong>
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
                            <strong><?php echo $me['FirstName']; ?></strong>
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
                            <strong><?php echo $me['LastName']; ?></strong>
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
                            <strong><?php echo $me['Email']; ?></strong>
                        </div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                        	<a href="account-manage-user.php" class="mt20 pt20 c_btn inline-block">Update profile</a>
                        </div>
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