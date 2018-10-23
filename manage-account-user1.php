<?php
session_start(); 
if(empty($_SESSION['idsession'])) {
		header("Location: login1");
}
	require "central/fr_functions.php"; 
	$page = "manage";
	$me = getUser($page);
	if(isset($_POST['user_update'])){
		if($_POST['user'] == "" || $_POST['user'] == NULL){
			$mmsg = "All fields are required to update your password";
		}
		else{
			$mmsg = c_changeType($me, $_POST['user'], $_POST['firstname'], $_POST['lastname']);
		}
	}
	if(isset($_POST['upload']) && $_POST['upload'] == "yes") {
		// Upload and Update Record
		$msg = "";
		$imgtype = array("1","2","3");
		$gettype = exif_imagetype($_FILES['the_image']['tmp_name']);
		$status = in_array($gettype, $imgtype);
		if($status) {
			switch($gettype){
				case "1":
					$ext = ".gif";
				break;
				
				case "2":
					$ext = ".jpg";
				break;
				
				case "3":
					$ext = ".png";
				break;
			}
			
			// UpdateDB
			$filename = uniqid().$ext;
			$newname = "avatars/members/".$filename;
			$session = $_SESSION['idsession'];
			$sql = mysql_query("UPDATE c_users SET u_avatar = '$newname' WHERE u_session = '$session'") or die(mysql_error());
			
			// Perform Upload
			$upload = move_uploaded_file($_FILES['the_image']['tmp_name'], "avatars/members/".$filename);
			if(!$upload) {
				echo "Upload Error". $_FILES['the_image']['error'];
			}	
		} else {
			$msg = "File Selected is Not an Image";
		}
		//print_r ($status);
		//die();
	}
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
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Manage Your Account</title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<?php
                        if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                            <div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Edit Your Account</h2></div>
							</div>
                        <?php }
                        else{ ?>
                           <div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Modifier votre compte</h2></div>
							</div>
                        <?php }
                        ?>
							
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
        	<div class="pr20">
           		<div class="twins">
                	<a href="account-activities1"><?php echo $result3[25][$lang."_".title];?></a>
                	<a href="manage-account1"><?php echo $result3[26][$lang."_".title];?></a>
                	<a href="cover1"><?php echo $result3[27][$lang."_".title];?></a>
                	<a href="messaging1">Message</a>
                	<a href="notification1">Notification</a>
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
                        if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
                            echo "Change your user profile";
                        }
                        else{
                            echo "Changez votre profil d\'utilisateur";
                        }
                        ?></legend>
						<?php if($_SESSION['toSuper'] == true){echo "<div class='alert alert-warning'>Please update your profile type to `super user` before trying to create personal stories</div>";}$_SESSION['toSuper'] = false;?>
						<?php
                        if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                            <div class="spacer">
                            <div class="c_label">Profile type</div>
                            <div class="c_input">
                            	<select name="user" id="mySelect">
                                	<option value="1"<?php if($_POST['user'] == "1"){  echo " selected";} else{ if($me['c_usertypes_ut_id'] == "1"){ echo " selected";} } ?>>Regular</option>
                                	<option value="2"<?php if($_POST['user'] == "2"){  echo " selected";} else{ if($me['c_usertypes_ut_id'] == "2"){ echo " selected";} } ?>>Power</option>
                                </select>
                            </div>
                        </div>
						<div id="super">
							
						</div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="user_update" value="Update" class="c_btn">
                            </div>
                        </div>
                       <?php }
                        else { ?>
                            <div class="spacer">
                            <div class="c_label">Type de profil</div>
                            <div class="c_input">
                            	<select name="user" id="mySelect">
                                	<option value="1"<?php if($_POST['user'] == "1"){  echo " selected";} else{ if($me['c_usertypes_ut_id'] == "1"){ echo " selected";} } ?>>Régulier</option>
                                	<option value="2"<?php if($_POST['user'] == "2"){  echo " selected";} else{ if($me['c_usertypes_ut_id'] == "2"){ echo " selected";} } ?>>Avec Pouvoir</option>
                                </select>
                            </div>
                        </div>
						<div id="super">
							
						</div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="user_update" value="Mettre à jour" class="c_btn">
                            </div>
                        </div>
                        <?php }
                        ?>
					   
						
                    </fieldset>
                </form>
				<form id="formulairecontact" action="" method="post" enctype="multipart/form-data" class="formular">
				<?php $response = isset($msg) ? $msg : "";  echo $response ;?>
					<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                           	
                    <fieldset>
                        <legend>Change your avatar</legend>
                        <div class="spacer">
                            <div class="c_label">Select file</div>
                            <div class="c_input">
                            	<input type="file" name="the_image" placeholder="Upload a photo">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
								<input type="hidden" id="upload" name="upload" value="yes" />
                                <input type="Submit" name="password_update" value="Update" class="c_btn">
                            </div>
                        </div>
                    </fieldset>
               <?php         } else { ?>
							
                    <fieldset>
                        <legend>Changez votre avatar</legend>
                        <div class="spacer">
                            <div class="c_label">Choisir le dossier</div>
                            <div class="c_input">
                            	<input type="file" name="the_image" placeholder="Upload a photo">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
								<input type="hidden" id="upload" name="upload" value="yes" />
                                <input type="Submit" name="password_update" value="Mettre à jour" class="c_btn">
                            </div>
                        </div>
                    </fieldset>
			   <?php }
			?>		
                </form>
				<form id="formulairecontact" action="" method="post" enctype="multipart/form-data" class="formular">
					<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                           <fieldset>
                        <legend>Update your password</legend>
                        <div class="spacer">
                            <div class="c_label">Old password</div>
                            <div class="c_input">
                                <input name="opass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">New password</div>
                            <div class="c_input">
                                <input name="pass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">Confirm new password</div>
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
               <?php         } else { ?>
						<fieldset>
                        <legend>Mettre à jour votre mot de passe</legend>
                        <div class="spacer">
                            <div class="c_label">Ancien mot de passe</div>
                            <div class="c_input">
                                <input name="opass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">Nouveau mot de passe</div>
                            <div class="c_input">
                                <input name="pass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">Confirmer le nouveau mot de passe</div>
                            <div class="c_input">
                                <input name="cpass" type="password">
                            </div>
                        </div>
                        <div class="spacer">
                            <div class="c_label">
                                <input type="Submit" name="password_update" value="Mettre à jour" class="c_btn">
                            </div>
                        </div>
                    </fieldset>
			   <?php }
			?>			
                    
                </form>			
				</div></div></div>
					</div>
				</div>
            </div>
        </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
<script>
$(document).ready(function(e) {
	$('#mySelect').on('change', function() {
	  var value = $(this).val();
	  if(value == 1){
		$('#super').html('');
	  }else{
		$('#super').html("<div class=\"spacer\"><div class=\"c_label\">First Name</div><div class=\"c_input\"><input name=\"firstname\" type=\"text\" value=\"<?php echo $me['u_fname'];?>\" required /></div></div><div class=\"spacer\"><div class=\"c_label\">Last Name</div><div class=\"c_input\"><input name=\"lastname\" type=\"text\" value=\"<?php echo $me['u_lastname'];?>\" required /></div></div>");
	  }
	});
});
</script>
</body>
</html>