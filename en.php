<?php
	require "central/functions.php";
	//$pager = "1";
	header('Content-Type: text/html; charset=utf-8');
	$forumName_romance = forumName(10);
	//$cstory_romance = countForumStories(10);
	$forums = getForums();
	$story_romance = getForumStorieshome(10, $pager);
	$story_crime = getForumStorieshome(4, $pager);
	$story_mystery = getForumStorieshome(9, $pager);
	// Posts - Proposed Scenes
	$posts = getPosts(1);
?>

<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<!--<meta http-equiv="content-type" content="text/html;charset=UTF-8" />-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Nextscenes.com - Nextscenes Multilingual Writing Platform</title>
<?php include("head.php");?>
		<div class="herald-section container herald-no-sid">
			<div class="row">
			<p>Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories</p>
			<!-- Slider	-->
				<div class="clearfix"></div>
				<div class="carousel slide" id="myCarousel" data-ride="carousel">
					<!--	Indicators	-->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
						<li data-target="#myCarousel" data-slide-to="4"></li>
						<li data-target="#myCarousel" data-slide-to="5"></li>
						<li data-target="#myCarousel" data-slide-to="6"></li>
						<li data-target="#myCarousel" data-slide-to="7"></li>
						<li data-target="#myCarousel" data-slide-to="8"></li>
						<li data-target="#myCarousel" data-slide-to="9"></li>
						<li data-target="#myCarousel" data-slide-to="10"></li>
					</ol>
					<!--	Wrapper for slides	-->
					<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="img/nextscenes01.jpg" alt="Fictional storyline that should be full of dire, despirate situations and events" />
						<div class="carousel-caption">
							<h2 class="rom">Romance</h2>
							<p>Fictional storyline that should be full of dire, despirate situations and events
							<div align="right"><a href="http://nextscenes.com/storylines-romance-10" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/crime.jpg" alt="These storylines are fictional situations involving a crime such as murder, robbery, kidnapping, etc" />
						<div class="carousel-caption">
							<h2 class="crm">Crime</h2>
							<p>These storylines are fictional situations involving a crime such as murder, robbery, kidnapping, etc
							<div align="right"><a href="http://nextscenes.com/storylines-crime-7" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/mysery.jpg" alt="In Mystery storyline, the contributors would try to suggest solutions to a mysterious event." />
						<div class="carousel-caption">
							<h2 class="mys">Mystery</h2>
							<p>In Mystery storyline, the contributors would try to suggest solutions to a mysterious event.
							<div align="right"><a href="http://nextscenes.com/storylines-mysery-9" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/comic.jpg" alt="A storyline comprising of funny characters, comical events and situations. Comedies should..." />
						<div class="carousel-caption">
							<h2 class="com">Comedy</h2>
							<p class="cc">A storyline comprising of funny characters, comical events and situations. Comedies should...
							<div align="right"><a href="http://nextscenes.com/storylines-comedy-6" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/action.jpg" alt="Action storylines that should be full of dire, despirate situations and events. The cha..." />
						<div class="carousel-caption">
							<h2 class="act" title="Action storylines that should be full of dire, despirate situations and events. The cha...">Action</h2>
							<p>Action storylines that should be full of dire, despirate situations and events. The cha...
							<div align="right"><a href="http://nextscenes.com/storylines-action-2" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/adventure.jpg" alt="Work of fiction that describes fictional people, events and places. The characters must ha..." />
						<div class="carousel-caption">
							<h2 class="adv">Adventure</h2>
							<p>Work of fiction that describes fictional people, events and places. The characters must ha...
							<div align="right"><a href="http://nextscenes.com/storylines-adventure-3" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/children.jpg" alt="These are storylines designed to amuse, entertain and teach the young ones. Stories should..." />
						<div class="carousel-caption">
							<h2 class="act">Children's Forum</h2>
							<p>These are storylines designed to amuse, entertain and teach the young ones. Stories should...
							<div align="right"><a href="http://nextscenes.com/storylines-childrens-forum-17" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/history.jpg" alt="For historical storylines, contributors will try to rewrite history! Storylines may start ..." />
						<div class="carousel-caption">
							<h2 class="hist">Historical</h2>
							<p>For historical storylines, contributors will try to rewrite history! Storylines may start ...
							<div align="right"><a href="" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/horror.jpg" alt="Horror storylines will be based on imaginary people, beings, events, locations, situations..." />
						<div class="carousel-caption">
							<h2 class="hor">Horror</h2>
							<p class="hh">Horror storylines will be based on imaginary people, beings, events, locations, situations...
							<div align="right"><a href="http://nextscenes.com/storylines-horror-8" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/inspirational.jpg" alt="Stories that touch the heart. True to life experiences of ordinary people demonstrating an..." />
						<div class="carousel-caption">
							<h2 class="rom">Inspirational</h2>
							<p>Stories that touch the heart. True to life experiences of ordinary people demonstrating an...
							<div align="right"><a href="http://nextscenes.com/storylines-inspirational-9" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					<div class="item">
						<img src="img/thriller.jpg" alt="The thriller storylines are meant to keep the audience in suspense by creating fear mixed ..." />
						<div class="carousel-caption">
							<h2 class="rom">Thriller</h2>
							<p>The thriller storylines are meant to keep the audience in suspense by creating fear mixed ...
							<div align="right"><a href="http://nextscenes.com/storylines-thriller-11" class="clickthis">&rarr; Enter forum</a></div></p>
						</div>
					</div>
					</div>
					<!--	Left and Right Navigations/Controls		-->
					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div><!--	Slider End	-->
			</div>
		</div>		
		<div style="height:15px;"></div>
		<div class="herald-section container ">
			<div class="row">			
				<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
					<div class="row">							
						<div class="herald-module col-lg-4 col-md-4 col-sm-4" id="herald-module-1-3" data-col="4">
							<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $forumName_romance['f_name']; ?></h2></div></div></div>
							<div class="row herald-posts row-eq-height">
    <?php
	foreach ($story_romance as $story_o){	
	?>
	<article class="herald-lay-g post-125 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-company tag-eco tag-environment-2">
	<div class="row">	
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id'] ?>" title="<?php echo $story_o['sl_name']; ?>">
				<img width="74" height="55" src="pictures/<?php if((!empty($story_o['sl_img']))){echo $story_o['sl_img'];}else{ echo "avatar.jpg";}?>" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="<?php echo $story_o['sl_name']; ?>" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" /></a>
			</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id'] ?>"><?php echo $story_o['sl_name']; ?></a></h2>
				<span class="meta-category meta-small sc"><?php echo $story_o['u_username']; ?></span>
			</div>
			<!--<a href="<?php echo custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id'] ?>" title="<?php echo $story_o['sl_name']; ?> "class="clickthis multi">&rarr; Read scene</a>-->
		</div>
	</div>
	</article>
	<?php } ?>
	</div>
