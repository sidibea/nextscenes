<?php include'includes/global.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Literary Entertainment.</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/zebra.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/dr-framework.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/navigation.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fullwidth.html" media="screen" />
<link rel="stylesheet" href="css/revslider.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Philosopher:400,700,400italic' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!-- html5.js for IE less than 9 -->
<!-- css3-mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
<![endif]-->
</head>
<body>

	<!-- Start Header -->
	<header>
       <?php include 'date-subheader.php' ; ?> 
        

		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	 <!-- Slider -->
	<div class="slider" >
		<div class="flexslider">
		  <ul class="slides">
		    <li>
		      <img src="images/slider-img.jpg" />
		    </li>
			
		  </ul>
		</div>
	

	<!-- Book Apointment -->
    
    <?php  
                if(empty($_SESSION['idsession'])) 
{
echo '
    
	<div class="book-form">
		<div class="inner-form">

		<h4>MEMBERS LOGIN</h4>
		<form method="post" action="connexion.php" >
			<div class="inputs">
				<input name="login" id="name" type="text" data-value="Login">
				<input name="password" id="mail" type="password" data-value="Password">
				
	        </div>

			<input name="connexion" type="submit" value="submit">
			
		</form>
		
		</div>
	</div>';
}
else
{
echo '
';
}

?>
    
    
    
    
	<!-- End Book Apointment -->
	</div>
	<!-- End SLider -->



	<!-- Container -->
	<div class="wrapper">
				
		<!-- Recent Works -->
		<div class="features dark">
		  <div class="clear"></div>
		</div>
		<!-- End Recent Works -->

		<div class="l-more">
			<div class="l-banner">
				<p><strong>NextScenes:</strong> The next level in literary entertainment. Unleash your imagination, get challenged!</p>
				<a href="lm.php">Learn More</a>
				<div class="clear"></div>
			</div>
		</div>
        
        
 
 
 
 <div class="recent-projects">
			<h4>FORUMS, STORYLINES &amp; SCENES</h4>
	<div class="border"></div>
			<ul class="dark">
            
            
            
             <?php
$query1 = 'SELECT * FROM forums ORDER BY RAND() ASC  LIMIT 0, 4';		
$result = mysql_query($query1);
while($data1 =mysql_fetch_assoc($result)){
echo '<li class="column3">';
if(empty($data1['Filename']))  { echo '<img src="pictures/avatar.jpg" alt="">'; } else { echo '<img src="/image.php?width=275&height=300&cropratio=3:2&image=/pictures/'.$data1['Filename'].'" alt="">'; }

echo'<h4>'.ucfirst(html_entity_decode(coupechaine($data1['Title'], 100))).'</h4>
<p>'.ucfirst(html_entity_decode(coupechaine($data1['Descriptions'], 150))).'</p>';
 if(empty($_SESSION['idsession']))  // Si Idsession est vide
   { echo ' <a href="connexion.php" class="details">Enter this forum</a>'; } // Se connecter
    else {  if($data1['Scenes']=='0') // sinon id session n'est pas vide mais si la variable scene egale a 0
	{ echo ' <div class="blog-text2"><a href="#">Inactive Forum</a></div> <br />   <br />'; } // Lien InActif
		else {echo ' <div class="blog-text3"><a href="forums-'.reecUrl($data1['Title']).'-'.$data1['IdForum'].'.html">View all '.$data1['Title'].' Story Lines</a></div> <br />   <br />   ';  }  // Sinon lien Actif
										 
	 }				
echo'</li>';
}
?>



</ul>
         
            
		  <div class="clear"></div>
		</div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
        
        
        
        
        
        
        
        
        
        
        
        
        
        

		
	
    
    
    
    
    
    
    
    
    
    
    

</div>
	<!-- End Wrapper -->

	<!-- Footer -->
	<?php include 'footer.php' ; ?>

	<!-- End Footer -->

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" charset="utf-8">
  		$(window).load(function() {
  		  $('.flexslider').flexslider();
  		});
	</script>
	<script type="text/javascript" src="js/jquery.superfish.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/zebra_datepicker.js"></script>
    <script type="text/javascript" src="js/core.js"></script>

</body>
</html>