<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "how";
	$info = getInfo(2);
	echo common_top($page, $info);
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
					<h3 class=\"h3\">".utf8_encode(stripslashes($info['Title']))."</h3>
					<div class=\"justify\">".utf8_encode(stripslashes($info['Descriptions']))."</div>";
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