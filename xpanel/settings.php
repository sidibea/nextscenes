<?php $page = "settings"; $subpage = "all"; require "functions.php"; ?>
<?php isLoggedIn();// isPermitted($page); ?>
<?php $catItems = checkGet("settings", $_SESSION['ev_u_name']); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Settings</title>
<style>
.left{
	float:left;
	padding-right:10px;
}
</style>
<?php include("include/head.php");?>
<?php
	if(isset($_POST['submit'])){
		$response = updateSelf($_POST['fname'], $_POST['lname'], $_POST['uname'], $_POST['email'], $_POST['fb'], $_POST['ig'], $_POST['li'], $_POST['tw']);
		$mssg = $response[0];
		$status = $response[1];
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
	}
	?>
	<form method="post">
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
		<div class="spacer">
			<div class="data">Username</div>
			<div class="field"><input type="text" name="uname" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['uname'];} else{echo $catItems['u_username'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Facebook <br /><span class="tiny"><em>(URL or Username)</em></span></div>
			<div class="field"><input type="text" name="fb" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['fb'];} else{echo $catItems['us_fb'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Instagram <br /><span class="tiny"><em>(URL or Username)</em></span></div>
			<div class="field"><input type="text" name="ig" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['ig'];} else{echo $catItems['us_ig'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Linkedin <br /><span class="tiny"><em>(URL)</em></span></div>
			<div class="field"><input type="text" name="li" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['li'];} else{echo $catItems['us_li'];} ?>" /></div>
		</div>
		<div class="spacer">
			<div class="data">Twitter <br /><span class="tiny"><em>(Username)</em></span></div>
			<div class="field"><input type="text" name="tw" placeholder="" class="form-control" value="<?php if($status == TRUE){ echo $_POST['tw'];} else{echo $catItems['us_tw'];} ?>" /></div>
		</div>
		<div class="submit"><input type="submit" value="Update" name="submit" class="_btn" /></div>
	</form>
<?php include("include/foot.php");?>