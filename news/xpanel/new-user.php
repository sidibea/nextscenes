<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Create New User</title>
<?php include("include/head.php");?>
    <h3>Create New User</h3>
    <?php $db->required(); $db->failed(); $db->userExist(); $db->success();?>
    <form action="../action.php?action=newuser" method="post" class="e-form">
        <input type="text" name="username" required="required" placeholder="Username..." />
        <div class="smallSpace"></div>
        <input type="email" name="email" required="required" placeholder="Email..." />
        <div class="smallSpace"></div>
        <input type="text" name="name" required="required" placeholder="Full Name..." />
        <div class="smallSpace"></div>
        <input type="password" name="password" required="required" placeholder="Password" />
        <div class="smallSpace"></div>
        <select name="role" class="form-control">
			<option value="4">Administrator</option>
			<option value="0">Editor</option>
		</select>
        <div class="space"></div>
        <input type="submit" class="btn btn-success" value="Add New User" />
    </form>
<?php include("include/foot.php");?>