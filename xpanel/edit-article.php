<?php require "functions.php"; isLoggedIn(); $row = getSamplePost($_REQUEST['id']);?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Article</title>
<?php include("include/head.php");?>
	<form method="post" action="mint?action=editpost">
		<div class="spacer">
			<div class="data"><strong>Title</strong></div>
			<div class="field"><input type="text" value="<?php echo $row['topic'];?>" name="title" placeholder="" class="form-control" /></div>
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
		</div>
		<div class="spacer">
			<div class="data mb10"><strong>Content</strong></div>
			<div class="field">
				<div class="holder">
					<div class="mw100p m5">
					<textarea name="content" class="form-control"><?php echo $row['content'];?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="space"></div>
		<div class="submit"><input type="submit" value="Update" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>