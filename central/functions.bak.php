<?php
//error_reporting(E_ALL);
//ini_set("display_serrors", 1);
session_start();
require "sitebase.php";
if(!$db_auth){
	require "db_auth.php";
}
function bot_detected() {
  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
    $_SESSION['idsession'] = 000001;
  }
  else {
    //return FALSE;
  }
}
function query($sql){
	return mysql_query($sql);
}
function fetch_array($query){
	return mysql_fetch_array($query);
}
function num_rows($query){
	return mysql_num_rows($query);
}
require_once __DIR__ . '/Facebook/autoload.php';
if(isset($_GET['lang'])){
	$_SESSION['language_session'] = $_GET['lang'];
	if($_GET['lang'] == "fr"){
		setlocale(LC_TIME, "fr_FR");
	}
	header("Location: /home");
	exit;
}
function salt(){
	$data = "c_=xPf3PL%2342Qv|=xPf3PL@#&s$^&=xPf3PL%2b342542AoFc=m6s%2AZN";
	return $data;
}
function getPosts($the_page){
	if(!$the_page || !is_numeric($the_page)){
		$pager = 1;
	}
	else{
		$pager = $the_page;
	}
	global $db_auth;
	$query = "(SELECT ps_id AS the_main_id, ps_ts, ps_desc, ps_scene, ps_status, c_proposed_scenes.c_users_u_id, c_storylines_sl_id, f_id, f_name, u_avatar, u_username, sl_id, sl_name, sl_views, 'yes' AS proposed_or_not FROM c_proposed_scenes
INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
INNER JOIN c_users ON c_users.u_id = c_proposed_scenes.c_users_u_id";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '1'";
	}
	else{
		$query .= "
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '2'";
	}
	$query .= ")
	UNION
(SELECT vs_id AS the_main_id, vs_ts, vs_desc, vs_scene, '1' AS vs_status, c_valid_scenes.c_users_u_id, c_storylines_sl_id, f_id, f_name, u_avatar, u_username, sl_id, sl_name, sl_views, 'no' AS proposed_or_not FROM c_valid_scenes
INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
INNER JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '1'";
	}
	else{
		$query .= "
	INNER JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
	WHERE c_forums.c_languages_l_id = '2'";
	}
	$query .= "
)";
	
	$query .= "
	ORDER BY the_main_id DESC";
	
	if($pager > 1){
		$query .= "
	LIMIT ".(($pager*10)-10).", 10";
	}
	else{
		$query .= "
	LIMIT 10";
	} 
	$result = mysql_query($query, $db_auth);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer;
	}
	return $data;
}
function countPosts($page){
	global $db_auth;
	$query = "SELECT COUNT(ps_id) AS the_count FROM c_proposed_scenes
INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id";
	$result = mysql_query($query, $db_auth);
	$answer = mysql_fetch_assoc($result);
	$data = $answer['the_count'];
	return $data;
}
function getForums($page){
	global $db_auth;
	$query = "SELECT * FROM c_forums
	LEFT JOIN (SELECT COUNT(sl_id) AS story_count, c_forums_f_id FROM c_storylines
	GROUP BY c_forums_f_id) dd ON dd.c_forums_f_id = c_forums.f_id";
	//WHERE storylines > 0";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	WHERE c_languages_l_id='1'";
	}
	else{
		$query .= "
	WHERE c_languages_l_id='2'";
	}
	$query .= "
ORDER BY f_name ASC";
	$result = mysql_query($query, $db_auth);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer;
	}
	return $data;
}
function getInfo($id){
	$query = "SELECT * FROM data WHERE Iddata='".mysql_real_escape_string($id)."'" ; 
	$result = mysql_query($query);
	$answer = mysql_fetch_assoc($result);
	$data = $answer;
	return $data;	
}
function shorten($text,$chars) { 
    $length = strlen($text); 
    $text = strip_tags($text);  
    $text = substr($text,0,$chars); 
    if($length > $chars) { $text = $text."..."; } 
    return $text; 

}
function shortenEnd($text,$chars) { 
    $length = strlen($text); 
    $text = strip_tags($text);  
    $text = substr($text,-$chars); 
    if($length > $chars) { $text = "...".$text; } 
    return $text; 

}
function getImgStyle($img){
	list($width, $height) = getimagesize($img);
	$ar = $width/$height;
	if($ar == 1){
		$data = "img_is_square";
	}
	else{
		if($ar > 1){
			$data = "img_is_wide";
		}
		else{
			$data = "img_is_long";
		}
	}
	return $data;
}
function siteName(){
	$data = "NextScenes";
	return $data;
}
function siteLink(){
	$data = "http://nextscenes.com";
	return $data;
}
function common_top($page){
	if($page == "home"){
		$title = "Welcome to ".siteName()."&reg;  – A multilingual, web-based, creative writing platform : Literary Entertainment.";
	}
	else if($page == "forums"){
		$title = "".siteName()." - All Forums, Stories in different genres.";
	}
	else if($page == "manage") {
		$title = "Manage My Account - ".siteName();
	}
	$data = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html dir=\"ltr\" xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<meta name=\"google-site-verification\" content=\"EQ7FjvLebh7jR887JBN1p5f2d4oGsqJI1Pq81AE-IzI\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\" />
<title>".$title."</title>
<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/zebra.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/dr-framework.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/navigation.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/revslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/jquery.bxslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/responsive.css\" type=\"text/css\" media=\"screen\">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<script src=\"ckeditor/ckeditor.js\"></script>
<!-- <link rel=\"stylesheet\" href=\"ckeditor/samples/sample.css\"> -->

<link rel=\"stylesheet\" href=\"central/stylee.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"central/lemonade.css\" type=\"text/css\" media=\"screen\">
<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"central/sociallogin.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"central/jquery.image-scale.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"central/jquery.bxslider.min.js\" language=\"javascript\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css\"/>
<script type=\"text/javascript\" src=\"//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js\"></script>
<script src=\"central/jquery.star-rating-svg.min.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"central/star-rating-svg.css\">

<script type=\"text/javascript\" language=\"javascript\">
$(document).ready(function (){
	$('.bxslider').bxSlider({
		mode: 'fade',
		touchEnabled : true,
		controls: true,
		pager: false,
		captions: false,
		pause: 6000,
		auto: true
	});
	$('.extra_scenes').slick({
		dots: true,
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 4,
			slidesToScroll: 4,
			infinite: true,
			dots: true
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
		]
	});
    
    function moveLeft() {
        $('.c_screen').animate({
            left: + slideWidth
        }, 200, function () {
            $('.c_screen .c_box:last-child').prependTo('.c_screen');
            $('.c_screen').css('left', '');
        });
    };
    
    function moveRight() {
        $('.c_screen').animate({
            left: - slideWidth
        }, 200, function () {
            $('.c_screen .c_box:first-child').appendTo('.c_screen');
            $('.c_screen').css('left', '');
        });
    };
    
	$(document).on(\"click\", function(e){
		var clickedAnchor = $(e.target);
		var fullResp;
		var theHandle;
		var theHandlex;
		var theHandley;
		if(clickedAnchor.is(\".mobile_menu_open\")){
			$('.mobile_menu_open').hide();
			$('.mobile_menu_close').show();
			$('.mobile_menu_option').slideDown();
		}
		else if(clickedAnchor.is(\".mobile_menu_close\")){
			$('.mobile_menu_close').hide();
			$('.mobile_menu_open').show();
			$('.mobile_menu_option').slideUp();
		}
		else if(clickedAnchor.is(\".c_screen_control\") || clickedAnchor.is(\".c_screen_control_left\")){
			$('.c_box__initial_set').toggle();
			$('.c_screen_holder').toggleClass('fluid');
			$('.c_screen').toggleClass('fluid');
		}
	});
	";
	$data .= "
	
});
</script>

</head>";
	return $data;
}
function getUser($page){
	global $db_auth;
	$query = "SELECT * FROM c_users WHERE u_session='".mysql_real_escape_string($_SESSION['idsession'])."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function topNav($page){	
	$data = "
<div class=\"w100p c_tiptop\">
	<div class=\"main\">
    	<ul>";        	
			if(empty($_SESSION['idsession'])){
				$data .= "
			<li><span>Welcome to <strong>".siteName()."&reg;</strong>  – A multilingual, web-based, creative writing platform</span></li>";
			}
			else{
				$user = getUser();
				if ($user['Account'] == 'Regular' ){
					if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
						$data .= "
			<li><span>".$user['Login'].", you are a <strong>".$user['Account']."</strong> user, you cannot write scenes.</span></li>";
					}
					else{
						$data .= "
			<li><span>".$user['Login'].", vous êtes une <strong>".$user['Account']."</strong> utilisateur, vous ne pouvez pas écrire des scènes.</span></li>";
					}
				}
				else if($user['Account'] == 'Power'){
					if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
						$data .= "
			<li><span>".$user['Login'].", you are a <strong>".$user['Account']."</strong> user, you can write scenes on all forums.</span></li>";
					}
					else{
						$data .= "
			<li><span>".$user['Login'].", vous êtes une <strong>".$user['Account']."</strong> utilisateur, vous ne pouvez pas écrire des scènes.</span></li>";
					}
				}
			}
			$data .= "
        </ul>";
		if(empty($_SESSION['idsession'])) {
			$data .= "
		<ul>";
			if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "
				<div id=\"google_translate_element\"></div><script type=\"text/javascript\">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-79838128-1'}, 'google_translate_element');
				}
				</script><script type=\"text/javascript\" src=\"//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>
				
				<!-- <li><a href=\"/".custom_site_base()."home?lang=fr\">FR</a></li> -->
				<li><a href=\"/".custom_site_base()."register\">Sign up</a></li>
				<li><a href=\"/".custom_site_base()."login\">Log in</a></li>
				
				";
			}
			else{
			$data .= "
				<li><a href=\"/".custom_site_base()."home?lang=en\">EN</a></li>
				<li><a href=\"/".custom_site_base()."register\">Nouveau membre? S'inscrire</a></li>
				<li><a href=\"/".custom_site_base()."login\">S'identifier</a></li>";
			}
			$data .= "
		</ul>";
		}
		else{
			$data .= "
		<ul>";
			if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "
				
				<div id=\"google_translate_element\"></div><script type=\"text/javascript\">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-79838128-1'}, 'google_translate_element');
				}
				</script><script type=\"text/javascript\" src=\"//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>			
			
				<li><a href=\"/".custom_site_base()."home?lang=fr\">FR</a></li>";
			}
			else{
			$data .= "
				<li><a href=\"/".custom_site_base()."home?lang=en\">EN</a></li>";
			}
			$data .= "			
				<li><a href=\"manage-account\">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Manage your account";
				}
				else{
					$data .= "Gérer son compte";
				}
				$data .= "</a></li>
				<li><a href=\"/".custom_site_base()."logout\">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Sign out";
				}
				else{
					$data .= "Se déconnecter";
				}
				$data .= "</a></li>
		</ul>";
		}
		$data .= "
        <div class=\"clear\"></div>
    </div>
