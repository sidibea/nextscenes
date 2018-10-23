<?php $page = "scenes"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php $page = getPage($_REQUEST['id']);
	if(isset($_POST['edit'])){
		editPaged($_POST['id'], $_POST['content']);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Edit Page</title>
<?php include("include/head.php");?>
	<div class="alert alert-warning">
		<?php
			$mssg = "<span class='warning'>You are about to edit a page, please note that once edited, it can't be reversed.";
			echo "
				<div class='nom mb10 alert'>".$mssg."</div>";
			?>
	</div>
        <div class="p10">
        	<table class="w50p table nop nom">
            	<tbody>
                	<tr>
                    	<th class="w25p">Title: </th><td><?php echo $page['Title']; ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Content:</th><td class="justify">
						<form method="post" action="">
							<input type="hidden" value="<?php echo $_GET['id'];?>" name="id" />
							<textarea name="content"><?php echo $page['Descriptions'];?></textarea>
							<input type="submit" name="edit" value="Edit Page" class="alert alert-success" />
						</form>
						</td>
                	</tr>
                </tbody>
            </table>
        </div>
<?php include("include/foot.php");?>