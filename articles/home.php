<?php
	include("../news/xpanel/include/database.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes &bull; Articles</title>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- All Stylesheets -->
<link href="css/all-stylesheets.css" rel="stylesheet">
<link rel="alternate stylesheet" type="text/css" href="css/colors/red.css" title="red">
<?php include("head.php");?>
		<div class="herald-section container herald-no-sid">
			<div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12">															 <!-- 
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
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =30;
	$tbname = "articles ORDER BY id DESC";
	$startpoint = ($page * $limit) - $limit;
	$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$query = $db->query($sql);
	$p=1;
	while($row = $db->fetch_array($query)){?>
		<!-- ARTICLE STARTS -->
            <article class="col-lg-6 col-md-6" style="padding-bottom:0px;">
			<div style="box-shadow: 3px 1px 5px #EFEFEF; padding:3px 1px 5px 3px; background:#FFF;">
                <div class="picture">
                    <div class="category-image latest">
                        <div class="theImg"><a href="<?php echo $db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">Articles</h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" ></a>
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "<div style=\"clear:both;\"><div style=\"height:10px;\"></div>";}?>
            <?php $p++;}?>
		</div>
		<div style="height:15px;"></div>
	</section>
	</div>
	<?php include("sidebar.php");?>
	</div>
	</div>
<?php include("footer.php");?>
</body>
</html>