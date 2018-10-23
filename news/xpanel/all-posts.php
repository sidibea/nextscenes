<?php include("include/database.php");$db->authenticate(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || View All Post</title>
<?php include("include/head.php");?>
    <h3>All Posts</h3>
    <?php
	$db->success();$db->failed();
	$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
	if($page == ""){
		$page = 1;
	}
	$limit =20;
	$tlink = "all-posts";
	$tbname = "topics ORDER BY id DESC";
	$url = $db->dlink()."/xpanel";
	$startpoint = ($page * $limit) - $limit;
	$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
	$query = $db->query($sql);
	while($row = $db->fetch_array($query)){
		echo "<div class=\"boxed\">
			<strong>".$db->topic($row)."</strong><br />
			<a href=\"edit.php?id=".$db->id($row)."\">Edit</a> || <a href=\"../action.php?action=deletePost&id=".$db->id($row)."\">Delete</a>
		</div><div class=\"smallSpace\"></div>";
	}
	echo "<div align=\"center\">" .$db->postsPaging($tlink,$page,$limit,$url,$tbname)."</div>"
?>
<?php include("include/foot.php");?>