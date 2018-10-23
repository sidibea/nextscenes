<head>	
	
	<meta charset="ASCII">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php header('Content-Type: text/html; charset=ASCII'); echo $title;?> &bull; NextScenes.Com</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="<?php echo $db->dlink();?>/apple-touch-icon.png">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/transitions.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/simpleWeather.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/flexslider.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/owl.theme.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/MetroJs.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/swiper.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/color.css">
	<link rel="stylesheet" href="<?php echo $db->dlink();?>/css/responsive.css">
	<script src="<?php echo $db->dlink();?>/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	
</head>
<body>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
			Preloader Start
	*************************************-->
	<div id="status">
		<div id="preloader" class="preloader">
			<img src="<?php echo $db->dlink();?>/img/next-scenes_logo.png" alt="Preloader" /><br>
            <div style="text-align:center; font-weight:bold;">Loading...</div>
		</div>
	</div>
	<!--************************************
			Preloader End
	*************************************-->
	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<!--************************************
			Wrapper Start
	*************************************-->
	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<!--************************************
				Header Start
		*************************************-->
		<header id="tg-header" class="tg-header tg-header-versionfour tg-haslayout">
			<div class="tg-topbar tg-haslayout">
				<div class="tg-topbarrightwidgets">
					<nav class="tg-addnav">
						<ul>
                        <?php if(!isset($_SESSION['uid'])){?>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#tg-LoginModal">login</a></li>
							<li><a href="javascript:void(0);" data-toggle="modal" data-target="#tg-RegisterModal">register</a></li>
						<?php }else{?>
                        	<li><a href="<?php echo $db->dlink();?>/profile">Profile</a></li>
                        	<li><a href="<?php echo $db->dlink();?>/mint?action=logout">Connectez - Out</a></li>
                        <?php }?>
                        </ul>
					</nav>
					<a class="tg-search-open" href="javascript:void(0);"><i class="glyphicon glyphicon-search"></i></a>
				<!--<a class="tg-search-open" href="javascript:void(0);"><i class="glyphicon glyphicon-search"></i></a> -->					
					<a class="tg-langue" href="http://nextscenes.com/en"><img src="<?php echo $db->dlink();?>/img/en.png" title="NEXTSCENES ANGLAIS" style="width:24px; height:24px;" /></a>
				</div>
				<div class="tg-searchbox">
					<form action="<?php echo $db->dlink();?>/search" method="get" class="tg-form-search">
						<fieldset>
							<input type="search" name="search" class="form-control" placeholder="Type &amp; press enter to search" value="">							
						</fieldset>
					</form>
					<!--<a class="tg-search-close" href="javascript:void(0);"><i class="fa fa-close"></i></a>-->
					<a class="tg-search-close" href="javascript:void(0);"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="tg-navigationarea tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<strong class="tg-logo">
								<a href="<?php echo $db->dlink();?>/"><img src="<?php echo $db->dlink();?>/img/next-scenes_logo.png" alt="NexScenes"></a>
							</strong>
							<nav id="tg-nav" class="tg-nav">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div id="tg-navigation" class="tg-navigation collapse navbar-collapse">
									<ul>
                                    	<li class="tg-hasdropdown"><a href="<?php echo $db->dlink();?>/">Accueil</a></li>
										<li class="tg-hasdropdown">
											<a href="<?php echo $db->dlink();?>/forums/">Forums</a>
											<ul class="">
                                                <?php $forum = $db->fetchForum();
													foreach($forum as $forums){
														echo "<li><a href=\"".$db->dlink()."/forums/".$forums['slug']."\">".$forums['title']."</a></li>";
													}
												?>
                                            </ul>
										</li>
                                        <li><a href="<?php echo $db->dlink();?>/comment-nexscenes-marche">Comment Il Marche</a></li>
                                        <li><a href="<?php echo $db->dlink();?>/news/">Blog</a></li>
                                        <li><a href="<?php echo $db->dlink();?>/nouvelle-histoire">Cr&eacute;er Nouvelle R&eacute;cit</a></li>
                                        <li><a href="<?php echo $db->dlink();?>/store/">Shop</a></li>
                                        <li><a href="<?php echo $db->dlink();?>/contact-us">Contact</a></li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!--************************************
				Header End
		*************************************--> 
        <div align="center"><?php $db->showNotification();?></div>       