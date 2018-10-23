<?php $page = "storylines"; $subpage = "edit"; require "functions.php"; isLoggedIn(); if(isset($_POST['submit'])){
	$response = updateStoryline($_POST['name'], $_POST['mssg'],$_POST['forum'], $_FILES, $_POST['cat']);
	$mssg = $response[0];
	$status = $response[1];
}
$catItems = checkGet("storyline", $_GET['cat']); $user = getUsername($_SESSION['ev_u_name']); //if($catItems['c_users_u_id'] != $user['u_id']){ header("Location: my_storylines"); }?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Storyline</title>
<?php include("include/head.php");?>
<?php echo "<p class='alert-warning'>".$mssg."<p>";?>
	<form method="post" enctype="multipart/form-data">
		<div class="spacer">
			<div class="data"><strong>Name</strong><br /><span class="tiny"><em>e.g. "The Long Road Home"</em></span></div>
			<div class="field"><input type="text" name="name" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['name'];} else{echo $catItems['sl_name'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data"><strong>Forum</strong></div>
			<div class="field">
				<div class="left bg c2">
				<select name="forum" class="mw350">
					<?php 
						$lang = getForums();
						foreach ($lang as $scat=>$skey){
							echo "
							<option value=\"".$skey['f_id']."\""; if($skey['f_id']==$catItems['c_forums_f_id']){ echo " selected=\"selected\"";} echo">".stripslashes(utf8_encode($skey['f_name']))." [Language: ".$skey['l_name']."]</option>";
						}
					?>
				</select>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data"><strong>Featured Image</strong></div>
			<div class="left w450">
				<div class="bg c5 vlgreybg h100 noverflow p10 w420">
				<?php
					$catImage = findImage("storyline", $_GET["cat"]);
					if ($catImage != 0){
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
		<div class="spacer">
			<div class="data mb10"><strong>Description</strong></div>
			<div class="field">
				<div class="holder">
					<div class="mw100p m5">
					<textarea name="mssg" placeholder="" class="form-control"><?php if($status == TRUE){ echo $_POST['mssg'];} else{echo stripslashes(utf8_encode($catItems['sl_desc']));} ?></textarea>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="cat" value="<?php echo $catItems['sl_id'];?>" />
		<div class="space"></div>
		<div class="submit"><input type="submit" value="Update" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>