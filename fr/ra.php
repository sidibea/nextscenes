

<?php include("xpanel/include/database.php");
 

 
    // If the values are posted, insert them into the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
	$email = $_POST['email'];
        $password = $_POST['password'];
 
        $query = "INSERT INTO `c_users` (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }
    ?>





 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 <link rel="stylesheet" href="css/reg.css" >
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





 
	     <form>     

		 <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
Complete Code of Register.php



<div class="container">
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please Register</h2>
        <div class="input-group">
		
<fieldset>
						<div class="form-group">
							<input type="text" class="form-control" name="fname" placeholder="First Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="lname" placeholder="Last Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="retypepassword" placeholder="Retype Password">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="Email">
						</div>
						<div class="form-group">
							<button class="tg-btn tg-btn-lg" type="submit">Register Now</button>
						</div>




  </form>










