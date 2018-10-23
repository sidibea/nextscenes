<?php include("xpanel/include/database.php");
	$slug = $db->clean($_REQUEST['slug']);
	$slug = str_replace(".php","",$slug);
	$main = explode("/",$slug);
	$ide = $main[0];
?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
<style>.tg-content{padding:0px;}</style>
<?php
	$story = $db->fetchScene($ide);
	echo $story['content'];
	$hit = $db->fetchStID($story['s_id']);
	$title = $hit['title'];
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
                            	<h1 class="topic"><?php echo $hit['title'];?></h1>
                                <div><?php echo $story['content'];?></div>
                                <div style="height:10px;"></div>
                                <div style="text-align:right; padding-right:20px;"><?php if($story['status'] == 0 && $_SESSION['uid'] == $hit['author']){?>
                                <a href="<?php echo $db->dlink();?>/mint?action=approve&id=<?php echo $ide;?>">
                                <button class="btn btn-success">Approve</button></a><?php }?></div>
                            </div>
                        </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>