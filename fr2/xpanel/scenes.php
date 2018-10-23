<?php include("include/database.php"); $db->isAdmin();
header('Content-Type: text/html; charset=ASCII');
$page = $db->clean($_REQUEST['page']);
if($page == ""){
	$page = 1;
}
$hist = $db->fetchScenes2(30, $page);?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<title>xPanel &bull; Sc&eacute;nes</title>
<?php include("include/head.php");?>
<h1>Sc&eacute;nes</h1>
<table class="table">
    <tr>
        <th>Titre</th>
        <th>Par</th>
        <th>La Description</th>
        <th>Action</th>
    </tr>
<?php
foreach((array)$hist as $history){?>
	<tr>
        <td style="font-size:14px;"><?php $str = $db->getStoryID($history['s_id']); echo $str['title'];?></td>
        <td style="font-size:12px;"><?php $eu = $db->getAuthor($history['author']); echo $eu['u_username'];?></td>
        <td><?php echo substr(strip_tags($history['content']),0,75);?>...<a href="scene?id=<?php echo $history['id'];?>">More &raquo;</a></td>
        <td style="font-size:12px;"><a href="edit-scene?id=<?php echo $history['id'];?>">Edit</a> &bull; <a href="mint?action=deleteScene&id=<?php echo $history['id'];?>"><i style="font-weight:bold; color:#F00;">Delete</a></td>
    </tr>
<?php }?>
</table>
<?php include("include/foot.php");?>