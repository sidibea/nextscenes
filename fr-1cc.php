<?php include'includes/global.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Comment ça Marche ?</title>
<?php include 'fr-css.php'; ?>
<?php include 'fonts.php'; ?>
</head>
<body>
 <?php
$sql1= 'SELECT*FROM data  WHERE Iddata="2"' ; 
$req1=mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
$info = mysql_fetch_assoc($req1);
?>

	<!-- Start Header -->
	<header id="header">
		
		<!-- Start Header -->
	
       <?php include 'fr-date-subheader.php' ; ?> 
        

		<?php include 'fr-menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note"> Comment ça Marche ?<?php // echo $info['Title'] ;  ?></div>
	  <div class="site-map">
    	Vous êtes ici :<a href="index.php">Home</a> &gt; Comment ça Marche ?<?php // echo $info['Title'] ;  ?>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-testimonials column9">
         <div class="post-text">
                 <div align="justify">
        <?php
				$sql1= 'SELECT*FROM data  WHERE Iddata="2"' ; 
               $req1=mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
               $info = mysql_fetch_assoc($req1);
			   echo $info['Descriptionsfr'] ;
				
				?>
			
		</div>	
</div>

		</div>
		<!-- Aside Blog -->
        
        
		<?php include 'fr-bloc-right2.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'fr-footer.php' ; ?>


	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/script.js"></script>

</body>
</html>