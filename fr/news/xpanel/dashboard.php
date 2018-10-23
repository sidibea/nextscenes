<?php include("include/database.php");$db->authenticate();?>
<!DOCTYPE html>
<html>
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
<div class="space"></div>
<div class="topicCat">Blog Statistics</div>
<div style="height:25px;"></div>
<?php $tf = $db->viewTraffic();?>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#0CF; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $tf[0]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Today</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#060; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $tf[1]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">Yesterday</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#90C; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $tf[2]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Week</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#6495ed; font-size:28px; padding:20px; color:#FFF; text-align:right;"> 
		<div class="counter"><?php echo $tf[3]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Month</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#000; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $tf[4]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">1 Year</div>
	</div>
</div>
<div class="col-md-2 col-sm-4 col-xs-12">
	<div style="background:#C30; font-size:28px; padding:20px; color:#FFF; text-align:right;">
		<div class="counter"><?php echo $tf[5]?></div>
		<div style="border-bottom:1px solid #FFF;"></div>
		<div style="font-size:18px;">All Time</div>
	</div>
</div>
<div class="clearfix"></div>
<div style="height:20px;"></div>

<?php include("include/foot.php");?>