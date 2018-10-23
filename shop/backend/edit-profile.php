<?php include("include/database.php"); $db->authenticateUser(); $title = "Edit Profile"; include("include/header.php"); $me = $db->fetchYou();?>
<form action="mint?action=edit-profile" method="post" enctype="multipart/form-data">
<strong>Username:</strong>
<input type="text" name="username" value="<?php echo $me['username'];?>" class="form-control" />
<div style="height:20px;"></div>
<strong>Full Name:</strong>
<input type="text" name="name" value="<?php echo $me['name'];?>" class="form-control" />
<div style="height:20px;"></div>
<strong>Location:</strong>
<input type="text" name="location" value="<?php echo $me['location'];?>" class="form-control" />
<div style="height:20px;"></div>
<strong>Password:</strong>
<input type="password" name="password" class="form-control" placeholder="Leave blank unless you want it changed" />
<div style="height:20px;"></div>
<strong>Profile Picture</strong>(Leave blank unless you want it changed)
<input type="file" name="pix" />
<div style="height:20px;"></div>
<input type="submit" value="Update Profile" class="btn btn-success" />
</form>
<?php include("include/footer.php");?>