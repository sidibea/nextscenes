<?php $page = "index"; require "functions.php"; isLoggedIn();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Dashboard</title>
<style>
.space{
	height:10px;
}
.topicCat{
	border-bottom:#6495ed 2px solid;
	padding: 5px;
	color: #000;
	text-transform: uppercase;
	font-weight: bolder;
	font-size: 18px;
	font-family: 'Playfair Display', serif;
}
</style>
<?php include("include/head.php");?>
	<!--	Blog Review	-->
		<?php 
		$date = date('Y-m-d', strtotime("today"));
        $sq2 = mysql_query("SELECT * FROM country WHERE date=\"$date\" ORDER BY hits DESC");
        $ref2 = mysql_query("SELECT * FROM ref WHERE date=\"$date\" ORDER BY hits DESC");
        //Get data for today
        $query = mysql_query("SELECT * FROM traffic WHERE date=\"$date\"");
        $rs = mysql_fetch_array($query);
		$today = $rs['count'];
		//Get data for yesterday
		$dd = date('Y-m-d', strtotime("-1 day"));
		$query1 = mysql_query("SELECT * FROM traffic WHERE date=\"$dd\" ORDER BY oid");
		$ry = mysql_fetch_array($query1);
		$yesterday = $ry['count'];
		//Get data for Last Seven days
		$ddw = date('Y-m-d', strtotime("-1 week"));
		$sev = 0;
		$query2 = mysql_query("SELECT * FROM traffic WHERE date ='".$ddw."'");
		if($query2){
			while($rw = mysql_fetch_array($query2)){
				$sev += $rw['count'];
			}
		}			//Get data for Last month
		$ddx = date('Y-m-d', strtotime("-1 month"));
		$mon = 0;
		$query3 = mysql_query("SELECT * FROM traffic WHERE date='".$ddx."' ORDER BY oid DESC");
		while($rx = mysql_fetch_array($query3)){
			$mon += $rx['count'];
		}
		//Get data for One year
		$ddz = date('Y-m-d', strtotime("-1 year"));
		$yer = 0;
		$query4 = mysql_query("SELECT * FROM traffic WHERE date='".$ddz."' ORDER BY oid DESC");
		while($rz = mysql_fetch_array($query4)){
			$yer += $rz['count'];
		}
	//Get data for All Time
		$query5 = mysql_query("SELECT * FROM traffic ORDER BY oid DESC");
		$rp = mysql_fetch_array($query5);
		$query6 = mysql_query("SELECT * FROM traffic ORDER BY oid ASC");
		$rp6 = mysql_fetch_array($query6);
		$dbx = $rp['date'];
		$dbx6 = $rp6['date'];
		$all = 0;
		$query5 = mysql_query("SELECT * FROM traffic WHERE date BETWEEN '".$dbx6."' AND '".$dbx."' ORDER BY oid DESC");
		while($rz1 = mysql_fetch_array($query5)){
			$all += $rz1['count'];
		}
		$ddm = "";
		while($hits = mysql_fetch_array($ref2)){
		   $ddm .= "<strong> ".$hits['name'].": ".$hits['hits']."(".round($hits['hits']/$rs['count']*100, 2)."%)</strong> || ";
		}
			
	//	Site Review	-->
		
		$date = date('Y-m-d', strtotime("today"));
        $sq2 = mysql_query("SELECT * FROM tcountry WHERE date=\"$date\" ORDER BY hits DESC");
        $ref2 = mysql_query("SELECT * FROM refs WHERE date=\"$date\" ORDER BY hits DESC");
        //Get data for today
        $query = mysql_query("SELECT * FROM ttraffic WHERE date=\"$date\"");
        $rs = mysql_fetch_array($query);
		$today1 = $rs['count'];
		//Get data for yesterday
		$dd = date('Y-m-d', strtotime("-1 day"));
		$query1 = mysql_query("SELECT * FROM ttraffic WHERE date=\"$dd\" ORDER BY oid");
		$ry = mysql_fetch_array($query1);
		$yesterday1 = $ry['count'];
		//Get data for Last Seven days
		$ddw = date('Y-m-d', strtotime("-1 week"));
		$sev1 = 0;
		$query2 = mysql_query("SELECT * FROM ttraffic WHERE date ='".$ddw."'");
		if($query2){
			while($rw = mysql_fetch_array($query2)){
				$sev1 += $rw['count'];
			}
		}			//Get data for Last month
		$ddx = date('Y-m-d', strtotime("-1 month"));
		$mon1 = 0;
		$query3 = mysql_query("SELECT * FROM ttraffic WHERE date='".$ddx."' ORDER BY oid DESC");
		while($rx = mysql_fetch_array($query3)){
			$mon1 += $rx['count'];
		}
		//Get data for One year
		$ddz = date('Y-m-d', strtotime("-1 year"));
		$yer1 = 0; 
		$query4 = mysql_query("SELECT * FROM ttraffic WHERE date='".$ddz."' ORDER BY oid DESC");
		while($rz = mysql_fetch_array($query4)){
			$yer1 += $rz['count'];
		}
        //Get data for All Time
		$query5 = mysql_query("SELECT * FROM ttraffic ORDER BY oid DESC");
		$rp = mysql_fetch_array($query5);
		$query6 = mysql_query("SELECT * FROM ttraffic ORDER BY oid ASC");
		$rp6 = mysql_fetch_array($query6);
		$dbx = $rp['date'];
		$dbx6 = $rp6['date'];
		$all1 = 0;
		$query5 = mysql_query("SELECT * FROM ttraffic WHERE date BETWEEN '".$dbx6."' AND '".$dbx."' ORDER BY oid DESC");
		while($rz1 = mysql_fetch_array($query5)){
			$all1 += $rz1['count'];
		}
		$ddm1 = "";
		while($hits = mysql_fetch_array($ref2)){
			$ddm1 .= "<strong> ".$hits['name'].": ".$hits['hits']."(".round($hits['hits']/$rs['count']*100, 2)."%)</strong> || ";
		}?>
