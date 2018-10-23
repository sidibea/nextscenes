<?php require "functions.php"; isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || All Article</title>
<?php include("include/head.php");?>
	<h3>All Articles</h3>
	<div style="text-align:right; padding-right:20px;"><a href="new-article">New Article++</a></div>
    <?php
	success();failed();
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =20;
	$tlink = "articles";
	$tbname = "articles ORDER BY id DESC";
	$url = $_SERVER['HTTP_HOST']."/xpanel";
	$startpoint = ($page * $limit) - $limit;
	$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$query = mysql_query($sql);
	while($row = mysql_fetch_array($query)){
		echo "<div class=\"boxed\">
			<strong>".$row['topic']."</strong><br />
			<a href=\"edit-article?id=".$row['id']."\">Edit</a> || <a href=\"mint?action=deletePost&id=".$row['id']."\">Delete</a>
		</div><div class=\"smallSpace\"></div>";
	}
	echo "<div align=\"center\">" .paging($tlink,$page,$limit,$url,$tbname)."</div>"
?>
<?php include("include/foot.php");?>