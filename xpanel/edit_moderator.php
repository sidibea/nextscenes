<?php require "functions.php"; $page = "moderators"; $subpage = "edit"; isLoggedIn(); ?>
<?php
if(isset($_POST['submit'])){
	$response = updateModerator($_POST['name'], $_POST['fname'], $_POST['lname'], $_POST['language'], $_POST['siteuser'], $_POST['email'], $_POST['permission'],$_FILES["upload"], $_POST['cat']);
	$mssg = $response[0];
	$status = $response[1];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Moderator</title>
<style>
.data{
	font-weight:bold;
}
</style>
<?php include("include/head.php");?>
	<?php
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
	?>
	<form method="post" enctype="multipart/form-data">
		<div class="spacer">
			<div class="data">Username</div>
			<div class="field"><input type="text" name="name" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['name'];} else{echo $catItems['u_username'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Role</div>
			<div class="field">
				<div class="left bg c2">
				<select name="permission" class="select">
					<option value="0">Revoke extended rights (Make a normal user)</option>
					<option value="3"<?php if($catItems['u_mod'] == 3){ echo " selected=\"selected\"";} ?>>Moderator</option>
					<option value="2"<?php if($catItems['u_mod'] == 2){ echo " selected=\"selected\"";} ?>>Editor</option>
					<option value="1"<?php if($catItems['u_mod'] == 1){ echo " selected=\"selected\"";} ?>>Administrator (Same rights as site owner)</option>
				</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data">Site user type</div>
			<div class="field">
				<div class="left bg c2">
				<select name="siteuser" class="mw350">
					<option value="1"<?php if($catItems['c_usertypes_ut_id'] == 1){ echo " selected=\"selected\"";} ?>>Regular user</option>
					<option value="2"<?php if($catItems['c_usertypes_ut_id'] == 2){ echo " selected=\"selected\"";} ?>>Power user</option>
				</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data">Language</div>
			<div class="field">
				<div class="left bg c2">
				<select name="language" class="mw350">
					<?php 
						$lang = languages();  
						foreach ($lang as $scat=>$skey){
							echo "
							<option value=\"".$skey['l_id']."\""; if($skey['l_id'] == $catItems['c_languages_l_id']){ echo " selected=\"selected\"";} echo ">".stripslashes($skey['l_name'])."</option>";
						}
					?>
				</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data">Image</div>
			<div class="left w450">
				<div class="bg c5 vlgreybg h100 noverflow p10 w420">
				<?php
					$catImage = findImage("moderator", $_GET["cat"]);
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
		<div class="spacer">
			<div class="data">First name</div>
			<div class="field"><input type="text" name="fname" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['fname'];} else{echo $catItems['u_fname'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Surname</div>
			<div class="field"><input type="text" name="lname" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['lname'];} else{echo $catItems['u_lastname'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Email</div>
			<div class="field"><input type="text" name="email" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['email'];} else{echo $catItems['u_email'];} ?>" /></div>
		</div>
		<input type="hidden" name="cat" value="<?php echo $catItems['u_id'];?>" />
		<div class="space"></div>
		<div class="submit"><input type="submit" value="Update" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>