</div>
	<div class="herald-module col-lg-4 col-md-4 col-sm-4" id="herald-module-1-4" data-col="4">
	<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-3"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Crime</h2></div></div></div>	
	<div class="row herald-posts row-eq-height ">
	<?php
	foreach ($story_crime as $story_c) {	
	?>
	<article class="herald-lay-g post-125 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-company tag-eco tag-environment-2">
	<div class="row">	
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo custom_site_base()."read-".urlThis($story_c['sl_name'])."-".$story_c['sl_id'] ?>" title="Why do people think the beach is a good idea?">
				<img width="74" height="55" src="pictures/<?php if($story_c['sl_img'] != "0" || (!empty($story_c['sl_img']))){echo $story_c['sl_img'];}else{ echo "avatar.jpg";}?>" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="<?php echo $story_c['sl_name'];?>" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" />			</a>
		</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."read-".urlThis($story_c['sl_name'])."-".$story_c['sl_id'] ?>"><?php echo $story_c['sl_name']; ?></a></h2>
				<span class="meta-category meta-small sc"><?php echo $story_c['u_username']; ?></span>
			</div>
		<!--<a href="<?php echo custom_site_base()."read-".urlThis($story_c['sl_name'])."-".$story_c['sl_id'] ?>" title="<?php echo $story_c['sl_name']; ?> "class="clickthis multi">&rarr; Read scene</a>-->
		</div>
	</div>
	</article>
	<?php } ?>
	</div>
	</div>
	<div class="herald-module col-lg-4 col-md-4 col-sm-4" id="herald-module-1-5" data-col="4">
	<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-4"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Personal Stories</h2></div></div></div>	
	<div class="row herald-posts row-eq-height ">	
	<?php
		$query = indexStories();
		while($row_m = fetch_array($query)){	
	?>
	<article class="herald-lay-g post-125 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-company tag-eco tag-environment-2">
	<div class="row">	
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo custom_site_base()."story-".$row_m['slug'];?>" title="Why do people think the beach is a good idea?">
				<img width="74" height="55" src="covers/<?php echo str_replace("i","",$row_m['pattern']);?>.jpg" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="<?php echo $row_m['topic'];?>" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" /></a>
		</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."story-".$row_m['slug'];?>"><?php echo $row_m['topic']; ?></a></h2>
				<span class="meta-category meta-small sc"><?php echo $row_m['username']; ?></span>
			</div>
		</div>
	</div>
	</article>
	<?php } ?>
	</div>
	</div>
	</div>
	</div>
	<div class="herald-sidebar col-lg-3 col-md-3 herald-sidebar-right">
	<div id="categories-3" class="widget widget_categories">
		<h4 class="widget-title h6"><span>Forum</span></h4>
		<ul>
			<li class="cat-item cat-item-48"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text">Action</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text">Romance</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-6"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text">Adventure</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-3"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text">Children's Forum</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-4"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text">Comedy</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-3"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Crime</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-4"><a href="http://nextscenes.com/storylines-mysery-9"><span class="category-text">Mistery</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-5"><a href="http://nextscenes.com/storylines-crime-7"><span class="category-text">Historical</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-7"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Horror</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-inspirational-9"><span class="category-text">Inspirtational</span><span class="count"></span></a></li>
			<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-thriller-11"><span class="category-text">Thriller</span><span class="count"></span></a></li>
		</ul>
	</div>			
	</div>
	</div>
	</div>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">							
			   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
	<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-2"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Latest Scenes</h2></div></div></div>
	<div class="row herald-posts row-eq-height">
	<?php foreach ($posts as $posts_o) { ?>
	<article class="herald-lay-b post-174 post type-post status-publish format-standard has-post-thumbnail hentry category-food-and">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="herald-post-thumbnail herald-format-icon-middle">
				<a href="<?php echo custom_site_base().'storylines-'.urlThis($posts_o['f_name']).'-'.$posts_o['f_id']; ?>" title="<?php $posts_o['sl_name']; ?>">
					<?php $theIDs = $posts_o['c_storylines_sl_id']; $qs = mysql_query("SELECT * FROM c_storylines WHERE sl_id=\"$theIDs\""); $rs = mysql_fetch_array($qs);?>
					<img width="300" height="200" src="pictures/<?php if((!empty($rs['sl_img']))){echo $rs['sl_img'];}else{ echo "avatar.jpg";}?>" class="attachment-herald-lay-b1 size-herald-lay-b1 wp-post-image" alt="Nextscenes"/></a>
			</div>
			</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<div class="entry-header">
							<span class="meta-category">
							<?php 
							$furl = '<a class="herald-cat-4" href="'.custom_site_base().'storylines-'.urlThis($posts_o['f_name']).'-'.$posts_o['f_id'].'">'.stripslashes($posts_o['f_name']).'</a>';
							echo $furl;
							?>
							</span>
							<?php
							if($posts_o['proposed_or_not'] == "yes"){
                                    	$the_scene_url = custom_site_base().'readscene-'.urlThis($posts_o['sl_name']).'-'.$posts_o['sl_id'].'-'.$posts_o['the_main_id'];
									}
									else{
										$the_scene_url = custom_site_base().'read-'.urlThis($posts_o['sl_name']).'-'.$posts_o['sl_id'];
									}
							if($posts_o['scene_type'] == "valid"){
								$intro = "Scene ".number_format($posts_o['ps_scene']);
							}
							else{
								$intro = "<strong>[Proposed]</strong> scene ".number_format($posts_o['ps_scene']);
							}
							?>
			<h4 class="entry-title h4"><a href="<?php echo $the_scene_url; ?>"><?php echo stripslashes(htmlspecialchars_decode(strtoupper($posts_o['sl_name']))) ?></a></h4>
					<div class="entry-meta">
					<div class="meta-item herald-date"><span class="updated"><?php echo date("jS F Y", strtotime($posts_o['ps_ts'])); ?></span></div>
					<div class="meta-item herald-comments"><?php echo $intro; ?></div>
					<div class="meta-item herald-date">By <?php echo stripslashes(htmlspecialchars_decode($posts_o['u_username'])); ?></div>
					</div>
					</div>
					<div class="entry-content">
					<p><?php echo shorten($posts_o['ps_desc'],220); ?></p>
					<a href="<?php echo $the_scene_url; ?>" title="<?php echo $post_o['sl_name']; ?> "class="clickthis multi">&rarr; Read scene</a>
		</div>
			</div>
		</div>
	</article>		
	<?php } ?>	
			</div>
		</div>						
	</div>
</div>
	<?php echo side2();?>

			</div>

		</div>
<?php echo footer($page); ?>
</body>
</html>