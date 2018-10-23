<?php
	require "central/functions.php";
	//$pager = "1";
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
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Nextscenes.com - Nextscenes Multilingual Writing Platform</title>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KFC59B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KFC59B');</script>

<script type="text/javascript" src="http://www.nextscenes.com/central/sociallogin.js" language="javascript"></script>

<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}.carousel-inner > .item > img,.carousel-inner > .item > a > img {  width: 100%;  margin: auto;}
</style>
<link rel='stylesheet' id='herald-fonts-css'  href='http://fonts.googleapis.com/css?family=Open+Sans%3A400%2C600%7CLato%3A400%2C700&amp;subset=latin%2Clatin-ext&amp;ver=1.5' type='text/css' media='all' />
<link rel='stylesheet' id='minit-96763c9c74ea00b10842fc3bd9577789-css'  href='wp-content/uploads/minit/96763c9c74ea00b10842fc3bd9577789.css' type='text/css' media='all' />
<link rel="stylesheet" href="central/stylee.css" type="text/css" />
<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"loaderUrl":"http:\/\/demo.mekshq.com\/herald\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif","recaptchaEmpty":"Please verify that you are not a robot.","sending":"Sending ...","cached":"1"};
/* ]]> */
</script>
<script type='text/javascript'>
/* <![CDATA[ */
var mks_ep_settings = {"ajax_url":"http:\/\/demo.mekshq.com\/herald\/wp-admin\/admin-ajax.php","action":"mks_open_popup"};
/* ]]> */
</script>
<script type='text/javascript'>
/* <![CDATA[ */
var wpreview = {"ajaxurl":"http:\/\/demo.mekshq.com\/herald\/wp-admin\/admin-ajax.php"};
/* ]]> */
</script>
<script type='text/javascript'>
/* <![CDATA[ */
var herald_js_settings = {"ajax_url":"http:\/\/demo.mekshq.com\/herald\/wp-admin\/admin-ajax.php","rtl_mode":"false","header_sticky":"1","header_sticky_offset":"600","header_sticky_up":"","single_sticky_bar":"","popup_img":"1","logo":"http:\/\/demo.mekshq.com\/herald\/wp-content\/themes\/herald\/assets\/img\/herald_logo.png","logo_mini":"http:\/\/demo.mekshq.com\/herald\/wp-content\/themes\/herald\/assets\/img\/herald_logo_mini.png"};
/* ]]> */
</script>

<meta property="og:url" content="http://nextscenes.com"/>
<meta property="og:type" content="article"/>
<meta property="article:author" content="https://www.facebook.com/nextscenes"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:site_name" content="Nextscenes"/>
<meta property="og:title" content="Nextscenes"/>
<meta property="og:description" content="Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories"/>
<meta name="twitter:domain" content="nextscenes.com"/>
<meta name="twitter:title" content="Nextscenes"/>
<meta name="twitter:description" content="A Multilingual story writing platform that allows you the reader to propose scenes"/>
<meta name="twitter:creator" content="https://twitter.com/nextscenes"/>
<meta name="twitter:card" content="summary"/>
<meta itemprop="url" content="http://www.nextscenes.com"/>
<meta itemprop="name" content="Nextscenes"/>
<meta itemprop="description" content="Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories.
"/>
<meta name="description" content="Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories.
"/>

<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "http://nextscenes.com",
    "name": "Nextscenes",
    "description": "A Multilingual story writing platform that allows you the reader to propose scenes"
}</script>
<style type="text/css">body.chrome { text-rendering:auto; } .herald-sticky, .herald-goto-top{ -webkit-transform: translateZ(0); transform: translateZ(0); }
</style>
</head>
<body class="home page page-id-207 page-template page-template-template-modules page-template-template-modules-php chrome herald-boxed">
	<header id="header" class="herald-site-header">
		<div class="header-top hidden-xs hidden-sm">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">					
						<div class="hel-l">
						<nav class="secondary-navigation herald-menu">	
						<span class="fb-like" data-href="http://www.nextscenes.com" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></span>
						<ul id="menu-herald-secondary-1" class="menu">
							
						</ul>
						</nav>
						</div>	
						<div class="hel-r">
							<span class="herald-calendar">
							<i class="fa fa-calendar"></i><?php echo date('M d, Y'); ?></span>
						</div>				
					</div>
				</div>
			</div>
		</div>
	<div class="header-middle herald-header-wraper hidden-xs hidden-sm">
	<div class="container">		
		<div class="row">				
		<div class="col-lg-12 hel-el">					
		<div class="hel-l herald-go-hor">					
		<div class="site-branding">				
		<h1 class="site-title h1">
		<a href="." rel="home"><img class="herald-logo" width="30%" src="imgs/next-scenes_logo.png" alt="Nextscenes" ></a>
		</h1>				
		</div>				
		</div>				
		<div class="hel-r herald-go-hor">				
		<div class="herald-ad c_tiptop">					
		<ul class="col-md-6 col-sm-6 col-xs-12" align="right">						
		<li><a href="register">Sign up</a></li> <li><a href="login">Log in</a></li>					
		</ul>					
		<div id="google_translate_element" class="col-md-6 col-sm-6 col-xs-12">						
		<script type="text/javascript">							
		function googleTranslateElementInit() {							  
			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-79838128-1'}, 'google_translate_element');								
			}				
		</script>					
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>	</div>
		<div class="clearfix"></div>
		</div>
		</div>			
		</div>		
		</div>		
		</div>
	</div>
	<div class="header-bottom herald-header-wraper hidden-sm hidden-xs">
	<div class="container">
		<div class="row">
				<div class="col-lg-12 hel-el">
				
