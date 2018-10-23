<?php $page = "forums"; $subpage = "new"; require "functions.php"; isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || New Forum</title>
<?php include("include/head.php");?>
<h1>Create New Forum</h1>
	<?php
		if(isset($_POST['submit'])){
			$response = createForum($_POST['name'], $_POST['mssg'], $_POST['language'],$_FILES);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "<div class='alert alert-success'>You can create a new forum using the form below.</div>";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
	?>
	<form method="post" enctype="multipart/form-data">
		<div class="spacer">
			<div class="data">Name<br /><span class="tiny"><em>e.g. "Entertainment"</em></span></div>
			<div class="field"><input type="text" name="name" placeholder="" class="form-control"<?php if ($status == FALSE && isset($_POST['name'])){ echo " value=\"".$_POST['name']."\""; }?> /></div>
		</div>
		<div class="spacer" style="display:none;">
			<div class="data">Forum language</div>
			<div class="field">
				<div class="left bg c2">
				<select name="language" class="mw350">
					<?php 
						$lang = languages();  
						foreach ($lang as $scat=>$skey){
							echo "
							<option value=\"".$skey['l_id']."\">".stripslashes($skey['l_name'])."</option>";
						}
					?>
				</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data">Image</div>
			<div class="field"><input type="file" name="upload" class="medium" /></div>
		</div>
		<div class="spacer">
			<div class="data mb10">Description</div>
			<div class="field">
				<div class="holder">
					<div class="mw100p m5">
					<textarea name="mssg" placeholder="" class="form-control"><?php if ($status == FALSE && isset($_POST['mssg'])){ echo $_POST['mssg']; }?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div style="height:10px;"></div>
		<div class="submit"><input type="submit" value="Submit" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>