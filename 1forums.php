<?php include'includes/global.inc.php'; ?>
<?php
	require "common/functions.php"; 
	$page = "forums";
	$forums = getForums();
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
                <h3 class="h3">All forums</h3>
                <div class="w100p">
                    <?php
                        foreach ($forums as $forums_o){
							if(!empty($forums_o['Filename'])){
								$image = "<img src=\"pictures/".$forums_o['Filename']."\" class=\"w100p\" />";
							}
							else{
								$image = "<img src=\"pictures/avatar.jpg\" alt=\"\" class=\"w100p\">";
							}
							if(empty($_SESSION['idsession'])){
								$the_url = " <a href=\"connect.html\" class=\"clickthis multi\">&rarr; ";
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$the_url .= "Enter Forum";
								}
								else{
									$the_url .= "Entrez Forum";
								}
								$the_url .= "</a>";
							}
							else {
								if($forums_o['storylines']=='0'){ 
									$the_url = '<a href="#" class="clickthis multi">';
									if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
										$the_url .= "Inactive Forum";
									}
									else{
										$the_url .= "Inactif Forum";
									}
									$the_url .= '</a> ';
								}
								else {
									$the_url = '<a href="storylines-'.reecUrl($forums_o['Title']).'-'.$forums_o['IdForum'].'.html" class="clickthis multi">&rarr; ';
									if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
										$the_url .= "View  storylines";
									}
									else{
										$the_url .= "Voir Les Histoires";
									}
									$the_url .= '</a>';
								}
							}
							if($forums_o['story_count'] == 1){
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$storyline = "1 storyline";
								}
								else{
									$storyline = "1 histoire";
								}
							}
							else{
								if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
									$storyline = number_format($forums_o['story_count'])." storylines";
								}
								else{
									$storyline = number_format($forums_o['story_count'])." histoires";
								}
							}
                            echo "
                    <div class=\"c_post\">
                        <div class=\"img\">
                            ".$image."
                        </div>
                        <div class=\"c_view\">
                            <h3 class=\"h3\">".stripslashes(htmlspecialchars_decode($forums_o['Title']))." (".$storyline.")</h3>
                            <p>".shorten($forums_o['Descriptions'],180)."</p>
                            ".$the_url."
                        </div>
                    </div>";
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