<div class="hel-l">
	<nav class="main-navigation herald-menu">	
	<ul id="menu-herald-main" class="menu">
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="index.html">Home</a></li>
	<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
	<a href="forums">Forum</a>
	<ul class="sub-menu">
	
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text">Action</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text">Romance</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text">Adventure</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text">Children's Forum</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text">Comedy</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Crime</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Historical</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Horror</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-inspirational-stories-31"><span class="category-text">Inspirtational</span><span class="count"></span></a>
	</li>

	</ul>
	</li>
	<li id="menu-item-979" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="principle">Principle</a></li>
	<li id="menu-item-966" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="faqs">FAQ</a></li>
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="howitworks">How it works</a></li>
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="discussions">Discussions</a></li>
	
	<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="search.html">Search</a></li>
	
	<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact">Contact</a></li></ul></nav>
	
</div>
<div class="hel-r">
<ul id="menu-herald-social" class="herald-soc-nav"><li id="menu-item-1037" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1037"><a href="https://www.facebook.com/nextscenes"><span class="herald-social-name">Facebook</span></a></li>
<li id="menu-item-1038" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1038"><a href="https://twitter.com/nextscenes"><span class="herald-social-name">Twitter</span></a></li>
					</div>
				</div>
		</div>
		</div>
</div>
	</div>
</div>
</div>		
	</header>
			<div id="sticky-header" class="herald-header-sticky herald-header-wraper herald-slide hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 hel-el">
			<div class="hel-l herald-go-hor">
			<div class="site-branding mini">
		<span class="site-title h1"><a href="." rel="home"><img class="herald-logo-mini" src="imgs/logo.png" alt="Nextscenes" ></a>
		</span>
</div>
</div>
															
<div class="hel-r herald-go-hor">
		<nav class="main-navigation herald-menu">	
		<ul id="menu-herald-main-1" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href=".">Home</a>
	<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
	<a href="#">Forum</a>
	<ul class="sub-menu">
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text">Action</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text">Romance</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text">Adventure</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text">Children's Forum</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text">Comedy</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Crime</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Historical</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Horror</span><span class="count"></span></a>
	</li>
	<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-inspirational-stories-31"><span class="category-text">Inspirtational</span><span class="count"></span></a>
	</li>
	</ul>
	</li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact">Contact</a></ul>	
	</nav>
				</div>
			</div>
		</div>
	</div>
</div>
	
	<div id="herald-responsive-header" class="herald-responsive-header herald-slide hidden-lg hidden-md">
	<div class="container">
		<div class="herald-nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="site-branding mini">
		<span class="site-title h1"><a href="." rel="home"><img class="herald-logo-mini" src="imgs/logo.png" alt="Herald" ></a></span>
</div>	
	</div>
</div>
<div class="herald-mobile-nav herald-slide hidden-lg hidden-md">
	<ul id="menu-herald-main-2" class="herald-mob-nav">
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href=".">Home</a></li>
	<li id="menu-item-978" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="forums">Forum</a></li>
	<li id="menu-item-979" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="principle">Principle</a></li>
	<li id="menu-item-966" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="faqs">FAQ</a></li>
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="howitworks">How it works</a></li>
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="discussions">Discussions</a></li>
	
	<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="login">Login/Register</a></li>

	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact">Contact</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="search.html">Search</a></li>
	
