<?php include'includes/global.inc.php'; ?>
<?php
      
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Submit') { 
$to= 'info@nextscenes.com';
//$to= 'aime.aholia@gmail.com';
$from ='Nextscenes.com' ;
$subj = ''.$_POST['mail'].' sent you a message';
$msg = $_POST['comment'];
send_email($from,$to,$subj,$msg);
//redirect_to('enregistrement-valide.html'); 
echo'<script language="javascript">
         alert("Message Sent");
                   history.go(-1);
                      </script>';

	   }
	   /*      
		  $sql = 'SELECT count(*) FROM membres WHERE cel="'.mysql_clean($_POST['mobile']).'"'; 
         $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
         $data = mysql_fetch_array($req); 
 
         if ($data[0] == 0) { 
		 
            $sql = 'INSERT INTO membres (dateinscription,login,nom,prenom, datenaissnace,  sexe,avatar, cel,email, password, pays) VALUES("'.$date.'", "'.mysql_clean($_POST['login']).'", "'.mysql_clean($_POST['nom']).'", "'.mysql_clean($_POST['prenom']).'", "'.mysql_clean($_POST['date_naissance']).'", "'.mysql_clean($_POST['sexe']).'", "avatar.jpg", "'.mysql_clean($_POST['mobile']).'", "'.mysql_clean($_POST['email']).'", "'.pass_code($password).'", '.mysql_clean($_POST['pays']).')'; 
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 

			
$to= $_POST['email'];
$from ='MoovSpace' ;
$subj = ' Bienvenue sur MoovSpace - Le portail web des jeunes branch&eacute;s';
$msg = 'Bonjour, <br><br> Bienvenue sur MoovSpace.<br><br>Voici tes parametres de connexion <br> Login : '.$_POST['mobile'].' <br><font color=#ff0000>Mot de Passe: '.$password.' <br><br><br>  <b>Message Automatique, veuillez ne pas repondre à ce message.</b></font>';
send_email($from,$to,$subj,$msg);



$fichier = fopen("test.txt", 'w+'); // On ouvre le fichier en mode écriture avec écrasement
fputs($fichier, $password); // On insère le code dans le fichier
fclose($fichier); // 


/*
		
// pour recuprer mon pass
fichier = open("test.txt", "w+");        #Créer le fichier s'il n'existe pas
fichier.write($password) ;       #Écrit la valeur de la variable a dans le fichier
fichier.close();

 
          //  session_start(); 
           // $_SESSION['login'] = $_POST['login'];
			redirect_to('enregistrement-valide.html'); 
          //  header('Location: membre.php'); 
            exit(); 
       //  } 
	   
	   
	   }
            else {
                $erreur = '<font color=#ff0000><b>Ce Numero de Cellulaire existe deja dans Notre Base de données</b></font>';
            }
	   
		 
	}
		
   */
?>
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
				<form id="contact-form" action="" method="post" enctype="multipart/form-data">
					<input name="name" id="name" type="text" data-value="name">
					<input name="mail" id="mail" type="text" data-value="email">					
					<textarea name="comment" id="comment"placeholder="message"></textarea>
					<input type="Submit" name="inscription" value="Submit">
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