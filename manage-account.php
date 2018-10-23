<?php 
session_start(); 
if(empty($_SESSION['idsession'])) {
		header("Location: login");
}
?>
<?php
	require "central/functions.php"; 
	$page = "scene";
	$me = getUser($page);
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Manage Account</title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">User Area</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
        	<div class="pr20">
           		<div class="twins">
                	<a href="account-activities">Account Activities</a>
                	<a href="manage-account">User Profile</a>
                	<a href="cover">New Story</a>
                	<a href="messaging">Message</a>
                	<a href="notification">Notification</a>
                </div>
                <div class="w100p relative this_is_the_text">
                <fieldset>
                    <legend>Basic Profile Information</legend>
                    <div class="spacer col-md-4 col-sm-4 col-xs-12">
                    	<div class="c_label"></div>
                        <div class="c_input">
                        	<img src="<?php echo $me['u_avatar']; ?>" alt="" class="img img-responsive">
                        </div>
						<div style="height:10px;"></div>
                    </div>
					<div class="col-md-8 col-sm-8 col-xs-12">
					<div style="height:70px;" class="hidden-xs"></div>
                    <div class="spacer">
                        <div class="c_label">Username: <strong><?php echo $me['u_username']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">First name: <strong><?php echo $me['u_fname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">Last name: <strong><?php echo $me['u_lastname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">Email: <strong><?php echo $me['u_email']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                        	<a href="manage-account-user" class="mt20 pt20 c_btn inline-block">Edit profile</a>
                        </div>
                    </div></div>
				<div style="clear:both;"></div>
                </fieldset>
				</div></div></div>
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