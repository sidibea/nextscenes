<!doctype html>
<html class="no-js" lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content=""/>
<!-- Document Title -->
<title>NextScenes | <?php echo $db->title($title);?></title>
<!-- StyleSheets -->
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/animate.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/icomoon.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/main.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/color-1.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/style.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/responsive.css">
<link rel="stylesheet" href="<?php echo $db->flink();?>/css/transition.css">
<!-- FontsOnline -->
<link href='https://fonts.googleapis.com/css?family=Merriweather:300,300italic,400italic,400,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900italic,900,100italic,100' rel='stylesheet' type='text/css'>

<!-- JavaScripts -->
<script src="<?php echo $db->flink();?>/js/vendor/modernizr.js"></script>
</head>
<body>

<!-- Preloader 
<div id="status">
	<div id="preloader">
		<div class="preloader position-center-center">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
</div>
 Preloader -->

<!-- Wrapper -->
<div class="wrapper push-wrapper">

	<!-- Header -->
	<header id="header">
		
		<!-- Top Bar -->
		<div class="topbar">
			<div class="container">
				
				<!-- Online Option 
				<div class="online-option">
					<ul>
						<li><a href="#">online store</a></li>
						<li><a href="#">Payment</a></li>
						<li><a href="#">shipping</a></li>
						<li><a href="#">Return</a></li>
					</ul>
				</div>
				 Online Option -->

				<!-- Social Icons -->
				<div class="social-icons pull-right">
					<ul>
						<li><a class="fa fa-facebook" href="#"></a></li>	
						<li><a class="fa fa-twitter" href="#"></a></li>	
						<li><a class="fa fa-google-plus" href="#"></a></li>	
						<li><a class="fa fa-pinterest-p" href="#"></a></li>	
					</ul>
				</div>
				<!-- Social Icons -->

				<!-- Cart Option -->
				<div class="cart-option">
					<ul>
						<li class="add-cart"><a href="#"><i class="fa fa-shopping-bag"></i><span>3</span></a></li>
						<!--<li><a href="#"><i class="fa fa-heart-o"></i>wish List 0 items</a></li> -->
						<li><a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user"></i>Login / Register</a></li>
					</ul>
				</div>
				<!-- Cart Option -->

			</div>
		</div>
		<!-- Top Bar -->

		<!-- Nav -->
		<nav class="nav-holder style-1">
			<div class="container">
				<div class="mega-dropdown-wrapper">

					<!-- Logo -->
					<div class="logo">
						<a href="<?php echo $db->flink();?>/"><img src="images/logo-1.png" alt=""></a>
					</div>
					<!-- Logo -->

					<!-- Search bar -->
					<div class="search-bar">
						<a href="#"><i class="fa fa-search"></i></a>
					</div>
					<!-- Search bar -->

					<!-- Responsive Button -->
					<div class="responsive-btn">
						<a href="#menu" class="menu-link circle-btn"><i class="fa fa-bars"></i></a>
					</div>
					<!-- Responsive Button -->

					<!-- Navigation -->
					<div class="navigation">
						<ul>
							<li class="active dropdown-icon">
								<a href="<?php echo $db->flink();?>/"><i class="fa fa-home"></i>Home</a>
							</li>
							<li class="dropdown-icon mega-dropdown-holder">
								<a href="#"><i class="fa fa-book"></i>categories</a>
								<ul>
									<li>
										<div class="mega-dropdown">
											<div class="row">
												<div class="col-sm-2">
													<div class="categories-list">
														<h6>Categories</h6>
														<?php $ct = $db->getCategories();
														foreach($ct as $cat){?>
                                                        	<a href="<?php echo $db->flink();?>/category/<?php echo $cat['slug'];?>"><?php echo $cat['name'];?></a>
                                                        <?php }?>
													</div>
												</div>
												<div class="col-sm-10">
													<div class="row">
                                                    <?php $it = $db->randomItem(5);foreach($it as $its){?>
														<div class="col-sm-4">
															<div class="s-product">
																<div class="s-product-img">
																	<img class="catImg" src="<?php echo $db->flink();?>/backend/<?php $img=explode(',',$its['images']);echo $img[0];?>" alt="">
																</div>
																<span><?php echo $its['title'];?></span>
															</div>
														</div>
                                                     <?php }?>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li class="dropdown-icon">
								<a href="#"><i class="fa fa-files-o"></i>Pages</a>
								<ul>
                                	<?php $pg = $db->getpages("cs");foreach($pg as $page){?>
									<li><a href="<?php echo $db->flink();?>/page/<?php echo $page['slug'];?>"><?php echo $page['title'];?></a></li>
                                    <?php }?>
								</ul>
							</li>
							<li class="dropdown-icon">
                            	<a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-file-text"></i> Register/Login</a>
							</li>
							<li><a href="contact-us"><i class="fa fa-fax"></i>Contact</a></li>
						</ul>
					</div>
					<!-- Navigation -->

				</div>
			</div>
		</nav>
		<!-- Nav -->
</header>