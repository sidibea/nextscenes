
	</main>
	<!-- Main Content -->	<!-- Footer -->
	<footer id="footer"> 
	    <!-- Sub Footer -->
	   	<div class="sub-foorer">
	   		<div class="container">
	   			<div class="row">
		   			<div class="col-sm-6">
		   				<p>Copyright <i class="fa fa-copyright"></i> <?php echo date("Y");?> <span class="theme-color">NextScenes</span> All Rights Reserved.</p>
		   			</div>
		   			<div class="col-sm-6">
		   				<a class="back-top" href="#">Back to Top<i class="fa fa-caret-up"></i></a>
		   				<ul class="cards-list">
		   					<li><img src="<?php echo $db->flink();?>/images/cards/img-01.jpg" alt=""></li>
		   					<li><img src="<?php echo $db->flink();?>/images/cards/img-02.jpg" alt=""></li>
		   					<li><img src="<?php echo $db->flink();?>/images/cards/img-03.jpg" alt=""></li>
		   					<li><img src="<?php echo $db->flink();?>/images/cards/img-04.jpg" alt=""></li>
		   				</ul>
		   			</div>
	   			</div>
	   		</div>
	   	</div>
	    <!-- Sub Footer -->

	</footer>
	<!-- Footer -->

</div>
<!-- Wrapper -->

<!-- Slide Menu -->
<nav id="menu" class="responive-nav">
	<a class="r-nav-logo" href="<?php echo $db->flink();?>/"><img src="images/logo-1.png" alt=""></a>
	<ul class="respoinve-nav-list">
		<li><a href="<?php echo $db->flink();?>/">Home</a></li>
        <li><a class="triple-eff" data-toggle="collapse" href="#list-2">categories</a>
            <ul class="collapse" id="list-2">
				<?php $ct = $db->getCategories();
                foreach($ct as $cat){?>
                    <li><a href="<?php echo $db->flink();?>/category/<?php echo $cat['slug'];?>"><?php echo $cat['name'];?></a></li>
                <?php }?>
            </ul>
        </li>
        <li>
            <a class="triple-eff" data-toggle="collapse" href="#list-3">Pages</a>
            <ul class="collapse" id="list-3">
                <?php $pg = $db->getpages("cs");foreach($pg as $page){?>
                <li><a href="<?php echo $db->flink();?>/page/<?php echo $page['slug'];?>"><?php echo $page['title'];?></a></li>
                <?php }?>
            </ul>
        </li>
        <li>
            <a href="#" data-toggle="modal" data-target="#login-modal">Register/Login</a>
        </li>
        <li><a href="contact-us">Contact</a></li>                      
	</ul>
</nav>
<!-- Slide Menu -->
<?php $rec = $db->fetchRecomend(); $ia = 1;
	foreach($rec as $recs){?>
<!-- View Pages -->
<div class="modal fade open-book-view" id="open-book-view<?php echo $ia;?>" role="dialog">
  	<div class="position-center-center" role="document">
 	   	<div class="modal-content">
 	   		<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    	<div id="magazine">
            	<?php $img = explode(',',$recs['image']); $cgm = ''; foreach($img as $imgs){
				$cgm .= '<div style="background-image:url(backend/'.$imgs.');"></div>';
                }echo $cgm;?>
			</div>
    	</div>
  	</div>
</div>
<!-- View Pages -->
<?php $ia++;}?>
<!-- Login Modal -->
<div class="modal fade login-modal" id="login-modal" role="dialog">
	<div class="position-center-center" role="document">
		<div class="modal-content">
			<strong>Register</strong>
			<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="social-options">
				<ul>
					<li><a class="facebook" href="#"><i class="fa fa-facebook"></i>Register with facebook</a></li>
					<li><a class="twitter" href="#"><i class="fa fa-twitter"></i>Register with twitter</a></li>
					<li><a class="google" href="#"><i class="fa fa-google-plus"></i>Register with gmail+</a></li>
				</ul>
			</div>
			<form class="sending-form" method="post">
				<div class="form-group">
					<input class="form-control" name="name" required placeholder="Full name">
					<i class="fa fa-user"></i>
				</div>
				<div class="form-group">
					<input class="form-control" name="email" required placeholder="Email Address">
					<i class="fa fa-user"></i>
				</div>
				<div class="form-group">
					<input class="form-control" name="password" type="password" required placeholder="Password">
					<i class="fa fa-user"></i>
				</div>
				<p class="terms">You agree to NextScenes <a href="#">Terms &amp; Conditions</a></p>
				<button class="btn-1 shadow-0 full-width">Register account</button>
			</form>
		</div>
	</div>
