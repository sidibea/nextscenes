<?php
session_start();
if(empty($_SESSION['idsession'])){
	header("Location: login");
}
	require "central/functions.php";
	$user = getUser();
	unset($_SESSION['links']);
	$sid = mysql_real_escape_string($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes - Contribute To Storyline</title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Contribute To Storyline</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
					<div id="tellus">
						<?php required(); failed(); length(); success();?>
					</div>
					<form action="mint.php?action=newcontribution" method="post" class="e-form">
						<div class="c_label">Story Title:</div>
						<div style="height:5px;"></div>
						<input type="text" name="title" id="ctopic" value="<?php echo $_SESSION['topic']; $_SESSION['topic'] = false;?>" required />
						<div style="height:5px;"></div>
						<div class="c_label">Write Your Content Here:</div>
						<div style="height:5px;"></div>
						<textarea name="content" id="ccont"><?php echo $_SESSION['content']; $_SESSION['content'] = false;?></textarea>
						<div style="height:5px;"></div>
						<input type="hidden" name="sid" value="<?php echo $sid;?>" />
						<input type="submit" name="submitPost" class="c_btn mt10" value="Contribute" />
					</form>
				</div>
					</div>
				</div></div>
            </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   bkLib.onDomLoaded(function() {
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  });
});
</script>
</body>
</html>