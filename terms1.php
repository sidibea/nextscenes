<?php include'includes/global.inc.php'; ?>
<?php
	require "central/fr_functions.php"; 
	$page = "terms";
	$info = getInfo(5);
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[10][$lang."_".title];?></title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[10][$lang."_".title];?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
                    <?php
						if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
                        	echo "
					<!--<h3 class=\"h3\">".utf8_encode((stripslashes($info['Title']))."</h3>-->
					<div class=\"justify\">".utf8_encode(stripslashes($info['Descriptions'])))."</div>";
						}
						else{
                        	echo "
					<!--<h3 class=\"h3\">".utf8_encode(stripslashes($info['Titlefr']))."</h3>-->
					<div class=\"justify\">".utf8_encode(stripslashes($info['Descriptionsfr']))."</div>";
						}
                    ?></div>
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