<?php include("backend/include/database.php"); $title = "Contact Us";
	include("include/header.php"); $site = $db->ShopSettings();?>
    <!-- Main Content -->
	<main class="main-content">
		<!-- Contant Holder -->
		<div class="tc-padding">
			<div class="container">
			<?php $db->showNotification();?>
				<!-- Address Columns -->
				<div class="tc-padding-bottom">
					<div class="row">
				
						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-map-marker"></i></span>
								<h6>Address</h6>
								<strong><?php echo $site['address'];?></strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-volume-control-phone"></i></span>
								<h6>Phone No.</h6>
								<strong><?php echo $site['tel'];?></strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-envelope"></i></span>
								<h6>Email</h6>
								<strong><?php echo $site['email'];?></strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-share-alt"></i></span>
								<h6>Fallow us</h6>
								<ul class="social-icons">
				                	<li><a class="facebook" href="<?php echo $site['facebook'];?>"><i class="fa fa-facebook"></i></a></li>
				                    <li><a class="twitter" href="<?php echo $site['twitter'];?>"><i class="fa fa-twitter"></i></a></li>
				                    <li><a class="youtube" href="<?php echo $site['youtube'];?>"><i class="fa fa-youtube-play"></i></a></li>
				                    <li><a class="pinterest" href="<?php echo $site['instagram'];?>"><i class="fa fa-instagram"></i></a></li>
				                </ul>
							</div>
						</div>
						<!-- Column -->

					</div>
				</div>
				<!-- Address Columns -->

				<!-- Contact Map -->
				
				<!-- Contact Map -->

				<!-- Form -->
				<div class="form-holder">

					<!-- Secondary heading -->
	        		<div class="sec-heading">
	        			<h3>Contact Form</h3>
	        		</div>
	        		<!-- Secondary heading -->

	        		<!-- Sending Form -->
	        		<form class="sending-form" method="post" action="backend/mint?action=contact-us">
	        			<div class="row">
	        				<div class="col-sm-12">
			        			<div class="form-group">
			        				<textarea class="form-control" required="required" name="message" rows="5" placeholder="Text here..."></textarea>
			        				<i class="fa fa-pencil-square-o"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input class="form-control" required="required" name="name" placeholder="Full name">
			        				<i class="fa fa-user"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input class="form-control" required="required" name="phone" placeholder="Phone no.">
			        				<i class="fa fa-phone"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input class="form-control" required="required" name="email" placeholder="Email">
			        				<i class="fa fa-envelope"></i>
			        			</div>
		        			</div>
		        			<div class="col-xs-12">
			        			<button class="btn-1 shadow-0 sm">send message</button>
		        			</div>
	        			</div>
	        		</form>
	        		<!-- Sending Form -->

				</div>
				<!-- Form -->

			</div>
		</div>
		<!-- Contant Holder -->

	</main>
	<!-- Main Content -->
<?php include("include/footer.php");?>