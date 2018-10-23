<?php

//******** Fonction et class Pour commentaires ***********************/
/****	Class connexion à la db *******/

class DbConnector {

var $theQuery;
var $link;

function DbConnector(){

        // Get the main settings from the array we just loaded
        $host = 'localhost';
        $db = 'moov';
        $user = 'root';
        $pass = '';

        // Connect to the database
        $this->link = mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        register_shutdown_function(array(&$this, 'close'));

    }
	
  //*** Function: query, Purpose: Execute a database query ***
    function query($query) {

        $this->theQuery = $query;
        return mysql_query($query, $this->link);

    }

    //*** Function: fetchArray, Purpose: Get array of query results ***
    function fetchArray($result) {

        return mysql_fetch_array($result);

    }

    //*** Function: close, Purpose: Close the connection ***
    function close() {

        mysql_close($this->link);

    }
	
}

//Convertir une date US vers une date en français affichant le jour de la semaine
function datelongue($date,$heure = 'yes'){

/* Configure le script en français */
setlocale (LC_TIME, 'fr_FR','fra');
//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
date_default_timezone_set("Europe/Paris");
//Definit l'encodage interne
mb_internal_encoding("UTF-8");

    if($heure == 'yes')
    {
    $strDate = mb_convert_encoding('%A %d %B %Y à %Hh%M','ISO-8859-9','UTF-8');  
    }
    else
    {
    $strDate = mb_convert_encoding('%A %d %B %Y','ISO-8859-9','UTF-8');    
    }
    return iconv("ISO-8859-9","UTF-8",strftime($strDate ,strtotime($date))); 
}


/*

function date_diff($d1, $d2){
	$d1 = (is_string($d1) ? strtotime($d1) : $d1);
	$d2 = (is_string($d2) ? strtotime($d2) : $d2);

	$diff_secs = abs($d1 - $d2);
	$base_year = min(date("Y", $d1), date("Y", $d2));

	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	$diffArray = array(
		"years" => date("Y", $diff) - $base_year,
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,
		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)
	);
	
	$tps ="Il y a  ";
	
	if($diffArray['days'] > 0){
		if($diffArray['days'] == 1){
			$days = $tps.'1 jour';
		}else{
			$days = $tps.$diffArray['days'] . ' jours';
		}
		return $days. ' '; // et' . $diffArray['hours'] . ' heures
	}else if($diffArray['hours'] > 0){
		if($diffArray['hours'] == 1){
			$hours = $tps.'1 heure';
		}else{
			$hours = $tps.$diffArray['hours'] . ' heures';
		}
		return $tps.$hours . ' et ' . $diffArray['minutes'] . ' minutes';
	}else if($diffArray['minutes'] > 0){
		if($diffArray['minutes'] == 1){
			$minutes = '1 minute';
		}else{
			$minutes = $diffArray['minutes'] . ' minutes';
		}
		return $tps.$minutes . ' et ' . $diffArray['seconds'] . ' secondes';
	}else{
		return 'Il y a Moins d\'une minute';
	}
}

*/


//******** Fin Pour commentaires ***********************/


/****	Class pour generer une chaine aléatoire. *******/

class outils {
function gen_key($longueur = 20) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$chars .= '01234567890123456789';
		$chars .= 'abcdefghijklmnopqrstuvwxyz';
		$chars .= '01234567890123456789';
		for ($n = 0, $ID = ''; $n < $longueur; $n++) {
			$ID .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $ID;
	}
}
function reecUrl($str)
{
 if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
 $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
$str = strtolower( trim($str, '-') );
return $str;

}

/*
function reecUrl($txt) 
{
  $txt = strtr($txt,' "!@#$%?&*()+*','--------------'); // enlever caractere speciaux
    $txt = strtr($txt,"'",'-'); // enlever guillement simple
    
    // enlever les accents
    $txt =  mb_strtolower(strtr($txt,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
                                         'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'));
    
    return $txt;
} 
*/

/*
function reecUrl($nom)
{
    $accent="ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ";
    $noAccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby";
    $reecriture=mb_strtolower(strtr(trim($nom),$accent,$noAccent));
    $url=preg_replace("# #","-",$reecriture);
    return  $url;
	
	
}
*/
function redirect_to($url){
		echo '<script type="text/javascript">
		window.location = "'.$url.'"
		</script>';
		}

