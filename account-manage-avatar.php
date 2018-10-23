<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "manage";
	$me = getUser($page);
	echo common_top($page);
	
	if($_POST['user'] == "" || $_POST['user'] == NULL){
		$mmsg = "All fields are required to update your password";
	}
	else{
		$mmsg = c_changeType($me, $_POST['user']);
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
                            echo "Change your avatar";
                        }
                        else{
                            echo "Modifier votre avatar";
                        }
                        ?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                                    echo "Select file";
                                }
                                else{
                                    echo "Choisir le dossier";
                                }
                                ?>
                            </div>
                            <div class="c_input">
                            	<input type="file" name="the_image" placeholder="Upload a photo">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="password_update" value="Update" class="c_btn">
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