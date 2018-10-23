<?php $page = "storylines"; $subpage = "new"; require "functions.php"; isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || New Storyline</title>
<?php include("include/head.php");?>
<?php
	if(isset($_POST['submit'])){
		$response = createStoryline($_POST['name'], $_POST['mssg'], $_POST['forum'],$_FILES, $_POST['owner']);
		$mssg = $response[0];
		$status = $response[1];
	}
	else{
		$mssg = "<div class='alert alert-warning'>You can create a new storyline using the form below.</div>";
	}
	echo "<p class='nom mb20 alert'>".$mssg."<p>";
?>
	<form method="post" enctype="multipart/form-data">
		<div class="spacer">
			<div class="data"><strong>Name</strong><br /><span class="tiny"><em>e.g. "The Lost Zanga"</em></span></div>
			<div class="field"><input type="text" name="name" placeholder="" class="form-control" <?php if ($status == FALSE && isset($_POST['name'])){ echo " value=\"".$_POST['name']."\""; }?> /></div>
		</div>
		<?php
		$user = getUsername($_SESSION['ev_u_name']);
		if($user['u_mod'] == 1){
			echo "
		<div class=\"spacer\">
			<div class=\"data\">Author/Writer</div>
			<div class=\"field\">
				<div class=\"left bg c2\">
				<select name=\"owner\" class=\"mw350\">";
					$mods = getModerators();  
					foreach ($mods as $mods=>$smods){
						$othernames = "";
						if($smods['u_fname'] != "" || $smods['u_lastname'] != ""){
							$othernames = " [".$smods['u_fname']." ".$smods['u_lastname']."]";
						}
						echo "
						<option value=\"".$smods['u_id']."\">".stripslashes(utf8_encode($smods['u_username'])).$othernames."</option>";
					}
					echo "
				</select>
				</div>
				<div class=\"clear\"></div>
			</div>
		</div>";
		}
		?>
		<div class="spacer">
			<div class="data"><strong>Forum</strong></div>
			<div class="field">
				<div class="left bg c2">
				<select name="forum" class="mw350">
					<?php 
						$lang = getForums();  
						foreach ($lang as $scat=>$skey){
							echo "
							<option value=\"".$skey['f_id']."\">".stripslashes(utf8_encode($skey['f_name']))." [Language: ".$skey['l_name']."]</option>";
						}
					?>
				</select>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="spacer">
			<div class="data"><strong>Featured Image</strong></div>
			<div class="field"><input type="file" name="upload" class="medium" /></div>
		</div>
		<div class="spacer">
			<div class="data mb10"><strong>Text</strong></div>
			<div class="field">
				<div class="holder">
					<div class="mw100p m5">
					<textarea name="mssg" placeholder="" class="form-control"><?php if ($status == FALSE && isset($_POST['mssg'])){ echo $_POST['mssg']; }?></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="space"></div>
		<div class="submit"><input type="submit" value="Submit" name="submit" class="btn btn-success" /></div>
	</form>
<?php include("include/foot.php");?>