<?php $page = "forums"; $subpage = "delete"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); ?>
<?php if(isset($_POST['trash'])){ $trash = trashIt("forum",$_POST['cat']); } else if(isset($_POST['cancel'])){ redirectIt("forum"); } else{ $catItems = checkGet("forum", $_GET['cat']); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo siteName($page, $subpage); ?></title>
<link href="stylee/stylee.css" type="text/css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php require "plugins/tinymce_simple.php"; ?>
</head>

<body>

<div class="main">
    <div class="nav">
        <div class="pt10">
        	<?php echo siteVersion(); ?>
        </div>
        <div class="clear ptb10"></div>
        <?php echo generateMenu($page, $subpage); ?>
    </div>
    <div class="content">
    	<?php echo generateHeader(); ?>
    	<div class="clear"></div>
        
		<?php if(!isset($_POST['trash'])){ ?>
        <div class="plr10 bbvg pb10">
        	<?php
			$mssg = "<span class='warning'>You are about to delete the \"".$catItems['f_name']."\" forum. <br />This means the forum, along with all storylines and scenes belonging to it, will be deleted.</span> Click 'Delete' to complete or 'Cancel' to stop.";
			echo "
				<div class='nom mb10 alert'>".$mssg."</div>";
			?>
        </div>
        <div class="p10">
        	<table class="w50p table nop nom">
            	<tbody>
                	<tr>
                    	<th class="w25p">Name</th><td><?php echo stripslashes($catItems['f_name']); ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Description</th><td><?php echo stripslashes($catItems['f_desc']); ?></td>
                	</tr>
                    <tr>
                        <th class="w25p">Adoption</th><td><?php 
						if ($key['story_count']==NULL){
							echo "0 storylines";
						}
						else {
							if($key['story_count'] == 1){
								echo "1 storyline";
							}
							else{
								echo number_format($key['story_count'])." storylines";
							}
						}
						echo "<br />";
						if ($catItems['validated_scenes']==NULL){
							echo "0 validated scenes";
						}
						else {
							if($catItems['validated_scenes'] == 1){
								echo "1 validated scenes";
							}
							else{
								echo number_format($catItems['validated_scenes'])." validated scenes";
							}
						}
						echo "<br />";
						if ($catItems['proposed_scenes']==NULL){
							echo "0 proposed scenes";
						}
						else {
							if($catItems['proposed_scenes'] == 1){
								echo "1 proposed scenes";
							}
							else{
								echo number_format($catItems['proposed_scenes'])." proposed scenes";
							}
						}
						?></td>
                    </tr>
                </tbody>
            </table>
            <div  class="mt10 mb20">
                <form method="post" action="" class="left">
                    <input type="hidden" value="<?php echo $catItems['f_id']; ?>" name="cat" />
                    <input type="submit" name="trash" value="Delete" class="_btn" />
                </form>
                <form method="post" action="" class="left">
                    <input type="submit" name="cancel" value="Cancel" class="_btn" />
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <?php } 
		else{
			echo "
			<div class=\"plr10 bbvg pb10\">
				<div class='nom mb10 alert'>".$trash."</div>
			</div>";
		}?>
        
    </div>
</div>
<?php ?>
</body>
</html>
