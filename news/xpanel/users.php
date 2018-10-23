<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || All Super Users</title>
<?php include("include/head.php");?>
    <h3>All Super Users</h3>
    <?php
		$db->success();$db->failed();
		$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
		if($page == ""){
			$page = 1;
		}
		$limit =10;
		$tlink = "users";
		$url = $db->dlink()."/xpanel";
		$startpoint = ($page * $limit) - $limit;
		$tbname = "membuser";
		$sql = "SELECT * FROM {$tbname} LIMIT {$startpoint} , {$limit}";
		$query = $db->query($sql);
		while($row = $db->fetch_array($query)){
			echo "<div class=\"boxed\">
				<strong>Username: </strong>".$db->username($row)."<br />
				<strong>Email: </strong>".$db->email($row)."<br />
				<strong>Full Name: </strong>".$db->name($row)."<br />
				<strong>Last Logged in: </strong>".$db->last_seen($row)."<br />
				<a href=\"edit-user?id=".$db->id($row)."\">Edit</a> || <a href=\"../action.php?action=deleteUser&id=".$db->id($row)."\">Delete</a> || ".$db->totalPosts($db->id($row))." Posts
			</div><div class=\"smallSpace\"></div>";
		}
		echo "<div align=\"center\">" .$db->postsPaging($tlink,$page,$limit,$url, $tbname)."</div>"
	?>
<?php include("include/foot.php");?>