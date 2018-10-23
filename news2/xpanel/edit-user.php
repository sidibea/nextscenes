<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit User Details</title>
<?php include("include/head.php");?>
    <h3>Edit User Details</h3>
    <?php $db->required(); $db->failed(); $db->userExist(); $db->success();
	$id = $db->clean($_REQUEST['id']);
	$query = $db->query($db->findUserID($id));
	if($db->num_rows($query)>0){ $row = $db->fetch_array($query);?>
    <form action="../action.php?action=edituser&id=<?php echo $id;?>" method="post" class="e-form">
        <input type="text" name="username" required="required" value="<?php echo $db->username($row);?>" placeholder="Username..." />
        <div class="smallSpace"></div>
        <input type="email" name="email" required="required" value="<?php echo $db->email($row);?>" placeholder="Email..." />
        <div class="smallSpace"></div>
        <input type="text" name="name" required="required" value="<?php echo $db->name($row);?>" placeholder="Full Name..." />
        <div class="smallSpace"></div>
        <input type="password" name="password" placeholder="Password" />
        <div class="smallSpace"></div>
        <input type="submit" class="btn btn-success" value="Update User" />
    </form>
    <?php }else{echo "Please find a user to edit by using the navigation link beside you.";}?>
<?php include("include/foot.php");?>