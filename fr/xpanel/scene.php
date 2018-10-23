<?php include("include/database.php"); 
header('Content-Type: text/html; charset=ASCII');
$page = $db->clean($_REQUEST['page']);
if($page == ""){
	$page = 1;
}
$id = $db->clean($_REQUEST['id']);
$hist = $db->fetchScene($id);
$story = $db->getStoryID($hist['s_id']);?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<title>xPanel &bull; <?php echo $story['title'];?></title>
<?php include("include/head.php");?>
<h1><?php echo $story['title'];?></h1>
<div><?php echo $hist['content'];?></div>
<div style="height:10px;"></div>
<div style="text-align:right; padding-right:20px;"><?php if($hist['status'] == 0){?><a href="mint?action=approve&id=<?php echo $id;?>"><button class="btn btn-success">Approve</button></a><?php }?></div>
<?php include("include/foot.php");?>