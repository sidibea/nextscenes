<?php
//error_reporting(E_ALL);
//ini_set("display_serrors", 1);
if(!$db_auth){
	require "db_auth.php";
}
require_once __DIR__ . '/Facebook/autoload.php';
if(isset($_GET['lang'])){
	$_SESSION['language_session'] = $_GET['lang'];
	if($_GET['lang'] == "fr"){
		setlocale(LC_TIME, "fr_FR");
	}
	header("Location: /index.html");
	exit;
}
function getPosts($the_page){
	if(!$the_page || !is_numeric($the_page)){
		$pager = 1;
	}
	else{
		$pager = $the_page;
	}
	global $db_auth;
	$query = "(SELECT scenes_proposes.id,scenes_proposes.scenes, scenes_proposes.Date,scenes_proposes.idstory,scenes_proposes.Login,scenes_proposes.Text, storylines.Forum AS forum_name, storylines.IdForum AS forum_id, storylines.Title AS original_title, 'proposed' AS scene_type, View FROM scenes_proposes
INNER JOIN storylines ON storylines.idstory = scenes_proposes.idstory
INNER JOIN members ON members.Login = scenes_proposes.Login";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	INNER JOIN forums ON forums.IdForum = storylines.IdForum
	WHERE forums.lang = 'en'";
	}
	else{
		$query .= "
	INNER JOIN forums ON forums.IdForum = storylines.IdForum
	WHERE forums.lang = 'fr'";
	}
	$query .= "
)

UNION

(SELECT scenes_valides.id,scenes_valides.scenes, scenes_valides.Date,scenes_valides.idstory,scenes_valides.Login,scenes_valides.Text, storylines.Forum AS forum_name, storylines.IdForum AS forum_id, storylines.Title AS original_title, 'valid' AS scene_type, View FROM scenes_valides
INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
INNER JOIN members ON members.Login = scenes_valides.Login";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	INNER JOIN forums ON forums.IdForum = storylines.IdForum
	WHERE forums.lang = 'en'";
	}
	else{
		$query .= "
	INNER JOIN forums ON forums.IdForum = storylines.IdForum
	WHERE forums.lang = 'fr'";
	}
	$query .= "
)";
	
	$query .= "
	ORDER BY id DESC";
	
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
	$query = "SELECT COUNT(id) AS the_count FROM scenes_proposes
INNER JOIN storylines ON storylines.idstory = scenes_proposes.idstory";
	$result = mysql_query($query, $db_auth);
	$answer = mysql_fetch_assoc($result);
	$data = $answer['the_count'];
	return $data;
}
function getForums($page){
	global $db_auth;
	$query = "SELECT * FROM forums
	LEFT JOIN (SELECT COUNT(idstory) AS story_count, IdForum FROM storylines
	GROUP BY IdForum) dd ON dd.IdForum = forums.IdForum";
	//WHERE storylines > 0";
	if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
		$query .= "
	WHERE lang='en'";
	}
	else{
		$query .= "
	WHERE lang='fr'";
	}
	$query .= "