</div>
<div class=\"w100p\">
	<div class=\"main\">
    	<ul class=\"nav\">
        	<span>
                <li><a href=\"/".custom_site_base()."\"><img src=\"/".custom_site_base()."central/next-scenes_logo.jpg\" alt=\"\" class=\"c_logo\"></a><div class=\"mobile_menu mobile_menu_open hide\"></div><div class=\"mobile_menu mobile_menu_close hide\"></div></li>
            </span>
            <span class=\"mobile_menu_option\">
                <li><a href=\"/".custom_site_base()."home\""; if($page == "home"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Home";
				}
				else{
					$data .= "Accueil";
				}
				$data .= "</a></li>
                <li><a href=\"/".custom_site_base()."forums\""; if($page == "forums"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Forums";
				}
				else{
					$data .= "Forums";
				}
				$data .= "</a></li>
                <li><a href=\"/".custom_site_base()."principle\""; if($page == "principle"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Principle";
				}
				else{
					$data .= "Principes";
				}
				$data .= "</a></li>
                <li><a href=\"/".custom_site_base()."howitworks\""; if($page == "how"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "How It Works";
				}
				else{
					$data .= "Comment Ça Marche";
				}
				$data .= "</a></li>
            </span>
        	<span class=\"mobile_menu_option\">
                <li><a href=\"#\" class=\"search_click_button"; if($page == "search"){ $data .= " selected"; } $data .= "\">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Search";
				}
				else{
					$data .= "Chercher";
				}
				$data .= "</a></li>
                <li><a href=\"/".custom_site_base()."faqs\""; if($page == "faqs"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "FAQs";
				}
				else{
					$data .= "FAQs";
				}
				$data .= "</a></li>
                <li><a href=\"/discussions/\">Discussions</a></li>
                <li><a href=\"/".custom_site_base()."contact\""; if($page == "contact"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Contact Us";
				}
				else{
					$data .= "Contactez-Nous";
				}
				$data .= "</a></li>
            </span>
			
        	
			
			
        	<span>
                <li>";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= date("l, j F Y");
				}
				else{
					$data .= ucwords(strftime("%A, %e %B %Y"));
				}
				
				$data .= "
				</li>
                <li>
                	<a class=\"social social_fb\" target=\"_blank\" href=\"https://www.facebook.com/nextscenes\" title=\"Join us on Facebook\">Facebook</a>
                	<a class=\"social social_tw\" target=\"_blank\" href=\"https://twitter.com/nextscenes\" title=\"Follow us on Twitter\">Twitter</a>
                	<a class=\"social social_gp\" target=\"_blank\" href=\"https://plus.google.com/104343619491056936695\" title=\"Join our Google+ community\">Google+</a>
                	<!-- <a class=\"social social_li\" target=\"_blank\" href=\"aaa\" title=\"Network with us on Linkedin\">Linkedin</a> -->
                </li>
            </span>
            <div class=\"clear\"></div>
        </ul>
    </div>
</div>";
	return $data;
}
function side2(){
	$data = '
	<div class="herald-sidebar col-lg-3 col-md-3 herald-sidebar-right">
		<div id="herald_posts_widget-8" class="widget herald_posts_widget">
		<h4 class="widget-title h6 herald-cat-7"><span>Facebook Feeds</span></h4>
		<div class="fb-page" data-href="https://www.facebook.com/nextscenes/" data-tabs="timeline" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nextscenes/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nextscenes/">Nextscenes</a></blockquote></div>
		</div>
		
	<div id="herald_posts_widget-8" class="widget herald_posts_widget">
		<h4 class="widget-title h6 herald-cat-7"><span>Twitter Feeds</span></h4>
		<p><span style="color: #000;">
			<a class="twitter-timeline" data-height="250" href="https://twitter.com/nextscenes">Tweets by nextscenes</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</span></p>
		<p style="margin-top:25px"></p>
	</div>
	<div id="herald_posts_widget-8" class="widget herald_posts_widget">
		<h4 class="widget-title h6 herald-cat-7"><span>Update!!!</span></h4>
		<img src="" class="imgs" />
	</div>
		<div class="herald-sticky">
			<div id="mks_ads_widget-10" class="widget mks_ads_widget">			
			<ul class="mks_adswidget_ul custom">
				<li data-showind="0"><img alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" style="width: 100%;">
				</li>
			</ul>   	
		</div>			
		</div>
	</div>';
	return $data;
}
function footer($page, $extras){
	$user = getUser();
	$data = "
	</div>
<div class=\"w100p c_footer\">
	<div class=\"main\">
        <ul class=\"oul\">
            <li><a href=\"/".custom_site_base()."terms\">Terms of use</a></li>
            <li><a href=\"/".custom_site_base()."privacy\">Privacy</a></li>
            <li>Copyright &copy; ".date("Y")." NextScenes, All Rights Reserved.</li>
            <span class=\"clear\"></span>
        </ul>
        <div class=\"clear\"></div>
    </div>
</div>    
<noscript><iframe src=\"http://www.googletagmanager.com/ns.html?id=GTM-KFC59B\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='http://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KFC59B');</script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
<script type=\"text/javascript\" src=\"http://www.nextscenes.com/central/sociallogin.js\" language=\"javascript\"></script>
<script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\"></script>
<script src=\"http://www.nextscenes.com/rateus.js\"></script>
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
<a href=\"javascript:void(0)\" id=\"back-top\" class=\"herald-goto-top\"><i class=\"fa fa-angle-up\"></i></a>
<script type='text/javascript' src='wp-content/plugins/anti-spam/js/anti-spam-4.2.js'></script>
<script type='text/javascript' src='wp-content/uploads/minit/f3b0c4ea208b4e28e5ff2f493ea400fe.js'></script>

	<!-- Asynchronous scripts by Minit -->

	<script id=\"async-scripts\" type=\"text/javascript\">
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
		add('wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js', 'async-script-wc-add-to-cart'); add('wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js', 'async-script-woocommerce'); add('wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js', 'async-script-wc-cart-fragments');
	});</script>";
	$data .="
