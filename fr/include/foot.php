		<!--************************************
				Footer Start
		*************************************-->
		<footer id="tg-footer" class="tg-footer tg-haslayout">
			<div class="tg-copyrights">
				<div class="container">
					<ul class="tg-footer-nav pull-right">
						<li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
					</ul>
					<p class="pull-left">&copy; <?php echo date("Y");?>  |  All Rights Reserved</p>
				</div>
			</div>
		</footer>
		<!--************************************
				Footer End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<!--************************************
			Login Start
	*************************************-->
	<div class="tg-login tg-theme-modalbox modal fade" id="tg-LoginModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="tg-modal-content">
				<div class="tg-section-heading">
					<h2>login</h2>
				</div>
				<form class="tg-form-login" method="post" action="<?php echo $db->dlink();?>/mint?action=login">
					<fieldset>
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Username/Email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						 
						<div class="form-group">
							<button class="tg-btn tg-btn-lg" type="submit">Login Now</button>
						</div>
						<div class="tg-description">
							<p>Don't have an account? <a href="javascript:void(0);" data-toggle="modal" data-target="#tg-RegisterModal">Signup</a></p>
						</div>
					</fieldset>
				</form>
				 
			</div>
		</div>
	</div>
	<!--************************************
			Login End
	*************************************-->
	<!--************************************
			Register Start
	*************************************-->
	<div class="tg-register tg-theme-modalbox modal fade" id="tg-RegisterModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="tg-modal-content">
				<div class="tg-section-heading">
					<h2>Register</h2>
				</div>
				<form class="tg-form-register" method="post" action="<?php echo $db->dlink();?>/mint?action=register">
					<fieldset>
						<div class="form-group">
							<input type="text" class="form-control" name="fname" placeholder="First Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="lname" placeholder="Last Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
					
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email">
						</div>
						<div class="form-group">
							<button class="tg-btn tg-btn-lg" type="submit">Register Now</button>
						</div>
						 
					</fieldset>
				</form>
				 
			</div>
		</div>
	</div>
	<!--************************************
			Register End
	*************************************-->
	<script src="<?php echo $db->dlink();?>/js/vendor/jquery-library.js"></script>
	<!--<script src="<?php echo $db->dlink();?>/js/vendor/bootstrap.min.js"></script>-->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo $db->dlink();?>/js/jquery.cycle2.min.js"></script>
	<script src="<?php echo $db->dlink();?>/js/jquery.cycle2.carousel.min.js"></script>
	<script src="<?php echo $db->dlink();?>/js/simpleWeather.js"></script>
	<script src="<?php echo $db->dlink();?>/js/owl.carousel.js"></script>
	<script src="<?php echo $db->dlink();?>/js/isotope.pkgd.js"></script>
	<script src="<?php echo $db->dlink();?>/js/flexslider.js"></script>
	<script src="<?php echo $db->dlink();?>/js/parallax.js"></script>
	<script src="<?php echo $db->dlink();?>/js/MetroJs.js"></script>
	<script src="<?php echo $db->dlink();?>/js/swiper.js"></script>
	<script src="<?php echo $db->dlink();?>/js/main.js"></script>
	<script type="text/javascript" src="http://www.nextscenes.com/central/sociallogin.js" language="javascript"></script>
    <?php if($edit == 1){?>
    <script src="<?php echo $db->dlink();?>/nicEdit.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
		   bkLib.onDomLoaded(function() {
				bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		  });
		});
  </script>
    <?php }?>
</body>
</html>