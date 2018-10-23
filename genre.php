<?php
session_start();
function clean($str){
	return mysql_real_escape_string($str);
}
if(empty($_SESSION['idsession'])) {
	header("Location: login");
}
	require "central/functions.php";
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Genre</title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">
            	<fieldset>
					<legend>Genre</legend>
					<?php
					$query = query("SELECT * FROM c_forums WHERE c_languages_l_id=1");
						while($rows = fetch_array($query)){
						$sql = query("SELECT * FROM c_topics WHERE cat=\"".$rows['f_id']."\""); $count = num_rows($sql);?>
							<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
								<strong><a href="journal-<?php echo $rows['f_id'];?>"><?php echo $rows['f_name'];?></a></strong>
								<div style="font-size:14px;"><div style="float:left; padding:10px;"><img src="http://www.nextscenes.com/pictures/avatar.jpg" height="70" width="70" /></div><?php echo strip_tags($rows['f_desc']);?><div style="clear:both;"></div></div>
								<div style="text-align:right; font-size:12px;">Total Stories: <?php echo $count;?></div>
							</div> 
							<div style="height:5px;"></div>
					<?php }?>
				</fieldset>
			</div>
			</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
</body>
</html>