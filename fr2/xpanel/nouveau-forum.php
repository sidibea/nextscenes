<?php include("include/database.php"); $db->isAdmin();
$forums = $db->fetchForum();
header('Content-Type: text/html; charset=ASCII');?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<?php echo "<title>xPanel &bull; Nouveau Forum</title>";?>
<?php include("include/head.php");?>
<h1>Nouveau Forum</h1>
<form action="mint?action=new-forum" method="post" enctype="multipart/form-data">
	<label><strong>Titre:</strong></label>
    <input type="text" name="title" class="form-control" />
    <div class="space"></div>
    <label><strong>Image:</strong></label>
    <input type="file" name="pix" class="form-control">
    <div class="space"></div>
    <label><strong>La Description:</strong></label>
    <textarea name="description"></textarea>
    <div style="height:5px;"></div>
    <input type="submit" value="Soumettre" class="btn btn-default">
</form>
<?php include("include/foot.php");?>