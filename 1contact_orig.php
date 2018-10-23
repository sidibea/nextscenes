<?php include'includes/global.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Contact Us</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/dr-framework.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/navigation.css" type="text/css" media="screen">
<?php // include'css.php'; ?>
<?php include'fonts.php'; ?>
</head>
<body>

	<!-- Start Header -->
	<header id="header">
		
		 <?php include 'date-subheader.php' ; ?> 


		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<div class="clear"></div>
	<div class="banner">
	<div class="inner-banner">
		<div class="note">Contact Us - For all inquiries about this website and the content, please contact the address below.</div>
		<div class="site-map">
    	You are here:<a href="index.php">Home</a> &gt; Contact Us
		</div>
	<div class="clear"></div>
	</div>
	</div>
	


	<!-- Container -->
	<div class="wrapper">
		<div class="contact-row dark">
			<div class="contact2 column4">
				<h4>Contact info</h4>
				<div class="border"></div>
				<p class="home">Ginco Communications
                  <br />
                  (Division of Ginco Group SARL)<br />
Immueble Pacific IV,
<br />
Hamdallaye ACI 2000, BP 2191
<br />
Bamako, Mali.

                  <br />
			  </p>
			  <p class="phone2"> +223 2022 3168<br />
	+223 7015 9015
</p>
				<p class="mail">info@gincogroup.com</p>
			</div>


			<div class="msg-form column8">
				<h4>Send us a message</h4>
				<div class="border"></div>
				<form  id="contact-form" action="#">
					<input name="name" id="name" type="text" data-value="name">
					<input name="mail" id="mail" type="text" data-value="email">
					
					<textarea name="comment" id="comment"placeholder="message"></textarea>
					<input type="submit" id="submit_contact" value="Submit">
	  				<div id="msg" class="message"></div>
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!-- End Wrapper -->

	<!-- Footer -->
	<?php include 'footer.php' ; ?>

	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>
</html>