</div>
<!-- Login Modal -->
<?php $query = $db->query("SELECT * FROM items LIMIT 0,5");
	$i = 1;	while($item1 = $db->fetch_array($query)){?>
<!-- Quick View -->
<div class="modal fade quick-view" id="quick-view<?php echo $i;?>" role="dialog">
	<div class="position-center-center" role="document">
		<div class="modal-content">
			<button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="single-product-detail">
				<div class="row">

					<!-- Product Thumnbnail -->
					<div class="col-sm-5">
						<div class="product-thumnbnail">
							<img class="smImg" src="backend/<?php $img = explode(',',$item1['images']); echo $img[0];?>" alt="">
						</div>
					</div>
					<!-- Product Thumnbnail -->

					<!-- Product Detail -->
					<div class="col-sm-7">
						<div class="single-product-detail">
							<span class="availability">Availability :<strong>Stock<i class="fa fa-check-circle"></i></strong></span>
							<h3><?php echo $item1['title'];?></h3>
							<div class="prics"><del class="was">₦<?php echo number_format($item1['amount']);?></del><span class="now">₦<?php echo number_format($item1['amount'] - $item1['discount']);?></span></div>
							<h4>Overview</h4>
							<p><?php echo substr($item1['description'],0,200);?></p>
							<div class="quantity-box">
								<label>Qty :</label>
								<div class="sp-quantity">
									<div class="sp-minus fff"><a class="ddd" data-multi="-1">-</a></div>
									<div class="sp-input">
									  <input type="text" class="quntity-input" value="1" />
									</div>
									<div class="sp-plus fff"><a class="ddd" data-multi="1">+</a></div>
								</div>
							</div>
							<ul class="btn-list">
								<li><a class="btn-1 sm shadow-0 " href="#">add to cart</a></li>
								<li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-heart"></i></a></li>
								<li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-repeat"></i></a></li>
								<li><a class="btn-1 sm shadow-0 blank" href="#"><i class="fa fa-share-alt"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- Product Detail -->

				</div>
			</div>
			<!-- Single Product Detail -->

		</div>
	</div>
</div>
<!-- Quick View -->
<?php $i++;}?>
<!-- Java Script -->
<script src="<?php echo $db->flink();?>/js/vendor/jquery.js"></script>        
<script src="<?php echo $db->flink();?>/js/vendor/bootstrap.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo $db->flink();?>/js/gmap3.min.js"></script>					
<script src="<?php echo $db->flink();?>/js/datepicker.js"></script>					
<script src="<?php echo $db->flink();?>/js/contact-form.js"></script>					
<script src="<?php echo $db->flink();?>/js/bigslide.js"></script>							
<script src="<?php echo $db->flink();?>/js/3d-book-showcase.js"></script>					
<script src="<?php echo $db->flink();?>/js/turn.js"></script>							
<script src="<?php echo $db->flink();?>/js/jquery-ui.js"></script>								
<script src="<?php echo $db->flink();?>/js/mcustom-scrollbar.js"></script>					
<script src="<?php echo $db->flink();?>/js/timeliner.js"></script>					
<script src="<?php echo $db->flink();?>/js/parallax.js"></script>			   	 
<script src="<?php echo $db->flink();?>/js/countdown.js"></script>	
<script src="<?php echo $db->flink();?>/js/countTo.js"></script>		
<script src="<?php echo $db->flink();?>/js/owl-carousel.js"></script>	
<script src="<?php echo $db->flink();?>/js/bxslider.js"></script>	
<script src="<?php echo $db->flink();?>/js/appear.js"></script>		 		
<script src="<?php echo $db->flink();?>/js/sticky.js"></script>			 		
<script src="<?php echo $db->flink();?>/js/prettyPhoto.js"></script>			
<script src="<?php echo $db->flink();?>/js/isotope.pkgd.js"></script>					 
<script src="<?php echo $db->flink();?>/js/wow-min.js"></script>			
<script src="<?php echo $db->flink();?>/js/classie.js"></script>					
<script src="<?php echo $db->flink();?>/js/main.js"></script>		
</body>
</html>