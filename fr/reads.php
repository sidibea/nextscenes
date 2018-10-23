<?php include("xpanel/include/database.php");
	$slug = $db->clean($_REQUEST['slug']);
	$main = explode("/",$slug);
	$id = $main[0];
	$slg = $main[1];
	$page = $main[2];
	if(!isset($_SESSION['uid'])){
		$_SESSION['msg'] = "<div class=\"alert alert-warning\">S'il vous plaît vous connecter pour utiliser cette fonctionnalité</div>";
		header("location: ".$db->dlink());
		exit;
	}?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>
<head>
<?php header('Content-Type: text/html; charset=ASCII'); $story = $db->readStoryline($id, $slg); $title = $story['title'];
	include("include/head.php");?>
<style>.tg-content{padding:0px;}</style>
    <!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<div class="container">
				<div class="row">
					<div id="tg-twocolumns-upper" class="tg-twocolumns tg-haslayout">
						<!--************************************
								Content Start
						*************************************-->
                        
						
						
						
						
						
						
						
						<div class="col-sm-8">
							<div id="tg-content-upper" class="tg-content tg-haslayout">
                            	<h1 class="topic"><?php echo $story['title'];?></h1>
								
								
								
								
								
								
								
				<br />
				<br />
				<?php $pageurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
				
				Share on: 
				<a class="social social_fb" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1907672512793214&amp;display=popup&amp;caption=<?php echo $scene['sl_name']; ?>&amp;link=<?php echo urlencode($pageurl) ?>&amp;redirect_uri=<?php echo urlencode($pageurl) ?>" title="Share on Facebook">Facebook</a>
				
				<a class="social social_tw" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $scene['sl_name']; ?>&url=<?php echo urlencode($pageurl) ?>&via=nextscenes"  img src= "images/logo/fb" title="Share on Twitter">Twitter</a>
				
				<a class="social social_gp" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($pageurl) ?>" title="Share on Gplus">Google+</a>
				
				<a class="social social_li" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageurl) ?>&title=Nextscenes&summary=&source=" title="Network with us on Linkedin">Linkedin</a>
				
				
				 <br><br>		
								
                                <div><?php echo $story['content'];?></div>
                                <div style="height:15px;"></div>
								
								<br />
				<br />
				<?php $pageurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
				
				Share on: 
				<a class="social social_fb" target="_blank" href="https://www.facebook.com/dialog/feed?app_id=1907672512793214&amp;display=popup&amp;caption=<?php echo $scene['sl_name']; ?>&amp;link=<?php echo urlencode($pageurl) ?>&amp;redirect_uri=<?php echo urlencode($pageurl) ?>" title="Share on Facebook">Facebook</a>
				
				<a class="social social_tw" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $scene['sl_name']; ?>&url=<?php echo urlencode($pageurl) ?>&via=nextscenes" title="Share on Twitter">Twitter</a>
				
				<a class="social social_gp" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($pageurl) ?>" title="Share on Gplus">Google+</a>
				
				<a class="social social_li" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($pageurl) ?>&title=Nextscenes&summary=&source=" title="Network with us on Linkedin">Linkedin</a>
				
				
				 <br><br>		 <br><br>	
								
                                <h2 class="topic">Sc&eacute;nes</h2>								
								<?php $scenes = $db->fetchScenes($id);
									foreach((array)$scenes as $scene){?>
									
											
									
										<div class="col-md-6 col-sm-6 col-xs-12">
											<h2 class="topic"><?php echo $story['title'];?> [<?php if($scene['status'] == 1){echo "Valide";}else{echo "Propos&eacute;";}?>] Sc&eacute;ne[<?php echo $scene['scene'];?>]</h2>
											<div><?php echo substr(strip_tags($scene['content']),0,75);?>...<a href="<?php echo $db->dlink();?>/view/<?php echo $scene['id']."/".$story['slug'];?>">Plus</a></div>
										</div>
										<?php }?>
                            	<div style="clear:both;"></div>
                                <div style="padding:10px; text-align:center">
                                	<a href="<?php echo $db->dlink();?>/new-scene?id=<?php echo $story['id'];?>"><button class="btn btn-default">Proposer Une Sc&eacute;ne</button></a>
                                </div>
    						</div>
                        </div>
                        <?php include("include/sidebar.php"); $edit = 0;?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>