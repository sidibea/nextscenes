<?php include("include/database.php"); $db->isAdmin();
header('Content-Type: text/html; charset=ASCII');
$id = $db->clean($_REQUEST['id']);
$scene = $db->fetchScene($id);?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<title>xPanel &bull; Modifier Scenes</title>
<?php include("include/head.php");?>
<h1>Modifier Histoire</h1>
<form action="mint?action=edit-scene" method="post">
	<label><strong>Titre:</strong></label><br>
	<?php $topic = $db->fetchStID($scene['s_id']); echo $topic['title'];?><br>
    <label><strong>La Description:</strong></label>
    <textarea name="content"><?php echo $scene['content'];?></textarea>
    <div style="height:5px;"></div>
    <input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id'])?>">
    <input type="submit" value="Soumettre" class="btn btn-default">
</form>
<?php include("include/foot.php");?>