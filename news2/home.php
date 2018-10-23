<?php
	include("xpanel/include/database.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes &bull; Blog Homepage</title>
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
																			 <!-- 
 	  LATEST ARTICLES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
				<?php if($_SESSION['language'] == "en"){?>
				LATEST ARTICLES
				<?php } else {?>
				DERNIÈRES ARTICLES
				<?php }?>
				</h2>
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
	$tbname = "topics ORDER BY id DESC";
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
                        <div class="theImg"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
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
	</section>
			</div>
		</div>
		<div style="height:15px;"></div>
		<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">							
			   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
				<div class="row herald-posts row-eq-height">
																			 <!-- 
 	  EXCLUSIVES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
				<?php if($_SESSION['language'] == "en"){?>
				EXCLUSIVES
				<?php } else {?>
				EXCLUSIVES
				<?php }?>
				</h2>
                <span class="pull-right"><a href="exclusives"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=4 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
	
																				 <!-- 
 	  REVIEW STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
				<?php if($_SESSION['language'] == "en"){?>
				REVIEW
				<?php } else {?>
				LA REVUE
				<?php }?>
				
				</h2>
                <span class="pull-right"><a href="review"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=1 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
	
																				 <!-- 
 	  PROFILES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
					<?php if($_SESSION['language'] == "en"){?>
				PROFILES
				<?php } else {?>
				PROFILS
				<?php }?>
				
				</h2>
                <span class="pull-right"><a href="profiles"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=2 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
	
																				 <!-- 
 	  UPDATES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
					<?php if($_SESSION['language'] == "en"){?>
				UPDATES
				<?php } else {?>
				MISES À JOUR
				<?php }?>
				</h2>
                <span class="pull-right"><a href="updates"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=3 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
	
																				 <!-- 
 	  OPPORUNITIES STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
				<?php if($_SESSION['language'] == "en"){?>
				OPPORUNITIES
				<?php } else {?>
				OPPORTUNITÉS
				<?php }?>
				
				</h2>
                <span class="pull-right"><a href="opportunities"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=5 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
	
																				 <!-- 
 	  EVENTS STARTS
      =========================================================================
 																				-->  
    <section class="latest-articles">
        <div class="row category-caption">
            <div class="col-lg-12">
                <h2 class="pull-left">
				<?php if($_SESSION['language'] == "en"){?>
				EVENTS
				<?php } else {?>
				ÉVÉNEMENTS
				<?php }?>
				
				</h2>
                <span class="pull-right"><a href="events"><i class="fa fa-plus"></i></a></span>
            </div>
        </div>
        <div class="row">
        <?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =6;
	$tbname = "topics WHERE cat=6 ORDER BY id DESC";
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
                        <div class="theImg1"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a></div>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo $db->name($csql);?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="caption"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <!--<div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>-->
                </div>
			</div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 3 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}?>
		</div>
	</section>	
				</div>
			</div>						
		</div>
	</div>
	<?php include("sidebar.php");?>
	</div>
	</div>
<?php include("footer.php");?>
</body>
</html>