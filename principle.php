<title>Nextscenes.com - Principles</title>
<meta name="description" value="Next Scenes is a web-based content development system that aims to develop a content from a pool of ideas contributed by various creative minds. The platform attempts to provide forums for latent creative writers who may not otherwise be able to write a full book on their own.">
<?php
	require "central/functions.php"; 
	$page = "principle";
	$info = getInfo(1);
	echo common_top($page);
?>
<body>
<?php
	echo topNav($page);
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
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
                    ?>
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