<?php
	require "central/functions.php"; 
	$page = "home";
	echo common_top($page);
?>
<body>
<?php
if(!isset($_GET['page']) || ($_GET['page'] == 1)){
?>

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KFC59B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KFC59B');</script>
<div class="c_screen_holder">
    <div class="c_screen">
        <?php
            $forums = getForums($page);
			$i = 1;
            foreach ($forums as $forums_o){
				if($i < 9){
					$j = "_initial_set";
				}
				else{
					$j = "_other_set";
				}
                $imgstyle = getImgStyle("pictures/".$forums_o['f_img']);
                if(!empty($forums_o['f_img'])){
                    $image = "<img src=\"pictures/".$forums_o['f_img']."\" class=\"fillit\" />";
                }
                else{
                    $image = "<img src=\"pictures/avatar.jpg\" alt=\"\" class=\"fillit\">";
                }
                echo "
            <div class=\"c_box c_box_".$j."\">
                <div class=\"c_boxed ".$imgstyle."\">
                    <div class=\"c_box_inner\">
                        <div class=\"c_box_bottom\">
                            <div class=\"c_box_title\">".$forums_o['f_name']."";
                            if(empty($_SESSION['idsession'])){
                                echo " <a href=\"/login\" class=\"clickthis\">&rarr; Enter forum</a>";
                            }
                            else {
								if($forums_o['story_count']=='0' || $forums_o['story_count']=='' || $forums_o['story_count']==NULL){
                                    echo ' <a href="#" class="clickthis">Inactive Forum</a> ';
                                }
                                else {
									echo '<a href="storylines-'.urlThis($forums_o['f_name']).'-'.$forums_o['f_id'].'" class="clickthis">&rarr; ';
									if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
										echo "View  storylines";
									}
									else{
										echo "Voir Les Histoires";
									}
									echo '</a>';
                                }
                            }
                            echo 
                            "</div>
                            <div class=\"c_box_desc\">".shorten($forums_o['f_desc'],90)."</div>
                        </div>
                    </div>
                    ".$image."
                </div>
            </div>";
			$i++;
            }
        ?>
    </div>
    <div class="c_screen_control_left"></div>
    <div class="c_screen_control"></div>
    <!--<div class="c_screen_control_left_mobile"></div>
    <div class="c_screen_control_mobile"></div>-->
</div>
<?php
}
	echo topNav($page);
if(!isset($_GET['page']) || ($_GET['page'] == 1)){
?>
<div class="slider" >
    <div class="flexslider">
        <ul class="slides">
            <li><img src="images/slider-special-offer.jpg" /></li>
            <li><img src="images/slider-media1.jpg" />
            <li><img src="images/slider-media2.jpg" />
            <li><img src="images/slider-media3.jpg" />
            <li><img src="images/slider-img1.jpg" /></li>
            <li> <img src="images/slider-img2.jpg" /></li>
        </ul>
    </div>
</div>
<?php
}
?>
<div class="w100p">
	<div class="main ptb20">
    	<div class="main_left">
        	<div class="pr20">
                <h3 class="h3"><?php
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					echo "Latest scenes";
				}
				else{
					echo "Dernières scènes";
				}
				?></h3>
                <div class="w100p">
                    <?php
                        $cposts = countPosts();
                        $posts = getPosts($_GET['page']);
                        foreach ($posts as $posts_o) {
							$imgstylex = getImgStyle("avatars/".$posts_o['u_avatar']);
							if(!empty($posts_o['avatar'])){
								$avatar = "<img src=\"avatars/".$posts_o['u_avatar']."\"/>";
							}
							else{
								$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
							}
							if($posts_o['scene_type'] == "valid"){
								$intro = "Scene ".number_format($posts_o['ps_scene']);
							}
							else{
								$intro = "<strong>[Proposed]</strong> scene ".number_format($posts_o['ps_scene']);
							}
                            if(empty($_SESSION['idsession'])){
                                $the_url = "<a href=\"/login\">".$posts_o['f_name']."</a>";
                                $the_scene_url = "<a href=\"".custom_site_base()."/login\" class=\"clickthis multi\">&rarr; Read scene</a>";
                            }
                            else {
                                if($posts_o['storylines']=='0'){ 
                                    $the_url = "<a href=\"#\">".$posts_o['f_name']."</a>";
                                    $the_scene_url = "<a href=\"#\" class=\"clickthis multi\">&rarr; Read scene</a>";
                                }
                                else {
									$the_url = '<a href="/'.custom_site_base().'storylines-'.urlThis($posts_o['f_name']).'-'.$posts_o['f_id'].'">'.stripslashes($posts_o['f_name']).'</a>';
									if($posts_o['proposed_or_not'] == "yes"){
                                    	$the_scene_url = '<a href="/'.custom_site_base().'readscene-'.urlThis($posts_o['sl_name']).'-'.$posts_o['sl_id'].'-'.$posts_o['the_main_id'].'" class="clickthis multi">&rarr; Read scene</a>';
									}
									else{
										$the_scene_url = '<a href="/'.custom_site_base().'read-'.urlThis($posts_o['sl_name']).'-'.$posts_o['sl_id'].'" class="clickthis multi">&rarr; Read scene</a>';
									}
                                }
                            }					
							if($posts_o['sl_views'] == 1){
								$views = "1 view";
							}
							else{
								$views = number_format($posts_o['sl_views'])." views";
							}
                            echo "
                    <div class=\"c_post\">
                        <div class=\"img\">
                            <img src=\"pictures/avatar.jpg\" alt=\"\" class=\"w100p\">
                        </div>
                        <div class=\"c_view\">
                            <h3 class=\"h3\">".stripslashes(htmlspecialchars_decode($posts_o['sl_name']))."</h3>
                            <span>".$views." | ".$the_url." | Created ".date("jS F Y", strtotime($posts_o['ps_ts']))." | ".$intro."<br>
							<div class=\"avatar_holder mt10\">
								<div class=\"avatar_holder_main\">
									<div class=\"c_avatar ".$imgstylex."\">
										".$avatar."
									</div>
								</div>
								<div class=\"avatar_text\">
									By ".stripslashes(htmlspecialchars_decode($posts_o['u_username']))."</span>
								</div>
							</div>
                            <p>".utf8_encode(shorten($posts_o['ps_desc'],180))."</p>
                            ".$the_scene_url."
                        </div>
                    </div>";
                        }
                    ?>
                    <div class="clear"></div>
                </div>
            <?php
				if($cposts > 10){
					echo "
					<div class=\"the_pager\">";
					if(!isset($_GET['page']) || !is_numeric($_GET['page'])){
						$pager = 1;
					}
					else{
						$pager = $_GET['page'];
					}
					if($cposts > ($pager*10)){
						echo "
						<a href=\"/home?page=".($pager+1)."\" class=\"a_pager_direction a_previous_nav\">&laquo; Older</a>";
					}
					if($pager > 1){
					echo "
						<a href=\"/home?page=".($pager-1)."\" class=\"a_pager_direction a_next_nav\">Newer &raquo; </a>";
					}
					echo "
						<div class=\"clear\"></div>
					</div>";
				}
			?>
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