<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		  <title>Admin : NEXTSCENES</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
		<link href="../sample.css" rel="stylesheet" type="text/css" >
	</head>
	<body>
		
		
<?php
//$tmp_file = $_FILES['urlimage']['tmp_name'];
@$image = $_FILES['urlimage']['name'][1];

// Récupération du dossier dans lequel le fichier sera uploadé	//
$DESTINATION_FOLDER = "../../pictures/";						//
// Taille maximale de fichier, valeur en bytes					//
$MAX_SIZE = 500000000000000;											//
						//
// Définition des extensions de fichier autorisées (avec le ".")//
$AUTH_EXT = array(".jpg", ".bmp", ".gif",".JPG",".png");											//
// ############################################################ //

function extensionauto($ext){
	global $AUTH_EXT;
	if(in_array($ext, $AUTH_EXT)){
		return true;
	}else{
		return false;
	}
}
function simpleName ($chaine)
{
  $string = iconv ('ISO-8859-1', 'US-ASCII//TRANSLIT//IGNORE', $chaine);
  $string = preg_replace ('#[^.0-9a-z]+#i', '', $string);
  $string = strtolower ($string);
  return $string;
}

###############################################################
#           traitement de le 1ere image                       #
###############################################################


// On vérifie que le champs contenant le chemin du fichier soit
// bien rempli.

if(!empty($_FILES["urlimage"]["name"][0])){
	$tps = time();
	// Nom des fichiers choisi:
	$userfile_name1= simpleName($_FILES['urlimage']['name'][0]); 
	//$userfile_name1= $_FILES['urlimage']['name'][0]; 


	// Noms temporaires sur le serveur:
	$nomTemporaire1 = $_FILES["urlimage"]["tmp_name"][0];

	//$nomTemporaire = $_FILES["file"]["tmp_name"] ;

	// Type du fichier choisi:
	$typeFichier1 = $_FILES["urlimage"]["type"][0] ;

	// Poids en octets du fichier choisit:
	$poidsFichier1 = $_FILES["urlimage"]["size"][0] ;
	

	// Code de l'erreur si jamais il y en a une:
	$codeErreur = $_FILES["urlimage"]["error"] ;
	// Extension du fichier
	$extension1 = strrchr($userfile_name1, ".");

	
	// Si le poids du fichier est de 0 bytes, le fichier est
	// invalide (ou le chemin incorrect) => message d'erreur
	// sinon, on continue.
	if($poidsFichier1 <> 0 ){
		// Si la taille du fichier est supérieure à la taille
		// maximum spécifiée => message d'erreur
		if($poidsFichier1 < $MAX_SIZE ){
			// On teste ensuite si le fichier a une extension autorisée
			if(extensionauto($extension1) ){			
			 
				// Ensuite, on copie le fichier uploadé ou bon nous semble.
				@$uploadOk1 = move_uploaded_file($nomTemporaire1, $DESTINATION_FOLDER.$tps.$userfile_name1);
				

				
			}else{
					if( !empty($image)){ 
									break;
					}else{
			    			 echo'<script language="javascript">
                   			 alert("Le format de votre image n\'est pas autorisé");
                    			history.go(-1);
                    			 </script>';
				//echo ("Les fichiers avec l'extension $extension ne peuvent pas être uploadés !<br>");
				//echo (createReturnLink()."<br>");
						}
			}
		}else{
			$tailleKo = $MAX_SIZE / 1000;
			//echo("Vous ne pouvez pas uploader de fichiers dont la taille est supérieure à : $tailleKo Ko.<br>");
			//echo (createReturnLink()."<br>");
		}		
	}else{
		echo'<script language="javascript">
alert("Votre photo est trop grande");
history.go(-1);
</script>';
	}
}


@$op1=$_POST['op1'];

@$date = date("Y-m-d");

@$fichier=$tps.$userfile_name1 ;

@$titre = mysql_escape_string($_POST['titre'] ) ;
@$titrefr = mysql_escape_string($_POST['titrefr'] ) ;
@$texte = mysql_escape_string($_POST['FCKeditor1']) ;
@$textefr = mysql_escape_string($_POST['FCKeditor1fr']) ;


if(!empty($titre) && !empty($texte))
{



include_once ("../../includes/connect_db.php");

$t3="data";

function mysql_clean($id){
	//$id = mysql_escape_string($id);
	$id = mysql_real_escape_string($id);
	return $id;
}
function redirect_to($url){
		echo '<script type="text/javascript">
		window.location = "'.$url.'"
		</script>';
}


if(!empty($fichier))
{
						
	$sql="UPDATE $t3 SET Title='$titre', Titlefr='$titrefr', Descriptions='$texte', Descriptionsfr='$textefr', filename='$fichier' WHERE Iddata='1'";
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		
		
	echo'<script language="javascript">
          alert("Modification reussie");
                   document.location.href="../home.php";
                      </script>';
					redirect_to('../home.php');

 }
else
        {
			$sql="UPDATE $t3 SET Title='$titre', Titlefr='$titrefr', Descriptions='$texte', Descriptionsfr='$textefr' WHERE Iddata='1'";
	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
	redirect_to('../home.php');
	
	echo'<script language="javascript">
          alert("Modification reussie");
                   document.location.href="../home.php";
                      </script>';
					  
					  redirect_to('../home.php');
					 
		}



				
				
	}
else
{
echo'<script language="javascript">
         alert("Insertion Impossible car Champ Texte ou Titre vide");
                   history.go(-1);
                      </script>';
}			
				
				
				
				?>
		</table>
	</body>
</html>
