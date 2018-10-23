<?php include("include/database.php"); $db->isAdmin();
$forum = $db->fetchStID($db->clean($_REQUEST['id']));
header('Content-Type: text/html; charset=ASCII');?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<?php echo "<title>xPanel &bull; Modifier Histoire</title>";?>
<?php include("include/head.php");?>
<h1>Modifier Histoire</h1>
<form action="mint?action=edit-history" method="post" enctype="multipart/form-data">
	<label><strong>Titre:</strong></label>
    <input type="text" name="title" value="<?php echo $forum['title'];?>" class="form-control" />
    <div class="space"></div>
    <label><strong>Selectionner Forum</strong></label>
    <select name="forum" class="form-control">
         <?php $forumd = $db->fetchForum();
            foreach($forumd as $forums){?>
				<option value="<?php echo $forums['id'];?>" <?php if($forums['id'] == $forum['category']){echo "selected";}?>><?php echo $forums['title'];?></option>
        <?php }?>
    </select>
    <div class="space"></div>
    <label><strong>Image:</strong></label>
    <input type="file" name="pix">
    <div class="space"></div>
    <label><strong>La Description:</strong></label>
    <textarea name="content"><?php echo $forum['content'];?></textarea>
    <div style="height:5px;"></div>
    <input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id'])?>">
    <input type="submit" value="Soumettre" class="btn btn-default">
</form>
<?php include("include/foot.php");?>