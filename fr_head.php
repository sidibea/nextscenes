<?php
session_start();
require_once("central/dbcontroller.php");


$db_handle = new DBController();

$query = "select * from menu_lang";
$result = $db_handle->runQuery($query);

$forums = "select * from forums_lang";
$result2 = $db_handle->runQuery($forums);

$query2 = "select * from ns_lang";
$result3 = $db_handle->runQuery($query2); 

$query_info = "select * from ns_infos";
$infos = $db_handle->runQuery($query_info);  

$query_forums_desc = "select * from forums_desc";
$forums_desc = $db_handle->runQuery($query_forums_desc); 


?>
<?php
// include language configuration file based on selected language
$lang = "";
if (!isset($_SESSION['language'])) {
  $lang = "en";
  $_SESSION['language'] =  $lang;
  $posts = getPosts(1);
}
else{
	$lang = $_SESSION['language'];
	$posts = getPosts(1);
}
if((isset($_GET['lang']) && $_GET['lang'] =="en") || (isset($_GET['lang']) && $_GET['lang'] =="fr")){ 
	$lang = $_GET['lang']; 
	$_SESSION['language'] =  $lang;
	$posts = getPosts(1);
	//header("Location: /fr.php");
}
/*else {
	$lang = "en";
}*/ 
?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>
<style type="text/css">
img.wp-smiley,img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
.carousel-caption {
	text-align:left;
}
.rom{
	background:#8bc34a;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.crm{
	background:#f06292;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.mys{
	background:#ffa726;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.com{
	background:#ffa726;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.act{
	background:#009688;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.adv{
	background:#ba68c8;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.hist{
	background:#f44336;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.hor{
	background:#2196f3;
	display:inline;
	color:#FFF;
	padding:10px;
	font-weight:700;
	font-size:16px;
}
.sc{
	color:#999;
	font-style:italic;
}
.cc{
	color:#ffa726;
}
.hh{
	color:#2196f3;
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 0px;
    margin-bottom: 0px;
}
._5lm5{
	display:none;
}
.glyphicon-refresh-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
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
<meta property="og:title" content="Nextscenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>"/>
<meta property="og:description" content="NextScenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>"/>
<meta name="twitter:domain" content="nextscenes.com"/>
<meta name="twitter:title" content="Nextscenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>"/>
<meta name="twitter:description" content="Nextscenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>"/>
<meta name="twitter:creator" content="https://twitter.com/nextscenes"/>
<meta name="twitter:card" content="summary"/>
<meta itemprop="url" content="http://www.nextscenes.com"/>
<meta itemprop="name" content="Nextscenes"/>
<meta itemprop="description" content="Nextscenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>" />
<meta name="description" content="Nextscenes - <?php if(!empty($prop['sl_name'])){echo utf8_encode($prop['sl_name']);}elseif(!empty($story['sl_name'])){echo utf8_encode($story['sl_name']);}elseif(!empty($scene['f_name'])){echo utf8_encode($scene['f_name']);}else{echo "Nextscenes® is an online multilingual platform for creative writing, where writers allow readers to help them propose the next scene of a story or write their own stories";}?>" />
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