<script type=\"text/javascript\" src=\"js/script.js\"></script>
<script type=\"text/javascript\" src=\"js/zebra_datepicker.js\"></script>
<script type=\"text/javascript\" src=\"js/core.js\"></script>
";
	return $data;
}
function side($page) {
	$data = "
	
	<div class=\"fb-page\" data-href=\"https://www.facebook.com/nextscenes/\" data-tabs=\"timeline\" data-width=\"500\" data-small-header=\"false\" data-adapt-container-width=\"true\" data-hide-cover=\"false\" data-show-facepile=\"true\"><blockquote cite=\"https://www.facebook.com/nextscenes/\" class=\"fb-xfbml-parse-ignore\"><a href=\"https://www.facebook.com/nextscenes/\">Nextscenes</a></blockquote></div>
	
<div class=\"trighta\" former-class=\"tright\">
	<div class=\"c_spacer\">
		<!-- <img src=\"images/ns300x250.jpg\" alt=\"\"> -->
	</div>
	";
	$new = newMembers();
	if($new != 0){
		$data .= "
		<h3 class=\"h3\">";
		if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "Latest members";
		}
		else{
			$data .= "Derniers membres";
		}
		$data .= "</h3>
		<div class=\"tab_like\">";
		foreach ($new as $new_o){
			$imgstylex = getImgStyle("".$new_o['u_avatar']);
			if(!empty($new_o['u_avatar'])){
				$avatar = "<img src=\"".$new_o['u_avatar']."\"/>";
			}
			else{
				$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
			}
			$data .= "
			<div class=\"holdem\">
				<div class=\"avatar_holder\">
					<div class=\"avatar_holder_main\">
						<div class=\"c_avatar ".$imgstylex."\">
							".$avatar."
						</div>
					</div>
					<div class=\"avatar_text\">
						<h4>".stripslashes(htmlspecialchars_decode($new_o['u_username']))."</h4>
						<h5>";
						if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
							$data .= "Registered";
						}
						else{
							$data .= "Inscrit";
						}
						$data .= ": ".$new_o['u_ts']."</h5>
					</div>
				</div>
			</div>";
		}
		$data .= "
		</div>";
	}
	$data .= "
</div>
<div style=\"width:100%; overflow: hidden;\">
	<a href='https://play.google.com/store/apps/details?id=com.ginco.nextscenes&utm_source=global_co&utm_medium=prtnr&utm_content=Mar2515&utm_campaign=PartBadge&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style=\"width: 100%;\"/></a>
</div>
<div class=\"clear\"></div>";
	return $data;
}
function getForumStories($id, $page) {
	if(!$page || !is_numeric($page)){
		$pager = 1;
	}
	else{
		$pager = $page;
	}
	global $db_auth;
	$query = "SELECT * FROM c_storylines
		INNER JOIN (
			SELECT MIN(vs_id) AS min_vs_id, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id) idd 
				ON idd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN ( 
			SELECT COUNT(vs_id) AS validated_scenes_count, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id
			) iddd ON iddd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN (
			SELECT COUNT(ps_id) AS proposed_scenes_count, c_storylines_sl_id FROM c_proposed_scenes
			GROUP BY c_storylines_sl_id
			) idx ON idx.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
		WHERE c_forums_f_id = '".mysql_real_escape_string($id)."'";
	
	$query .= "
	ORDER BY sl_id DESC";
	
	if($pager > 1){
		$query .= "
	LIMIT ".(($pager*10)-10).", 10";
	}
	else{
		$query .= "
	LIMIT 10";
	}
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: /forums');
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;	
}


function getForumStorieshome($id, $page) {
	if(!$page || !is_numeric($page)){
		$pager = 1;
	}
	else{
		$pager = $page;
	}
	global $db_auth;
	$query = "SELECT * FROM c_storylines
		INNER JOIN (
			SELECT MIN(vs_id) AS min_vs_id, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id) idd 
				ON idd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN (
			SELECT COUNT(vs_id) AS validated_scenes_count, c_storylines_sl_id FROM c_valid_scenes
			GROUP BY c_storylines_sl_id
			) iddd ON iddd.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN (
			SELECT COUNT(ps_id) AS proposed_scenes_count, c_storylines_sl_id FROM c_proposed_scenes
			GROUP BY c_storylines_sl_id
			) idx ON idx.c_storylines_sl_id = c_storylines.sl_id
		LEFT JOIN c_users ON c_users.u_id = c_storylines.c_users_u_id
		WHERE c_forums_f_id = '".mysql_real_escape_string($id)."'";
	$query .= "
	ORDER BY sl_id DESC LIMIT 0, 6";
	$result = mysql_query($query, $db_auth);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer;
	}
	/*
	if($pager > 1){
		$query .= "
	LIMIT ".(($pager*10)-10).", 10";
	}
	else{
		$query .= "
	LIMIT 10";
	}
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: /forums');
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}*/
	return $data;	
}



