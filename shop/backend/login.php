<?php include("include/database.php"); $db->authenticateLogin();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Unit1Store - Login</title>

<!-- Bootstrap Core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/adminnine_classic.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="loginpages">
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="userpic"><img src="img/default_profile.png" alt="" ></div>
        <div class="panel-body">
          <h2 class="text-center">Please Sign In</h2>
          <?php $db->showNotification();?>
          <form action="mint?action=login" method="post">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password">
              </div>
              <div class="checkbox">
                <label>
                  <input name="remember" type="checkbox" value="Remember Me">
                  Remember Me </label>
              </div>
              <br>
              <!-- Change this to a button or input when using this as a form --> 
              <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
            </fieldset>
            <br>
            <br>
            <div class="row">
              <div class="col-md-6 "> <a href="forgot">Forgot password?</a> </div>
              <div class="col-md-6  text-right"> <a href="../">Back To Shop</a> </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- jQuery --> 
<script src="vendor/jquery/jquery.min.js"></script> 

<!-- Bootstrap Core JavaScript --> 
<script src="vendor/bootstrap/js/bootstrap.min.js"></script> 
</body>
</html>