/**********Function mot de pass******************/
	  
	  function random($car) {
$string = "";
$chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

// APPEL
// Génère une chaine de longueur 20
//$chaine = random(6);
//echo $chaine;
	  
	

/***********************Password********************/
	
	function pass_code($string) {
 	 $password = md5(md5(sha1(sha1(md5($string)))));
 	 return $password;
	}
	
//Mysql Clean Queries
	
	function mysql_clean($id){
		
		/*$id = clean($id);
		if (get_magic_quotes_gpc())
		{
		$id = stripslashes($id);
		}
		*/
	$id = mysql_real_escape_string($id);
	return $id;
	}


/*********************** Les Titre ********************/
	
	function Titre() {
 	 $TitrePage = "Moovspace ";
 	 echo $TitrePage ;
	}
	
	function Titre2() {
 	 $Titre2Page = "Portail Web des jeunes branch&eacute;s";
 	 echo $Titre2Page ;
	}

/*****************************************************/



function GetVideoDetail($flv){
	global $LANG;
		$query = mysql_query("SELECT * FROM video_detail WHERE flv='".$flv."'");
		$data = mysql_fetch_array($query);
		return $data;
	}
	


function Admin_Add_User(){
	// global $LANG,$stats;
	$login 		= mysql_clean($_POST['username']);
	$email		= mysql_clean($_POST['email']);
	$pass 		= pass_code(mysql_clean($_POST['password']));
	$mobile		= mysql_clean($_POST['mobile']);
	$sexe		= mysql_clean($_POST['sexe']);
	$naissance		= mysql_clean($_POST['naissance']);
	$profession		= mysql_clean($_POST['profession']);
	$pays		= $_POST['pays'];
	/*
	$dob_d		= $_POST['day'];
	$dob_y		= $_POST['year'];
	$ht			= mysql_clean($_POST['hometown']);
	$city 		= mysql_clean($_POST['city']);
	$country 	= $_POST['country'];
	$zip		= mysql_clean($_POST['zip']);
	$active		= $_POST['active'];
	*/
	if(empty($uname)){
	$msg[] = $LANG['usr_uname_err'];
	}
	if($this->duplicate_user($uname)){
	$msg[] = $LANG['usr_uname_err2'];
	}
	if(!$this->isValidUsername($uname)){
	$msg[] = $LANG['usr_uname_err3'];
	}
	if(empty($_POST['password'])){
	$msg[] = $LANG['usr_pass_err2'];
	}
	if(empty($email)){
	$msg[] = $LANG['usr_email_err1'];
	}elseif(!$this->isValidEmail($email)){
	$msg[] = $LANG['usr_email_err2'];
	}
	if($this->duplicate_email($email)){
	$msg[] = $LANG['usr_email_err3'];
	}
	if(empty($fname)){
	//$msg[] = $LANG['usr_fname_err'];
	}
	if(empty($lname)){
	//$msg[] = $LANG['usr_lname_err'];
	}
	
	if(!empty($zip) && !is_numeric($zip)){
	$msg[] = $LANG['usr_pcode_err'];
	}
	$dob = mktime(0,0,0,$dob_m,$dob_d,$dob_y);
	$dob = date('Y-m-d',$dob);
		if(empty($msg)){
		if(!mysql_query("INSERT INTO users (username,password,email,first_name,last_name,sex,level,dob,hometown,city,country,zip,usr_status)
	VALUES('".$uname."','".$pass."','".$email."','".$fname."','".$lname."','".$gender."','".$level."','".$dob."','".$ht."','".$city."','".$country."','".$zip."','".$active."')")) die(mysql_error());
		$stats->UpdateUserRecord(1);
		redirect_to($_SERVER['PHP_SELF'].'?msg='.urlencode($LANG['usr_add_succ_msg']));
		}
	
	return $msg;
	
	}








 function coupechaine($chaine,$max)
		{
			if(strlen($chaine)>=$max){$chaine=substr($chaine,0,$max);  
			$espace=strrpos($chaine," "); 
			$chaine=substr($chaine,0,$espace)."..."; } 
			return $chaine;
		}




//Function Send Email
		function send_email($from,$to,$subj,$msg){
				$header = "From: ".$from." \r\n";
				$header .= "Content-Type: text/html; charset=utf-8  \r\n";
				@$retval = mail ($to,$subj,$msg,$header);
				   if( $retval == true ){
					 return true;
				   }else{
					 return false;
				   }
		}












function GenerationCle($Texte,$CleDEncryptage) 
  { 
  $CleDEncryptage = md5($CleDEncryptage); 
  $Compteur=0; 
  $VariableTemp = ""; 
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++) 
    { 
    if ($Compteur==strlen($CleDEncryptage))
      $Compteur=0; 
    $VariableTemp.= substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1); 
    $Compteur++; 
    } 
  return $VariableTemp; 
  }

function Crypte($Texte,$Cle) 
  { 
  srand((double)microtime()*1000000); 
  $CleDEncryptage = md5(rand(0,32000) ); 
  $Compteur=0; 
  $VariableTemp = ""; 
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++) 
    { 
    if ($Compteur==strlen($CleDEncryptage)) 
      $Compteur=0; 
    $VariableTemp.= substr($CleDEncryptage,$Compteur,1).(substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1) ); 
    $Compteur++;
    } 
  return base64_encode(GenerationCle($VariableTemp,$Cle) );
  }

function Decrypte($Texte,$Cle) 
  { 
  $Texte = GenerationCle(base64_decode($Texte),$Cle);
  $VariableTemp = ""; 
  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++) 
    { 
    $md5 = substr($Texte,$Ctr,1); 
    $Ctr++; 
    $VariableTemp.= (substr($Texte,$Ctr,1) ^ $md5); 
    } 
  return $VariableTemp; 
  }

/*
function GetDomain($url){

     $t = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1",$url);
     $r = explode('.', $t);
     if(isset($r[2])){
             return $r[1].'.'.$r[2];
     }else{
             return $r[0].'.'.$r[1];
     }
}
*/

function getDomain($url)
{
   $t = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1",$url);
   $r = explode('.', $t);
   return $r[count($r)-2].'.'.$r[count($r)-1]; 

}

/*
function getDomain($url)
{
   return preg_match('#^[\w.]*\.(\w+\.[a-z]{2,6})[\w/._-]*$#',$url,$match);
   $url=$match[1];
  // return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1",$url);
}
*/





?>


