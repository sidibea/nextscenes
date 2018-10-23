<?php
	require "central/fr_functions.php"; 
	$page = "forum";
	$forum = getForums();
	include("Encoding.php");
?> 
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result3[12][$lang.'_title']; ?></title>
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result3[12][$lang.'_title']; ?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
                    <?php
                        foreach ($forum as $forums_o){
							if(!empty($forums_o['f_img'])){
								$image = "<img width=\"20%\" src=\"pictures/".$forums_o['f_img']."\" class=\"w100p\" />";
							}
							else{
								$image = "<img src=\"pictures/avatar.jpg\" alt=\"\" class=\"w100p\">";
							}
							if(empty($_SESSION['idsession'])){
								$the_url = " <a href=\"/login1\" class=\"clickthis multi\">&rarr; ";
								
									$the_url .= $result3[13][$lang.'_title'];
								
								$the_url .= "</a>";
							}
							else {
								if($forums_o['story_count']=='0' || $forums_o['story_count']=='' || $forums_o['story_count']==NULL){ 
									$the_url = '<a href="#" class="clickthis multi">';
									if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
										$the_url .= "Inactive Forum";
									}
									else{
										$the_url .= "Forum Inactif";
									}
									$the_url .= '</a> ';
								}
								else {
									$the_url = '<a href="storylines1-'.urlThis($forums_o['f_name']).'-'.$forums_o['f_id'].'" class="clickthis multi">&rarr; ';
									if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
										$the_url .= "View  storylines";
									}
									else{
										$the_url .= "Voir Les Histoires";
									}
									$the_url .= '</a>';
								}
							}
							if($forums_o['story_count'] == 1){
								if(!isset($_SESSION['language']) || ($_SESSION['languag'] == "en")){
									$storyline = "1 storyline";
								}
								else{
									$storyline = "1 histoire";
								}
							}
							else{
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
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
                            <a href=\"storylines1-".urlThis($forums_o['f_name']).'-'.$forums_o['f_id']."\"><h3 class=\"h3\">".Encoding::toUTF8($forums_o['f_name'])." (".$storyline.")</h3></a>
                            <p>"./*shorten($forums_o['f_desc'],180)*/Encoding::toUTF8($forums_o['f_desc'])."</p>
                            ".$the_url."
                        </div>
                    </div>";
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