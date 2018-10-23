<?php
session_start();
if(empty($_SESSION['idsession'])) {
		header("Location: login1");
}
?>
<?php
	require "central/fr_functions.php"; 
	$page = "messaging";
	$me = getUser($page);
	
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Inbox</title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[45][$lang."_".title];?></h2></div>
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
                        <legend><?php echo $result3[45][$lang."_".title];?></legend>
						<?php success(); failed();?>
						<div align="right"><button data-target="#myModal" class="btn btn-primary btn-large" data-toggle="modal" data-backdrop="false"><?php echo $result3[46][$lang."_".title];?></button></div>
						<div id="myModal" class="modal fade">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title"><?php echo $result3[45][$lang."_".title];?></h4>
									</div>
									<div class="modal-body">
										<form action="mint?action=sendMail" method="post">
											<textarea name="content"></textarea>
											<div align="center"><input type="submit" value="Send" class="btn btn-success" /></div>
										</form>
									</div>
									<div class="modal-footer">
										<span style="color:red; font-weight:bold;"><?php echo $result3[47][$lang."_".title];?></span>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<?php
							$cu = explode('_',$_SESSION['idsession']);
							$uid = $cu[0];
							$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
							if($page == ""){
								$page = 1;
							}
							$startpoint = ($page * $limit) - $limit;
							$limit =20;
							$q = "messaging WHERE (mfrom=\"$uid\" || mto=\"$uid\") ORDER BY date DESC";
							$tlink = "messaging";
							$url = "http://www.nextscenes.com/";
							$query = "SELECT * FROM {$q} LIMIT {$startpoint} , {$limit}";
							getMail($query);
						?>
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