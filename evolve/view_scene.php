<?php $page = "scenes"; $subpage = "view"; require "functions.php"; ?>
<?php isLoggedIn(); isPermitted($page); isScenePermitted($_GET['scene']); ?>
<?php if(isset($_POST['validate'])){ $mssg = validateIt("scene",$_POST['scene'],$_POST['type']); } else if(isset($_POST['cancel'])){ redirectIt("scene"); } else{ $catItems = checkGet("scene", $_GET['scene'], $_GET['type']); } ?>
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
			if($mssg){
			echo "
				<div class='nom mb10 alert'>".$mssg."</div>";
			}
			?>
        </div>
        <div class="p10">
        	<div class="nom mb10 vlgreybg">
            	<div class="left w30p">
                    <h3 class='alert'>
                        <span class="block_this_span">Storyline</span><?php echo stripslashes($catItems['sl_name']); ?>
                    </h3>
                    <h3 class='alert'>
                        <span class="block_this_span">Forum</span><?php echo stripslashes($catItems['f_name']); ?>
                    </h3>
                    <h3 class='alert'>
                        <span class="block_this_span">Scene</span><?php 
                        if($catItems['scene_type'] == "proposed"){
                            echo "<strong>Proposed</strong> ";
                        }
                        echo stripslashes($catItems['scene_number']); 
                        ?>
                    </h3>
                    <h3 class='alert'>
                        <span class="block_this_span">Adoption</span><?php 
                        if ($catItems['rating_count']==NULL){
                            echo "0 ratings";
                        }
                        else {
                            if($catItems['rating_count'] == 1){
                                echo "1 rating";
                            }
                            else{
                                echo "<strong>".number_format($catItems['rating_count'])." ratings</strong>";
                            }
                        }
                        echo "<br />";
                        if ($catItems['review_count']==NULL){
                            echo "0 reviews";
                        }
                        else {
                            if($catItems['review_count'] == 1){
                                echo "1 review";
                            }
                            else{
                                echo "<strong>".number_format($catItems['review_count'])." reviews</strong>";
                            }
                        }
                        ?>
                    </h3>
                </div>
                <div class="left w70p whitebg">
                	<div class="p10">
                    	<?php echo (stripslashes(utf8_encode(htmlspecialchars_decode($catItems['scene_desc'])))); ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div  class="mt10 mb20">
            	<?php
				if($catItems['scene_type'] == "proposed"){
				?>
                <form method="post" action="" class="left">
                    <input type="hidden" value="<?php echo $catItems['scene_id']; ?>" name="scene" />
                    <input type="hidden" value="<?php echo $catItems['scene_type']; ?>" name="type" />
                    <input type="submit" name="validate" value="Validate Scene" class="_btn" />
                </form>
                <form method="post" action="" class="left">
                    <input type="submit" name="cancel" value="Cancel" class="_btn" />
                </form>
                <?php
				}
				?>
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
