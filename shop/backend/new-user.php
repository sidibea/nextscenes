<?php include("include/database.php"); $db->authenticateUser(); $title = "Add New Admin"; include("include/header.php");?>
<h1>Add New Administrator</h1>
<form action="mint?action=new-user" method="post">
<strong>Username:</strong>
<input type="text" name="username" class="form-control" placeholder="Username For Incoming Administrator" />
<div style="height:20px;"></div>
<strong>Full Name:</strong>
<input type="text" name="name" class="form-control" placeholder="Enter Full Name Here" />
<div style="height:20px;"></div>
<strong>Email:</strong>
<input type="email" name="email" class="form-control" placeholder="Email Address" />
<div style="height:20px;"></div>
<strong>Location:</strong>
<input type="text" name="location" class="form-control" placeholder="Ex: Lagos, Nigeria" />
<div style="height:20px;"></div>
<strong>Password:</strong>
<input type="password" name="password" class="form-control" placeholder="Password For Incoming Administrator" />
<div style="height:20px;"></div>
<input type="submit" value="Submit" class="btn btn-default" />
</form>
<?php include("include/footer.php");?>