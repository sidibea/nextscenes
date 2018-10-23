<?php $page = "settings"; $subpage = "password"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Update Password</title>
<style>
.data{
	font-weight:bold;
}
</style>
<?php include("include/head.php");?>
	<?php
		if(isset($_POST['submit'])){
			$response = updatePassword($_SESSION['ev_u_name'],$_POST['opass'], $_POST['npass'],$_POST['cnpass']);
			$mssg = $response[0];
			$status = $response[1];
		}
		else{
			$mssg = "You can update your evolve user settings by using the form below.";
		}
		echo "<p class='nom mb20 alert'>".$mssg."<p>";
		$theUser = getUserdetails($_SESSION['ev_u_name']);
		?>
        <form method="post">
        	<div class="spacer">
            	<div class="data">Old password<br /></span></div>
                <div class="field"><input type="password" name="opass" placeholder="" class="form-control" value="" /></div>
            </div>
        	<div class="spacer">
            	<div class="data">New password<br /></span></div>
                <div class="field"><input type="password" name="npass" placeholder="" class="form-control" value="" /></div>
            </div>
        	<div class="spacer">
            	<div class="data">Confirm new password<br /></span></div>
                <div class="field"><input type="password" name="cnpass" placeholder="" class="form-control" value="" /></div>
            </div>
            <div class="submit"><input type="submit" value="Update" name="submit" class="btn btn-success" /></div>
        </form>
<?php include("include/foot.php");?>