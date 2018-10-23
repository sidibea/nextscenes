<?php include("include/database.php"); $db->authenticateUser(); $title = "All Users"; include("include/header.php"); $users = $db->getUsers();?>
<h1>All Users</h1>
<!-- /.row -->
<div class="row">
<?php foreach($users as $user){ $color = array("blue", "yellow", "red", "green");?>
	<div class="col-lg-3 col-md-4 col-sm-6">
        <div class="panel panel-<?php echo $color[array_rand($color)];?> userlist">
          <div class="panel-body text-center">
            <div class="userprofile">
              <div class="userpic"> <img src="uploads/<?php echo $user['pix'];?>" alt="" class="userpicimg"> </div>
              <h3 class="username"><?php echo $user['name'];?></h3>
              <p><?php echo $user['location'];?></p>
            </div>
            <p><a href="mailto:<?php echo $user['email'];?>"><?php echo $user['email'];?></a></p>
            <div class="socials tex-center"> <a href="#" class="btn btn-circle btn-primary "><i class="fa fa-facebook"></i></a> <a href="#" class="btn btn-circle btn-danger "><i class="fa fa-google-plus"></i></a> <a href="#" class="btn btn-circle btn-info "><i class="fa fa-twitter"></i></a> <a href="#" class="btn btn-circle btn-warning "><i class="fa fa-envelope"></i></a> </div>
          </div>
          <div class="panel-footer"> <a href="#" class="btn btn-link">Connect</a> <a href="#" class="btn btn-link pull-right favorite"><i class="fa fa-heart-o"></i></a> </div>
        </div>
      </div>
      <!-- /.col-lg-3 col-md-4 -->
<?php }?>
</div>
<?php include("include/footer.php");?>