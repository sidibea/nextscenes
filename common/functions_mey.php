<?php
if(!$db_auth){
	require "db_auth.php";
}
function getForums($page){
	global $db_auth;
	$query = "SELECT * FROM forums
ORDER BY storylines DESC";
	$result = mysql_query($query, $db_auth);
	while($answer = mysql_fetch_assoc($result)){
		$data[] = $answer;
	}
	return $data;
}
function shorten($text,$chars) { 
    $length = strlen($text); 
    $text = strip_tags($text);  
    $text = substr($text,0,$chars); 
    if($length > $chars) { $text = $text."..."; } 
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
	$data = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html dir=\"ltr\" xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title>NextScenes : Literary Entertainment.</title>
<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/zebra.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/dr-framework.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/navigation.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/fullwidth.html\" media=\"screen\" />
<link rel=\"stylesheet\" href=\"css/revslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/jquery.bxslider.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/responsive.css\" type=\"text/css\" media=\"screen\">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Philosopher:400,700,400italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<link rel=\"stylesheet\" href=\"common/stylee.css\" type=\"text/css\" media=\"screen\">
<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"common/jquery.image-scale.js\" language=\"javascript\"></script>
<script type=\"text/javascript\" src=\"common/jquery.bxslider.min.js\" language=\"javascript\"></script>
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
	$(document).on(\"click\", function(e){
		var clickedAnchor = $(e.target);
		var fullResp;
		var theHandle;
		var theHandlex;
		var theHandley;
		if(clickedAnchor.is(\".generic_click\")){
			
		}
	});
	";
	$data .= "
	
});
</script>
</head>";
	}
	return $data;
}
function topNav($page){
	$data = "
<div class=\"w100p c_tiptop\">
	<div class=\"main\">
    	<ul>
        	<li><span>Welcome to <strong>".siteName()."</strong></span></li>
        </ul>
    	<ul>
            <li><a href=\"/fr/index.html\">FR</a></li>
            <li><a href=\"register.html\">New member? Sign up</a></li>
            <li><a href=\"connect.html\">Log in</a></li>
        </ul>
        <div class=\"clear\"></div>
    </div>
</div>
<div class=\"w100p\">
	<div class=\"main\">
    	<ul class=\"nav\">
        	<span>
                <li><a href=\"index.html\"><img src=\"images/logo.png\" alt=\"\" class=\"c_logo\"></a></li>
            </span>
            <span>
                <li><a href=\"index.html\""; if($page == "home"){ $data .= " class=\"selected\""; } $data .= ">Home</a></li>
                <li><a href=\"forums.html\""; if($page == "forums"){ $data .= " class=\"selected\""; } $data .= ">Forums</a></li>
                <li><a href=\"principle.html\""; if($page == "principle"){ $data .= " class=\"selected\""; } $data .= ">Principle</a></li>
                <li><a href=\"howitworks.html\""; if($page == "how"){ $data .= " class=\"selected\""; } $data .= ">How It Works</a></li>
            </span>
        	<span>
                <li><a href=\"search.html\""; if($page == "search"){ $data .= " class=\"selected\""; } $data .= ">Search</a></li>
                <li><a href=\"faq.html\""; if($page == "faqs"){ $data .= " class=\"selected\""; } $data .= ">FAQs</a></li>
                <li><a href=\"/discussions/\">Discussions</a></li>
                <li><a href=\"contact.html\""; if($page == "contact"){ $data .= " class=\"selected\""; } $data .= ">Contact Us</a></li>
            </span>
        	<span>
                <li><a href=\"register.html\""; if($page == "login"){ $data .= " class=\"selected\""; } $data .= ">Log in</a></li>
                <li><a href=\"connect.html\""; if($page == "signup"){ $data .= " class=\"selected\""; } $data .= ">Sign up</a></li>
            </span>
        	<span>
                <!--<li><a href=\"\">English <strong>EN</strong></a></li>-->
                <li>".date("l, j F Y")."</li>
                <li>
                	<a class=\"social social_fb\" target=\"_blank\" href=\"https://www.facebook.com/nextscenes\">Facebook</a>
                	<a class=\"social social_tw\" target=\"_blank\" href=\"https://twitter.com/nextscenes\">Twitter</a>
                	<a class=\"social social_gp\" target=\"_blank\" href=\"https://plus.google.com/104343619491056936695\">Google+</a>
                	<a class=\"social social_li\" target=\"_blank\" href=\"aaa\">Linkedin</a>
                </li>
            </span>
            <div class=\"clear\"></div>
        </ul>
    </div>
</div>";
	return $data;
}
function footer($page){
	$data = "
<div class=\"w100p c_footer\">
	<div class=\"main\">
    	<ul class=\"ul\">
        	<li>
            	<h3>Contact us</h3>
                <span>
                    <p>NextScene&reg; Nigeria.<br>No. 12 Esomo Crescent,<br>Off Toyin Street Ikeja, Lagos,<br>Nigeria.<br><a href=\"http://www.nextscenes.com\">www.nextscenes.com</a><br>+ 234 803 945 4555<br>+234 806 410 5588<br><a href=\"mailto:info@nextscenes.com\">info@nextscenes.com</a></p>
                </span>
                <span>
                	<p>Ginco Communications<br>(Division of Ginco Group SARL)<br>Immeuble Pacific IV,<br>Hamdallaye ACI 2000, BP 2191<br>Bamako, Mali.<br>+223 2022 3168<br>+223 7015 9015<br><a href=\"mailto:info@nextscenes.com\">info@nextscenes.com</a></p>
				</span>
                <span class=\"clear\"></span>
           	</li>
    	</ul>
        <ul class=\"oul\">
            <li><a href=\"terms.php\">Terms of use</a></li>
            <li><a href=\"privacy.php\">Privacy</a></li>
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
<script>
	$(document).ready(function(){
		$('.slider1').bxSlider({
			slideWidth: 370,
			minSlides: 2,
			maxSlides: 4,
			slideMargin: 30
		});
	});
</script>
<script type=\"text/javascript\" src=\"js/script.js\"></script>
<script type=\"text/javascript\" src=\"js/zebra_datepicker.js\"></script>
<script type=\"text/javascript\" src=\"js/core.js\"></script>";
	return $data;
}
?>