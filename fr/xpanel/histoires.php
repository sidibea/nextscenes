<?php include("include/database.php"); $db->isAdmin();
header('Content-Type: text/html; charset=ASCII');
$page = $db->clean($_REQUEST['page']);
if($page == ""){
	$page = 1;
}
$hist = $db->fetchStories(30, $page, "xpanel/histoires");?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<title>xPanel &bull; Histoires</title>
<?php include("include/head.php");?>
<h1>Histoires</h1>
<table class="table">
    <tr>
        <th>Titre</th>
        <th>Par</th>
        <th>Cat&eacute;gorie</th>
        <th>Action</th>
    </tr>
<?php
foreach((array)$hist as $history){?>
	<tr>
        <td style="font-size:14px;"><?php echo $history['title'];?></td>
        <td style="font-size:12px;"><?php $eu = $db->getAuthor($history['author']); echo $eu['u_username'];?></td>
        <td><?php $fr = $db->fetchForumID($history['category']); echo $fr['title'];?></td>
        <td style="font-size:12px;"><a href="edit-histoire?id=<?php echo $history['id'];?>">Edit</a> &bull; <a href="mint?action=deleteHistory&id=<?php echo $history['id'];?>"><i style="font-weight:bold; color:#F00;">Delete</a></td>
    </tr>
<?php }?>
</table>
<?php include("include/foot.php");?>