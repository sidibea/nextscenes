<?php include'includes/global.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Principle</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>
</head>
<body>

	<!-- Start Header -->
	<header id="header">
		
		<!-- Start Header -->
	
       <?php include 'date-subheader.php' ; ?> 
        

		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note">NextScenes: The next level in literary entertainment. Unleash your imagination, get challenged!</div>
		<div class="site-map">
    	You are here :<a href="index.php">Home</a> &gt; Basic Principle
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
			<div class="blog-box">
				<a href="#"><img src="images/news1.jpg" alt=""></a> 
				<div class="blog-text">
                <?php
				$sql1= 'SELECT*FROM data  WHERE Title="Principle"' ; 
               $req1=mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
               $info = mysql_fetch_assoc($req1);
			   echo $info['Descriptions'] ;
				
				?>
					<!--<h4>Nextscenes is a web based content that is contributed from different sources which may include individuals or a group of individuals.</h4>
					<div class="border"></div>
					<div class="post-meta">
					  <div class="clear"></div>
					</div>
					<div class="post-text2"> All contributors, the Power Users, are required to participate under a pseudonym. The ultimate goal is to compile books from the best inputs from these different sources. Inputs with the most compelling contents. The successful contributors will also benefit from the sales of the books but in proportion to their contributions. <br />
					  <br />
					  Power Users will register into the Forums of their interest and commence contribution upon registration. A Power User may register in more than one Forum. Each Forum represents a particular genre of story.<br />
                      
                      <div class="border"></div>
                      <h4>Basic Principle.</h4>
					<div class="border"></div>
					<div class="post-meta">
					  <div class="clear"></div>
                      The principle behind Nextscenes is simple. <br />
                      <br />
                      The story in any book comprises of different scenes. As a story line unfolds, contributors will propose what a subsequent scene should be in no more than 500 words. A Power User will not contribute more than fifty times in the course of a book					</div>
				  </div>-->
				 
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<!-- Aside Blog -->
        
        
		<?php include 'bloc-right2.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>


	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>