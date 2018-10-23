<?php
session_start();
if(empty($_SESSION['idsession'])){
	header("Location: login1");
}
	require "central/fr_functions.php";
	$user = getUser();
	$mid = mysql_real_escape_string($_REQUEST['id']);
	$row = getSingleID($mid, $user['u_id']);
	if(empty($row['topic'])){
		header("location: account-activities1");
		exit;
	}
	if($row['publish'] >0){
		header("location: account-activities1");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes - Create/Edit Story Description</title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Create/Edit Story Description</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
				<fieldset>
					<legend><?php echo $row['topic'];?></legend>
					<div id="tellus">
						<?php required(); failed(); success();?>
					</div>
					<form action="mint.php?action=upatepost&dir=<?php echo $mid;?>" method="post" class="e-form">
						<textarea name="content" style="width:100%; height:200px;" id="contentText"><?php echo $row['c_desc'];?></textarea>
						<div style="height:5px;"></div>
						<input type="submit" name="submitPost" class="c_btn mt10" value="Update Description" /> <span id="remain"></span> of 150 characters
					</form>
					</fieldset>
				</div>
					</div>
				</div></div>
            </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
<script type="text/javascript">
	$(document).ready(function(e){
		$('#contentText').keyup(function(e) {
			var tval = $('#contentText').val(),
				tlength = tval.length,
				set = 150,
				remain = parseInt(set - tlength);
			$('#remain').text(remain);
			if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
				$('textarea').val((tval).substring(0, tlength - 1))
			}
		});
	});
</script>
</body>
</html>