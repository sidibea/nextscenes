<?php
require "functions.php"; isLoggedIn();
	$check = getSinglePostID($_REQUEST['id']);
	if(empty($check['topic'])){
		header("location: personal");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit: <?php echo $check['topic'];?></title>
<?php include("include/head.php");?>
<h1>Edit: <?php echo $check['topic'];?></h1>
<form action="mint.php?action=edit-personal-story&id=<?php echo $_REQUEST['id'];?>" method="post" class="e-form">
	<span class="ginput"></span>
	<div style="clear:both;"></div>
	<div class="c_label">Click To Select A Category:</div>
	<div style="height:5px;"></div>
	<div class="btn-group" data-toggle="buttons"> 
		<?php 
		$query = mysql_query("SELECT * FROM c_forums WHERE c_languages_l_id=1");
		$i = 1; while($rows = mysql_fetch_array($query)){?>
			<label class="btn btn-primary <?php if($check['cat'] == $rows['f_id']){echo "active";}?>">
				<input type="radio" name="category" id="option<?php echo $i;?>" value="<?php echo $rows['f_id'];?>" autocomplete="off" <?php if($check['cat'] == $rows['f_id']){echo "checked";}?>> <?php echo $rows['f_name'];?>
			</label>
		<?php $i++;}?>
	</div>
	<div style="height:5px;"></div>
	<div class="c_label">Edit Content Here:</div>
	<div style="height:5px;"></div>
	<textarea name="content" id="ccont" class="form-control"><?php echo $check['content'];?></textarea>
	<div style="height:5px;"></div>
	<input type="hidden" name="links" value="<?php echo $_REQUEST['id'];?>" class="links" />
	<input type="submit" name="submitPost" class="btn btn-success" value="Save Story" /> 
</form>
<?php include("include/foot.php");?>