<div class="topicCat">Website Review</div>
<div style="height:25px;"></div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#0CF; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo countStories();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Storylines</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#060; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo countForums();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Forums</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#90C; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo countValidScenes();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Valid</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#6495ed; font-size:28px; padding:20px; color:#FFF; text-align:right;"> 
		<div class="counter"><?php echo countProposedScenes();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Proposed</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#969; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo countPersonalStories();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Personal</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#000; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo countUsers();?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Users</div>
	</div>
</div>
<div class="clearfix"></div>
<div style="height:20px;"></div>
<div class="topicCat">Website Traffic Count</div>
<div style="height:25px;"></div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#666; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $today1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Today</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#303; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $yesterday1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Yesterday</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#969; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $sev1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Week</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#000; font-size:28px; padding:20px; color:#FFF; text-align:right;"> 
		<div class="counter"><?php echo $mon1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Month</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#90C; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $yer1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Year</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#6495ed; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $all1;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">All</div>
	</div>
</div>
<div class="clearfix"></div>
<div style="height:20px;"></div>
<div class="topicCat">Blog Traffic Count</div>
<div style="height:25px;"></div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#060; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $today;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Today</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#0CF; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $yesterday;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Yesterday</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#000; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $sev;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Week</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#969; font-size:28px; padding:20px; color:#FFF; text-align:right;"> 
		<div class="counter"><?php echo $mon;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Month</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#6495ed; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $yer;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Year</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#90C; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $all;?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">All</div>
	</div>
</div>
<div class="clearfix"></div>
<div style="height:20px;"></div> 
<div class="topicCat">Latest Users</div>
<div style="height:25px;"></div>
<?php $user = findThem(6);
	foreach($user as $use){?>
		<div class="col-md-4 col-sm-6 col-xs-6">
			<img src="<?php echo $use['u_avatar'];?>" style="height:50px; width:50px; padding:10px; float:left;" />
			<strong><?php echo $use['u_username'];?></strong><br />
			<div style="font-size:14px;">Last Seen: <?php echo $use['u_lastvisit'];?></div>
		</div>
<?php }?>
<div style="clear:both;"></div>
<div style="height:20px;"></div>
<div class="topicCat">Website Traffic Source</div>
<div style="height:25px;"></div>
<?php echo $ddm1;?>
<div style="height:20px;"></div>
<div class="topicCat">Blog Traffic Source</div>
<div style="height:25px;"></div>
<?php echo $ddm;?>
<div style="height:20px;"></div>

<?php include("include/foot.php");?>