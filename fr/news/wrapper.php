<?php
	include("xpanel/include/database.php");
	$tlink = $db->clean($_REQUEST['slug']);
	$page = $db->clean($_REQUEST['page']);
	$sq1 = "SELECT * FROM nfr_cat WHERE slug=\"$tlink\"";
	$q1 = $db->query($sq1);
	$q2 = $db->singlePost($tlink);
	if($db->num_rows($q1)>0){$rows = $db->fetch_array($q1);}elseif($db->num_rows($q2)>0){$rows = $db->fetch_array($q2);}
?>
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
    <div id="tg-content-upper" class="tg-content tg-haslayout">
		<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-8 col-md-8 col-mod-main">
			   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
				<div class="row herald-posts row-eq-height">
					<?php if($db->num_rows($q1)>0){?>
					<section class="category">
							<div class="row category-caption">
								<div class="col-lg-12">
									<h2 class="pull-left"><?php echo $db->name($rows);?></h2>
								</div>
							</div>
							<div class="row">
						<?php $cat = $db->id($rows);
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =20;
	$tbname = "nfr_topics WHERE cat=\"$cat\" ORDER BY id DESC";
	$startpoint = ($page * $limit) - $limit;
	$tlink = $slug;
	$url = $db->dlink2()."/".$tlink;
	$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$query = $db->query($sql);
	$p=1;
	while($row = $db->fetch_array($query)){?>
		<!-- ARTICLE STARTS -->
            <article class="col-lg-6 col-md-6">
                <div class="picture">
                    <div class="category-image">
                        <a href="<?php echo $db->dlink2()."/".$db->slug($row);?>"><img src="<?php echo $db->firstImage($db->content($row));?>" class="img-responsive" alt="<?php echo $db->topic($row)?>" /></a>
                        <h2 class="overlay-category">
						<?php $csql = $db->catName($db->cat($row)); echo strtoupper($db->name($csql));?></h2>
                    </div>
                </div>
                <div class="detail">
                    <div class="info">
                        <span class="date"><i class="fa fa-calendar-o"></i> <?php $old = DateTime::createFromFormat('Y-m-d\TH:i:sP',$db->dates($row));echo $old->format('d/m/Y');?></span>                        
                        <span class="comments pull-right"><i class="fa fa-eye"></i> <?php echo $db->views($row);?></span>
                        <span class="likes pull-right"><i class="fa fa-heart-o"></i> <?php echo $db->love($row)?></span>
                    </div>
                    <div class="caption"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>"><?php echo $db->topic($row)?></a></div>
                    <div class="author">
                        <div class="pic">
                        <?php $author = $db->getAuthor($db->author($row));?>
                            <img src="xpanel/uploads/<?php echo $db->image($author);?>" class="img-circle" alt="" > 
                            <span class="name"><a><?php echo strtoupper($db->name($author));?></a></span> 
                            <span class="read-article pull-right"><a href="<?php echo $db->dlink2()."/".$db->slug($row);?>">MORE <i class="fa fa-angle-right"></i></a></span>
                        </div>
                    </div>
                </div>
            </article>
            <!-- ARTICLE ENDS -->
            <?php if($p % 2 == 0){echo "</div><div class=\"row\">";}?>
            <?php $p++;}
			echo "<div align=\"center\">" .$db->postsPaging($tlink,$page,$limit,$url,$tbname)."</div>"; 
			?>
			</div>
		</section>
					<?php }elseif($db->num_rows($q2)>0){?>
					<section class="category img" style="border:1px solid #ECECEC; padding:0px 10px;">
							<div class="row">
								<div class="col-lg-12">
									<h2 class="pull-left"><?php echo strtoupper($db->topic($rows));?></h2>
								</div>
							</div>
							<div style="border-bottom:1px solid #ECECEC; height:2px;"></div>
					<!--	Single Post Found	-->
					<div class="description">
						<?php echo $db->content($rows);
						$db->query("UPDATE nfr_topics SET views=views+1 WHERE slug=\"$tlink\"");
						?>
					</div>
					<div class="detail">
						<div class="info" style="border-bottom:1px solid #ECECEC;">
							<span class="date"><i class="fa fa-calendar-o"></i> <?php $old = DateTime::createFromFormat('Y-m-d\TH:i:sP',$db->dates($rows));echo $old->format('d/m/Y');?></span>                        
							<span class="comments pull-right"><i class="fa fa-eye"></i> <?php echo $db->views($rows);?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa  fa-hand-o-up point" id="love"></i> <?php echo $db->love($rows)?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-hand-o-down point" id="dislove"></i> <?php echo $db->dislove($rows)?></span>
							<span class="pull-right" id="note"></span>
						</div>
					</div>
					<div style="display:none;" id="slug"><?php echo $tlink;?></div>
					<div style="height:10px;"></div>
					<!-- Share this post starts -->
					<div id="fb-root"></div>
					  <script>(function(d, s, id) {
					  var js, fjs =  d.getElementsByTagName(s)[0];
					  if  (d.getElementById(id)) return;
					  js =  d.createElement(s); js.id = id;
					  js.src =  "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
					  fjs.parentNode.insertBefore(js, fjs);
					  }(document, 'script', 'facebook-jssdk'));</script>
					<div class="sharepost">
						<ul>
							<li>SHARE THIS POST</li>
							<li>
								<span class='st_facebook_large' displayText='Facebook'></span>
							</li>
							<li>
								<span class='st_twitter_large' displayText='Tweet'></span>
							</li>
							<li>
								<span class='st_email_large' displayText='Email'></span>
							</li>
							<li>
								<span class='st_googleplus_large' displayText='Google +'></span>
							</li>
							<li>
								<span class='st_youtube_large' displayText='Youtube Subscribe'></span>
							</li>
							<li>
								<span class='st_fbrec_large' displayText='Facebook Recommend'></span>
							</li>
							<li>
								<span class='st_instagram_large' displayText='Instagram Badge'></span>
							</li>
							<li>
								<span class='st_sharethis_large' displayText='ShareThis'></span>
							</li>
							<li>
								<span class='st_linkedin_large' displayText='LinkedIn'></span>
							</li>
							<li>
								<span class='st_pinterest_large' displayText='Pinterest'></span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<div style="height:20px;"></div>
						<script type="text/javascript">var switchTo5x=true;</script>
						<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "3fb9af65-2b85-4da7-a395-bff81db19307", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
						<div class="fb-comments"  data-href="<?php echo $db->dlink2()."/".$db->slug($rows);?>" data-width="740" data-numposts="5"></div>
					</div>
					<!-- Share this post ends -->
					</section><div class="clearfix"></div><div style="height:20px;"></div>
					<?php }else{?>
					
					<?php }?>
				</div>
			   </div>
			</div>
			<?php include("../include/sidebar.php");?>
            </div>
            </div></div>
        </div>
    </main>
    <script type="text/javascript">
	$(document).ready(function(e){
		$('#love').click(function() {
			var slug = $("#slug").text();
			$('#note').html('Loading <i class="fa fa-spin"></i>');
			var dataString = "action=like&slug="+slug;
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "action.php",
				data: dataString,
				cache: false,
				dataType: 'json',
				success: function(result){
					if(result[0] == 1){
						$('#note').html('Thank You For Voting.&nbsp;&nbsp;&nbsp;&nbsp;');
						$('#love').html(result[1]);
					}else
					if(result[0] == 2){
						$('#note').html('You Had Voted This Blog Post.&nbsp;&nbsp;&nbsp;&nbsp;');
					}else{
						$('#note').html('Volting Failed, Please refresh page and try again.&nbsp;&nbsp;&nbsp;&nbsp;');
					}
				}
			});
		});
		$('#dislove').click(function() {
			var slug = $("#slug").text();
			$('#note').html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">');
			var dataString = "action=dislike&slug="+slug;
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "action.php",
				data: dataString,
				cache: false,
				dataType: 'json',
				success: function(result){
					if(result[0] == 1){
						$('#note').html('Thank You For Voting.&nbsp;&nbsp;&nbsp;&nbsp;');
						$('#love').html(result[1]);
					}else
					if(result[0] == 2){
						$('#note').html('You Had Voted This Blog Post.&nbsp;&nbsp;&nbsp;&nbsp;');
					}else{
						$('#note').html('Volting Failed, Please refresh page and try again.&nbsp;&nbsp;&nbsp;&nbsp;');
					}
				}
			});
		}); 
	});
</script>
<?php include("../include/foot.php");?>