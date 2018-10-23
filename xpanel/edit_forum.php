<?php $page = "forums"; $subpage = "edit"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<?php
if(isset($_POST['submit'])){
	$response = updateForum($_POST['name'], $_POST['mssg'],$_POST['language'], $_FILES, $_POST['cat']);
	$mssg = $response[0];
	$status = $response[1];
}
?>
<?php $catItems = checkGet("forum", $_GET['cat']); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Forum</title>
<?php include("include/head.php");?>
	<?php
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
	?>
	<div class="space"></div>
	<form method="post" enctype="multipart/form-data" action="">
		<div class="spacer">
			<div class="data">Name<br /><span class="tiny"><em>e.g. "Entertainment"</em></span></div>
			<div class="field"><input type="text" class="form-control" name="name" placeholder="" class="medium" value="<?php if($status == TRUE){ echo $_POST['name'];} else{echo $catItems['f_name'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Forum image</div>
			<div class="left w450">
				<div>
				<?php
					$catImage = findImage("forum", $_GET["cat"]);
					if ($catImage){
						echo "
						<div class=\"left w100 h100 noverflow mr10\">
							<img src=\"".$catImage."\" class=\"w100\" />
						</div>";
					}
				?>
					<div class="">
						<input type="file" name="upload" class="_btn" />
						<p class="nop nom _t"><?php echo genericUploadMssg(); ?></p>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<textarea name="mssg" placeholder="" class="form-controls"><?php if($status == TRUE){ echo $_POST['mssg'];} else{echo $catItems['f_desc'];} ?></textarea>
		<input type="hidden" name="cat" value="<?php echo $catItems['f_id'];?>" />
		<div align="center"><input type="submit" value="Update" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>