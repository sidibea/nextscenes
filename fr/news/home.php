<?php include("xpanel/include/database.php");?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
<link href="http://www.nextscenes.com/news/css/all-stylesheets.css" rel="stylesheet">
<link rel="alternate stylesheet" type="text/css" href="http://www.nextscenes.com/news/css/colors/red.css" title="red">
<?php $title = "Home";
	include("../include/head.php");?>
<!--************************************
				Main Start
*************************************-->
<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
    <!-- LATEST STUFFS		-->
<div class="col-sm-12">
    <div id="tg-content-upper" class="tg-content tg-haslayout">
																			 <!-- 
 	  LATEST ARTICLES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">LATEST ARTICLES</h2>
            </div>
        </div>
        <div class="row">
			<?php
            $db->success();$db->failed();
            $page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
            if($page == ""){
                $page = 1;
            }
            $limit =6;
            $tbname = "nfr_topics ORDER BY id DESC";
            $startpoint = ($page * $limit) - $limit;
            $sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
            $query = $db->query($sql);
            $p=1;
            while($row = $db->fetch_array($query)){?>
                <!-- ARTICLE STARTS -->
                    <article class="col-lg-4 col-md-4" style="padding-bottom:0px;">
                    <div style="box-shadow: 3px 1px 5px #EFEFEF; padding:3px 1px 5px 3px; background:#FFF;">
                        <div class="picture">
                            <div class="category-image latest">
                                <div class="theImg"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>">
                                <img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" />
                                </a></div>
                                <h2 class="overlay-category">
                                <?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="caption"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                        </div>
                    </div>
                    </article>
                    <!-- ARTICLE ENDS -->
				<?php if($p % 3 == 0){echo "<div style=\"clear:both;\"><div style=\"height:10px;\"></div>";}?>
        	<?php $p++;}?>
     	</div>
	</section>
    </div>
</div>
    <!-- LATEST STUFFS ENDS		-->
		<div class="row">
			<div class="herald-main-content col-lg-8 col-md-8 col-mod-main">
			   <div class="herald-module" id="herald-module-3-0" data-col="12">
				<div class="row herald-posts row-eq-height">
				<?php 
                    $qx = $db->query("SELECT * FROM nfr_cat");
                    while($rx = $db->fetch_array($qx)){
                        $cat = $rx['id'];
                    ?>
                                                                             <!-- 
 	  				<?php echo strtoupper($rx['name']);?> STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left"><?php echo strtoupper($rx['name']);?></h2>
                <span class="pull-right"><a href="<?php echo $rx['slug'];?>"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
			$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
			if($page == ""){
				$page = 1;
			}
			$limit =6;
			$tbname = "nfr_topics WHERE cat=\"$cat\" ORDER BY id DESC";
			$startpoint = ($page * $limit) - $limit;
			$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
			$query = $db->query($sql);
			$p=1;
			while($row = $db->fetch_array($query)){?>
				<!-- ARTICLE STARTS -->
					<article class="col-lg-4 col-md-4">
					<div style="box-shadow: 3px 1px 5px #EFEFEF; padding:3px 1px 5px 3px; background:#FFF;">
						<div class="picture">
							<div class="category-image">
								<div class="theImg1"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
								<h2 class="overlay-category">
								<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
							</div>
						</div>
						<div class="detail">
							<div class="caption"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
						</div>
					</div>
                </article>
                <!-- ARTICLE ENDS -->
        	<?php }?>
		</div>
	</section>
    <?php }?>
    	</div>
        	</div>
            	</div>
			<?php include("../include/sidebar.php");?>
            </div>
        </div>
    </main>
<?php include("../include/foot.php");?>