<?php include("include/database.php"); $db->authenticateUser(); $title = "Shop Settings"; include("include/header.php"); $site = $db->ShopSettings();?>
<h1>Shop Settings</h1>
<form action="mint?action=shop-settings" method="post">
<strong>Contact Address:</strong>
<input type="text" name="address" class="form-control" value="<?php echo $site['address'];?>" required="required" />
<div style="height:10px;"></div>
<strong>Contact Line:</strong>
<input type="text" name="tel" class="form-control" value="<?php echo $site['tel'];?>" required="required" />
<div style="height:10px;"></div>
<strong>Contact Email:</strong>
<input type="email" name="email" class="form-control" value="<?php echo $site['email'];?>" required="required" />
<div style="height:10px;"></div>
<strong>Facebook:</strong>
<input type="text" name="facebook" class="form-control" value="<?php echo $site['facebook'];?>" />
<div style="height:10px;"></div>
<strong>Twitter:</strong>
<input type="text" name="twitter" class="form-control" value="<?php echo $site['twitter'];?>" />
<div style="height:10px;"></div>
<strong>Instagram:</strong>
<input type="text" name="instagram" class="form-control" value="<?php echo $site['instagram'];?>" />
<div style="height:10px;"></div>
<strong>Youtube:</strong>
<input type="text" name="youtube" class="form-control" value="<?php echo $site['youtube'];?>">
<div style="height:10px;"></div>
<input type="submit" value="Update Shop" class="btn btn-default" />
</form>
<?php include("include/footer.php");?>