<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "contact";
	echo common_top($page);
?>
<?php
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Send') { 
	$to= 'info@thgirb.com';
	$subj = 'You have received a message From Nextscenes.com';
	$msg = $_POST['comment'];
	$headers = 'From: '.$_POST['name'].' <'.$_POST['mail'].'>'."\r\n";
	$headers .='Reply-To: '.$_POST['mail'].''."\n"; 
	$headers .= "\r\n";
	mail($to, $subj, $msg, $headers);
	redirect_to('send.php'); 
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
                <h3 class="h3"><?php
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
                	echo "Contact us";
				}
				else{
					echo "Envoyez nous un message en remplissant ce formulaire";
				}
				?></h3>
                <div class="mt10">
                    <ul class="ul">
                        <li>
                            <span>
                                <p>NextScenes&reg; Nigeria.<br>No. 12 Esomo Crescent,<br>Off Toyin Street Ikeja, Lagos,<br>Nigeria.<br><a href="http://www.nextscenes.com">www.nextscenes.com</a><br>+ 234 803 945 4555<br>+234 806 410 5588<br><a href="mailto:info@nextscenes.com">info@nextscenes.com</a></p>
                            </span>
                            <span>
                                <p>Ginco Communications<br>(Division of Ginco Group SARL)<br>Immeuble Pacific IV,<br>Hamdallaye ACI 2000, BP 2191<br>Bamako, Mali.<br>+223 2022 3168<br>+223 7015 9015<br><a href="mailto:info@nextscenes.com">info@nextscenes.com</a></p>
                            </span>
                            <span class="clear"></span>
                        </li>
                    </ul>
                </div>
                <div class="w100p justify">
                    <h4>Send us a message</h4>
                    <div class="border"></div>
                    <strong><font color="#FF0000">Your message has been sent.</font></strong>
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