</ul></div>
	<div id="content" class="herald-site-content herald-slide">		
		<div class="herald-section container herald-no-sid">
			<div class="alert alert-primary">
			</div>
			<div class="row">			
				<iframe frameborder="0" style="margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bot" scrolling="no" width="100%" height="280" src="nextscenesslide/slide.html"></iframe>
			</div>
		</div>		
		<div class="herald-section container ">

			<div class="row">			
				<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">

					<div class="row">							
						<div class="herald-module col-lg-4 col-md-4 col-sm-4" id="herald-module-1-3" data-col="4">
							<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-2"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $forumName_romance['f_name']; ?></h2></div></div></div>
	
	<div class="row herald-posts row-eq-height">
    <?php
	foreach ($story_romance as $story_o){	
	?>
	<article class="herald-lay-g post-125 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-company tag-eco tag-environment-2">
<div class="row">	
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id'] ?>" title="<?php echo $story_o['sl_name']; ?>">
				<img width="74" height="55" src="pictures/avatar.jpg" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="<?php echo $story_o['sl_name']; ?>" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" />			</a>
		</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."read-".urlThis($story_o['sl_name'])."-".$story_o['sl_id'] ?>"><?php echo $story_o['sl_name']; ?></a></h2>
				<font size="-2">By</font><span class="meta-category meta-small"><?php echo $story_o['u_username']; ?></span>
				
			</div>
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
				<img width="74" height="55" src="pictures/avatar.jpg" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="herald091" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" />			</a>
		</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."read-".urlThis($story_c['sl_name'])."-".$story_c['sl_id'] ?>"><?php echo $story_c['sl_name']; ?></a></h2>
				<font size="-2">By</font><span class="meta-category meta-small"><?php echo $story_c['u_username']; ?></span>
			</div>
		</div>
	</div>
	</article>
	<?php } ?>
	</div>
