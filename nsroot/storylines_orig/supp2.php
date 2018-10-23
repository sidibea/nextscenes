<?php // include 'inc.php'; ?>
<?php //PHP ADODB document - made with PHAkt 2.4.0?>
<?php //Connection statement
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
@$op=$_POST['op'];
@$reponse=$_POST['reponse'];
if ($reponse=="vrai") {


$sqlst = 'SELECT * FROM storylines WHERE idstory = "'.mysql_clean($op).'"';
$reqst = mysql_query($sqlst) or die('Erreur SQL !<br />'.$sqlst.'<br />'.mysql_error()); 
$datast = mysql_fetch_array($reqst);

// Incrementer le nombre de sotyline dans forum 
$sql0 = 'UPDATE forums SET storylines=storylines-1 WHERE IdForum= "'.$datast['IdForum'].'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 

$sql = "DELETE FROM storylines WHERE idstory like '$op'";
$req=mysql_query($sql);

$sql = "DELETE FROM scenes_valides WHERE idstory like '$op'";
$req=mysql_query($sql);



}
redirect_to('manage.php');
//include('manage.php');
?>
