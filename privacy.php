<?php include'includes/global.inc.php'; ?>
<?php
	require "central/functions.php"; 
	$page = "privacy";
	$info = getInfo(4);
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Privacy Policy</title>
<meta name="description" value="Next Scenes is a web-based content development system that aims to develop a content from a pool of ideas contributed by various creative minds">
<?php include("head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Privacy Policy</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
                    <?php
						if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                        	echo "
					<h3 class=\"h3\">".utf8_encode((stripslashes($info['Title']))."</h3>
					<div class=\"justify\">".utf8_encode(stripslashes($info['Descriptions'])))."</div>";
						}
						else{
                        	echo "
					<h3 class=\"h3\">".utf8_encode(stripslashes($info['Titlefr']))."</h3>
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
<?php echo footer($page); ?>
</body>
</html>