<?php
	require "central/functions.php"; 
	$page = "search";
	$search = searchScenes($_POST['search']);
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
                <h3 class="h3">Search</h3>
                <div class="w100p">
                    
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