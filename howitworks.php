<title>Nextscenes.com - How it works</title>
<meta name="description" value="Get in-depth knowledge on the usage and the working system behind Nextscenes.com">
<?php
	require "central/functions.php"; 
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
<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyEgsSBXVzZXJzGICAgK3ik4wJDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->
</body>
</html>