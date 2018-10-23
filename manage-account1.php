<?php 
session_start(); 
if(empty($_SESSION['idsession'])) {
		header("Location: login1");
}
?>
<?php
	require "central/fr_functions.php"; 
	$page = "scene";
	$me = getUser($page);
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[40][$lang."_".title];?></title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[40][$lang."_".title];?></h2></div>
							</div>
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
                <fieldset>
                    <legend><?php echo $result3[35][$lang."_".title];?></legend>
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
                        <div class="c_label"><?php echo $result3[36][$lang."_".title];?>: <strong><?php echo $me['u_username']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label"><?php echo $result3[37][$lang."_".title];?>: <strong><?php echo $me['u_fname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label"><?php echo $result3[38][$lang."_".title];?>: <strong><?php echo $me['u_lastname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">Email: <strong><?php echo $me['u_email']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                        	<a href="manage-account-user1" class="mt20 pt20 c_btn inline-block"><?php echo $result3[39][$lang."_".title];?></a>
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
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>