function countForumStories($id){
	global $db_auth;
	$query = "SELECT COUNT(sl_id) AS the_count FROM c_storylines
		WHERE c_forums_f_id = '".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer['the_count'];
	}
	return $data;
}
function updateStorylineViews($id){
	global $db_auth;
	$query = "UPDATE c_storylines SET sl_views = sl_views+1
		WHERE sl_id = '".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
}
function getStory($id){
	global $db_auth;
	$query = "SELECT * FROM c_storylines
	LEFT JOIN (SELECT (MAX(vs_scene)+1) AS latest_scene, c_storylines_sl_id
		FROM c_valid_scenes
		WHERE c_storylines_sl_id ='".mysql_real_escape_string($id)."'
		) mss ON mss.c_storylines_sl_id = c_storylines.sl_id
	WHERE sl_id ='".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: /forums');
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function getScene($group, $id){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type, Forum AS forum_name, scenes_valides.scenes AS scene_number FROM scenes_valides
		INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
		WHERE scenes_valides.id = '".mysql_real_escape_string($id)."'
		AND scenes_valides.idstory = '".mysql_real_escape_string($group)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$query2 = "SELECT *, 'proposed' AS scene_type, Forum AS forum_name, scenes_proposes.scenes AS scene_number FROM scenes_proposes
			INNER JOIN storylines ON storylines.idstory = scenes_proposes.idstory
			WHERE scenes_proposes.id = '".mysql_real_escape_string($id)."'
			AND scenes_proposes.idstory = '".mysql_real_escape_string($group)."'";
		$result2 = mysql_query($query2, $db_auth);
		if(mysql_num_rows($result2) == 0){
			header('location: /forums');
		}
		else{
			$answer2 = mysql_fetch_assoc($result2);
			$data = $answer2;
		}
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function scene1Preview($group){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type, Forum AS forum_name FROM scenes_valides
		INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
		WHERE scenes_valides.idstory = '".mysql_real_escape_string($group)."'
		AND scenes_valides.scenes = '1'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function getProposedScene($scene, $user){
	global $db_auth;
	$query = "SELECT * FROM c_proposed_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_proposed_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		LEFT JOIN (
			SELECT AVG(ra_rating) AS scene_rating, COUNT(ra_rating) AS scene_votes, c_proposed_scenes_ps_id 
			FROM c_ratings 
			GROUP BY c_proposed_scenes_ps_id
		) ratata ON ratata.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		LEFT JOIN (SELECT COUNT(ra_id) AS user_self_reviews, c_proposed_scenes_ps_id, ra_comment FROM c_ratings
			WHERE c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
			GROUP BY c_proposed_scenes_ps_id) ppsid ON ppsid.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		WHERE ps_id = '".mysql_real_escape_string($scene)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function proposedScenes($id, $scene){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type FROM c_proposed_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_proposed_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		WHERE c_storylines_sl_id = '".mysql_real_escape_string($id)."'
		ORDER BY ps_id DESC";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;
}
function validatedScenes($id, $scene){
	global $db_auth;
	$query = "SELECT *, Forum AS forum_name, scenes_valides.scenes AS scene_number FROM scenes_valides
		INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
		WHERE scenes_valides.idstory = '".mysql_real_escape_string($id)."'
		AND scenes_valides.id != '".mysql_real_escape_string($scene)."'
		ORDER BY scenes_valides.id ASC";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;
}
function forumName($id){
	global $db_auth;
	$query = "SELECT * FROM c_forums
		WHERE f_id = '".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function getVScenes($id, $group){
	global $db_auth;
	$query = "SELECT *, 'valid' AS scene_type FROM c_valid_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_valid_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		WHERE c_storylines_sl_id = '".mysql_real_escape_string($id)."'
		AND vs_id IN (
			SELECT vs_id FROM c_valid_scenes
			WHERE c_storylines_sl_id = '".mysql_real_escape_string($id)."'
			ORDER BY vs_scene DESC
		)
		ORDER BY c_valid_scenes.vs_scene ASC
		LIMIT 5";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: /forums');
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;
}
function getLatestVScene($id, $group){
	global $db_auth;
	$query = "SELECT * FROM c_valid_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_valid_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_users.u_id = c_valid_scenes.c_users_u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		WHERE sl_id = '".mysql_real_escape_string($id)."'
		ORDER BY vs_scene DESC
		LIMIT 1";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: /forums');
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function loadScene($scene, $fro){
	global $db_auth;
	$query = "SELECT * FROM c_proposed_scenes
		INNER JOIN c_storylines ON c_storylines.sl_id = c_proposed_scenes.c_storylines_sl_id
		LEFT JOIN c_users ON c_proposed_scenes.c_users_u_id = c_users.u_id
		LEFT JOIN c_forums ON c_forums.f_id = c_storylines.c_forums_f_id
		LEFT JOIN (
			SELECT AVG(ra_rating) AS scene_rating, COUNT(ra_rating) AS scene_votes, c_proposed_scenes_ps_id 
			FROM c_ratings 
			GROUP BY c_proposed_scenes_ps_id
		) ratata ON ratata.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		LEFT JOIN (SELECT COUNT(ra_id) AS user_self_reviews, c_proposed_scenes_ps_id, ra_comment FROM c_ratings
			WHERE c_users_u_id = '".mysql_real_escape_string($fro)."'
			GROUP BY c_proposed_scenes_ps_id) ppsid ON ppsid.c_proposed_scenes_ps_id = c_proposed_scenes.ps_id
		WHERE ps_id = '".mysql_real_escape_string($scene)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = "
		<div class=\"w100p courrier relative this_is_the_text this_is_the_text_padding\">
			<div class=\"c_3mm\"></div>
			<div class=\"c_2mm\"></div>
			<div class=\"c_1mm\"></div>
			<fieldset class=\"relative\">
				<legend>";
					if($answer['scene_type'] == 'valid'){
						$data .= utf8_encode($answer['sl_name'])." - Scene ".$answer['ps_scene'];
					}
					else{
						$data .= utf8_encode($answer['sl_name'])." - <strong>[Proposed]</strong> scene ".$answer['ps_scene'];
					}							
				$data .= "
				</legend>";
				$imgstylex = getImgStyle("avatars/".$answer['u_avatar']);
				if($answer['scene_rating'] == NULL){
					$rating_score = "0";
				}
				else{
					$rating_score = number_format(($answer['scene_rating']/2), 2, '.', '');
				}
				if($answer['scene_votes'] == NULL){
					$rating_count = "<span class=\"the_scene_rating_figure\">0</span> votes";
				}
				else{
					$rating_count = $answer['scene_votes'];
					if($rating_count == 1){
						$rating_count = "<span class=\"the_scene_rating_figure\">1</span> vote";
					}
					else{
						$rating_count = "<span class=\"the_scene_rating_figure\">".number_format($rating_count)."</span> votes";
					}
				}
				if(!empty($answer['u_avatar'])){
					$avatar = "<img src=\"avatars/".$answer['u_avatar']."\"/>";
				}
				else{
					$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
				}
				if($answer['user_self_reviews'] == 0){
					$self_rated = 0;
				}
				else{
					$self_rated = $answer['user_self_reviews'];
				}
				$data .= utf8_encode($answer['ps_desc'])."
				<div class=\"avatar_holder mt10 right\">
					<div class=\"avatar_holder_main\">
						<div class=\"c_avatar ".$imgstylex."\">
							".$avatar."
						</div>
					</div>
					<div class=\"avatar_text\">
						By ".stripslashes(htmlspecialchars_decode($answer['u_username']))."
					</div>
				</div>
				<div class=\"clear\"></div>
			</fieldset>
			<div class='writers_choice'>
				<div class=\"t\">
					<div class=\"tc\">
						Rate &amp; review this:
						<div class=\"rate_widget\" rel=\"".($answer['ps_scene'])."\" rating=\"".$rating_score."\" selfrated='".$self_rated."'>
							<div class=\"writers-rating\"></div>
						</div>
						<div class=\"total_votes\">
							<h3>Rating: ".$rating_score."</h3>
							<h4>".$rating_count."</h4>
						</div>
					</div>
					<div class=\"tc\">
						<form method=\"post\" action=\"\">
							<input type=\"hidden\" name=\"score\" class=\"the_input_score_class\">
							<textarea name=\"comment\" class=\"the_input_score_comment\">".stripslashes(utf8_encode(htmlspecialchars_decode($answer['ra_comment'])))."</textarea
							<p class=\"rate_small\"><strong>*Please note:</strong> All reviews must be accompanied by a rating<br />You can rate a proposed scene by clicking on the stars on the left hand side of this box.</p>
							<input type=\"submit\" class=\"c_btn mt20 the_input_score_review\" value=\"";
							if($answer['ra_comment'] == "" || $answer['ra_comment'] == NULL){
								$data .= "Add review";
							}
							else{
								$data .= "Update review";
							}
							$data .= "\" ";
							if($answer['user_self_reviews'] == 0 || $answer['user_self_reviews'] == NULL || $answer['user_self_reviews'] == ""){
								$data .= "disabled";
							}
							$data .= ">
						</form>
					</div>
				</div>
			</div>
			<div class=\"clear\"></div>
		</div>";
		$comments = getPostComments($scene, $fro);
			$data .= "
		<div class=\"proposed_scene_comments\">";
		if($comments != 0){
			$data .= "
		<h1 class=\"comments_h1\">Comments</h1>";
			foreach($comments as $comments_o){
				if($comments_o['ra_rating'] == 0 || $comments_o['ra_rating'] == NULL){
					$comment_rating_score = 0;
				}
				else{
					$comment_rating_score = $comments_o['ra_rating'];
				}
				$imgstylex = getImgStyle("avatars/".$comments_o['u_avatar']);
				if(!empty($comments_o['u_avatar'])){
					$avatar = "<img src=\"avatars/".$comments_o['u_avatar']."\"/>";
				}
				else{
					$avatar = "<img src=\"avatars/default.png\" alt=\"\">";
				}
			$data .= "
			<div class=\"contributor_comment"; if($comments_o['comment_owner'] == "self"){$data .= " contributor_is_self";} $data .= "\">
				<div class=\"t\">
					<div class=\"tc\">
						<div class=\"rate_widget_display\">
							<div class=\"clear mtb5\">";
							$i = 0;
							if($comment_rating_score != 0){
								for ($x = 1; $x <= $comment_rating_score; $x++) {
									if($i == 0){
										$data .= "
								<div class=\"max35\">
									<svg class=\"icon\" viewBox=\"0 0 35 35\">
        								<g id=\"half-star\">";
										$there_open_tag = TRUE;
									}
										if($x%2){
											$odd = TRUE;
										}
										else{
											$odd = FALSE;
										}
										if($odd == 1){
											$data .= "
											<polygon fill=\"#ff9511\" points=\"11.547,10.918 0,12.118 8.822,19.867 6.127,31.4 16,25.325 16,0.66\"/>											";
											if($x == $comment_rating_score){
												$data .= "
											<polygon fill=\"#d3d3d3\" points=\"32,12.118 20.389,10.918 16.026,0.6 16,0.66 16,25.325 16.021,25.312 25.914,31.4 23.266,19.867\"/>";
											}
										}
										else{
											$data .= "
											<polygon fill=\"#ff9511\" points=\"32,12.118 20.389,10.918 16.026,0.6 16,0.66 16,25.325 16.021,25.312 25.914,31.4 23.266,19.867\"/>";
										}
									if($i != 0 && $i%2){
										$data .= "
										</g>
									</svg>
								</div>";
										$there_open_tag = FALSE;
									}
									if($x != $comment_rating_score){
										if($i%2){
											$there_open_tag = TRUE;
											$data .= "
								<div class=\"max35\">
									<svg class=\"icon\" viewBox=\"0 0 35 35\">
        								<g id=\"half-star\">";
										}
									}
									$i++;
								}
							}
							if($there_open_tag == TRUE){
								$data .= "
										</g>
									</svg>
								</div>";
							}
							$data .= "	
								<div class=\"clear\"></div>
							</div>
							<div class=\"avatar_holder mt5\">
								<div class=\"avatar_holder_main\">
									<div class=\"c_avatar ".$imgstylex."\">
										".$avatar."
									</div>
								</div>
								<div class=\"avatar_text\">
									".stripslashes(htmlspecialchars_decode($comments_o['comment_writer']))."
								</div>
							</div>
							<div class=\"clear\"></div>
						</div>
					</div>
					<div class=\"tc\">
						<div class=\"comment_body\">
							".stripslashes(utf8_encode(htmlspecialchars_decode($comments_o['ra_comment'])))."
						</div>
					</div>
				</div>
			</div>";
			}
		}
			$data .= "
		</div>";
	}
	return $data;
}
function writeScene($id, $user, $nextscenes){
	global $db_auth;
	if($user['u_username'] == "" || $user['u_username'] == NULL){
		header("Location: /login");
	}
	$chkq = "SELECT * FROM c_proposed_scenes
		WHERE c_storylines.sl_id = '".mysql_real_escape_string($id)."'
		AND c_users_u_id = '".mysql_real_escape_string($user['u_id'])."'
		AND ps_desc = '".mysql_real_escape_string($nextscenes)."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) == 0){
		$getq = "SELECT (MAX(vs_scene)+1) AS the_latest_scene FROM c_valid_scenes
			WHERE c_storylines_sl_id = '".mysql_real_escape_string($id)."'";	
		$getr = mysql_query($getq, $db_auth);
		if(mysql_num_rows($getr) == 0){
			$data = 0;
		}
		else{
			$get = mysql_fetch_assoc($getr);
			$insq = "INSERT INTO c_proposed_scenes (ps_scene, ps_desc, c_users_u_id, c_storylines_sl_id)
				VALUES ('".mysql_real_escape_string($get['the_latest_scene'])."', '".mysql_real_escape_string($nextscenes)."', '".mysql_real_escape_string($user['u_id'])."', '".mysql_real_escape_string($id)."')";
			$insr =mysql_query($insq, $db_auth);
			if(!$insr){
				$data = 0;
			}
			else{
				$data = 1;
			}
		}
	}
	else{
		$data = 2;
	}
	return $data;
}
function newMembers(){
	global $db_auth;
	$query = "SELECT * FROM c_users
		WHERE u_username != ''
		ORDER BY u_id DESC
		LIMIT 5";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$data = 0;
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;
}
function FBLoginUser($first_name, $last_name, $id, $name, $email, $authkey){
	global $db_auth;
	$date = date("Y-m-d");
	$query = "SELECT * FROM members
		LEFT JOIN members_fb ON members_fb.members_IdMembers = members.IdMembers
		WHERE Email = '".mysql_real_escape_string($email)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		$insq = "INSERT INTO members (LastName, FirstName,Email,Ip,fbUser, Date) 
		VALUES ('".mysql_real_escape_string($last_name)."', '".mysql_real_escape_string($first_name)."','".mysql_real_escape_string($email)."', '".$_SERVER['REMOTE_ADDR']."', '1', '".$date."')";
		$insr = mysql_query($insq, $db_auth);
		$member_id = mysql_insert_id($db_auth);
		if($insr){
			$iq = "INSERT INTO members_fb (mfb_fbid, mfb_auth, members_IdMembers)
			VALUES ('".mysql_real_escape_string($id)."', '".mysql_real_escape_string($authkey)."','".mysql_real_escape_string($member_id)."')";
			$ir = mysql_query($iq, $db_auth);
			if($ir){
				@$idsession = outils::gen_key();
				$_SESSION['idsession'] = $idsession;
				$updq = "UPDATE members SET Idsession='".$idsession."', 
				Ip= '".$_SERVER['REMOTE_ADDR']."',
				Lastvisite='".date("Y-m-d H:i:s")."'
				WHERE IdMembers = '".$member_id."'";
				$updr = mysql_query($updq, $db_auth);
				header("Location: /start");
				exit;
			}
			else{
				header("Location: /login?error=2");
				exit;
			}
		}
		else{
			header("Location: /login?error=1");
			exit;
		}
		
	}
	else{
		$answer = mysql_fetch_assoc($result);
		@$idsession = outils::gen_key();
		$_SESSION['idsession'] = $idsession;
		$updq = "UPDATE members SET fbUser = 1,
		Idsession='".$idsession."', 
		Ip= '".$_SERVER['REMOTE_ADDR']."',
		Lastvisite='".date("Y-m-d H:i:s")."'
		WHERE IdMembers = '".$answer['IdMembers']."'";
		$updr = mysql_query($updq, $db_auth);
		header("Location: /forums");
		exit;
	}
}
function FBLoginUsers($first_name, $last_name, $id, $name, $email, $authkey){
	$query = mysql_query("SELECT * FROM c_users WHERE u_email=\"$email\"");
	if(mysql_num_rows($query) >0){
		$answer = mysql_fetch_array($query);
		$idsession = $answer['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
		$_SESSION['language_session'] = "en";
		mysql_query("UPDATE c_users SET u_session=\"".$idsession."\", u_ip=\"".$_SERVER['REMOTE_ADDR']."\", u_lastvisit=\"".date("Y-m-d H:i:s")."\" WHERE u_email=\"$email\"");
		header('Location: /forums');
		exit;
	}else{
		$usertype = 2;
		$uname = $first_name.".".$last_name;
		$uname = str_replace(" ",".",$uname);
		$avatar = "https://graph.facebook.com/".$id."/picture";
		$sql = mysql_query("INSERT INTO c_users (u_email, u_username, c_usertypes_ut_id, u_avatar)VALUES(\"$email\", \"$uname\", \"$usertype\", \"$avatar\")");
		if($sql){
			$query1 = mysql_query("SELECT * FROM c_users WHERE u_email=\"$email\"");
			$row = mysql_fetch_array($query1);
			$idsession = $row['u_id']."_".md5(microtime().rand());
			$_SESSION['idsession'] = $idsession;
			$_SESSION['language_session'] = "en";
			mysql_query("UPDATE c_users SET u_session=\"".$idsession."\", u_ip=\"".$_SERVER['REMOTE_ADDR']."\", u_lastvisit=\"".date("Y-m-d H:i:s")."\" WHERE u_email=\"$email\"");
			header('Location: /forums');
			exit;
		}
	}
}
function c_resetPassword($me, $opass, $pass){
	global $db_auth;
	$opass = sha1($opass.salt());
	$pass = sha1($pass.salt());
	$chkq = "SELECT * FROM c_users
		WHERE u_pass = '".mysql_real_escape_string($opass)."'
		AND u_id = '".mysql_real_escape_string($me['u_id'])."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) > 0){
		$updq = "UPDATE c_users SET u_pass = '".mysql_real_escape_string($pass)."'
				WHERE u_id = '".mysql_real_escape_string($me['u_id'])."'";
		$updr = mysql_query($updq, $db_auth);
		if(!$updr){
			$data = "Sorry, something seems to have gone wrong.";
		}
		else{
			$data = "You have successfully updated your password";
		}
	}
	else{
		$data = "The old password you entered is wrong";
	}
	return $data;
}
function c_changeType($me, $usertype){
	global $db_auth;
	if(!$me || $me == "" || $me == NULL || empty($me)){
		header("Location: /login");
	}
	$chkq = "SELECT * FROM c_users
		WHERE u_id = '".mysql_real_escape_string($me['u_id'])."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) > 0){
		$updq = "UPDATE c_users SET c_usertypes_ut_id = '".mysql_real_escape_string($usertype)."'
				WHERE u_id = '".mysql_real_escape_string($me['u_id'])."'";
		$updr = mysql_query($updq, $db_auth);
		if(!$updr){
			$data = "Sorry, something seems to have gone wrong.";
		}
		else{
			$data = "You have successfully updated your user profile";
		}
	}
	else{
		$data = "Sorry, you do not have authorization to do that";
	}
	return $data;
}
function applyRating($scene, $score, $fro){
	global $db_auth;
	if($fro == "" || $fro == NULL){
		$data = 1;
	}else{
		$chkq = "SELECT * FROM c_ratings
		WHERE c_users_u_id = '".mysql_real_escape_string($fro)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) > 0){
			$updq = "UPDATE c_ratings SET ra_rating = '".mysql_real_escape_string($score)."'
		WHERE c_users_u_id = '".mysql_real_escape_string($fro)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
			$updr = mysql_query($updq);
			if(!$updr){
				$data = 2;
			}else{
				$data = 3;
			}
		}else{
			$insq = "INSERT INTO c_ratings (ra_rating, c_users_u_id, c_proposed_scenes_ps_id)VALUES(\"".mysql_real_escape_string($score)."\", \"".mysql_real_escape_string($fro)."\", \"".mysql_real_escape_string($scene)."\")";
			$insr = mysql_query($insq);
			if(!$insr){
				$data = "4 Error: ".mysql_error();
			}else{
				$data = 5;
			}
		}
	}
	return $data;
}
function applyUnit1Rating($scene, $score, $fro, $pscene){
	global $db_auth;
	if($fro == "" || $fro == NULL){
		$data = 1;
		$data1 = getUnit1Rating($scene, $pscene);
	}else{
		$chkr = mysql_query("SELECT * FROM unit1_rating WHERE (usrID=\"".mysql_real_escape_string($fro)."\" && scene=\"".mysql_real_escape_string($scene)."\") && pscene=\"".mysql_real_escape_string($pscene)."\"");
		if(mysql_num_rows($chkr) > 0){
			$updr =  mysql_query("UPDATE unit1_rating SET score=\"".mysql_real_escape_string($score)."\" WHERE (usrID=\"".mysql_real_escape_string($fro)."\" && scene=\"".mysql_real_escape_string($scene)."\") && pscene=\"".mysql_real_escape_string($pscene)."\"");
			if(!$updr){
				$data = 2;
				$data1 = getUnit1Rating($scene, $pscene);
			}else{
				$data = 3;
				$data1 = getUnit1Rating($scene, $pscene);
			}
		}else{
			$insr = mysql_query("INSERT INTO unit1_rating(score, usrID, scene, pscene)VALUES(\"".mysql_real_escape_string($score)."\", \"".mysql_real_escape_string($fro)."\", \"".mysql_real_escape_string($scene)."\", \"".mysql_real_escape_string($pscene)."\")");
			if(!$insr){
				$data = 4;
				$data1 = getUnit1Rating($scene, $pscene);
			}else{
				$data = 5;
				$data1 = getUnit1Rating($scene, $pscene);
			}
		}
	}
	$array = array($data, $data1);
	return json_encode($array);
}
function getUnit1Rating($scene, $pscene){
	$data = 0;
	$datas = 0;
	$count = 0;
	if(empty($scene)){
		header("location: forum");
		exit;
	}
	$query = mysql_query("SELECT * FROM unit1_rating WHERE scene=\"$scene\" && pscene=\"$pscene\"");
	$query1 = mysql_query("SELECT * FROM unit1_rating WHERE scene=\"$scene\"");
	if($query1){
		while($rows = mysql_fetch_array($query1)){
			$datas = $datas + $rows['score'];
		}
	}
	if($query){
		while($row = mysql_fetch_array($query)){
			$data = $data + $row['score'];
			$count++;
		}
		$rt = $data/$datas * 100;
		$msg = "Current Cumulative Rating: ".round($rt,1)."%";
	}else{
		$msg = "Be This First To Rate This Scene";
	}
	return $msg;
}
function addComment($scene, $comment, $fro){
	global $db_auth;
	if($fro == "" || $fro == NULL){
		$data = 0;
	}
	else{
		$chkq = "SELECT * FROM c_ratings
		WHERE c_users_u_id = '".mysql_real_escape_string($fro)."'
		AND c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) == 0){
			$data = 0;
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$updq = "UPDATE c_ratings SET ra_comment = '".mysql_real_escape_string($comment)."'
				WHERE ra_id = '".mysql_real_escape_string($chk['ra_id'])."'";
			$updr = mysql_query($updq, $db_auth);
			if(!$updr){
				$data = 0;
			}
			else{
				$data = 1;
			}
		}
	}
	return $data;
}
function getPostComments($scene, $fro){
	global $db_auth;
	$chkq = "SELECT *, u_username AS comment_writer, CASE WHEN u_id = '".mysql_real_escape_string($fro)."' THEN 'self'
	ELSE 'not'
	END AS comment_owner
	FROM c_ratings
	LEFT JOIN c_users ON c_users.u_id = c_ratings.c_users_u_id
	WHERE c_proposed_scenes_ps_id = '".mysql_real_escape_string($scene)."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) == 0){
		$data = 0;
	}
	else{
		while($chk = mysql_fetch_assoc($chkr)){
			$data[] = $chk;
		}
	}
	return $data;
}
function urlThis($name){
	$string = stripslashes(utf8_encode(htmlspecialchars_decode($name)));
	$string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function SocialLogin($fullname, $email, $account) {
	global $db_auth;
	$query = "SELECT * FROM c_users WHERE u_username='".mysql_real_escape_string($email)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0) {
		// Register User and Login
		$queryreg = "INSERT INTO c_users (u_username,u_email,c_usertypes_ut_id) VALUES ($fullname, $email, $account)";
		$res = mysql_query($queryreg, $db_auth);
		
		// Login
		$query = "SELECT * FROM c_users WHERE u_username='".mysql_real_escape_string($email)."'";
		$result = mysql_query($query, $db_auth);
		$answer = mysql_fetch_assoc($result);
		$idsession = $answer['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
	}
	else {
		$answer = mysql_fetch_assoc($result);
		$idsession = $answer['u_id']."_".md5(microtime().rand());
		$_SESSION['idsession'] = $idsession;
	}
	$updq = "UPDATE c_users SET u_session='".$idsession."', 
					u_ip= '".$_SERVER['REMOTE_ADDR']."',
					u_lastvisit='".date("Y-m-d H:i:s")."'
					WHERE u_username='".mysql_real_escape_string($_POST['username'])."'";
	$uodr = mysql_query($updq, $db_auth);
	header('Location: /forums');
}
function fuckpbnl($string){
	$string = strtolower($string);
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
function myScenes(){
	//Objectives
	//Get Proposed Scene using userID
	//Get Storyline using proposed scene relational id
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$q1 = mysql_query("SELECT * FROM c_proposed_scenes WHERE c_users_u_id=\"$id\" ORDER BY ps_id DESC");
	if(mysql_num_rows($q1)>0){
		while($r1 = mysql_fetch_array($q1)){
			$scid = $r1['c_storylines_sl_id'];
			$q2 = mysql_query("SELECT * FROM c_storylines WHERE sl_id=\"$scid\"");
			if(mysql_num_rows($q2)>0){
				$r2 = mysql_fetch_array($q2);
			}?>
			<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
				<div class="c_label"><strong><?php echo strtoupper($r2['sl_name']);?></strong></div>
				<div style="clear:both;"></div>
				<div class="c_label"><a href="read-<?php echo fuckpbnl($r2['sl_name']);?>-<?php echo $r2['sl_id'];?>">View Storyline</a> | <a href="readscene-<?php echo fuckpbnl($r2['sl_name']);?>-<?php echo $r2['sl_id'];?>-<?php echo $r1['ps_id'];?>">View Your Proposed Scene</a></div>
			</div>
			<div style="height:5px;"></div>
		<?php }
	}else{
		echo "You are yet to propose a scene, do well by hitting the forums to make your own sensible contributions.";
	}
}
function getPerson($uid){
	$query = mysql_query("SELECT * FROM c_users WHERE u_id=\"$uid\"");
	return mysql_fetch_array($query);
}
function myStories(){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$query = mysql_query("SELECT * FROM c_topics WHERE author=\"$id\" ORDER BY id DESC");
	if(mysql_num_rows($query)>0){
		while($row = mysql_fetch_array($query)){?>
			<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
				<div class="c_label"><strong><?php echo strtoupper($row['topic']);?></strong></div>
				<div style="clear:both;"></div>
				<div class="c_label"><a href="story-<?php echo $row['slug'];?>">Read Storyline</a> | <a href="manuscript-<?php echo $row['slug'];?>">View As Manuscript</a> <?php if($row['publish'] >0){}else{?>| <a href="edit-<?php echo $row['id'];?>">Edit Storyline</a><?php }?> | <?php if($row['status'] == 0){}else{?> <?php if($row['publish'] == 0){?><button data-target="#myModal<?php echo $row['id'];?>" class="btn btn-primary btn-large" data-toggle="modal" data-backdrop="false">Publish</button> <?php }elseif($row['publish'] == 1){echo "<span class='review'>In Review</span>";}elseif($row['publish'] == 2){echo "<span class='accepted'>Accepted</span>";}else{echo "<span class='declined'>Declined</span>";} }?><font size="1"><?php if($row['status'] == 0){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Draft</font>";}else{if($row['mode'] ==0){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='green'>Public(Everyone can see this)</font>";}else{echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Private(Only you can see this)</font>";}}?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mint.php?action=deleteOneLine&id=<?php echo $row['id'];?>"><span style="font-weight:bold; color:red;">Delete</span></a></div>
				<div id="myModal<?php echo $row['id'];?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Confirmation</h4>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to send <strong><?php echo strtoupper($row['topic']);?></strong> to admin for final check up and publication?</p>
								<p class="text-warning"><small>If your story meets all rules, you would be contacted via email but for now, please do check always for detail on your storyline is accepted or declined.</small></p>
								<p class="text-danger"><small>Note that you will no longer be able to edit this storyline</small></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<a href="mint?action=publish&id=<?php echo $row['id'];?>"><button type="button" class="btn btn-primary">Publish</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="height:5px;"></div>
		<?php }
	}else{
		echo "<div align='center'>You are yet to tell us about any of your super stories, do well by telling us soon.</div>";
	}
}
function required(){
	if($_SESSION['required'] == true){
	echo "<div class=\"alert alert-warning\">*All Fields Are Required</div>";
	$_SESSION['required'] = false;
	}
}
function length(){
	if($_SESSION['length'] == true){
	echo "<div class=\"alert alert-warning\">You can not create a scene with less than 100 words</div>";
	$_SESSION['length'] = false;
	}
}
function success(){
	if($_SESSION['s'] == true){
		echo "<div class=\"alert alert-success\">Operation Successful</div>";
	}
	$_SESSION['s'] = false;
}
function ownError(){
	if($_SESSION['ownError'] == true){
		echo "<div class=\"alert alert-warning\">Sorry you don't seem to be the owner of this storyline, thereby not having such rights over this storyline</div>";
	}
	$_SESSION['ownError'] = false;
}
function failed(){
	if($_SESSION['f'] == true){
		echo "<div class=\"alert alert-danger\">Operation Failed</div>";
	}
	$_SESSION['f'] = false;
}
function postExist(){
	if($_SESSION['pex'] == true){
		echo "<div class=\"alert alert-warning\">Operation Failed, Topic Already Exist, modify your topic/content</div>";
	}$_SESSION['pex'] = false;
}
function makePost($content, $uid, $mode, $category, $links){
	$_SESSION['content'] = $content;
	$cx = strip_tags($content);
	$con = preg_replace('/\s+/', '', $cx);
	if(empty($cx) || empty($uid) || empty($category)){
		$_SESSION['required'] = true;
		header("location: new-story-$links");
		exit;
	}
	if(isValidLength($content) < 100){
		$_SESSION['length'] = true;
		header("location: new-story-$links");
		exit;
	}
	$date = date("Y-m-d\TH:i:sP");
	$sql = getSinglePostID($links);
	if($sql['author'] == $uid){
		$query = mysql_query("UPDATE c_topics SET content=\"$content\", date=\"$date\", mode=\"$mode\", cat=\"$category\", status=1 WHERE id=\"$links\"");
		if($query){
			$_SESSION['s'] = true;
			header("location: account-activities");
			unset($_SESSION['content']);
			exit;
		}else{
			$_SESSION['f'] = true;
			header("location: new-story");
			exit;
		}
	}
}
function savePost($content, $uid, $mode, $links, $category){
	$rate = 0;
	$data = 0;
	$cx = strip_tags($content);
	$con = preg_replace('/\s+/', '', $cx);
	if(empty($cx) || empty($uid)){
		$data = 1;
	}
	$date = date("Y-m-d\TH:i:sP");
	$sql = getSinglePostID($links);
	if($sql['author'] == $uid){
		$query = mysql_query("UPDATE c_topics SET content=\"$content\", mode=\"$mode\", cat=\"$category\" WHERE id=\"$links\"");
		if($query){
			$data = 2;
			$_SESSION['links'] = $links;
		}else{
			$data = 3;
		}
	}else{
		$data = 4;
	}
	$array = array($data, $rate);
	return json_encode($array);
}
function getSinglePostID($links){
	$query = query("SELECT * FROM c_topics WHERE id=\"$links\"");
	if($query){
	$row = fetch_array($query);
	}
	return $row;
}
function getSinglePost($links){
	$query = query("SELECT * FROM c_topics WHERE slug=\"$links\"");
	if($query){
	$row = fetch_array($query);
	}
	return $row;
}
function getSinglePosts($links){
	$query = query("SELECT * FROM c_topics WHERE slug=\"$links\"");
	if($query){
	$row = fetch_array($query);
	}
	return $row;
}
function getSingleID($cid){
	$query = query("SELECT * FROM c_topics WHERE id=\"$cid\"");
	if($query){
	$row = fetch_array($query);
	}
	return $row;
}
function updateSelfStory($slug){
	mysql_query("UPDATE c_topics SET views=views+1 WHERE slug=\"$slug\"");
}
function updatePost($title, $content, $uid, $mode, $dir){
	$tx = strip_tags($title);
	$cx = strip_tags($content);
	$ttl = preg_replace('/\s+/', '', $tx);
	$con = preg_replace('/\s+/', '', $cx);
	if(empty($ttl) || empty($cx) || empty($uid)){
		$_SESSION['required'] = true;
		header("location: edit-$dir");
		exit;
	}
	if(isValidLength($content) < 100){
		$_SESSION['length'] = true;
		header("location: edit-$dir");
		exit;
	}
	$query = mysql_query("UPDATE c_topics SET topic=\"$title\", content=\"$content\", date=\"$date\", mode=\"$mode\", status=1 WHERE id=\"$dir\"");
	if($query){
		$_SESSION['s'] = true;
		header("location: account-activities");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: edit-$dir");
		exit;
	}
}
function isValidLength($text){
	$text = strip_tags($text);
    $words = preg_split('#\PL+#u', $text, -1, PREG_SPLIT_NO_EMPTY);
    return count($words);
}
function checkScene($uid){
	$query = mysql_query("SELECT * FROM c_topic_scenes WHERE c_id=\"$uid\" ORDER BY id DESC");
	if(mysql_num_rows($query)>0){
		return mysql_fetch_array($query);
	}else{
		return 0;
	}
}
function newscene($story, $content, $line, $mid){
	$lx = strip_tags($content);
	$cx = preg_replace('/\s+/', '', $lx);
	if(empty($story) || empty($cx)){
		$_SESSION['required'] = true;
		header("location: story-$line#commentbox");
		exit;
	}
	if(isValidLength($content) < 100){
		$_SESSION['length'] = true;
		header("location: story-$line#commentbox");
		exit;
	}
	$check = checkScene($story);
	if($check == 0){
		$scene = 2;
	}else{
		$scene = $check['scene']+1;
	}
	$date = date("Y-m-d\TH:i:sP");
	$query = query("INSERT INTO c_topic_scenes(c_id, content, scene, date)VALUES(\"$story\", \"$content\", \"$scene\", \"$date\")");
	if($query){
		$_SESSION['s'] = true;
		query("UPDATE c_contribute SET status=1 WHERE tid=\"$story\"");
		query("UPDATE c_topics SET edit=0 WHERE id=\"$story\"");
		query("INSERT INTO notifications(title, slug, owner, date)VALUES(\"A new scene have been approved, credit to you\", \"story-$line\", \"$mid\", \"$date\")");
		header("location: story-$line#commentbox");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: story-$line#commentbox");
		exit;
	}
}
function pagination($total_pages, $limit, $targetpage, $page){
if ($page == 0 || empty($page)){$page = 1;}
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;						
	$paginate = '';
	if($lastpage > 1){
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage?page=$prev'>previous</a>";
		}else{
			$paginate.= "<span class='disabled'>previous</span>";
		}
		// Pages	
		if ($lastpage < 7 + ($stages * 2)){	// Not enough pages to breaking it up	
			for ($counter = 1; $counter <= $lastpage; $counter++){
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
			}
		}elseif($lastpage > 5 + ($stages * 2)){	// Enough pages to hide a few?
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2)){
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++){
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2)){
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++){
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}else{ // End only hide early pages
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++){
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";
					}		
				}
			}
		}
		// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage?page=$next'>next</a>";
		}else{
			$paginate.= "<span class='disabled'>next</span>";
		}
		$paginate.= "</div>";
		return $paginate;
	}
}
function publishStory($uid, $id){
	$query = mysql_query("SELECT * FROM c_topics WHERE id=\"$uid\"");
	if(mysql_num_rows($query)>0){
		$row = mysql_fetch_array($query);
		if($row['author'] != $id){
			$_SESSION['ownError'] = true;
			header("location: account-activities");
			exit;
		}
		$sql = mysql_query("UPDATE c_topics SET publish=1 WHERE id=\"$uid\"");
		if($sql){
			$_SESSION['s'] = true;
			header("location: account-activities");
			exit;
		}else{
			$_SESSION['f'] = true;
			header("location: account-activities");
			exit;
		}
	}
}
function paging($pages, $page, $per_page, $dlink, $tbname){
	$url = $dlink."/".$pages."?page";
	$query = "SELECT COUNT(*) as `num` FROM {$tbname}";
	$row = fetch_array(query($query));
	$total = $row['num'];
	$adjacents = "2"; 

	$page = ($page == 0 ? 1 : $page);  
	$start = ($page - 1) * $per_page;								
	
	$prev = $page - 1;							
	$next = $page + 1;
	$lastpage = ceil($total/$per_page);
	$lpm1 = $lastpage - 1;
	if($page > 1){
	$pagination = "<a href='".$url."=$prev'>[prev]</a>";
	}
	if($lastpage > 1)
	{	
		$pagination .= "";
				$pagination .= "";
		if ($lastpage < 7 + ($adjacents * 2))
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "[$counter]";
				else
					$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "[<a class='current'>$counter]</a>";
					else
						$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
				$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
			}
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href='".$url."=1'>[1]</a>";
				$pagination.= "<a href='".$url."=2'>[2]</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class='current'>[$counter]</a>";
					else
				 $pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
				$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
			}
			else
			{
				$pagination.= "<a href='".$url."=1'>[1]</a>";
				$pagination.= "<a href='".$url."=2'>[2]</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<a class='current'>[$counter]</a>";
					else
						$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
				}
			}
		}
		
		if ($page < $counter - 1){ 
			$pagination.= "<a href='".$url."=$next'>[Next]</a>";
			$pagination.= "<a href='".$url."=$lastpage'>[Last]</a>";
		}else{
			$pagination.= "<a class='current'>[Next]</a>";
			$pagination.= "<a class='current'>[Last]</a>";
		}
		$pagination.= "\n";		
	}
	 return $pagination;
}
function sendMail($content){
	$cu = explode('_',$_SESSION['idsession']);
	$from = $cu[0];
	$date = date("d D M Y h:iA");
	if(empty($from)){
		$_SESSION['f'] = true;
		header("location: messaging");
		exit;
	}
	$ql = query("SELECT * FROM messaging WHERE ((mfrom=\"$from\" && mto=\"0\") || (mfrom=\"0\" && mto=\"$from\"))");
	if(num_rows($q1)>0){
		$row = fetch_array($q1);
		$msid = $row['msid'];
		$query = query("UPDATE messaging SET mfrom=\"$from\", date=\"$date\", status=0 WHERE id=\"$msid\"");
		$sql = query("INSERT INTO mreply(mfrom, date, content)VALUES(\"$from\", \"$date\", \"$content\")");
	}else{
		$query = query("INSERT INTO messaging(mfrom, date)VALUES(\"$from\", \"$date\")");
		$sql = query("INSERT INTO mreply(mfrom, date, content)VALUES(\"$from\", \"$date\", \"$content\")");
	}
	if($query){
		$_SESSION['s'] = true;
		header("location: messaging");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: messaging");
		exit;
	}
}
function getMail($uid, $sql){
	$query = query($sql);
	if($query){
		while($row = fetch_array($query)){
			if($row['status'] == 0){
				$strong = "<strong>";
				$strong2 = "</strong>";
			}else{
				$strong = "";
				$strong2 = "";
			}
			echo '<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
				<div class=""><a href="readmail?id='.$row['id'].'">'.$strong.'Moderator'.$strong2.'</a></div>
				<div style="font-size:12px; text-align:right;">'.$row['date'].'</div>
			</div>';
		}
	}else{
		return "<div align='center'><em>You Have No Message Yet!</em></div>";
	}
}
function readMail($uid, $page=1){
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =20;
	$tbname = "messaging WHERE mfrom=\"$uid\" || mto=\"$uid\" ORDER BY date	 DESC";
	$startpoint = ($page * $limit) - $limit;
	$tlink = "messaging";
	$url = "http://www.nextscenes.com/";
	$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$query = query($sql);
	if(num_rows($query)>0){
	while($row = fetch_array($query)){
	$sq = guery("SELECT * FROM mreply WHERE ((mfrom=\"$from\" && mto=\"$to\") || (mfrom=\"$to\" && mto=\"$from\")) ORDER BY date DESC LIMIT 0,1");
	$sr = fetch_array($sq);
	$strong = $row['status'];?>
	<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
	<div class="c_label"><?php $sender = getPerson($row['from']); if($strong == 0){?><strong><?php echo strtoupper($sender['u_username']);?></strong><?php }else{echo strtoupper($sender['u_username']); }?></div>
	<div style="clear:both;"></div>
	<?php echo substr($sr['content'],0,50);?>
	</div>
	<?php }
	}
}
function findUser($usrid){
	$query = query("SELECT * FROM c_users WHERE u_id=\"$usrid\"");
	return fetch_array($query);
}
function requestcontribute($iid, $url){
	$query = query("UPDATE c_topics SET edit=1 WHERE id=\"$iid\"");
	if($query){
		$_SESSION['s'] = true;
		header("location: account-activities");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: $url");
		exit;
	}
}
function newcontribution($content, $url, $tid){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$usid = $cu[0];
	$date = date("d D M Y h:iA");
	$query = query("INSERT INTO c_contribute(content, date, tid, credit)VALUES(\"$content\", \"$date\", \"$tid\", \"$usid\")");
	$q = query("SELECT * FROM c_topics id=\"$tid\"");
	$r = fetch_array($q);
	$own = $r['author'];
	if($query){
		$_SESSION['s'] = true;
		query("INSERT INTO notifications(title, slug, owner, date)VALUES(\"A new contribution have made on your story\", \"$url\", \"$own\", \"$date\")");
		header("location: $url");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: $url");
		exit;
	}
}
function approvesceneContribute($id, $tid, $name, $line, $eid){
	$query1 = query("SELECT * FROM c_contribute WHERE id=\"$id\"");
	$row1 = fetch_array($query1);
	$content = $row1['content']."<div style='text-align:right; font-size:12px; padding-top:5px;'><strong>-Credit:</strong> ".$name.'</div>';
	newscene($tid, $content, $line, $eid);
}
function deleteOneLine($id){
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$usid = $cu[0];
	$query = query("SELECT * FROM c_topics WHERE id=\"$id\"");
	if(num_rows($query)>0){
		$row = fetch_array($query);
		if($row['author'] != $usid){
			$_SESSION['fool'] = true;
			header("location: account-activities");
			exit;
		}else{
			$sql = query("DELETE FROM c_topics WHERE id=\"$id\"");
			if($sql){
				query("DELETE FROM c_topic_scenes WHERE c_id=\"$id\"");
				query("DELETE FROM c_contribute WHERE tid=\"$id\"");
				$_SESSION['s'] = true;
				header("location: account-activities");
				exit;
			}
		}
	}else{
		$_SESSION['notfound'] = true;
		header("location: account-activities");
		exit;
	}
}
function notfound(){
	if($_SESSION['notfound'] == true){
		echo "<div class=\"alert alert-warning\">Sorry I can't find the story you intend deleting, you can contact support if you think it's an error as I'm only a robot.</div>";
	}
	$_SESSION['notfound'] = false;
}
function fool(){
	if($_SESSION['fool'] == true){
		echo "<div class=\"alert alert-danger\">Wait! Humans can be so evil, why trying to delete someone's story?. You can contact support if you think it's an error as I'm only a robot.</div>";
	}
	$_SESSION['fool'] = false;
}
function cover($name, $title, $pattern){
	$tx = strip_tags($title);
	$cx = strip_tags($content);
	$ttl = preg_replace('/\s+/', '', $tx);
	$con = preg_replace('/\s+/', '', $cx);
	if(empty($ttl) || empty($name) || empty($pattern)){
		$_SESSION['required'] = true;
		header("location: cover");
		exit;
	}
	$_SESSION['topic'] = $title;
	$_SESSION['ntname'] = $name;
	$lnk = fuckpbnl($title);
	$date = date("Y-m-d\TH:i:sP");
	$sql = getPostDesc();
	$join = $sql+1;
	$links = $lnk."".$join;
	$query = query("INSERT INTO c_topics(name, topic, pattern, slug)VALUES(\"$name\", \"$title\", \"$pattern\", \"$links\")");
	if($query){
		$slt = getSinglePost($links);
		$ild = $slt['id'];
		header("location: new-story-$ild");
		exit;
	}else{
		$_SESSION['f'] = true;
		header("location: cover");
		exit;
	}
}
function getPostDesc(){
	$q = query("SELECT * FROM c_topics ORDER BY id DESC");
	return num_rows($q);
}
?>