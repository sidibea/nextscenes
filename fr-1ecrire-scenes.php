<?php include'includes/global.inc.php'; ?>
<?php  if(empty($_SESSION['idsession'])) { redirect_to('connexion.php');  exit();} ?>
<?php
$id = $_GET['id'];
$sc = $_GET['sc'];
$sql1 = 'SELECT * FROM storylines WHERE idstory = "'.mysql_clean($id).'"';
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$data1 = mysql_fetch_array($req1);

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Proposez votre scène Suivante</title>
<?php include'fr-css.php'; ?>
<?php include'fonts.php'; ?>

<script type="text/javascript" src="/js/jquery.min.js"></script>

	

<script>
$(document).ready(function(e) {

  $('#message').keyup(function() {
  
    var nombreCaractere = $(this).val().length;
    
    var nombreMots = jQuery.trim($(this).val()).split(' ').length;
    if($(this).val() === '') {
     	nombreMots = 0;
    }	
    
    var msg = ' ' + nombreMots + ' words / 500';
    $('#compteur').text(msg);
    if (nombreMots > 500) { $('#compteur').addClass("mauvais"); } else { $('#compteur').removeClass("mauvais"); }
    
  })  
  
});
</script>

<!--<script type="text/javascript" src="js/formfieldlimiter.js"></script>-->

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
		<div class="note"><strong><?php echo $data1['Title'] ; ?></strong> : Proposez votre scène Suivante.</div>
		<div class="site-map">
    	Vous êtes : <a href="index.html">Home</a> &gt; <a href="forums.html">Forums</a> &gt; <a href="storylines-<?php echo reecUrl($data1['Forum']) ; ?>-<?php echo $data1['IdForum'] ; ?>.html">Story Lines <?php echo $data1['Forum'] ; ?> </a> &gt; <!--<a href="scenes-<?php echo reecUrl($data1['Title']) ; ?>-<?php echo $data1['idstory'] ; ?>.html">-->
		<?php echo $data1['Title'] ; ?><!--</a>--> &gt; <strong>Proposez votre scène Suivante </strong>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
			<div class="blog-box">
           
				<a href="#"><img src="/pictures/avatar.jpg" alt=""></a> 
               
				<div class="blog-text">
					
					<div class="post-meta">
					  <div class="clear"></div>
					</div>
					<div class="post-text2"> 
                    
                  <!--  <div class="scenes">
         <fieldset>
                   
           	 <legend><strong>Dernière Scène Validée</strong></legend>
             
       
        <blockquote><p class="post-text2"><?php echo ucfirst(html_entity_decode(coupechaine($data1['Description'], 500))) ; ?></p></blockquote>
       
		
        </fieldset>
        </div>-->
                    
					 
                      
                      <div class="border"></div>
                      <h4>Proposez votre scène Suivante.</h4>
					<div class="border"></div>
					<div class="post-meta">
					  <div class="clear"></div>
 <?php if ($dataUser['Account']=='Power' ) {  ?>
 
 <?php

function CoupeTexte($Texte,$NB) 
{ 
$TabMots=explode(" ",$Texte); 
$NvTexte =""; 
for($i=0;$i<$NB;$i++) 
{ 
@$NvTexte.=' '.$TabMots[$i]; 
} 
return $NvTexte; 
} 
		
 
 if (isset($_POST['submit']) and !empty($_POST['nextscenes']) && $_POST['submit'] == 'Submit') {
 $date = date("Y-m-d");
 
 $sql = 'INSERT INTO scenes_proposes (Date,idstory,Login,Text,scenes) 
			             VALUES
			              ("'.$date.'", "'.mysql_clean($id).'", "'.$dataUser['Login'].'", "'.mysql_clean(html_entity_decode(nl2br(CoupeTexte($_POST['nextscenes'], 500)))).'", "'.mysql_clean($sc).'")'; // '.html_entity_decode(coupechaine2($_POST['nextscenes'], 500)).'
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
$sql0 = 'UPDATE storylines SET scenes=scenes+1 WHERE idstory= "'.mysql_clean($id).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
			
			$erreur = '<font color=#ff0000><b>Votre scènes a été soumise avec succès !.</b></font>'; 
			
			redirect_to('scenes-'.mysql_clean($sc).'-'.reecUrl($data1['Title']).'-'.mysql_clean($id).'.html');
 }
 ?> 
 
 <?php
	  
 if (isset($erreur)) echo '',$erreur;
?>
 
<form method="post" action="">
  <textarea id="message" name="nextscenes" cols="72" rows="20"></textarea>
  <p id="compteur">0 words / 500</p>
  <input type="submit" name="submit" id="submit" value="Submit">
</form>

<?php } ?>

<script type="text/javascript" src="/js/script.js"></script>                
                      
       				  </div>
				  </div>
				 
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


	

</body>
</html>