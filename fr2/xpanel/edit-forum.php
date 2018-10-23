<?php include("include/database.php"); 
$forum = $db->fetchForumID($db->clean($_REQUEST['id']));
header('Content-Type: text/html; charset=ASCII');?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<?php echo "<title>xPanel &bull; Modifier Forum</title>";?>
<?php include("include/head.php");?>
<h1>Modifier Forum</h1>
<form action="mint?action=edit-forum" method="post" enctype="multipart/form-data">
	<label><strong>Titre:</strong></label>
    <input type="text" name="title" value="<?php echo $forum['title'];?>" class="form-control" />
    <div class="space"></div>
    <label><strong>Image:</strong></label>
    <input type="file" name="pix" class="form-control">
    <div class="space"></div>
    <label><strong>La Description:</strong></label>
    <textarea name="description"><?php echo $forum['description'];?></textarea>
    <div style="height:5px;"></div>
    <input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id'])?>">
    <input type="submit" value="Soumettre" class="btn btn-default">
</form>
<?php include("include/foot.php");?>