</div>
							
   <div class="herald-module col-lg-4 col-md-4 col-sm-4" id="herald-module-1-5" data-col="4">
	<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-4"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Mystery</h2></div></div></div>	
	<div class="row herald-posts row-eq-height ">	
    
	<?php
	foreach ($story_mystery as $story_m) {	
	?>
	<article class="herald-lay-g post-125 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-company tag-eco tag-environment-2">
<div class="row">	
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo custom_site_base()."read-".urlThis($story_m['sl_name'])."-".$story_m['sl_id'] ?>" title="Why do people think the beach is a good idea?">
				<img width="74" height="55" src="pictures/avatar.jpg" class="attachment-herald-lay-g1 size-herald-lay-g1 wp-post-image" alt="herald091" sizes="(max-width: 74px) 100vw, 74px" data-wp-pid="1230" />			</a>
		</div>
	</div>
		<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
			<div class="entry-header">
				<h2 class="entry-title h7"><a href="<?php echo custom_site_base()."read-".urlThis($story_m['sl_name'])."-".$story_m['sl_id'] ?>"><?php echo $story_m['sl_name']; ?></a></h2>
				<font size="-2">By</font><span class="meta-category meta-small"><?php echo $story_m['u_username']; ?></span>
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
	<div id="categories-3" class="widget widget_categories"><h4 class="widget-title h6"><span>Forum</span></h4><ul>
	<li class="cat-item cat-item-48"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text">Action</span><span class="count"></span></a>
	</li>
<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text">Romance</span><span class="count"></span></a>
</li>
<li class="cat-item cat-item-6"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text">Adventure</span><span class="count"></span></a>
</li>
	<li class="cat-item cat-item-3"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text">Children's Forum</span><span class="count"></span></a>
</li>
	<li class="cat-item cat-item-4"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text">Comedy</span><span class="count"></span></a>
</li>
	<li class="cat-item cat-item-3"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Crime</span><span class="count"></span></a>
</li>
<li class="cat-item cat-item-5"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text">Historical</span><span class="count"></span></a>
</li>
<li class="cat-item cat-item-7"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Horror</span><span class="count"></span></a>
</li>
<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Inspirtational</span><span class="count"></span></a>
</li>
<li class="cat-item cat-item-2"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text">Thriller</span><span class="count"></span></a>
</li>
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

	<div class="herald-mod-wrap"><div class="herald-mod-head "><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Latest Scenes</h2></div></div></div>
	
	<div class="row herald-posts row-eq-height">
	<?php foreach ($posts as $posts_o) { ?>
	<article class="herald-lay-b post-174 post type-post status-publish format-standard has-post-thumbnail hentry category-food-and">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="herald-post-thumbnail herald-format-icon-middle">
				<a href="<?php echo custom_site_base().'storylines-'.urlThis($posts_o['f_name']).'-'.$posts_o['f_id']; ?>" title="<?php $posts_o['sl_name']; ?>">
					<img width="300" height="200" src="pictures/avatar.jpg" class="attachment-herald-lay-b1 size-herald-lay-b1 wp-post-image" alt="Nextscenes"/></a>
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
					<p><?php echo utf8_encode(shorten($posts_o['ps_desc'],220)); ?></p>
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
	
		<div id="herald_posts_widget-8" class="widget herald_posts_widget">
		<h4 class="widget-title h6"><span>Facebook Feeds</span></h4>
		
		<div class="fb-page" data-href="https://www.facebook.com/nextscenes/" data-tabs="timeline" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nextscenes/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nextscenes/">Nextscenes</a></blockquote></div>
		
		</div>
		
		<div class="herald-sticky">
				<div id="mks_ads_widget-10" class="widget mks_ads_widget">			
			<ul class="mks_adswidget_ul custom">
					<li data-showind="0"><img alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" style="width: 100%;">
					</li>
			</ul>   	
		</div>			
		</div>
	</div>
			</div>
		</div>
	</div>

	<footer id="footer" class="herald-site-footer herald-slide">

					
<div class="footer-widgets container">
	<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3">
				<div id="text-3" class="widget widget_text">
				<div class="textwidget"><p><img src="imgs/logo.png" alt="Nextscenes"></p>
				<p><span style="color: #000;">Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories.
				</span></p>
				<p style="margin-top:25px"></p></div>
				</div>
				</div>
				
			
				<div class="col-lg-3 col-md-3 col-sm-3">
				<div id="text-3" class="widget widget_text">
				<div class="textwidget"><p style="color: #000;"><h5>Other Links</h5></p>
				<p style="margin-top:25px"><a href="faqs" style="color: #000;">FAQ</a></p>
				<p style="margin-top:25px"><a href="terms" style="color: #000;">Terms of Service</a></p>
				<p style="margin-top:25px"><a href="privacy" style="color: #000;">Privacy Policy</a></p>
				</div>
				</div>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3">
				<div id="text-3" class="widget widget_text">
				<div class="textwidget"><p></p>
				<p><span style="color: #000;"></span></p>
				<p style="margin-top:25px"></p></div>
				</div>
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3">
				<div id="text-3" class="widget widget_text">
				<div class="textwidget">
				<p><span style="color: #000;">
				<a class="twitter-timeline" data-height="250" href="https://twitter.com/nextscenes">Tweets by nextscenes</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</span></p>
				<p style="margin-top:25px"></p></div>
				</div>
				</div>
			
				</div>
			</div>
			</div>
		
					<div class="footer-bottom">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			
									<div class="hel-l herald-go-hor">
									<div class="herald-copyright">Copyright &copy; 2016</div>
							</div>
			
									<div class="hel-r herald-go-hor">
											<ul id="menu-herald-social-1" class="herald-soc-nav"><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1037"><a href="https://www.facebook.com/nextscenes"><span class="herald-social-name">Facebook</span></a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1038"><a href="https://twitter.com/nextscenes"><span class="herald-social-name">Twitter</span></a></li>
<li style="display:none;" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1039"><a href="https://plus.google.com/u/0/+meksHQgplus/posts"><span class="herald-social-name">Google+</span></a></li>
</ul>
</div>
			
						
		</div>
	</div>
</div>
</div>
	    
	</footer>
			<a href="javascript:void(0)" id="back-top" class="herald-goto-top"><i class="fa fa-angle-up"></i></a>
<div id="more-themes"></div><script type='text/javascript' src='wp-content/plugins/anti-spam/js/anti-spam-4.2.js'></script>
<script type='text/javascript' src='wp-content/uploads/minit/f3b0c4ea208b4e28e5ff2f493ea400fe.js'></script>
	<!-- Asynchronous scripts by Minit -->
	<script id="async-scripts" type="text/javascript">
	(function() {
		var js, fjs = document.getElementById('async-scripts'),
			add = function( url, id ) {
				js = document.createElement('script'); 
				js.type = 'text/javascript'; 
				js.src = url; 
				js.async = true; 
				js.id = id;
				fjs.parentNode.insertBefore(js, fjs);
			};
		add("wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js", "async-script-wc-add-to-cart"); add("wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js", "async-script-woocommerce"); add("wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js", "async-script-wc-cart-fragments"); 	})();
	</script>
	
	<!-- ClickDesk Live Chat Service for websites -->
<script type='text/javascript'>
var _glc =_glc || []; _glc.push('all_ag9zfmNsaWNrZGVza2NoYXRyEgsSBXVzZXJzGICAgK3ik4wJDA');
var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
'http://my.clickdesk.com/clickdesk-ui/browser/');
var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);
</script>
<!-- End of ClickDesk -->
	
</body>
</html>