<body class="home page page-id-207 page-template page-template-template-modules page-template-template-modules-php chrome herald-boxed preventcopy">
	<header id="header" class="herald-site-header">
		<!--<div class="header-top hidden-xs hidden-sm">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">					
						<div class="hel-l">
						<nav class="secondary-navigation herald-menu">	
						<span class="fb-like" data-href="http://www.nextscenes.com" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></span> <?php if(isset($_SESSION['idsession'])){echo "<span> || Logged In As: ".$_SESSION['isuser']."</span>";}?>
						<ul id="menu-herald-secondary-1" class="menu">
						</ul>
						</nav>
						</div>	
						<div class="hel-r">
							<span class="herald-calendar">
							<i class="fa fa-calendar"></i><?php //echo date('M d, Y');?></span>
						</div>				
					</div>
				</div>
			</div>
		</div>-->
		<div class="header-middle herald-header-wraper hidden-xs hidden-sm">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 hel-el">
						<div class="hel-l herald-go-hor">
							<div class="site-branding">
								<h1 class="site-title h1"><a href="lang.php" rel="home"><img class="herald-logo" width="30%" src="http://nextscenes.com/imgs/next-scenes_logo.png" alt="Nextscenes" ></a></h1>
							</div>
						</div>
						<div class="hel-r herald-go-hor">
							<div class="herald-ad c_tiptop">
								<!--<div id="google_translate_element" class="col-md-6 col-sm-6 col-xs-12">
									<script type="text/javascript">
										function googleTranslateElementInit() {
										 new google.translate.TranslateElement({pageLanguage: "en", includedLanguages:"en,es,fr", layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: "UA-79838128-1"}, "google_translate_element");
										}
									</script>
									<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
								</div>-->
								<div  class="col-md-6 col-sm-6 col-xs-12">
									
								</div>
								<ul class="col-md-6 col-sm-6 col-xs-12"> 
								<?php 
											if(!empty($result3)){ 							
										?>
								<?php if(empty($_SESSION['idsession'])){?>
										
									<li><a href="register1"><?php echo $result3[1][$lang.'_title']; ?></a></li> <li><a href="login1"><?php echo $result3[0][$lang.'_title']; ?></a></li> 
								<?php }else{?>
									<!--<li><a href="account-activities">User Area <i class="fa fa-user"></i><?php //echo $_SESSION['isuser']?></a></li>-->
									<li><a href="account-activities1"><i class="fa fa-user"></i><?php echo $_SESSION['isuser'];?></a></li>
									<li><a href="logout1"><?php echo $result3[6][$lang.'_title']; ?></a></li>
								<?php }}?>
								</ul>
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
								<?php 
								if(!empty($result)){ 
									
							?>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="lang.php"><?php echo $result[0][$lang.'_title']; ?></a></li>
									<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
										<a href="forum"><?php echo $result[1][$lang.'_title']; ?></a>
										<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
										<ul class="sub-menu">
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-action-2"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-romance-10"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-adventure-3"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-childrens-forum-17"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-comedy-6"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-4"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-4"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-horror-8"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-inspirational-stories-31"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
										</ul>
										<?php } else { ?>
											<ul class="sub-menu">
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-action-18"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-romance-27"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-adventure-39"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-childrens-forum-45"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-comedy-41"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-20"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-historical-42"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-horror-43"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-inspirational-stories-47"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
										</ul>
										<?php } ?>
									</li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="about" ><?php echo $result[2][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="news2"><?php echo $result[3][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="cover1"><?php echo $result[4][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a <?php if($lang == 'en'){?> href="http://nextscenes.com/store" <?php } ?> <?php if($lang == 'fr'){?> href="http://nextscenes.com/fr/store" <?php } ?>><?php echo $result[5][$lang.'_title']; ?></a></li>
									<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact1"><?php echo $result[6][$lang.'_title']; ?></a></li></ul></nav>
								<?php 	
									} 
								
							?>
								</ul>
							</nav>
						</div>
						<div class="hel-r">
							<ul id="menu-herald-social" class="herald-soc-nav">
								<li id="menu-item-1037" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1038"><a  <?php if($lang == 'en'){?> href="lang.php?lang=fr" <?php } ?> <?php if($lang == 'fr'){?> href="lang.php?lang=en" <?php } ?> ><img <?php if($lang == 'en'){?> src="http://nextscenes.com/images/fr.png" <?php } ?> <?php if($lang == 'fr'){?> src="http://nextscenes.com/fr/img/en.png" <?php } ?> <?php if($lang == 'en'){?> title="FR" <?php } ?> <?php if($lang == 'fr'){?> title="EN" <?php } ?>  alt="FRENCH" style="width:24px; height:24px;" /></a></li>
								<li id="menu-item-1037" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1037"><a href="https://www.facebook.com/nextscenes"><span class="herald-social-name">Facebook</span></a></li>
								<li id="menu-item-1038" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1038"><a href="https://twitter.com/nextscenes"><span class="herald-social-name">Twitter</span></a></li>							
							</ul>
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
								<span class="site-title h1"><a href="." rel="home"><img class="herald-logo-mini" src="http://nextscenes.com/imgs/logo.png" alt="Nextscenes" ></a></span>
							</div>
							
						</div>
						<div class="hel-r herald-go-hor">
							<nav class="main-navigation herald-menu">	
								<ul id="menu-herald-main-1" class="menu">
									<?php 
								if(!empty($result)){ 
									
							?>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="lang.php"><?php echo $result[0][$lang.'_title']; ?></a></li>
									<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
										<a href="forums"><?php echo $result[1][$lang.'_title']; ?></a>
										<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
										<ul class="sub-menu">
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-action-2"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-romance-10"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-adventure-3"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-childrens-forum-17"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-comedy-6"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-4"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-4"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-horror-8"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-inspirational-stories-31"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
										</ul>
										<?php } else { ?>
											<ul class="sub-menu">
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-action-18"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-romance-27"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-adventure-39"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-childrens-forum-45"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-comedy-41"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-crime-20"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-historical-42"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-horror-43"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines1-inspirational-stories-47"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
										</ul>
										<?php } ?>
									</li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="a-propos"><?php echo $result[2][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="news"><?php echo $result[3][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="cover"><?php echo $result[4][$lang.'_title']; ?></a></li>
									<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="http://nextscenes.com/store"><?php echo $result[5][$lang.'_title']; ?></a></li>
									<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact"><?php echo $result[6][$lang.'_title']; ?></a></li></ul></nav>
								<?php 	
									} 
								
							?>
								</ul>	
							</nav>
						</div>
						<div class="hel-l herald-go-hor">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	<div id="herald-responsive-header" class="herald-responsive-header herald-slide hidden-lg hidden-md">
		<div class="container">
			<div class="herald-nav-toggle"><i class="fa fa-bars"></i></div>
			<div class="site-branding mini">
				<span class="site-title h1"><a href="." rel="home"><img class="herald-logo-mini" src="imgs/logo.png" alt="NextScenes" ></a></span>
				
			</div>
			<div class="langue">
				
					<a  <?php if($lang == 'en'){?> href="lang.php?lang=fr" <?php } ?> <?php if($lang == 'fr'){?> href="lang.php?lang=en" <?php } ?> ><img <?php if($lang == 'en'){?> src="images/fr.png" <?php } ?> <?php if($lang == 'fr'){?> src="fr/img/en.png" <?php } ?> title="NEXTSCENES ANGLAIS" alt="FRENCH" style="width:24px; height:24px;" /></a>

				
			</div>
		</div>
	</div>
	<div class="herald-mobile-nav herald-slide hidden-lg hidden-md">
		<ul id="menu-herald-main-2" class="herald-mob-nav">
			<?php 
								if(!empty($result)){ 
									
							?>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="."><?php echo $result[0][$lang.'_title']; ?></a></li>
			<li id="menu-item-978" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="forum"><?php echo $result[1][$lang.'_title']; ?></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="about"><?php echo $result[2][$lang.'_title']; ?></a></li>
			<?php if(empty($_SESSION['idsession'])){?>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="login1"><?php echo $result3[0][$lang.'_title']; ?></a></li>
			<?php }else{?>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="account-activities1"><?php echo $result3[40][$lang.'_title']; ?></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="logout1"><?php echo $result3[6][$lang.'_title']; ?></a></li>
			<?php }?>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="news2"><?php echo $result[3][$lang.'_title']; ?></a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="cover1"><?php echo $result[4][$lang.'_title']; ?></a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="http://nextscenes.com/store"><?php echo $result[5][$lang.'_title']; ?></a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="contact1"><?php echo $result[6][$lang.'_title']; ?></a></li>
		<?php 	
									} 
								
							?>
		</ul>
	</div>
	<div style="display:none;">
		<?php
			date_default_timezone_set("Africa/Lagos");
			$date = date('Y-m-d');
			$s0 = mysql_query("SELECT * FROM ttraffic");
			$s1 = mysql_query("SELECT * FROM ttraffic WHERE date=\"$date\"");
			if(mysql_num_rows($s1)>0){
				mysql_query("UPDATE ttraffic SET count=count+1 WHERE date=\"$date\"");
			}else{
				mysql_query("INSERT INTO ttraffic(date, count)VALUES(\"$date\", \"1\")");
			}
			$user_ip = getenv('REMOTE_ADDR');
			$url = "http://www.geoplugin.net/php.gp?ip=".$user_ip;
			//	echo url_get_contents($url);
			//	$geo = var_export(unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$user_ip)));
			$country = $geo["geoplugin_countryName"];
			$sq1 = mysql_query("SELECT * FROM tcountry WHERE name=\"$country\" && date=\"$date\"");
			if(mysql_num_rows($sq1)>0){
				//mysql_query("UPDATE tcountry SET hits=hits+1 WHERE name=\"$country\" && date=\"$date\"");
			}else{
				//mysql_query("INSERT INTO tcountry(name, hits, date)VALUES(\"$country\", \"1\", \"$date\")");
			}
			$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
			if($ref == ""){
				$ref = "Annonymous";
			}
			$ref1 = mysql_query("SELECT * FROM refs WHERE name=\"$ref\" && date=\"$date\"");
			if(mysql_num_rows($ref1) > 0){
				mysql_query("UPDATE refs SET hits=hits+1 WHERE name=\"$ref\" && date=\"$date\"");
			}else{
				mysql_query("INSERT INTO refs(name, hits, date)VALUES(\"$ref\", \"1\", \"$date\")");
			}
		?>
	</div>
	<div id="content" class="herald-site-content herald-slide">		