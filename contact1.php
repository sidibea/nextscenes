<?php
	require "central/fr_functions.php"; 
	$page = "contact";
?>
<?php
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Send') { 
	$to= 'info@nextscenes.com';
	$subj = 'You have received a message From Nextscenes.com';
	$msg = $_POST['comment'];
	$headers = 'From: '.$_POST['name'].' <'.$_POST['mail'].'>'."\r\n";
	$headers .='Reply-To: '.$_POST['mail'].''."\n"; 
	$headers .= "\r\n";
	mail($to, $subj, $msg, $headers);
	redirect_to('send.php'); 
}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[14][$lang."_".title];?></title>
<meta name="description" value="Next Scenes contact information">
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[14][$lang."_".title];?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
        	<div class="pr20">
               <!-- <h3 class="h3"><?php
				/*if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                	echo "Contact us";
				}
				else{
					echo "Envoyez nous un message en remplissant ce formulaire";
				}*/
				?></h3>-->
                <div class="mt10">
					<div class="col-md-6 col-sm-6 col-xs-12">
                                <p>NextScenes&reg; Nigeria.<br>Suite S2, Yad Prime Complex,<br> Ado Road, Ajah, Lagos<br>Nigeria.<br><a href="http://www.nextscenes.com">www.nextscenes.com</a><br>+234 907 514 1723<br>+234 806 410 5588<br><a href="mailto:info@nextscenes.com">info@nextscenes.com</a><br><a href="mailto:support@nextscenes.com">support@nextscenes.com</a></p>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p>Ginco Communications<br>(Division of Ginco Group SARL)<br>P/C 754, Rue 623<br>Baco Djikoroni ACI<br>Bamako, Mali.<br>+223 74141514<br>+223 7015 9015<br><a href="mailto:info@nextscenes.com">info@nextscenes.com</a><br><a href="mailto:support@nextscenes.com">support@nextscenes.com</a></p>
						</div>
						<span class="clear"></span>
                </div>
                <div class="w100p justify">
                    <form id="formulairecontact" action="" method="post" enctype="multipart/form-data" class="formular">
                    	<fieldset>
                            <legend>
								<?php echo $result3[15][$lang."_".title];?>
							</legend>
                            <div class="spacer">
                                <div class="c_label">
                                    <?php echo $result3[16][$lang."_".title];?>
                                </div>
                                <div class="c_input">
                                    <input  name="name" id="name" type="text" data-value="name" required="true" placeholder="<?php
                                     	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
											echo "Name";
										}
										else{
											echo "Nom";
										}
									?>">
                                </div>
                            </div>
                            <div class="spacer">
                                <div class="c_label">
                                     Email
                                </div>
                                <div class="c_input">
                                    <input name="mail" id="mail" type="text" data-value="email" required="true" placeholder="email">
                                </div>
                            </div>
                            <div class="spacer">
                                <div class="c_label">
                                     
                                </div>
                                <div class="c_input">
                                    <textarea name="comment" id="comment" class="tinput"  required="true" placeholder="<?php
                                     	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
											echo "Enter your message here";
										}
										else{
											echo "Entrez votre message ici";
										}
									?>"></textarea>
                                </div>
                            </div>
                            <div class="spacer">
                                <div class="c_label">
                                    <input type="Submit" name="inscription" <?php
                                     	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "fr")){?>
											value="Envoyer"
										<?php } ?>
										<?php
                                     	if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){?>
											value="Send"
										<?php } ?> class="c_btn" place>
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