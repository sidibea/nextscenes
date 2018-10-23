<?php include'includes/global.inc.php'; ?>
<?php
$sql1= 'SELECT*FROM data  WHERE Iddata="1"' ; 
$req1=mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
$info = mysql_fetch_assoc($req1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : <?php echo $info['Titlefr'] ;  ?></title>
<?php include'fr-css.php'; ?>
<?php include'fonts.php'; ?>
</head>
<body>

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
		<div class="note"><?php echo $info['Titlefr'] ;  ?>:  Le prochain niveau en matière de divertissement littéraire. Libérez votre imagination !</div>
		<div class="site-map">
    	Vous êtes ici :<a href="index.php">Home</a> &gt;  <?php echo $info['Titlefr'] ;  ?>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
			
                
                <div class="post-text">
                 <div align="justify">
                <?php echo $info['Descriptionsfr'] ; ?>
				</div>	
				 </div>
                 	
				
			<div class="clear"></div>
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