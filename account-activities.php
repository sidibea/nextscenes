<?php
session_start();
if(empty($_SESSION['idsession'])) {
		header("Location: login");
}
?>
<?php
	require "central/functions.php"; 
	$page = "manage";
	$me = getUser($page);
	if(isset($_POST['password_update'])){
		if($_POST['opass'] == "" || $_POST['opass'] == NULL ||
			$_POST['pass'] == "" || $_POST['pass'] == NULL ||
			$_POST['cpass'] == "" || $_POST['cpass'] == NULL
		){
			$mmsg = "All fields are required to update your password";
		}
		else if($_POST['pass'] != $_POST['cpass']){
			$mmsg = "The passwords you entered do not match";
		}
		else{
			$mmsg = c_resetPassword($me, $_POST['opass'], $_POST['pass']);
		}
	}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Your Account Activities</title>
<meta name="description" value="By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions">
<style>
.modal::after {
  content: "";
  background: black;
  opacity: 0.5;
  top: 0;
  left: 0;
  bottom: -300px;
  right: 0;
  position: absolute;
  z-index: -1;   
}
.review{
	font-weight:bold;
}
.accepted{
	font-weight:bold;
	color:#34B475;
}
.declined{
	font-weight:bold;
	color:red;
}
</style>
<?php include("head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">					
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
						<div class="herald-mod-wrap">
							<div class="herald-mod-head herald-cat-2">
								<div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color">Your Account Activities</h2></div>
							</div>
						</div>
					<div class="row herald-posts row-eq-height">
                <div class="w100p">
        	<div class="pr20">
           		<div class="twins">
                	<a href="account-activities">Account Activities</a>
                	<a href="manage-account">User Profile</a>
                	<a href="cover">New Story</a>
                	<a href="messaging">Message</a>
                	<a href="notification">Notification</a>
                </div>
                <div class="w100p relative this_is_the_text">
				<?php success();ownError(); failed();fool();notfound();?>
					<fieldset>
                        <legend>Your Proposed Scenes</legend>
						<?php
							myScenes();
						?>
                    </fieldset>
					<fieldset>
                        <legend>Your Personal Stories</legend>
						<?php
							myStories();
						?>
                    </fieldset>
					<fieldset>
                        <legend>Your Group Stories</legend>
						<?php
							$cid = $_SESSION['idsession'];
							$cu = explode('_',$cid);
							$id = $cu[0];
							$query = query("SELECT * FROM c_topics WHERE FIND_IN_SET($id, author)>0 && mode = 2 ORDER BY id DESC");
							if(num_rows($query)>0){
								while($row = fetch_array($query)){?>
									<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px; text-align:left;">
									<div class="c_label"><strong><?php echo strtoupper($row['topic']);?></strong></div>
									<div style="clear:both;"></div>
									<div style="font-size:14px;"><?php if(empty($row['c_desc'])){echo "Please Click On <strong>Project Description</strong> Below To Add A Description";}else{echo $row['c_desc'];}?></div>
									<div class="c_label" style="font-size:12px;"><a href="story-<?php echo $row['slug'];?>">Read Storyline</a> | <a href="manuscript-<?php echo $row['slug'];?>">View As Manuscript</a> | <a href="edit-<?php echo $row['id'];?>">Project Description</a> <?php if($row['publish'] >0){}else{?>| <a href="new-story-<?php echo $row['id'];?>">Edit Storyline</a><?php }?> | <?php if($row['status'] == 0){}else{?> <?php if($row['publish'] == 0){?><button data-target="#myModal<?php echo $row['id'];?>" class="btn btn-primary btn-large" data-toggle="modal" data-backdrop="false">Publish</button> <?php }elseif($row['publish'] == 1){echo "<span class='review'>In Review</span>";}elseif($row['publish'] == 2){echo "<span class='accepted'>Accepted</span>";}else{echo "<span class='declined'>Declined</span>";} }?><font size="1"><?php if($row['status'] == 0){echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>Draft</font>";}?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mint.php?action=deleteOneLine&id=<?php echo $row['id'];?>"><span style="font-weight:bold; color:red;">Delete</span></a></div>
									<div id="myModal<?php echo $row['id'];?>" class="modal fade">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Confirmation</h4>
												</div>
												<div class="modal-body">
													<p>Are you sure you want to send <strong><?php echo strtoupper($row['topic']);?></strong> to admin for final check up and publication?</p>
													<p class="text-warning"><small>If your story meets all rules, you would be contacted via email but for now, please do check always for detail on your storyline is accepted or declined.</small></p>
													<p class="text-danger"><small>Note that you will no longer be able to edit this storyline</small></p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<a href="mint?action=publish&id=<?php echo $row['id'];?>"><button type="button" class="btn btn-primary">Publish</button></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div style="height:5px;"></div>
							<?php }
						}?>
                    </fieldset>
                </div></div></div>
					</div>
				</div>
            </div>
        </div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
</body>
</html>