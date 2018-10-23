<?php
include('Encoding.php');
session_start();
if(empty($_SESSION['idsession'])){
	header("Location: login1");
}
	require "central/fr_functions.php";
	$user = getUser();
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
	$check = getSinglePostID($_REQUEST['id'],$id);
	if(empty($check['topic'])){
		header("location: account-activities1");
		exit;
	}
	if($check['publish'] >0){
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
<title>Nextscenes - <?php echo $result[4][$lang.'_title']; ?></title>
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result[4][$lang.'_title']; ?></h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
				<div class="twins">
                	<a href="account-activities1"><?php echo $result3[25][$lang."_".title];?></a>
                	<a href="manage-account1"><?php echo $result3[26][$lang."_".title];?></a>
                	<a href="cover1"><?php echo $result3[27][$lang."_".title];?></a>
                	<a href="messaging1">Message</a>
                	<a href="notification1">Notification</a>
                </div>
				<fieldset>
					<legend><?php echo $result3[52][$lang."_".title];?></legend>
					<?php 
						$data = is_array($check['author']) ? implode(',', $check['author']) : $check['author'];
						$mk = "SELECT * FROM c_users WHERE u_id IN (".$data.")";
						$query1 = query($mk);
						while($row1 = fetch_array($query1)){
							echo "&bull; ".$row1['u_fname']." ".$row1['u_lastname']."<br />";
						}
					?>
					</fieldset>
				<fieldset>
					<legend><?php echo $result3[53][$lang."_".title];?></legend>
					<div id="tellus">
						<?php required(); failed(); postExist(); length(); success();nmode();?>
					</div>
					<form action="mint1.php?action=newpost" method="post" class="e-form">
						<div class="c_label"><?php echo $result3[54][$lang."_".title];?></div>
						<div style="height:5px;"></div>
						<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
						<div class="btn-group" data-toggle="buttons">
						  <label class="btn btn-primary <?php if($check['mode'] == 0){echo "active";}?>">
							<input type="radio" name="mode" id="option1" value="0" autocomplete="off" <?php if($check['mode'] == 0){echo "checked";}?>>Make Public
						  </label>
						  <label class="btn btn-primary <?php if($check['mode'] == 1){echo "active";}?>"> 
							<input type="radio" name="mode" id="option2" value="1" autocomplete="off" <?php if($check['mode'] == 1){echo "checked";}?>> Make Private
						  </label>
						  <label class="btn btn-primary groupProject1 <?php if($check['mode'] == 2){echo "active";}?>">
							<input type="radio" name="mode" id="option3" value="2" autocomplete="off" <?php if($check['mode'] == 2){echo "checked";}?>> Group Story Project
						  </label>
						</div>
						<?php }else { ?>
								<div class="btn-group" data-toggle="buttons">
						  <label class="btn btn-primary <?php if($check['mode'] == 0){echo "active";}?>">
							<input type="radio" name="mode" id="option1" value="0" autocomplete="off" <?php if($check['mode'] == 0){echo "checked";}?>>Rendre publique
						  </label>
						  <label class="btn btn-primary <?php if($check['mode'] == 1){echo "active";}?>"> 
							<input type="radio" name="mode" id="option2" value="1" autocomplete="off" <?php if($check['mode'] == 1){echo "checked";}?>> Rendre privé
						  </label>
						  <label class="btn btn-primary groupProject1 <?php if($check['mode'] == 2){echo "active";}?>">
							<input type="radio" name="mode" id="option3" value="2" autocomplete="off" <?php if($check['mode'] == 2){echo "checked";}?>> Projet d'histoire de groupe
						  </label>
						</div>
						<?php } ?>	
						<span class="ginput"></span>
						<div style="clear:both;"></div>
						<div class="c_label"><?php echo $result3[55][$lang."_".title];?>:</div>
						<div style="height:5px;"></div>
						<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
									<div class="btn-group" data-toggle="buttons"> 
							<?php 
							$query = query("SELECT * FROM c_forums WHERE c_languages_l_id=1");
							$i = 1; while($rows = fetch_array($query)){?>
								<label class="btn btn-primary <?php if($check['cat'] == $rows['f_id']){echo "active";}?>">
									<input type="radio" name="category" id="option<?php echo $i;?>" value="<?php echo $rows['f_id'];?>" autocomplete="off" <?php if($check['cat'] == $rows['f_id']){echo "checked";}?>> <?php echo $rows['f_name'];?>
							    </label>
							<?php $i++;}?>
						</div><?php
								} 
								else{ ?>
									<?php 
							$query = query("SELECT * FROM c_forums WHERE c_languages_l_id=2");
							$i = 1; while($rows = fetch_array($query)){?>
								<label class="btn btn-primary <?php if($check['cat'] == $rows['f_id']){echo "active";}?>">
									<input type="radio" name="category" id="option<?php echo $i;?>" value="<?php echo Encoding::fixUTF8($rows['f_id']);?>" autocomplete="off" <?php if($check['cat'] == $rows['f_id']){echo "checked";}?>> <?php echo Encoding::toUTF8($rows['f_name']);?>
							    </label>
							<?php $i++;}
								}?>
						
						<div style="height:5px;"></div>
						<div class="c_label"><?php echo $result3[56][$lang."_".title];?>:</div>
						<div style="height:5px;"></div>
						<textarea name="content" id="ccont"><?php echo $check['content'];?></textarea>
						<div style="height:5px;"></div>
						<input type="hidden" name="links" value="<?php echo $_REQUEST['id'];?>" class="links" />
						<?php if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){ ?>
						<input type="submit" name="submitPost" class="c_btn mt10" value="Publish" /> 
						<?php } else { ?>
							<input type="submit" name="submitPost" class="c_btn mt10" value="Publier" /> 
						<?php } ?>
						<a class="c_btn mt10 savedraft" style="cursor:pointer;"><?php echo $result3[57][$lang."_".title];?></a> <span id="note"></span>
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
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
   bkLib.onDomLoaded(function() {
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  }); 
	$('.groupProject1').click(function(){
            // append goes here
			$('.ginput').html('<input type="email" name="email" class="gemail" placeholder="Enter Contributor\'s Email" /><span style="display:inline; color:#FFF; border-radius:6px; padding:6px; background:#008000; cursor:pointer;" class="gsubmit">Add User</span><span class="checkload"></span><div style="height:10px;"></div>');
    });
  $('.savedraft').click(function(){
		var links = $('.links').val();
		var content = $('.nicEdit-main').text();
		var mode = $('input[name=mode]:checked').val();
		var category = $('input[name=category]:checked').val();
		var dataString = "action=savepost&links="+links+"&content="+content+"&mode="+mode+"&cat="+category;
		$('#note').html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">');
		if(content){}else{$('#note').html('Please make sure the editor is loaded and not empty.'); throw "stop execution";}
		// AJAX Code To Submit Form.
		$.ajax({
			type: "POST",
			url: "mint.php",
			data: dataString,
			cache: false,
			dataType: 'json',
			success: function(result){
				if(result[0] == 1){
					$('#note').html('All Fields Are Required. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 2){
					$('#note').html('Post Saved! <a href="cover">Create New Story</a>. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 3){
					$('#note').html('Failed To Save Post. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 4){
					$('#note').html("You don't have a right over this post. &nbsp;&nbsp;&nbsp;&nbsp;");
				}else
				if(result[0] == 5){
					$('#note').html("You can not move out from a group story to personal story. &nbsp;&nbsp;&nbsp;&nbsp;");
				}else{
					$('#note').html('Debug: '+result[0]);
				}
			}
		});   
	});
	$(document).on('click', '.gsubmit', function () {
		var email = $('.gemail').val();
		var links = $('.links').val();
		var dataString = "action=contributorEmail&email="+email+"&link="+links;
		$('.checkload').html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">');
		if(email){}else{$('.checkload').html('Please be sure you added an email address.'); throw "stop execution";}
		// AJAX Code To Submit Form.
		$.ajax({
			type: "POST",
			url: "mint.php",
			data: dataString,
			cache: false,
			dataType: 'json',
			success: function(result){
				$('.gemail').val('');
				if(result[0] == 1){
					$('.checkload').html('All Fields Are Required. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 2){
					$('.checkload').html('You Added '+result[2]+' to your project. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 3){
					$('.checkload').html('Failed To Add User. &nbsp;&nbsp;&nbsp;&nbsp;');
				}else
				if(result[0] == 4){
					$('.checkload').html("User Does Not Exist. &nbsp;&nbsp;&nbsp;&nbsp;");
				}else
				if(result[0] == 5){
					$('.checkload').html('User is already a member of your project');
				}else
				if(result[0] == 6){
					$('.checkload').html('You don\'t have rights over this project');
				}else{
					$('#note').html('Debug: '+result[0]);
				}
			}
		});
	});
});
</script>
</body>
</html>