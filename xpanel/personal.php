<?php require "functions.php"; isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || All Personal Stories</title>
<?php include("include/head.php");?>
<style>
.btn{
	padding: 9px 10px;
}
</style>
<h1>All Personal Stories</h1>
<div class="col-sm-4 col-md-4 pull-right">
	<form class="navbar-form" role="search" action="search">
		<div class="input-group">
			<input type="search" class="form-control" placeholder="Search This Blog" name="s" />
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
	</form>
</div>
<div class="clearfix"></div>
<?php
	success();failed();
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =30;
	$tlink = $slug;
	$tbname = "c_topics ORDER BY id DESC";
	$url = "";
	$startpoint = ($page * $limit) - $limit;
	$query = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$sql = "{$query}";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){?>
	<div style="padding:10px; border-radius:10px; border:1px solid #EFEFEF; overflow:hidden;">
		<h3><?php echo $row['topic'];?></h3>
		<div><?php echo strip_tags(substr($row['content'],0,300));?>...</div>
		<div class="space"></div>
		<div style="font-size:12px;"><a href="../story-<?php echo $row['slug'];?>" target="_blank">View</a> | <?php if($row['mode'] == 0){echo "Public";}?><?php if($row['mode'] == 1){echo "Private";}?><?php if($row['mode'] == 3){echo "Group Story";}?> | <?php if($row['status'] == 0){echo "Inactive";}?><?php if($row['status'] == 1){echo "Active";}?> | By: <?php echo $row['name'];?> | <a href="edit-personal-story?id=<?php echo $row['id'];?>">Edit</a> | <a href="mint?action=delete-personal-story&id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to DELETE this story?')"><span style="font-weight:bold; color:red;">Delete</span></a></div>
	</div>
	<div style="height:5px;"></div>
	<?php }?>
<?php echo "<div align=\"center\">".pagingCustom($tlink,$page,$limit,$url,$tbname)."</div>";?>
<?php include("include/foot.php");?>