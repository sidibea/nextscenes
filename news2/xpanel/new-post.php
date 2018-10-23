<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Create New Post</title>
<?php include("include/head.php");?>
    <h3>Create New Post</h3>
    <?php $db->required(); $db->failed(); $db->postExist(); $db->success();?>
    <form action="../action.php?action=newpost" method="post" class="e-form">
        <input type="text" name="title" value="<?php echo $_SESSION['topic']; $_SESSION['topic'] = false;?>" required="required" placeholder="Title" />
        <div class="smallSpace"></div>
        <select class="selectpicker" data-style="btn-primary" name="cat">
        	<option>Please Select A Category</option>
        	<?php $db->allCatOption();?>
        </select>
        <div class="smallSpace"></div>
        <textarea name="content"><?php echo $_SESSION['content']; $_SESSION['content'] = false;?></textarea>
        <div class="smallSpace"></div>
        <input type="submit" class="btn btn-success" value="Make Post" />
    </form>
<?php include("include/foot.php");?>