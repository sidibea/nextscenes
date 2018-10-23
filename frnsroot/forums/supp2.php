<?php // include 'inc.php'; ?>
<?php //PHP ADODB document - made with PHAkt 2.4.0?>
<?php //Connection statement
include '../../includes/connect_db.php' ; 
function redirect_to($url){
		echo '<script type="text/javascript">
		window.location = "'.$url.'"
		</script>';
} 
@$op=$_POST['op'];
@$reponse=$_POST['reponse'];
if ($reponse=="vrai") {
$sql = "DELETE FROM forums WHERE IdForum like '$op'";
$req=mysql_query($sql);
}
redirect_to('manage.php');
//include('manage.php');
?>
