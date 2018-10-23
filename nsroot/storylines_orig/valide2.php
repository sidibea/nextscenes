<?php // include 'inc.php'; ?>
<?php //PHP ADODB document - made with PHAkt 2.4.0?>
<?php //Connection statement
include '../../includes/connect_db.php' ;
include'../../includes/functions.inc.php';
/* 
function redirect_to($url){
		echo '<script type="text/javascript">
		window.location = "'.$url.'"
		</script>';
} 
*/
@$date = date("Y-m-d");

@$op=$_POST['op'];
@$reponse=$_POST['reponse'];
if ($reponse=="vrai") {

$sql0 = 'UPDATE scenes_proposes SET valide=valide+1 WHERE id= "'.mysql_clean($op).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 

// je copie toute les donnes de la table scenes proposes dans la table scene valide 
$sql = 'INSERT INTO scenes_valides (idstory, Login, Text, scenes) SELECT idstory, Login, Text, scenes FROM scenes_proposes where id= "'.mysql_clean($op).'"';
$req=mysql_query($sql);

// Je selectionne le dernier id de la table scene valide
$sqlsv ='SELECT MAX(id) as id FROM scenes_valides'; // ,"'.time().'"
$datasv = mysql_fetch_array(mysql_query($sqlsv));

// Je selectionne les donnes du derneir enregistrement de la table scene valide
$sql2 = 'SELECT * FROM scenes_valides WHERE id = "'.$datasv['id'].'"';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
$data2 = mysql_fetch_array($req2);

// Je compte le nombre de fois de idstory, ce qui represente le  numero de la scene en cours et j'ajoute 1 pour la scene suivante.
$query = 'SELECT COUNT(*) FROM scenes_valides WHERE idstory= "'.$data2['idstory'].'"';
$total = mysql_fetch_array(mysql_query($query));
$total1 =$total[0]++;

// Je modifie la date et le numero de la scene dur dernier enregistrement
$sql1 = 'UPDATE scenes_valides SET Date="'.date("Y-m-d").'", scenes="'.$total1.'" WHERE id= "'.$datasv['id'].'"';
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 

}
redirect_to('manage.php');
//include('manage.php');
?>
