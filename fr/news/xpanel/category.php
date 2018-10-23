<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Categories</title>
<?php include("include/head.php");?>
    <h3>Create New Post</h3>
    <?php $db->failed(); $db->success();?>
    <form action="../action.php?action=newcat" method="post" class="e-form">
        <input type="text" name="name" required="required" placeholder="Category Name" /><input type="submit" class="btn btn-success" value="Add Category" />
    </form>
    <div style="height:15px;"></div>
    <?php 
		$qx = $db->query("SELECT * FROM nfr_cat");
		while($rx = $db->fetch_array($qx)){?>
			<div style="border:1px solid #CCC;">
            	<?php echo $rx['name'];?>
            </div>
            <div style="height:10px;"></div>
		<?php }
	?>
<?php include("include/foot.php");?>