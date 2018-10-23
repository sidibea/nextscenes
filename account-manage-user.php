<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "manage";
	$me = getUser($page);
	echo common_top($page);
	if(isset($_POST['user_update'])){
		if($_POST['user'] == "" || $_POST['user'] == NULL){
			$mmsg = "All fields are required to update your password";
		}
		else{
			$mmsg = c_changeType($me, $_POST['user']);
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
           		<div class="twins">
                	<a href="account-activities">Account Activities</a>
                	<a href="manage-account">User Profile</a>
                	<a href="new-story">New Story</a>
                	<a href="messaging">Message</a>
                	<a href="notification">Notification</a>
                </div>
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
                            echo "Change your user profile";
                        }
                        else{
                            echo "Mettre à jour votre mot de passe";
                        }
                        ?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                    echo "Profile type";
                                }
                                else{
                                    echo "Type de profil";
                                }
                                ?>
                            </div>
                            <div class="c_input">
                            	<select name="user">
                                	<option value="Regular"<?php if($_POST['user'] == "Regular"){  echo " selected";} else{ if($me['Account'] == "Regular"){ echo " selected";} } ?>>Regular</option>
                                	<option value="Power"<?php if($_POST['user'] == "Regular"){  echo " selected";} else{ if($me['Account'] == "Power"){ echo " selected";} } ?>>Power</option>
                                </select>
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="user_update" value="Update" class="c_btn">
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