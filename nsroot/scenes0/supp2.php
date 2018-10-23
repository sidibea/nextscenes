<?php // include 'inc.php'; ?>
<?php //PHP ADODB document - made with PHAkt 2.4.0?>
<?php //Connection statement
include '../include/connect_db.php' ;  
@$op=$_POST['op'];
@$reponse=$_POST['reponse'];
if ($reponse=="vrai") {
$sql = "DELETE FROM news WHERE id like '$op'";
$req=mysql_query($sql);
}
redirect_to('manage.php');
//include('manage.php');
?>
