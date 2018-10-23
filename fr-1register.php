<?php
include'includes/global.inc.php';
require_once('lib/recaptchalib.php');
$publickey = "6Lf7xAsTAAAAAJjD4eU4cBMh1RgTo6RG1UShxbND";
//require_once('lib/recaptchalib.php');
//require_once('lib/keys.php');
?>
<?php
	
	if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
		
		?>
        <?php
	
	//require_once('lib/recaptchalib.php');
$privatekey = "6Lf7xAsTAAAAALsIW37MWU4omEqoITpHUwpXk_ag";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

$resp = recaptcha_check_answer (
$privatekey,
$_SERVER["REMOTE_ADDR"],
$_POST["recaptcha_challenge_field"],
$_POST["recaptcha_response_field"]
);
//var_dump($resp);

if($resp->is_valid) {
	
	$date = date("Y-m-d");
	
	
	 $sql0 = 'SELECT count(*) FROM members WHERE Login="'.mysql_clean(@$_POST['login']).'" AND Password="'.mysql_clean(@$_POST['password']).'"'; 
      $req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
      $data0 = mysql_fetch_array($req0); 
	  
	    if ($data0[0] == 0) { 
		
		
	$sql = 'INSERT INTO members (Date,LastName,FirstName,Login,Password,Email,Account) 
			             VALUES
			              ("'.$date.'", "'.mysql_clean($_POST['lastname']).'", "'.mysql_clean($_POST['firstname']).'", "'.mysql_clean($_POST['login']).'", "'.mysql_clean($_POST['password']).'", "'.mysql_clean($_POST['email']).'", "'.mysql_clean($_POST['account']).'")'; 
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
			       $to= ''.$_POST['email'].'';
$subj = 'Bienvenue sur Nextscenes.com !';
$msg = '
<html> 
     <head> 
     <title>Bienvenue sur Nextscenes.com</title> 
     </head> 
     <body> <center> <img src="http://www.nextscenes.com/images/logo.png" alt="Bienvenue sur Nextscenes.com">  <br><br><h3><font color=#ff00ff>Merci de votre inscription ! !</font></h3> </center>
	 
	 <div align=left>
	 <h3><font color=#698C00> Salut '.$_POST['firstname'].' ! </font></h3>
	 
	 Bienvenue sur Nextscenes.com. Maintenant que vous êtes membre, vous pouvez lire de grands esprits, créer votre propre chef-d\'œuvre littéraire et vous divertir. <br><br> Visitez tous les forums et faîtes votre choix pour commencer votre voyage dans ce monde littéraire.
	 
	  <br>
<font color=#7A4DFF><a href="http://www.nextscenes.com/fr/index.html" target="_blank"><center><h3>Connectez-vous sur Nextscenes.com : Le Divertissement littéraire!</h3></center></font></a></font>
</div></body> 
     </html>';
 
// Headers
$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
$headers .='Reply-To: info@nextscenes.com'."\n"; 
//$headers .= "\r\n";
$headers .= "MIME-version: 1.0\n";
$headers .= "Content-type: text/html; charset= iso-8859-1\n";
// Function mail()
mail($to, $subj, $msg, $headers);
			
$_SESSION['email'] = $_POST['email'];
					
						redirect_to('inscription-valide.html');
			//header('Location:mc_main.php');
				exit;
			
			}
			elseif ($data0[0] == 0) { 
redirect_to('index.php');
        // $erreur = '<font color=#ff0000><b>Compte non reconnu</b></font>';
		// $erreur = '<b>VOTRE MESSAGE A ETE POSTE AVEC SUCCES, NOUS VOUS CONTACTERONS TRES RAPIDEMENT</b>';
      } 
	  
			
						

	
	?>
    
  
    
    <?php } else { 
    
    $erreur = '<b><font color=#ff0000>The text in captcha is incorrect Seized</font></b><br>';
	  $error = $resp->error;
    
     } ?>
	
	 <?php } 
	 
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Register</title>
<?php include'fr-css.php'; ?>
<?php include'fonts.php'; ?>


