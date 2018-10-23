<?php
session_start();
require_once("../central/dbcontroller.php");
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
  $lang = "fr";
  $_SESSION['language'] =  $lang;
}
else{
	$lang = $_SESSION['language'];
}
if((isset($_GET['lang']) && $_GET['lang'] =="en") || (isset($_GET['lang']) && $_GET['lang'] =="fr")){ 
	$lang = $_GET['lang']; 
	$_SESSION['language'] =  $lang;
	//header("Location: /fr.php");
}
/*else {
	$lang = "en";
}*/ 
?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
.pic img{
	width:50px;
	height:50px;
}
.name, .detail{
	font-size:14px;
}
.latest img{
	max-height:230px;
	height:;
}
div._5lm5{
	display:none;
}
.clearfix{
	clear:both;
}
.point{
	cursor:pointer;
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
.theImg{
	height:230px;
	max-width:100%;
	overflow:hidden;
	text-align:center;
}
.theImg1{
	height:192px;
	max-width:100%;
	overflow:hidden;
	text-align:center;
}
</style>
<link rel='stylesheet' id='herald-fonts-css'  href='http://fonts.googleapis.com/css?family=Open+Sans%3A400%2C600%7CLato%3A400%2C700&amp;subset=latin%2Clatin-ext&amp;ver=1.5' type='text/css' media='all' />
<link rel='stylesheet' id='minit-96763c9c74ea00b10842fc3bd9577789-css'  href='../wp-content/uploads/minit/96763c9c74ea00b10842fc3bd9577789.css' type='text/css' media='all' />
<link rel="stylesheet" href="../central/stylee.css" type="text/css" />
<link rel="stylesheet" href="css/mod.css" type="text/css" />
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
<meta property="og:url" content="http://nextscenes.com/news/<?php echo $_REQUEST['slug'];?>" />
<meta property="og:type" content="article"/>
<meta property="article:author" content="https://www.facebook.com/nextscenes"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:site_name" content="Nextscenes"/>
<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "http://nextscenes.com",
    "name": "Nextscenes",
    "description": "A Multilingual story writing platform that allows you the reader to propose scenes"
}</script>
<style type="text/css">body.chrome { text-rendering:auto; } .herald-sticky, .herald-goto-top{ -webkit-transform: translateZ(0); transform: translateZ(0); }</style>
</head>
<body class="home page page-id-207 page-template page-template-template-modules page-template-template-modules-php chrome herald-boxed">
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
							<i class="fa fa-calendar"></i><?php echo date('M d, Y');?></span>
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
				<h1 class="site-title h1"><a href="../" rel="home"><img class="herald-logo" width="30%" src="../imgs/next-scenes_logo.png" alt="Nextscenes" ></a></h1>
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
					<?php if(empty($_SESSION['idsession'])){?>
						<li><a href="../register1"><?php echo $result3[1][$lang.'_title']; ?></a></li> <li><a href="login1"><?php echo $result3[0][$lang.'_title']; ?></a></li> 
					<?php }else{?>
						<li><a href="../account-activities"><i class="fa fa-user"></i><?php echo $_SESSION['isuser']?></a></li>
						<li><a href="../logout"><?php echo $result3[6][$lang.'_title']; ?></a></li>
						<?php }?>
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
				<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../lang.php"><?php echo $result[0][$lang.'_title']; ?></a></li>
				<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
				<a href="../forum"><?php echo $result[1][$lang.'_title']; ?></a>
				<ul class="sub-menu">
				<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-inspirational-stories-31"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
			</ul>
			</li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a <?php if($lang == 'en'){?> href="../about" <?php } ?> <?php if($lang == 'fr'){?> href="../a-propos" <?php } ?> ><?php echo $result[2][$lang.'_title']; ?></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../news2"><?php echo $result[3][$lang.'_title']; ?></a></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../new-story1"><?php echo $result[4][$lang.'_title']; ?></a></a></li>
				<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a <?php if($lang == 'en'){?> href="http://nextscenes.com/store" <?php } ?> <?php if($lang == 'fr'){?> href="http://nextscenes.com/fr/store" <?php } ?>><?php echo $result[5][$lang.'_title']; ?></a></li>
			<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../contact1"><?php echo $result[6][$lang.'_title']; ?></a></li></ul></nav>
		</div>
		<div class="hel-r">
			<ul id="menu-herald-social" class="herald-soc-nav">
				<li id="menu-item-1037" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1038"><a  <?php if($lang == 'en'){?> href="../lang.php?lang=fr" <?php } ?> <?php if($lang == 'fr'){?> href="../lang.php?lang=en" <?php } ?> ><img <?php if($lang == 'en'){?> src="http://nextscenes.com/images/fr.png" <?php } ?> <?php if($lang == 'fr'){?> src="http://nextscenes.com/fr/img/en.png" <?php } ?> <?php if($lang == 'en'){?> title="FR" <?php } ?> <?php if($lang == 'fr'){?> title="EN" <?php } ?>  alt="FRENCH" style="width:24px; height:24px;" /></a></li>	
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
					<span class="site-title h1"><a href="../" rel="home"><img class="herald-logo-mini" src="../imgs/logo.png" alt="Nextscenes" ></a></span>
				</div>
			</div>
		<div class="hel-r herald-go-hor">
		<nav class="main-navigation herald-menu">	
			<ul id="menu-herald-main-1" class="menu">
				<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../lang.php"><?php echo $result[0][$lang.'_title']; ?></a></li>
				<li id="menu-item-979" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-979">
				<a href="../forum"><?php echo $result[1][$lang.'_title']; ?></a>
				<ul class="sub-menu">
				<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-action-2"><span class="category-text"><?php echo $result2[0][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-romance-10"><span class="category-text"><?php echo $result2[12][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-adventure-3"><span class="category-text"><?php echo $result2[1][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-childrens-forum-17"><span class="category-text"><?php echo $result2[2][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-comedy-6"><span class="category-text"><?php echo $result2[3][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text"><?php echo $result2[4][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-crime-4"><span class="category-text"><?php echo $result2[5][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-horror-8"><span class="category-text"><?php echo $result2[6][$lang.'_title']; ?></span><span class="count"></span></a></li>
											<li id="menu-item-980" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-980"><a href="http://nextscenes.com/storylines-inspirational-stories-31"><span class="category-text"><?php echo $result2[8][$lang.'_title']; ?></span><span class="count"></span></a></li>
			</ul>
			</li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a <?php if($lang == 'en'){?> href="../about" <?php } ?> <?php if($lang == 'fr'){?> href="../a-propos" <?php } ?> ><?php echo $result[2][$lang.'_title']; ?></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../news2"><?php echo $result[3][$lang.'_title']; ?></a></a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../new-story1"><?php echo $result[4][$lang.'_title']; ?></a></a></li>
				<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a <?php if($lang == 'en'){?> href="http://nextscenes.com/store" <?php } ?> <?php if($lang == 'fr'){?> href="http://nextscenes.com/fr/store" <?php } ?>><?php echo $result[5][$lang.'_title']; ?></a></li>
			<li id="menu-item-990" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../contact1"><?php echo $result[6][$lang.'_title']; ?></a></li>
			</ul>	
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
				<span class="site-title h1"><a href="../" rel="home"><img class="herald-logo-mini" src="../imgs/logo.png" alt="NextScenes" ></a></span>
			</div>	
		</div>
	</div>
	<div class="herald-mobile-nav herald-slide hidden-lg hidden-md">
		<ul id="menu-herald-main-2" class="herald-mob-nav">
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../">Home</a></li>
			<li id="menu-item-978" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../forums">Forum</a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../how-nextscenes-works">How it works</a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../discussions">Discussions</a></li>
			<?php if(empty($_SESSION['idsession'])){?>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../login">Login/Register</a></li>
			<?php }else{?>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../account-activities">User Area</a></li>
			<li id="menu-item-991" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../logout">Sign out</a></li>
			<?php }?>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../news">Blog</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../new-story1">Create New Story</a></li>
			<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-990"><a href="../contact">Contact</a></li>
		</ul>
	</div>
	<div style="">
		<?php $db->setTraffic();?>
	</div>
	<div id="content" class="herald-site-content herald-slide">		