ORDER BY Title ASC";
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
function common_top($page){
	if($page == "home"){
		$title = "Welcome to ".siteName()."&reg;  – A multilingual, web-based, creative writing platform : Literary Entertainment.";
	}
	else if($page == "forums"){
		$title = "".siteName()." : All Forums.";
	}
	$data = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html dir=\"ltr\" xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no\">
<title>".$title."</title>
<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/zebra.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/dr-framework.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/navigation.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/fullwidth.html\" media=\"screen\" />
<link rel=\"stylesheet\" href=\"css/revslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/jquery.bxslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/responsive.css\" type=\"text/css\" media=\"screen\">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link rel=\"stylesheet\" href=\"common/stylee.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"common/lemonade.css\" type=\"text/css\" media=\"screen\">
<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"common/jquery.image-scale.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"common/jquery.bxslider.min.js\" language=\"javascript\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css\"/>
<script type=\"text/javascript\" src=\"//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js\"></script>
<script src=\"common/jquery.star-rating-svg.min.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"common/star-rating-svg.css\">

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
<script type=\"text/javascript\" src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de6c866430c3273\"></script>";
?>
</head>

<?php
	return $data;
}
function getUser($page){
	global $db_auth;
	$query = "SELECT * FROM members WHERE Idsession='".mysql_real_escape_string($_SESSION['idsession'])."'";
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
		if(empty($_SESSION['idsession'])){
			$data .= "
		<ul>";
			if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "
				<li><a href=\"/index.html?lang=fr\">FR</a></li>
				<li><a href=\"register.html\">New member? Sign up</a></li>
				<li><a href=\"connect.html\">Log in</a></li>";
			}
			else{
			$data .= "
				<li><a href=\"/index.html?lang=en\">EN</a></li>
				<li><a href=\"register.html\">Nouveau membre? S'inscrire</a></li>
				<li><a href=\"connect.html\">S'identifier</a></li>";
			}
			$data .= "
		</ul>";
		}
		else{
			$data .= "
		<ul>";
			if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "
				<li><a href=\"/index.html?lang=fr\">FR</a></li>";
			}
			else{
			$data .= "
				<li><a href=\"/index.html?lang=en\">EN</a></li>";
			}
			$data .= "
				<li><a href=\"account-manage.php\">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Manage your account";
				}
				else{
					$data .= "Gérer son compte";
				}
				$data .= "</a></li>
				<li><a href=\"logout.php\">";
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
                <li><a href=\"index.html\"><img src=\"images/logo.png\" alt=\"\" class=\"c_logo\"></a><div class=\"mobile_menu mobile_menu_open hide\"></div><div class=\"mobile_menu mobile_menu_close hide\"></div></li>
            </span>
            <span class=\"mobile_menu_option\">
                <li><a href=\"index.html\""; if($page == "home"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Home";
				}
				else{
					$data .= "Accueil";
				}
				$data .= "</a></li>
                <li><a href=\"forums.html\""; if($page == "forums"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Forums";
				}
				else{
					$data .= "Forums";
				}
				$data .= "</a></li>
                <li><a href=\"principle.html\""; if($page == "principle"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Principle";
				}
				else{
					$data .= "Principes";
				}
				$data .= "</a></li>
                <li><a href=\"howitworks.html\""; if($page == "how"){ $data .= " class=\"selected\""; } $data .= ">";
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
                <li><a href=\"faq.html\""; if($page == "faqs"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "FAQs";
				}
				else{
					$data .= "FAQs";
				}
				$data .= "</a></li>
                <li><a href=\"/discussions/\">Discussions</a></li>
                <li><a href=\"contact.html\""; if($page == "contact"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Contact Us";
				}
				else{
					$data .= "Contactez-Nous";
				}
				$data .= "</a></li>
            </span>
        	<span class=\"mobile_menu_option\">
                <li><a href=\"connect.html\""; if($page == "login"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Log in";
				}
				else{
					$data .= "S'identifier";
				}
				$data .= "</a></li>
                <li><a href=\"register.html\""; if($page == "signup"){ $data .= " class=\"selected\""; } $data .= ">";
				if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
					$data .= "Sign up";
				}
				else{
					$data .= "S'inscrire";
				}
				$data .= "</a></li>
				<li>
					<form method=\"post\" action=\"/search.html\">
						<input type=\"text\" name=\"search\" class=\"menu_search\" placeholder=\"Enter keyword\">
					</form>
				</li>
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
                	<a class=\"social social_li\" target=\"_blank\" href=\"aaa\" title=\"Network with us on Linkedin\">Linkedin</a>
                </li>
            </span>
            <div class=\"clear\"></div>
        </ul>
    </div>