<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<SCRIPT type="text/javascript" src="/files/jquery.validate.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/files/jquery.metadata.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/files/jscal2.js"></SCRIPT>
<SCRIPT src="/files/cmxforms.js" type="text/javascript"></SCRIPT> 
<SCRIPT src="/files/additional-methods.js" type="text/javascript"></SCRIPT>
	

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
    
    <SCRIPT type="text/javascript">
/*
 $(function(){
	$("#refreshimg").click(function(){
		$.post('newsession.php');
		$("#captchaimage").load('image_req.php');
		return false;
	});
	
	$("#captchaform").validate({
		rules: {
			captcha: {
				required: true,
				remote: "process.php"
			}
		},
		messages: {
			captcha: "Correct captcha is required. Click the captcha to generate a new one"	
		},
		submitHandler: function() {
			alert("Correct captcha!");
		},
		success: function(label) {
			label.addClass("valid").text("Valid captcha!")
		},
		onkeyup: false
	});
	
});
 */
 
 
 	  
	  $(document).ready(function(){
	  
	  $("#refreshimg").click(); // initialiser le premier
	  
	  /*

			$("#refreshimg").click(function(){
				$.post('captcha/newsession.php');
				$("#captchaimage").find("a#refreshimg").load('captcha/image_req.php');
				return false;
			});
	
			*/
		
			var validator = $("#captchaform").submit(function() {
				// update underlying textarea before submit validation
				//tinyMCE.triggerSave();
			}).validate({							   
				meta: "validate",
				errorPlacement: function(label, element) {
					// position error label after generated textarea
					if (element.is("textarea")) {
						label.insertAfter(element.next());
					} else {
						label.insertAfter(element)
					}
				},
				
				
				rules: {
					captcha: {
						required: true,
						remote: "captcha/process.php"
					},
					
					password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
				
			}
					
										
					
				},
				messages: {
					captcha: {
						required: "Veuillez taper les lettres qui apparaissent dans l'image.",
						remote: "Erreur, Veuillez retaper les lettres"	
					},
					
					password: {
				required: " *This field is required",
				minlength: "Enter at least 6 characters"
			},
			confirm_password: {
				required: "Confirm your Password",
				minlength: "Enter at least 6 characters",
				equalTo: "Enter the same password as above"
				
				
			}
					
					
					
					
				},
								
								
				success: function(label) {
				// set &nbsp; as text for IE
					label.html("&nbsp;").addClass("checked");
				},
				onkeyup: false
			});	
		});	
		
 </SCRIPT>
 
 <script>

//"Accept terms" form submission- By Dynamic Drive
//For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
//This credit MUST stay intact for use

var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return true
else{
alert("Please read/accept terms to submit form")
return false
}
}
}

</script>

         

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
		<div class="note">Inscription   &nbsp;&nbsp;  <?php
	  
 if (isset($erreur)) echo '',$erreur;
?></div>
		<div class="site-map">
    	Vous êtes ici :<a href="index.html">Home</a> &gt; Inscription
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
        
        <div class="contact-row dark">
	  <div class="msg-form column8"> 
      <div class="div-wrapper">
    <img src="/images/free_registration.png" />
