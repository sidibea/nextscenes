<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ; 
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
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		  <title>NEXTSCENES ADMIN</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="noindex, nofollow">
	</head>
	<body>
		
		
<?php

//$tmp_file = $_FILES['urlimage']['tmp_name'];
@$image = $_FILES['urlimage']['name'][1];

// R�cup�ration du dossier dans lequel le fichier sera upload�	//
$DESTINATION_FOLDER = "../../pictures/";							//
// Taille maximale de fichier, valeur en bytes					//
$MAX_SIZE = 500000000000000;	
//$MAX_SIZE = 500000000000000;										//
						//
// D�finition des extensions de fichier autoris�es (avec le ".")//
$AUTH_EXT = array(".jpg", ".bmp", ".gif",".JPG",".png",".jpeg", ".JPEG" );											//
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


// On v�rifie que le champs contenant le chemin du fichier soit
// bien rempli.

if(!empty($_FILES["urlimage"]["name"][0])){
	$tps = time();
	// Nom des fichiers choisi:
	
	//$userfile_name1= $_FILES['urlimage']['name'][0]; 
    $userfile_name1= simpleName($_FILES['urlimage']['name'][0]); 

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
		// Si la taille du fichier est sup�rieure � la taille
		// maximum sp�cifi�e => message d'erreur
		if($poidsFichier1 < $MAX_SIZE ){
			// On teste ensuite si le fichier a une extension autoris�e
			if(extensionauto($extension1) ){			
			 
				// Ensuite, on copie le fichier upload� ou bon nous semble.
				@$uploadOk1 = move_uploaded_file($nomTemporaire1, $DESTINATION_FOLDER.$tps.$userfile_name1);
				

				
			}else{
					if( !empty($image)){ 
									break;
					}else{
			    			 echo'<script language="javascript">
                   			 alert("Le format de votre image n\'est pas autoris�");
                    			history.go(-1);
                    			 </script>';
				//echo ("Les fichiers avec l'extension $extension ne peuvent pas �tre upload�s !<br>");
				//echo (createReturnLink()."<br>");
						}
			}
		}else{
			$tailleKo = $MAX_SIZE / 1000;
			//echo("Vous ne pouvez pas uploader de fichiers dont la taille est sup�rieure � : $tailleKo Ko.<br>");
			//echo (createReturnLink()."<br>");
		}		
	}else{
		echo'<script language="javascript">
alert("Picture Large");
history.go(-1);
</script>';
	}
}

@$date = date("Y-m-d");

@$fichier=$tps.$userfile_name1 ;

@$title = mysql_escape_string($_POST['title'] ) ;
@$IdFor = mysql_escape_string($_POST['IdFor'] ) ;
@$login = mysql_escape_string($_POST['login'] ) ;
@$texte = mysql_escape_string($_POST['FCKeditor1']) ;

$sqlforum = 'SELECT * FROM forums WHERE IdForum = "'.mysql_clean($IdFor).'"';
$reqforum = mysql_query($sqlforum) or die('Erreur SQL !<br />'.$sqlforum.'<br />'.mysql_error()); 
$dataforum = mysql_fetch_array($reqforum);



if(!empty($title) && (strlen($texte) > 10) && !empty($IdFor) )
{

// j'inserre le storyline ds sa table     
$sql='INSERT INTO storylines (DateCreate,IdForum, Forum, Title,Description,Login,Filename) VALUES ("'.$date.'", "'.$IdFor.'", "'.$dataforum['Title'].'", "'.$title.'", "'.$texte.'","'.$login.'","'.$fichier.'")'; // ,"'.time().'"
mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

//je recupère la id inserrée
$sqlstory ='SELECT MAX(idstory) as id FROM storylines'; // ,"'.time().'"
$datastory = mysql_fetch_array(mysql_query($sqlstory));


//$datastory = mysql_query($sqlstory) or die('Erreur SQL !'.$sqlstory.'<br />'.mysql_error());
//$datastory = mysql_query("SELECT idstory FROM storylines WHERE idstory=LAST_INSERT_ID()")or die(mysql_error());
//$datastory = mysql_query("SELECT MAX(idstory) FROM storylines")or die(mysql_error());
// $sqlstory ='SELECT * FROM storylines WHERE idstory = MAX(idstory)'; // ,"'.time().'"



// j'inserre la description du storyline comme 1ère scene proposée   
$sql='INSERT INTO scenes_valides (Date,idstory, Login, Text,scenes) VALUES ("'.$date.'", "'.$datastory['id'].'", "'.$login.'", "'.$texte.'","1")'; 
mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());


// Incrementer le nombre de sotyline dans forum 
$sql0 = 'UPDATE forums SET storylines=storylines+1 WHERE IdForum= "'.mysql_clean($IdFor).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 


echo'<script language="javascript"> 
alert("Successfully"); 
document.location.href="manage.php"; 
</script>';
redirect_to('insert.php');
						

         }
		 
 else 
		 {
			//echo'<br><br><div align="center">Insertion Failed<br><br> <a href="javascript:history.go(-1)">return</a></div> '; 
			
			echo'<script language="javascript"> 
alert("Error! A Missing orIinsufficient text field"); 
 history.go(-1); 
</script>';
//redirect_to('insert.php');

		 }



								
				?>
		
	</body>
</html>
