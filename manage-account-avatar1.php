<?php
	require "central/fr_functions.php"; 
	$page = "manage";
	$me = getUser($page);
	
	if(isset($_POST['upload']) && $_POST['upload'] == "yes") {
		// Upload and Update Record
		$msg = "";
		$imgtype = array("1","2","3");
		$gettype = exif_imagetype($_FILES['the_image']['tmp_name']);
		$status = in_array($gettype, $imgtype);
		if($status) {
			switch($gettype) {
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
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Manage Account Avatar</title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
						<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                            <div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Manage Account Avatar</h2></div>
							</div>
               <?php         } else { ?>
						<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Gérer le compte Avatar</h2></div>
							</div>
			   <?php }
			?>			
							
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
        	<div class="pr20">
			 <?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
                            <ul class="twins">
                	<li><a href="manage-account-avatar1">Change your avatar</a></li>
                	<li><a href="manage-account-user1">Manage profile</a></li>
                	<li><a href="manage-account-pass1">Manage your password</a></li>
                	<li><a href="account-activities1">Account Activities</a></li>
                </ul>
               <?php         } else { ?>
						<ul class="twins">
                	<li><a href="manage-account-avatar1">Changez votre avatar</a></li>
                	<li><a href="manage-account-user1">Gérer le profil</a></li>
                	<li><a href="manage-account-pass1">Gérer votre mot de passe</a></li>
                	<li><a href="account-activities1">Activités du compte</a></li>
                </ul>
			   <?php }
			?>			
            	
                <div class="w100p relative this_is_the_text">
                <?php
                	if($mmsg){
						echo "<div class=\"alert\">".$mmsg."</div>";
					}
				?>
                <form id="formulairecontact" action="" method="post" enctype="multipart/form-data" class="formular">
				<?php $response = isset($msg) ? $msg : "";  echo $response ;?>
                    <fieldset>
                        <legend><?php
                        if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
                            echo "Change your avatar";
                        }
                        else{
                            echo "Modifier votre avatar";
                        }
                        ?></legend>
                        <div class="spacer">
                            <div class="c_label">
                                <?php
                                if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
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
								<input type="hidden" id="upload" name="upload" value="yes" />
                                <input type="Submit" name="password_update" value="Update" class="c_btn">
                            </div>
                        </div>
                    </fieldset>
                </form></div></div></div>
					</div>
				</div>
            </div>
        </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>