<?php include("include/database.php"); 
$forums = $db->fetchForum();
header('Content-Type: text/html; charset=ASCII');?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<title>xPanel &bull; Nouveau Forum</title>
<?php include("include/head.php");?>
<h1>Nouveau Forum</h1>
<table class="table">
    <tr>
        <th>S/N</th>
        <th>Titre</th>
        <th>La Description</th>
        <th>Action</th>
    </tr>
<?php 
	foreach($forums as $forum){?>
    	<tr>
        	<td><?php echo $forum['id'];?></td>
            <td style="font-size:14px;"><?php echo $forum['title'];?></td>
            <td style="font-size:12px;"><?php echo $forum['description'];?></td>
            <td style="font-size:12px;"><a href="edit-forum?id=<?php echo $forum['id'];?>">Edit</a> &bull; <a href="mint?action=deleteForum&id=<?php echo $forum['id'];?>"><i style="font-weight:bold; color:#F00;">Delete</a></td>
        </tr>
    <?php }?>
    </table>
<?php include("include/foot.php");?>