<?php include'includes/global.inc.php'; ?>
<?php  if(empty($_SESSION['idsession'])) { redirect_to('connect.html');  exit();} ?>
<?php
$id = $_GET['id'];

$sql0 = 'SELECT * FROM storylines WHERE idstory = "'.mysql_clean($id).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
$data0 = mysql_fetch_array($req0);


if(reecUrl($data0["Title"]) != $_GET["url"]) {
//redirect_to('forums.php');
header('location: forums.html');
}



//$url =''.REP_ACTU.''.reecUrl($data0['titre']).'-'.$data1['idnews'].'.html';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Action Forums</title>

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
	<div class="banner">
	<div class="inner-banner">
		<div class="note"><strong><?php echo $data0['Title'] ;  ?></strong></div>
		<div class="site-map">
    	Vous êtes ici : <a href="index.php">Home</a> &gt; <a href="forums.html">Forums</a> &gt;  <a href="storylines-<?php echo reecUrl($data0['Forum']) ; ?>-<?php echo $data0['IdForum'] ; ?>.html"><?php echo $data0['Forum'] ; ?></a> &gt; <?php echo $data0['Title'] ; ?> &gt; <strong>Scènes Validées</strong>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">
		
		<div class="main-testimonials column9">
       
       <!--
       <div class="scenes">
         <fieldset>
                   
           	 <legend><strong>Introduction of this scene</strong></legend>
             
       
             <blockquote><p class="post-text2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p></blockquote>
       
		
        </fieldset>
        </div>	
       --> 
        
			
		 <div class="border"></div>
			<h4> Last validated Scenes </h4> 
            <div class="border"></div>
            

            
            
            <div class="headings1">
            
            
            <?php
$sql1 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" ORDER BY id ASC LIMIT 5  ';
$result1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
//$data0 = mysql_fetch_array($req0);
//$result = mysql_query($query1);
while($data1 =mysql_fetch_assoc($result1))
{
echo'

<div class="scenes">
         <fieldset>
                   
           	 <legend><strong>Scene '.$data1["scenes"].'</strong></legend>
             
       
              <blockquote><p class="post-text2">'.$data1["Text"].' </p> <div class="post-user">By <strong>'.$data1["Login"].'</strong> </div> <div class="post-date">Proposed : 18 September, 2015  - Validate : '.$data1["Date"].'</div> <br></blockquote>
       
		
        </fieldset>
        </div>	



           ';
}
?>
            
            
            
            
            </div>
<br /><br />
	
    <p class="user">			
 <?php  // if ($dataUser['Account'] == 'Power') { echo '<div align=center><div class="blog-text2"><a href="scenes-write.php">Propose your Scenes</a></div></div> ' ; } ?>
 <?php // if ($dataUser['Account'] == 'Regular') { echo '<div align=center><div class="blog-text2"><a href="account-manage-user.php">Change your Profile to propose Scenes</a></div></div> ' ; } ?>

 </p>		

<!--
		<div class="pagenation clearfix">
			<ul>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">50</a></li>
			</ul>
		</div>
-->
		</div>
		

		<!-- Aside Testimonials -->
		<?php include 'fr-bloc-right.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'fr-footer.php' ; ?>


	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>