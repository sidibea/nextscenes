<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Post</title>
<?php include("include/head.php");?>
    <h3>Create New Post</h3>
    <?php $db->success(); $db->postNotExist(); $db->failed(); $db->required();?>
    <form action="../action.php?action=updatePost" method="post" class="e-form">
    	<?php $id = $db->clean($_GET['id']); $sql = $db->getPostByID($id);?>
        <input type="text" name="title" value="<?php echo $sql['topic'];?>" required="required" placeholder="Title" />
        <div class="smallSpace"></div>
        <textarea name="content"><?php echo $sql['content'];?></textarea>
        <div class="smallSpace"></div>
        <input type="hidden" name="id" value="<?php echo $db->clean($_GET['id']);?>" />
        <input type="submit" class="btn btn-success" value="Edit Post" />
    </form>
<?php include("include/foot.php");?>