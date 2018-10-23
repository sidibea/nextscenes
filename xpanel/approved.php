<?php require "functions.php"; isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Approved Personal Stories</title>
<?php include("include/head.php");?>
<h1>Approved Personal Stories</h1>
<?php if($_SESSION['s'] == true){echo "<div class=\"alert alert-success\">Story Approved For Store Listing!.</div>";}$_SESSION['s'] = false;?>
<?php if($_SESSION['d'] == true){echo "<div class=\"alert alert-danger\">Story Declined.</div>";}$_SESSION['d'] = false;?>
<?php if($_SESSION['f'] == true){echo "<div class=\"alert alert-success\">Operation Failed, Please Try Again Later.</div>";}$_SESSION['f'] = false;?>
<?php
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1; 
	}
	$limit =20;
	$tlink = $slug;
	$tbname = "c_topics WHERE publish=2 ORDER BY id DESC";
	$url = "";
	$startpoint = ($page * $limit) - $limit;
	$query = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$sql = "{$query}";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){?>
	<div style="padding:10px; border-radius:10px; border:1px solid #EFEFEF">
		<h3><?php echo $row['topic'];?></h3>
		<div><?php echo $row['content'];?></div>
		<div class="space"></div>
		<div style="font-size:12px;"><a href="../story-<?php echo $row['slug'];?>" target="_blank">View</a> | <?php if($row['mode'] == 0){echo "Public";}?><?php if($row['mode'] == 1){echo "Private";}?><?php if($row['mode'] == 3){echo "Group Story";}?> | By: <?php echo $row['name'];?> | <a href="edit-personal-story?id=<?php echo $row['id'];?>">Edit</a> | <a href="mint?action=decline&id=<?php echo $row['id'];?>">Decline</a> | <a href="mint?action=delete-personal-story&id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to DELETE this story?')"><span style="font-weight:bold; color:red;">Delete</span></a></div>
	</div>
	<?php }?>
<?php echo "<div align=\"center\">".pagingCustom($tlink,$page,$limit,$url,$tbname)."</div>";?>
<?php include("include/foot.php");?>