</div>";
	return $data;
}
function footer($page){
	$user = getUser();
	$data = "
<div class=\"w100p c_footer\">
	<div class=\"main\">
        <ul class=\"oul\">
            <li><a href=\"terms.html\">Terms of use</a></li>
            <li><a href=\"privacy.html\">Privacy</a></li>
            <li>Copyright &copy; ".date("Y")." NextScenes, All Rights Reserved.</li>
            <span class=\"clear\"></span>
        </ul>
        <div class=\"clear\"></div>
    </div>
</div>    
<script src=\"js/jquery.flexslider.js\"></script>
<script type=\"text/javascript\" charset=\"utf-8\">
	$(window).load(function() {
		$('.flexslider').flexslider();
	});
</script>
<script type=\"text/javascript\" src=\"js/jquery.superfish.js\"></script>
<script type=\"text/javascript\" src=\"js/accordion.js\"></script>
<script src=\"js/jquery.bxslider.js\"></script>
<script  type=\"text/javascript\">
	$(document).ready(function(){
		$('.slider1').bxSlider({
			slideWidth: 370,
			minSlides: 2,
			maxSlides: 4,
			slideMargin: 30
		});
	});
	$(document).on(\"click\", function(e){
		var clickedAnchor = $(e.target);
		var fullResp;
		var theHandle;
		var theHandlex;
		var theHandley;
		if(clickedAnchor.is(\".click_to_read_this\")){
			theHandle = clickedAnchor.attr(\"rel\");
			$('.read_proposed_posts').html('<div class=\"loading_div\">Loading proposed scene...</div>');
			$.ajax({
				method: \"POST\",
				url: \"/a_scene.php\",
				data: { scene: theHandle, fro: ".$user['IdMembers']."}
			})
			.done(function(response) {
				if(response == '0'){
					$('.read_proposed_posts').html('<div class=\"loading_div\">Sorry, the scene you selected cannot be viewed.</div>');
				}
				else{
					$('.read_proposed_posts').html(response);
					var the_rating_score = ($('.rate_widget').attr('rating'));
					var the_rating_scene = $('.rate_widget').attr('rel');
					var the_rating_self = $('.rate_widget').attr('selfrated');
					$('.writers-rating').starRating({
						initialRating: the_rating_score,
						starSize: 25,
						disableAfterRate: false,
						callback: function(currentRating){
							$.ajax({
								method: \"POST\",
								url: \"/a_score.php\",
								data: { scene: the_rating_scene, score: (currentRating*2), fro: ".$user['IdMembers']."}
							})
							.done(function(response) {
								$('.the_input_score_class').val((currentRating*2));
								$('.the_input_score_review').prop(\"disabled\", false);
								if(response == '1'){
									var num_of_votes = $('.the_scene_rating_figure').text();
									if(num_of_votes == 0){
										num_of_votes = '1 vote';
									}
									else{
										if(the_rating_self != '1'){
											num_of_votes = (parseInt(num_of_votes)+1)+' votes';
											$('.total_votes h4').text(num_of_votes);
										}
										else{
											$('.rate_widget').attr('selfrated', '1');
										}
									}
								}
								else{
									alert('Rating unsuccessful');
								}
								
							})
							.fail(function(error) {
								alert('Error applying your rating');
							})
						}

					});
					setTimeout( function() {
						$('.read_proposed_posts').scrollTop(0)
					}, 500 );				
				}
			})
			.fail(function(error) {
				$('.read_proposed_posts').html('<div class=\"loading_div\">Unable to retrieve scenes</div>');
			})
			.always(function() {
				
			});
			return false;
		}
		else if(clickedAnchor.is(\".search_click_button\")){
			$('.menu_search').fadeToggle();
			return false;
		}
		else if(clickedAnchor.is(\".the_input_score_review\")){
			var the_rating_scene = $('.rate_widget').attr('rel');
			$.ajax({
				method: \"POST\",
				url: \"/a_scene_comment.php\",
				data: { scene: the_rating_scene, comment: $('.the_input_score_comment').val(), fro: ".$user['IdMembers']."}
			})
			.done(function(response) {
				if(response == '1'){
					alert('Successfully posted your comment');
				}
				else{
					alert('Unable to post your comment');
				}
			})
			.fail(function(error) {
				alert('Unable to post your comment');
			})
			.always(function() {
				
			});
			return false;
		}
	});";
	if($page == "propose"){
		$data .= "
var wordCount_global = 0;
counter = function() {
    var value = $('.write_scene').val();
    if (value.length == 0) {
        $('#mon_compteur').html('0 words/500');
        return;
    }

    var regex = /\s+/gi;
    var wordCount = value.trim().replace(regex, ' ').split(' ').length;
	wordCount_global = wordCount;
    $('#mon_compteur').html(wordCount+' words/500');
};

$('.write_scene').change(counter);
$('.write_scene').keydown(counter);
$('.write_scene').keypress(counter);
$('.write_scene').keyup(counter);
$('.write_scene').blur(counter);
$('.write_scene').focus(counter);

$(document).on(\"keyup\", function(e){
	var clickedAnchor = $(e.target);
	var fullResp;
	var theHandle;
	var theHandlex;
	var theHandley;
	if(clickedAnchor.is(\".write_scene\")){
		if(wordCount_global > 500){
			alert('You have reached the limit of characters allowed');
		}
	}
});";
	}
	$data .= "
</script>
<script type=\"text/javascript\" src=\"js/script.js\"></script>
<script type=\"text/javascript\" src=\"js/zebra_datepicker.js\"></script>
<script type=\"text/javascript\" src=\"js/core.js\"></script>

  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-79838128-1', 'auto');
  ga('send', 'pageview');
";
if($page == "signup" || $page == "start"){
	$data .= "
<script>
    var checkobj
    function agreesubmit(el) {
        checkobj = el
        if (document.all || document.getElementById) {
            for (i = 0; i < checkobj.form.length; i++) { //hunt down submit button
                var tempobj = checkobj.form.elements[i]
                if (tempobj.type.toLowerCase() == \"submit\")
                    tempobj.disabled = !checkobj.checked
            }
        }
    }
    function defaultagree(el) {
        if (!document.all && !document.getElementById) {
            if (window.checkobj && checkobj.checked)
                return true
            else {
                alert(\"Please read/accept terms to submit form\")
                return false
            }
        }
    }
</script>";
}
	return $data;
}
function side($page){
	$data = "
<div class=\"tright\">
	<div class=\"c_spacer\">
		<img src=\"images/ns300x250.jpg\" alt=\"\">
	</div>";
	$new = newMembers();
	if($new != 0){
		$data .= "
		<h3 class=\"h3\">";
		if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
			$data .= "Latests members";
		}
		else{
			$data .= "Derniers membres";
		}
		$data .= "</h3>
		<div class=\"tab_like\">";
		foreach ($new as $new_o){
			$imgstylex = getImgStyle("avatars/".$new_o['avatar']);
			if(!empty($new_o['avatar'])){
				$avatar = "<img src=\"avatars/".$new_o['avatar']."\"/>";
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
						<h4>".stripslashes(htmlspecialchars_decode($new_o['Login']))."</h4>
						<h5>";
						if(!isset($_SESSION['language_session']) || ($_SESSION['language_session'] == "en")){
							$data .= "Registered";
						}
						else{
							$data .= "Inscrit";
						}
						$data .= ": ".$new_o['Date']."</h5>
					</div>
				</div>
			</div>";
		}
		$data .= "
		</div>";
	}
	$data .= "
</div>
<div class=\"clear\"></div>";
	return $data;
}
function getForumStories($id, $page){
	if(!$page || !is_numeric($page)){
		$pager = 1;
	}
	else{
		$pager = $page;
	}
	global $db_auth;
	$query = "SELECT *, members.avatar AS avatarr FROM storylines
		INNER JOIN (
			SELECT MIN(id) AS id, idstory AS iddstory FROM scenes_valides
			GROUP BY idstory) idd 
				ON idd.iddstory = storylines.idstory
		LEFT JOIN (
			SELECT COUNT(id) AS validated_scenes_count, idstory AS idddstory FROM scenes_valides
			GROUP BY idstory
			) iddd ON iddd.idddstory = storylines.idstory
		LEFT JOIN (
			SELECT COUNT(id) AS proposed_scenes_count, idstory AS idxstory FROM scenes_proposes
			GROUP BY idstory
			) idx ON idx.idxstory = storylines.idstory
		LEFT JOIN members ON members.Login = storylines.Login
		WHERE IdForum = '".mysql_real_escape_string($id)."'";
	
	$query .= "
	ORDER BY idstory DESC";
	
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
		header('location: forums.html');
	}
	else{
		while($answer = mysql_fetch_assoc($result)){
			$data[] = $answer;
		}
	}
	return $data;	
}
function countForumStories($id){
	global $db_auth;
	$query = "SELECT COUNT(idstory) AS the_count FROM storylines
		WHERE IdForum = '".mysql_real_escape_string($id)."'";
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
	$query = "UPDATE storylines SET View = View+1
		WHERE idstory = '".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
}
function getStory($id){
	global $db_auth;
	$query = "SELECT * FROM storylines
	LEFT JOIN (SELECT (MAX(scenes_valides.scenes)+1) AS latest_scene, scenes_valides.idstory AS mssid
		FROM scenes_valides
		WHERE idstory ='".mysql_real_escape_string($id)."'
		) mss ON mss.mssid = storylines.idstory
	WHERE idstory ='".mysql_real_escape_string($id)."'";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: forums.html');
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
			header('location: forums.html');
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
function proposedScenes($id, $scene){
	global $db_auth;
	$query = "SELECT *, Forum AS forum_name, scenes_proposes.Login AS scene_writer, scenes_proposes.scenes AS scene_number FROM scenes_proposes
		INNER JOIN storylines ON storylines.idstory = scenes_proposes.idstory
		WHERE scenes_proposes.idstory = '".mysql_real_escape_string($id)."'
		ORDER BY scenes_proposes.id ASC";
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
	$query = "SELECT * FROM forums
		WHERE IdForum = '".mysql_real_escape_string($id)."'";
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
	$query = "SELECT *, 'valid' AS scene_type, Forum AS forum_name, scenes_valides.scenes AS scene_number FROM scenes_valides
		INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
		WHERE scenes_valides.idstory = '".mysql_real_escape_string($id)."'
		AND scenes_valides.id IN (
			SELECT id FROM scenes_valides
			WHERE scenes_valides.idstory = '".mysql_real_escape_string($id)."'
			ORDER BY scenes DESC
		)
		ORDER BY scenes_valides.scenes ASC
		LIMIT 5";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: forums.html');
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
	$query = "SELECT *, 'valid' AS scene_type, Forum AS forum_name, scenes_valides.scenes AS scene_number FROM scenes_valides
		INNER JOIN storylines ON storylines.idstory = scenes_valides.idstory
		WHERE scenes_valides.idstory = '".mysql_real_escape_string($id)."'
		ORDER BY scenes_valides.scenes DESC
		LIMIT 1";
	$result = mysql_query($query, $db_auth);
	if(mysql_num_rows($result) == 0){
		header('location: forums.html');
	}
	else{
		$answer = mysql_fetch_assoc($result);
		$data = $answer;
	}
	return $data;
}
function loadScene($scene, $fro){
	global $db_auth;
	$query = "SELECT *, 'proposed' AS scene_type, Forum AS forum_name, scenes_proposes.Login AS scene_writer, scenes_proposes.scenes AS scene_number, scenes_proposes.id AS scene_id FROM scenes_proposes
		INNER JOIN storylines ON storylines.idstory = scenes_proposes.idstory
		LEFT JOIN (
			SELECT AVG(ra_rating) AS scene_rating, COUNT(ra_rating) AS scene_votes, proposed_scene_id 
			FROM ratings 
			GROUP BY proposed_scene_id
		) ratata ON ratata.proposed_scene_id = scenes_proposes.id
		LEFT JOIN (SELECT COUNT(ra_id) AS user_self_reviews, proposed_scene_id AS ppsid, ra_comment FROM ratings
			WHERE members_IdMembers = '".mysql_real_escape_string($fro)."'
			GROUP BY proposed_scene_id) ppsid ON ppsid.ppsid = scenes_proposes.id
		WHERE scenes_proposes.id = '".mysql_real_escape_string($scene)."'";
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
						$data .= utf8_encode($answer['Title'])." - Scene ".$answer['scene_number'];
					}
					else{
						$data .= utf8_encode($answer['Title'])." - <strong>[Proposed]</strong> scene ".$answer['scene_number'];
					}							
				$data .= "
				</legend>";
				$imgstylex = getImgStyle("avatars/".$answer['avatar']);
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
				if(!empty($answer['avatar'])){
					$avatar = "<img src=\"avatars/".$answer['avatar']."\"/>";
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
				$data .= utf8_encode($answer['Text'])."
				<div class=\"avatar_holder mt10 right\">
					<div class=\"avatar_holder_main\">
						<div class=\"c_avatar ".$imgstylex."\">
							".$avatar."
						</div>
					</div>
					<div class=\"avatar_text\">
						By ".stripslashes(htmlspecialchars_decode($answer['scene_writer']))."
					</div>
				</div>
				<div class=\"clear\"></div>
			</fieldset>
			<div class='writers_choice'>
				<div class=\"t\">
					<div class=\"tc\">
						Rate &amp; review this:
						<div class=\"rate_widget\" rel=\"".($answer['scene_id'])."\" rating=\"".$rating_score."\" selfrated='".$self_rated."'>
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
							<textarea name=\"comment\" class=\"the_input_score_comment\">".stripslashes(utf8_encode(htmlspecialchars_decode($answer['ra_comment'])))."</textarea>
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
				$imgstylex = getImgStyle("avatars/".$comments_o['avatar']);
				if(!empty($comments_o['avatar'])){
					$avatar = "<img src=\"avatars/".$comments_o['avatar']."\"/>";
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
function writeScene($id, $sc, $Login, $nextscenes){
	global $db_auth;
	if(!$Login || $Login == "" || $Login == NULL){
		header("Location: connect.html");
	}
	$chkq = "SELECT * FROM scenes_proposes
		WHERE idstory = '".mysql_real_escape_string($id)."'
		AND scenes = '".mysql_real_escape_string($sc)."'
		AND Login = '".mysql_real_escape_string($Login)."'
		AND Text = '".mysql_real_escape_string($nextscenes)."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) == 0){
		$insq = "INSERT INTO scenes_proposes (idstory, scenes, Login, Text, Date)
			VALUES ('".mysql_real_escape_string($id)."', '".mysql_real_escape_string($sc)."', '".mysql_real_escape_string($Login)."', '".mysql_real_escape_string($nextscenes)."', '".date("Y-m-d")."')";
		$insr =mysql_query($insq, $db_auth);
		if(!$insr){
			$data = 0;
		}
		else{
			$data = 1;
		}
	}
	else{
		$data = 2;
	}
	return $data;
}
function newMembers(){
	global $db_auth;
	$query = "SELECT * FROM members
		WHERE Login != ''
		ORDER BY IdMembers DESC
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
				header("Location: /start.html");
				exit;
			}
			else{
				header("Location: /connect.html?error=2");
				exit;
			}
		}
		else{
			header("Location: /connect.html?error=1");
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
		header("Location: /forums.html");
		exit;
	}
}
function c_resetPassword($me, $opass, $pass){
	global $db_auth;
	$chkq = "SELECT * FROM members
		WHERE Password = '".mysql_real_escape_string($opass)."'
		AND IdMembers = '".mysql_real_escape_string($me['IdMembers'])."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) > 0){
		$updq = "UPDATE members SET Password = '".mysql_real_escape_string($pass)."'
				WHERE IdMembers = '".mysql_real_escape_string($me['IdMembers'])."'";
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
		header("Location: connect.html");
	}
	$chkq = "SELECT * FROM members
		WHERE IdMembers = '".mysql_real_escape_string($me['IdMembers'])."'";
	$chkr = mysql_query($chkq, $db_auth);
	if(mysql_num_rows($chkr) > 0){
		$updq = "UPDATE members SET Account = '".mysql_real_escape_string($usertype)."'
				WHERE IdMembers = '".mysql_real_escape_string($me['IdMembers'])."'";
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
		$data = 0;
	}
	else{
		$chkq = "SELECT * FROM ratings
		WHERE members_IdMembers = '".mysql_real_escape_string($fro)."'
		AND proposed_scene_id = '".mysql_real_escape_string($scene)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) > 0){
			$updq = "UPDATE ratings SET ra_rating = '".mysql_real_escape_string($score)."'
		WHERE members_IdMembers = '".mysql_real_escape_string($fro)."'
		AND proposed_scene_id = '".mysql_real_escape_string($scene)."'";
			$updr = mysql_query($updq, $db_auth);
			if(!$updr){
				$data = 0;
			}
			else{
				$data = 1;
			}
		}
		else{
			$insq = "INSERT INTO ratings (ra_rating, members_IdMembers, proposed_scene_id)
				VALUES ('".mysql_real_escape_string($score)."', '".mysql_real_escape_string($fro)."', '".mysql_real_escape_string($scene)."')";
			$insr = mysql_query($insq, $db_auth);
			if(!$insr){
				$data = 0;
			}
			else{
				$data = 1;
			}
		}
	}
	return $data;
}
function addComment($scene, $comment, $fro){
	global $db_auth;
	if($fro == "" || $fro == NULL){
		$data = 0;
	}
	else{
		$chkq = "SELECT * FROM ratings
		WHERE members_IdMembers = '".mysql_real_escape_string($fro)."'
		AND proposed_scene_id = '".mysql_real_escape_string($scene)."'";
		$chkr = mysql_query($chkq, $db_auth);
		if(mysql_num_rows($chkr) == 0){
			$data = 0;
		}
		else{
			$chk = mysql_fetch_assoc($chkr);
			$updq = "UPDATE ratings SET ra_comment = '".mysql_real_escape_string($comment)."'
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
	$chkq = "SELECT *, members.Login AS comment_writer, CASE WHEN members_IdMembers = '".mysql_real_escape_string($fro)."' THEN 'self'
	ELSE 'not'
	END AS comment_owner
	FROM ratings
	LEFT JOIN members ON members.IdMembers = ratings.members_IdMembers
	WHERE proposed_scene_id = '".mysql_real_escape_string($scene)."'";
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
?>