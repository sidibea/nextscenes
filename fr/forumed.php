<?php include("xpanel/include/database.php");
	$slug = $db->clean($_REQUEST['slug']);
	$main = explode("/",$slug);
	$slg = $main[0];
	$page = $main[1];
	$cts = $db->fetchForumSlug($slg);
	$cat = $cts['id'];
	$limit = 20;
	$forumd = $db->fetchStoryline($cat, $page, $limit, $slg);
	$title = $cts['title'];
	if(empty($slg)){$title = "Forums";}
	?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>

<?php include("include/head.php");?>
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
                            	<!--************************************
										Latest Scenes
								*************************************-->
                                <section class="tg-haslayout tg-latest-technology">
									<div class="tg-section-heading">
										<h2><?php if(empty($slg)){$title = "Forums";}echo $title;?></h2>
									</div>
                                    <?php 
									if(empty($slg)){
										$frm = $db->fetchForum();?>
                                    <article class="tg-theme-post tg-category-full">
										<div class="row">
                                        <?php foreach($frm as $frmz){?>
                                        	<div class="col-md-4 col-sm-4 col-xs-6">
                                            	<img class="img img-responsive" src="<?php echo $db->dlink();?>/uploads/<?php echo $frmz['image'];?>" />
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-6">
                                            	<a href="<?php echo $frmz['slug'];?>"><strong><?php echo $frmz['title'];?></strong></a>
                                                <p><?php echo $frmz['description'];?></p>
                                            </div>
                                            <div style="clear:both;"></div>
                                            <div style="height:10px;"></div>
                                        <?php }?>
                                        </div>
                                    </article>
                                    <?php }else{
									foreach((array)$forumd as $story){?>
									<article class="tg-theme-post tg-category-full">
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<figure>
                                                <div class="newDiv">
													<a href="<?php echo $db->dlink();?>/read/<?php echo $story['id']."/".$story['slug'];?>/">
														<img src="<?php echo $db->firstImage($story['content']);?>" alt="<?php echo $db->clean($story['title']);?>">
													</a>
                                                </div>
												</figure>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="tg-box">
													<div class="tg-postcontent">
														<div class="tg-border-heading">
															<h3><a href="<?php echo $db->dlink();?>/read/<?php echo $story['id']."/".$story['slug'];?>/"><?php echo $story['title'];?></a></h3>
														</div>
														<ul class="tg-postmetadata">
															<li>
																<a href="#">
																	<i class="fa fa-clock-o"></i>
																	<span><?php echo $story['date'];?></span>
																</a>
															</li>
															<li>
																<a href="#">
																	<i class="fa fa-user"></i>
																	<span><?php $au = $db->getAuthor($story['author']); echo $au['u_username'];?></span>
																</a>
															</li>
														</ul>
														<div class="tg-description">
															<p><?php echo substr(strip_tags($story['content']),0,150);?></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</article>
                                    <?php }
									}?>
                                    <div style="clear:both; height:10px;"></div>
                                    <div align="center"><?php $startpoint = ($page * $limit) - $limit;$tbname = "fr_storylines WHERE category=\"$cat\" ORDER BY id DESC"; $db->paging("forums/".$slg, $page, $limit, $tbname);?></div>
								</section>
                                <!--************************************
										Latest Scenes End
								*************************************-->
                            </div>
                        </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>