</div>
     
        <form  class="formular" name="captchaform" id="captchaform" method="post" action="" onSubmit="return testChamps(this);">
        
         <fieldset>
                   
            	<legend><strong>ENTREZ LES INFORMATIONS DE VOTRE COMPTE</strong></legend>
               
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="27%"><div class="homeform">NOM </div></td>
    <td width="73%"> <input name="lastname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['lastname'])) echo stripslashes(htmlentities(trim($_POST['lastname']))); ?>" minlength="3" id="lastname" type="text"></td>
  </tr>
  <tr>
    <td><div class="homeform">PRENOM</div></td>
    <td><input name="firstname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['firstname'])) echo stripslashes(htmlentities(trim($_POST['firstname']))); ?>" minlength="3" id="firstname" type="text"></td>
  </tr>
  <tr>
    <td><div class="homeform">EMAIL</div></td>
    <td> <input name="email" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>"  class="{validate:{required:true, email:true, messages:{required:&#39;* This field is required&#39;, email:&#39; * Enter a valid email&#39;}}}" type="text"></td>
  </tr>
  
  <tr>
    <td><div class="homeform">LOGIN</div></td>
    <td><input name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Enter at least 6 characters&#39;}}}" minlength="6" type="text" ></td>
  </tr>
  
  <tr>
    <td> <div class="homeform">TYPE DE COMPTE </div></td>
    <td> <select name="account">
               
<option value="Regular" selected="selected">Simple Utilisateur</option>
<option value="Power">Utilsateur Actif</option>

</select></td>
  </tr>
  
  <tr>
    <td><div class="homeform">PASSWORD</div></td>
    <td> <input name="password" value="<?php if (isset($_POST['password'])) echo stripslashes(htmlentities(trim($_POST['password']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Entrer 6 caracteres minimum&#39;}}}" minlength="6" id="password" type="password" ></td>
  </tr>
  
  <tr>
    <td><div class="homeform">REPETEZ PASSWORD</div></td>
    <td><input name="confirm_password" value="<?php if (isset($_POST['confirm_password'])) echo stripslashes(htmlentities(trim($_POST['confirm_password']))); ?>" id="confirm_password" type="password"></td>
  </tr>
  
  <!-- <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
</table>
</fieldset>
        
        
              
             
	 <fieldset>
                   
            	<legend><strong>ENTRER CE QUE VOUS VOYEZ - CAPTCHA DE SECURITE</strong></legend>
            <?php
			echo recaptcha_get_html($publickey);
			?>
			</fieldset>				
                    
					
                    
                    
					 
                   
                 
               



 



                    
                  <!-- <div class="homeform">PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">
                   <div class="homeform">REPEAT PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">-->
                   
                   
            
     
      <fieldset>
                   
            	<legend><strong>TERMES D'UTILISATION DE NEXTSCENES </strong></legend>       
            
            
<textarea rows="5" name="S1" cols="30" style="width:95%" wrap="virtual">

En utilisant ce site et les services qui y sont contenues (services) vous acceptez de respecter et d'être lié par les termes et conditions suivantes (les «conditions d'utilisation»). Si vous n'êtes pas d'accord et acceptez ces conditions d'utilisation, vous ne devriez pas utiliser ce site. Toutes les références dans ces conditions d'utilisation à nous / nous / notre réfèrent à NextScenes.com.

Conditions d'utilisation
Nextscenes Interactive a le plaisir de vous fournir ses sites, logiciels, applications, le contenu, les produits et services («Services Nextscenes»), ces termes régissent votre utilisation et notre prestation des services Nextscenes sur lequel ces termes sont affichés, ainsi que Nextscenes Les services que nous rendent disponibles sur les sites tiers et des plates-formes si ces termes sont communiquées dans le cadre de votre utilisation des Services Nextscenes.

S'IL VOUS PLAÎT LIRE ATTENTIVEMENT CES CONDITIONS AVANT D'UTILISER LES SERVICES NEXTSCENES.

Rien dans ces conditions est destinée à toucher vos droits en vertu la loi dans votre lieu de résidence habituel. SI IL YA UN CONFLIT ENTRE CES DROITS ET CES CONDITIONS, VOS DROITS EN VERTU DU DROIT LOCAL APPLICABLE prévaudra.

1. contrat entre vous et nous
Ceci est un contrat entre vous et Nextscenes (indiquer votre adresse locale de l'entreprise et pays) ou entre vous et tout autre fournisseur de services identifié pour un service Nextscenes particulier. Vous devez lire et accepter ces conditions avant d'utiliser les services Nextscenes. Si vous ne les acceptez pas, vous ne pouvez pas utiliser les Services Nextscenes. Ces termes décrivent la base limitée sur laquelle les services Nextscenes sont disponibles et remplacera les accords ou arrangements préalables.

Termes et conditions supplémentaires peuvent être facturés pour certains services Nextscenes, telles que les règles d'un concours particulier, un service ou une autre activité, ou des termes qui peuvent accompagner certains contenus ou logiciels accessibles via les Services Nextscenes. Termes et conditions supplémentaires seront divulguées à vous en relation avec une telle concurrence, service ou activité. Les termes et conditions supplémentaires sont en plus de ces conditions et, dans le cas d'un conflit, l'emportent sur ces termes.
Nous pouvons modifier ces termes. Toute modification sera en vigueur trente (30) jours suivant soit notre envoi d'un avis à vous ou à notre détachement de l'amendement sur les services Nextscenes. Si vous n'êtes pas d'accord à toute modification de ces conditions, vous devez cesser d'utiliser les services Nextscenes.

Nos représentants du service à la clientèle ne sont pas autorisés à nous pouvons immédiatement résilier le présent contrat à l'égard de (y compris votre accès aux Services Nextscenes) si vous ne parvenez pas à se conformer à toute disposition de ces termes.
2. Les services Nextscenes
Les services sont Nextscenes (divertissement alphabétisation compétition tenue qui peut donner de l'argent des participants sous le terme et les conditions de la tenue.

Les Nextscenes services sont notre propriété sous copyright ou de la propriété sous copyright de nos concédants de licence ou licenciés et toutes les marques de commerce, marques de service, noms commerciaux, robe de commerce et autres droits de propriété intellectuelle dans les services Nextscenes sont détenues par nous ou nos concédants de licence ou licenciés. Sauf accord contraire par écrit, aucun élément des Services Nextscenes peut être utilisé ou exploité de quelque façon autre que dans le cadre des Nextscenes Services offerts à vous. Vous pouvez posséder les médias physiques sur lesquels des éléments des Services Nextscenes vous sont livrés, mais nous conserver la propriété pleine et entière des services Nextscenes. Nous ne transférons pas le titre de toute portion des Services Nextscenes à vous.

CONTENU ET DE LICENCE DE LOGICIEL
Si un service Nextscenes est configuré pour permettre l'utilisation de logiciels, du contenu, des objets virtuels ou d'autres matériaux appartenant à ou licenciés par nous, nous vous accordons un, non cessible, non transférable limitée, non-exclusive, pour accéder et utiliser ce logiciel , le contenu, objet virtuel ou tout autre matériel pour votre usage personnel et non commercial.

Vous ne pouvez pas contourner ou désactiver tout système de protection du contenu ou de la technologie numérique de gestion des droits est utilisé avec un service Nextscenes; décompiler, désosser, désassembler ou réduire tout service Nextscenes à une forme lisible par l'homme autrement; supprimer l'identification, droit d'auteur ou autres mentions de propriété; ou l'accès ou l'utilisation de tout Service Nextscenes de manière illégale ou non autorisée ou d'une manière qui suggère une association avec nos produits, services ou marques. Vous ne pouvez pas accéder ou d'utiliser tout service Nextscenes en violation des États-Unis le contrôle des exportations et des sanctions exigences économiques. En acquérant les services, contenus ou logiciels à travers les services Nextscenes, vous déclarez et garantissez que votre accès et l'utilisation des services, contenus ou logiciels se conformer à ces exigences.

EXCLUSIONS ET LIMITATION DE RESPONSABILITÉ
LES NEXTSCENES SERVICES SONT FOURNIS «TEL QUEL» ET «TELS QUE DISPONIBLES." Nous déclinons toute CONDITIONS, REPRÉSENTATIONS ET GARANTIES pas expressément dans les présentes conditions.
NOUS NE SERONS PAS TENUS POUR RESPONSABLES, accessoires, spéciaux ou consécutifs indirects, y compris PERDU DE PROFITS ET DES DÉGÂTS MATÉRIELS, même si nous devions AVERTIS DE LA POSSIBILITÉ DE TELS DOMMAGES, nous ne serons être tenue pour responsable retard ou manquement dans performance qui en résulte de causes indépendantes de notre volonté. EN AUCUN CAS NOTRE RESPONSABILITÉ TOTALE ENVERS VOUS POUR TOUS DOMMAGES, PERTES ET CAUSES D'ACTION EST dépasse pas mille dollars américains (US $ 1.000).

CES EXCLUSIONS ET LIMITATIONS ne affectent pas vos droits de consommateur ou l'objet de limiter la responsabilité QUI NE PEUT PAS être exclus en vertu la loi dans votre lieu de résidence habituel.

CHANGEMENTS AUX SERVICES NEXTSCENES
Les Nextscenes services évoluent constamment et va changer au fil du temps. Si nous faisons un changement important pour les services Nextscenes, nous allons vous fournir un préavis raisonnable et vous serez en droit de résilier le contrat.

SERVICES DE TIERS ET CONTENU
Les services Nextscenes peut intégrer, être intégré dans, ou être fournis dans le cadre de prestations de tiers et de contenu. Nous ne contrôlons pas ces t services tiers et contenu. Vous devriez lire les termes des accords d'utilisation et politiques de confidentialité applicables à ces services tiers et contenu.

Si vous accédez à un service Nextscenes utilisant un Apple iOS, Android ou périphérique Microsoft Windows alimenté ou Microsoft Xbox One, Apple Inc., Google, Inc. ou de Microsoft Corporation, respectivement, doit être un tiers bénéficiaire de ce contrat. Cependant, ces tiers bénéficiaires ne sont pas partie à ce contrat et ne sont pas responsables pour la fourniture ou le soutien des services Nextscenes. Vous acceptez que votre accès aux Services Nextscenes utilisation de ces appareils doit être également soumis aux conditions d'utilisation prévues dans les termes de la bénéficiaires tiers de service applicables.

LES RÉSEAUX MOBILES
Lorsque vous accédez aux services Nextscenes travers un réseau mobile, votre réseau ou d'itinérance de messagerie du fournisseur, de données et d'autres taux et les frais seront facturés. Téléchargement, l'installation ou l'utilisation de certains services Nextscenes peut être interdit ou restreint par votre fournisseur de réseau et tous les services Nextscenes peut travailler avec votre fournisseur ou le périphérique réseau.

3. VOTRE CONTENU ET COMPTE
CONTENU GÉNÉRÉ PAR L'UTILISATEUR
Les services Nextscenes peut vous permettre de communiquer, soumettez, téléchargez ou autrement rendre disponible texte, images, audio, vidéo, des entrées de la concurrence ou tout autre contenu ("User Generated Content"), qui peut être accessible et visible par le public. L'accès à ces fonctions peuvent être soumis à des restrictions d'âge. Vous ne pouvez pas soumettre ou télécharger User Generated Content qui est diffamatoire, harcelant, menaçant, sectaire, haineux, violent, vulgaire, obscène, pornographique, ou autrement offensant ou que ses risques ou peut raisonnablement attendre de nuire à toute personne ou entité, ou non tel matériau est protégé par la loi.

Nous ne revendiquons pas la propriété à votre User Generated Content; Cependant, vous nous accordez une sous-licence irrévocable et libre de redevance non exclusive, dans le monde entier dans tous les droits d'auteur, marques, brevets, secrets commerciaux, la vie privée et les droits de publicité et d'autres droits de propriété intellectuelle à utiliser, reproduire, transmettre, imprimer, publier, afficher publiquement, exposer, distribuer, redistribuer, copie, index, commenter, modifier, adapter, traduire, créer des œuvres dérivées basées sur, exécuter publiquement, mettre à disposition et exploiter autrement tels User Generated Content, en tout ou en partie, dans tous les médias formats et canaux maintenant connus ou à venir (y compris en liaison avec les services Nextscenes et sur les sites et plates-formes tierces telles que Facebook, YouTube et Twitter), dans un certain nombre de copies et sans limite dans le temps, la manière et la fréquence d'utilisation , sans autre préavis, avec ou sans attribution, et sans l'exigence d'autorisation de paiement ou de vous ou de toute autre personne ou entité.

Vous déclarez et garantissez que votre User Generated Content conforme à ces termes et que vous possédez ou avez les droits et autorisations nécessaires, sans la nécessité pour le paiement de toute autre personne ou entité, à utiliser et à exploiter, et de nous autoriser à utiliser et exploiter , votre User Generated Content de toutes les manières envisagées par ces termes. Vous acceptez d'indemniser et de nous et de notre filiales et sociétés affiliées, et chacun de leurs employés et dirigeants respectifs, de toute demande, perte, responsabilité, réclamation ou dépenses (y compris les honoraires d'avocat), portées contre nous tenir par une tierce partie découlant de ou en connexion avec l'utilisation et l'exploitation de votre User Generated Content. Vous acceptez également de ne pas faire respecter les droits moraux, les droits accessoires ou des droits similaires ou à l'User Generated Content contre nous ou nos licenciés, distributeurs, agents, représentants et autres utilisateurs autorisés, et convenir de procurer le même accord de ne pas appliquer d'autres qui peut posséder ces droits.

Dans la mesure où nous vous autorisons à créer, afficher, télécharger, distribuer, afficher publiquement ou exécuter publiquement User Generated Content qui nécessite l'utilisation de nos œuvres protégées, nous vous accordons une licence non-exclusif de créer une œuvre dérivée en utilisant nos œuvres protégées comme requis pour le but de créer les matières, à condition que cette licence doit être conditionné à votre affectation à nous de tous les droits dans le travail que vous créez. Si ces droits ne sont pas assignés à nous, votre permis de créer des œuvres dérivées à l'aide de nos œuvres protégées sera nulle et non avenue.

Nous avons le droit, mais non l'obligation de surveiller, écran, afficher, supprimer, modifier, stocker et examen User Generated Content ou communications envoyées par un service Nextscenes, à tout moment et pour toute raison, y compris pour assurer que le User Generated Content ou la communication est conforme à ces termes, sans préavis. Nous ne sommes pas responsables et ne soutenons ni ne garantissons, les opinions, les vues, les conseils ou recommandations publiés ou envoyés par les utilisateurs.

4. MODUS DE FONCTIONNEMENT
Le Nextscenes est un contenu Web qui reçoit des contributions provenant de différentes sources - des individus ou groupe d'individus. Il fournit des plates-formes en créant un forum pour les écrivains créatifs latentes qui peuvent ne pas être capable d'écrire un livre complet sur leur propre. Les participants expriment leur point de vue ci-dessus sur les lignes de l'histoire à travers les contributions d'histoire Rafale, ainsi libérer leurs énergies créatives latentes, qui Nextscenes, harnais en matériel de lecture très convaincantes.

INSCRIPTIONS
Membres font leurs observations sous forme d'histoire Rafale et le public les taux les soumissions. Soumissions avec notes de dix points seront adoptées dans le cadre de l'histoire qui va former les livres. Nous pouvons disqualifier qui sont en retard, mal adressées, incomplètes, corrompu, le consentement parental approprié perdu, illisible ou non valide ou lorsque n'a été fourni. Utilisation des entrées automatiques, votes ou d'autres programmes est interdite et toutes les entrées (ou voix) sera disqualifié.

Nous nous réservons le droit de modifier, suspendre, annuler ou mettre fin à un épisode ou de prolonger ou de reprendre la période d'inscription ou de disqualifier tout participant ou l'entrée à tout moment sans notification préalable. Nous allons le faire si elle ne peut pas être garantie la compétition peut être réalisée assez correctement ou pour des raisons techniques, juridiques ou autres, ou si nous soupçonnons que toute personne a manipulé des entrées ou des résultats, fourni de faux renseignements ou a agi contrairement à l'éthique. Si nous annuler ou résilier la concurrence, les prix peuvent être décernés en aucune manière que nous jugeons équitable et appropriée compatible avec les lois locales régissant la concurrence.

ADMISSIBILITE
Pour entrer dans un groupe, vous devez être un utilisateur enregistré des Services Nextscenes et avoir un compte actif avec les informations de contact de courant Si vous avez moins de 18 ans (ou l'âge de la majorité en vertu du droit applicable) et le système est ouvert à vous, nous pouvons besoin de votre parent ou le consentement du tuteur avant que nous puissions accepter votre inscription. Nous nous réservons le droit de demander une preuve d'identité ou de vérifier les conditions d'admissibilité et les entrées gagnantes potentielles, et lui attribuer un prix à un gagnant en personne. Les compétitions sont nulle là où interdite ou restreinte par la loi. Les gagnants potentiels qui sont des résidents dans les territoires où les compétitions nécessitent un élément de compétence peuvent être tenus de répondre à un test mathématique afin d'être admissible à gagner un prix.



RÉCOMPENSE
Les membres dont les contributions ont été acceptées seront compensées par la vente des livres mais en proportion de la valeur de leur contribution. Récompense ne peut être transférée (sauf à un enfant ou un autre membre de la famille) ou vendu par les gagnants. Seuls les membres dont les contributions ont été acceptés de la manière indiquée ci-dessus recevront une compensation.

Votre acceptation d'une récompense / compensation comme indiqué ci-dessus constitue accord pour participer à la publicité raisonnable liée à la concurrence et nous accorde un droit inconditionnel à nous d'utiliser votre nom, la ville et l'État, province ou pays, la ressemblance, des informations de prix et de déclarations par vous à propos de la compétition pour la publicité, la publicité et des fins promotionnelles et de se conformer aux lois et règlements applicables, le tout sans permission ou compensation supplémentaire. Comme condition de recevoir un prix, les gagnants (ou leurs parents ou tuteurs) peuvent être tenus de signer et retourner un affidavit d'admissibilité, d'exonération de responsabilité et de publicité.

5. DISPOSITIONS SUPPLÉMENTAIRES

MOYENS ET POLITIQUES idées non sollicitées
Notre politique d'entreprise de longue date ne nous permet pas d'accepter ou non sollicités considérons créatif idées, des suggestions ou des matériaux. Dans le cadre de tout ce que vous nous soumettez - ou non sollicité par nous - vous acceptez que les idées créatives, suggestions ou autres matériaux que vous soumettez ne sont pas faites en confidence ou confiance et qu'aucune relation confidentielle ou fiduciaire est prévue ou créée entre vous et nous en aucune façon, et que vous avez aucune attente de l'examen, la réparation ou l'examen de tout type.

AUTONOMIE
Si une quelconque disposition de ces termes est jugée illégale, nulle ou pour toute raison inapplicable, cette disposition sera réputée divisible de ces conditions et ne doit pas affecter la validité et le caractère exécutoire des dispositions restantes.

SURVIE
Les dispositions de ces termes qui, par leur nature, doivent survivre à la résiliation de ces termes doivent survivre à une telle résiliation.

EXONÉRATION
Aucune renonciation de toute disposition de ces termes par nous doit être considéré comme une renonciation supplémentaire ou permanente de cette disposition ou toute autre disposition, et notre incapacité de faire valoir un droit ou une disposition en vertu de ces termes ne constitue pas une renonciation à ce droit ou à cette disposition.

1. L'utilisateur confirme que les termes et conditions et l'utilisation de ce site d'sera régie par les lois de la République fédérale du Nigeria 2011 et que tout litige en résultant seront soumis à la compétence exclusive des tribunaux nigérians.

7. INDEMNISATION
Vous reconnaissez que vous êtes seul responsable de l'utilisation de vouloir vous mettez ce site et tout le résultat et l'information que vous obtenez de lui et que toutes les garanties, conditions, l'entreprise, les représentations et les conditions si expresse ou implicite, légale ou autrement sont exclues dans toute la mesure permise par la loi.

Sauf en cas de responsabilité pour la mort ou des blessures résultant de la négligence ou de déclaration frauduleuse, nous et tous les contributeurs à ce site déclinons dans toute la mesure permise par la loi tous les engagements pour toute perte ou dommage, y compris toute perte ou dommages consécutifs ou indirects encourus par vous, soit de manière délictuelle, contractuelle ou autre, et découlant de ou en relation ou en relation avec votre accès ou de l'utilisation ou de l'incapacité à nous ce site.

Alors que nous prenons toutes les précautions pour garantir que la norme de ce site reste élevé et de maintenir la continuité de celui-ci, nous déclinons toute obligation ou responsabilité va fonctionner ce site web (ou toute partie de celle-).

Si une partie de nos termes et conditions est jugée inapplicable (y compris toute disposition dans laquelle nous excluons ou responsabilité envers vous) le caractère exécutoire de toute autre partie de ces conditions ne sera pas affectée.

Ces termes et conditions et votre utilisation de ce site sont exclusivement régis par la loi nigériane.

Les exclusions et limitations ne visent pas à limiter la responsabilité qui ne peut être exclu en vertu de la loi dans votre lieu de résidence habituel.

8. INSCRIPTION
Vous devez avoir plus de dix-huit ans à enregistrer sur notre site et devez vous assurer que les détails fournis par vous sur l'inscription sont vrais et exacts, à jour et complètes. Nonobstant ce qui précède nextScene services permettra également de créer un forum où les mineurs qui montrent la capacité des potentiels pour l'écriture participeront à l'objet ci-dessus pour leur approbation parentale nécessaire comme l'exige la loi. Il est de votre responsabilité de date et de nous informer de tout changement dans les détails fournis lors de l'inscription. Bien que certaines parties de notre site peuvent être utilisées par toute personne qui visite sans nécessiter l'enregistrement de certains services nécessitent de vous inscrire afin de nous permettre de vérifier votre identité.

En vous inscrivant au service, vous acceptez que nous puissions vous envoyer des courriels à propos de votre compte, d'autres services Nextscene.com et troisième offres occasionnelles du parti.

Lors de l'inscription, vous serez invité à créer un mot de passe et serez responsable de maintenir la confidentialité de votre mot de passe et de restreindre l'accès à votre ordinateur comme vous serez responsable de toutes les activités à votre ordinateur, que vous serez responsable de toutes les activités menées dans le cadre de votre mot de passe. Si vous croyez que quelqu'un a accédé à votre compte sans autorisation s'il vous plaît contactez-nous immédiatement.

9. ADHÉSION
un. Pour accéder ou d'utiliser certaines parties du site, vous devez vous inscrire en tant que membre du site.
b. Lors de l'inscription en tant que membre du site, vous devez nous fournir des informations à jour exacts, complets et comme l'a demandé. Il est de votre responsabilité de nous informer de tout changement de cette information.
c. Vous êtes autorisé à créer un profil pour vous-même. Vous ne devez pas créer des profils de membres multiples sur le site.
ré. Tous les renseignements personnels que vous nous fournissez sera traitée conformément à notre politique de confidentialité.

10. CESSATION DE PARTICIPATION
un. Vous pouvez résilier votre abonnement du site pour une raison quelconque à condition que vous nous envoyez un avis écrit. Vous pouvez fournir un avis de résiliation en nous écrivant via la page nous contacter.
b. Nous nous réservons le droit sans restriction à faire tout ou partie de ce qui suit en relation avec votre adhésion.
je. Suspendre votre adhésion
je je. Résilier votre adhésion pour une raison quelconque en donnant un avis par e-mail.
iii. Résilier votre abonnement immédiatement et sans préavis à vous si vous avez commis une violation des conditions d'utilisation, et.
iv. Définitivement ou temporairement bloquer votre accès à tout ou partie du site.

11. LOI
L'utilisateur confirme que les termes et conditions et l'utilisation de ce site sont régies par les lois de la République fédérale du Nigeria 2011 et que tous les litiges qui en découlent sont soumis à la compétence exclusive des tribunaux nigérians.

</textarea><br>
<input name="agreecheck" type="checkbox" onclick="agreesubmit(this)"><b>J'accepte les conditions d'utilisation ci-dessus.</b><br>

</fieldset><br />

<input type="submit" name="submit" value="Submit" disabled>
            
            
					
		     <!-- <br><input class="submit" type="submit" name="submit" value="Submit">-->
                <br>
	  				<div id="msg" class="message"></div>
                    
                    
                    
                    
				</form>
                  <br>  <br>
                </div></div>
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