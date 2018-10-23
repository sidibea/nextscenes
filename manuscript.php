<?php
session_start();
function clean($str){
	return mysql_real_escape_string($str);
}
if(empty($_SESSION['idsession'])) {
	header("Location: login");
}
	require "central/functions.php"; 
	$slug = clean($_REQUEST['slug']);
	updateSelfStory($slug);
	$row = getSinglePosts($slug);
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $row['topic'];?></title>
<?php include("head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">
            	<fieldset>
					<legend>Manuscript For: <?php echo $row['topic'];?></legend>
					<?php echo $row['content'];?>
					<?php
					$cimp = $row['id'];
					$sql = query("SELECT * FROM c_topic_scenes WHERE c_id=\"$cimp\"");
					if(num_rows($sql)>0){
						while($rows = fetch_array($sql)){?>
							<div style="height:5px;"></div>
							<div style="height:1px; border-bottom:1px dotted #CCC;"></div>
							<div style="height:5px;"></div>
								<?php echo $rows['content'];?>
						<?php }
					}
				?>
				</fieldset>
			</div>
			</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page); ?>
</body>
</html>