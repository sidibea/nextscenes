<?php
session_start();
function clean($str){
	return mysql_real_escape_string($str);
}
if(empty($_SESSION['idsession'])) {
	header("Location: login1");
}
	require "central/fr_functions.php";
	$cid = $_SESSION['idsession'];
	$cu = explode('_',$cid);
	$id = $cu[0];
?>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - Notifications</title>
<?php include("fr_head.php");?>
	<div class="herald-section container ">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			<div class="row">
				<div class="twins">
                	<a href="account-activities1"><?php echo $result3[25][$lang."_".title];?></a>
                	<a href="manage-account1"><?php echo $result3[26][$lang."_".title];?></a>
                	<a href="cover1"><?php echo $result3[27][$lang."_".title];?></a>
                	<a href="messaging1">Message</a>
                	<a href="notification1">Notification</a>
                </div>
            	<fieldset>
					<legend>Notifications</legend>
					<?php
						$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
							if($page == ""){
								$page = 1;
							}
							$startpoint = ($page * $limit) - $limit;
							$limit =20;
							$url = "http://www.nextscenes.com/";
							$sql = "notifications WHERE owner=\"$id\" ORDER BY date DESC LIMIT {$startpoint}, {$limit}";
						$query = query("SELECT * FROM {$sql}");
						if(num_rows($query)>0){
							while($row = fetch_array($query)){
								if($row['status'] == "0"){$st1 = "<strong>"; $st2 = "</strong>";}
							?>
								<div style="border:1px solid #ECECEC; border-radius:15px; padding:10px;">
									<a href="<?php echo $row['slug'];?>"><?php echo $st1.$row['title'].$st2;?></a>
								</div>
							<?php }
						}else{
							echo '<div align="center"><em>'.$result3[48][$lang."_".title].'</em></div>';
						}
						echo "<div align=\"center\">".paging("notification", $page, $limit, $url, $sql)."</div>";
					?>
				</fieldset>
			</div>
			</div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>