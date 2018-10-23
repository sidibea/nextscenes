<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Unit1Shop - <?php echo $db->title($title); $getMe = $db->fetchYou();?></title>
<!-- font link  -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
<!-- Bootstrap Core CSS -->
<link href="<?php echo $db->dlink();?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Morris Charts CSS -->
<link href="<?php echo $db->dlink();?>/vendor/morrisjs/morris.css" rel="stylesheet">
<!-- jvectormap CSS -->
<link href="<?php echo $db->dlink();?>/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?php echo $db->dlink();?>/css/adminnine_classic.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="<?php echo $db->dlink();?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- loader -->
<div class="loader"><h1 class="loadingtext">Unit<span>1</span>Shop</h1><p>Awesome things getting ready...</p><br><img src="img/loader2.gif" alt=""> </div>
<!-- loader ends -->
<div id="wrapper">
  <div class="navbar-default sidebar" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" > <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand">Unit1 E-Shop</a> </div>
    <div class="clearfix"></div>
    <div class="sidebar-nav navbar-collapse"> 
      <!-- user profile pic -->
      <div class="userprofile text-center">
        <div class="userpic"> <img src="uploads/<?php echo $getMe['pix'];?>" alt="" class="userpicimg"> <a href="edit-profile" class="btn btn-primary settingbtn"><i class="fa fa-gear"></i></a> </div>
        <h3 class="username"><?php echo $getMe['name'];?></h3>
        <p><?php echo $getMe['location'];?></p>
      </div>
      <div class="clearfix"></div>
      <!-- user profile pic -->
      <ul class="nav" id="side-menu">
        <li> <a href="./"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> </li>
        <li> <a href="javascript:void(0)" class="menudropdown"><i class="fa fa-cubes"></i> Inventory <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="items">All Items</a></li>
            <li><a href="new-item">Add New Item</a></li>
          </ul>
          <!-- /.nav-second-level --> 
        </li>
        <li><a href="categories"><i class="fa fa-sitemap fa-fw"></i> Categories</a></li>
        <li><a href="pages"><i class="fa fa-book fa-fw"></i> Pages</a></li>
        <li> <a href="javascript:void(0)" class="menudropdown"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="users">All Users</a> </li>
            <li> <a href="new-user">New User</a> </li>
            <li> <a href="profile">User Profile</a> </li>
            <li> <a href="edit-profile">Settings</a> </li>
          </ul>
          <!-- /.nav-second-level --> 
        </li>
        <li><a href="site-settings"><i class="fa fa-fax"></i>Shop Settings</a></li>
        <li><a href="mint?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>        
      </ul>
    </div>
    <!-- /.sidebar-collapse --> 
  </div>
  <!-- /.navbar-static-side -->
  
  <div id="page-wrapper">
    <div class="row">
      <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
        <button class="menubtn pull-left btn "><i class="glyphicon  glyphicon-th"></i></button>
        <div class="searchwarpper">
          <div class="input-group searchglobal">
            <input type="text" class="form-control" placeholder="Search for..." autofocus>
            <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
            </span> </div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <!--<li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"> <i class="fa fa-envelope fa-fw"></i> </a>
            <ul class="dropdown-menu dropdown-messages">
              <li> <a href="javascript:void(0)">
                <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <strong>John Smith</strong> <span class="pull-right text-muted"> <em>Yesterday</em> </span> </div>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>

                </a> </li>
              <li> <a class="text-center" href="javascript:void(0)"> <strong>Read All Messages</strong> <i class="fa fa-angle-right"></i> </a> </li>
            </ul>
          </li>
          <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"> <i class="fa fa-tasks fa-fw"></i> <span class="count">9+</span> </a>
            <ul class="dropdown-menu dropdown-tasks">
              <li> <a href="javascript:void(0)">
                <div>
                  <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                  </div>
                </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div>
                  <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                  </div>
                </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div>
                  <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                  </div>
                </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div>
                  <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                  </div>
                </div>
                </a> </li>
              <li> <a class="text-center" href="javascript:void(0)"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a> </li>
            </ul>
          </li>
          <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"> <i class="fa fa-bell fa-fw"></i> <span class="count">1</span> </a>
            <ul class="dropdown-menu dropdown-alerts">
              <li> <a href="javascript:void(0)">
                <div> <i class="fa fa-comment fa-fw"></i> New Comment <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <i class="fa fa-twitter fa-fw"></i> 3 New Followers <span class="pull-right text-muted small">12 minutes ago</span> </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <i class="fa fa-envelope fa-fw"></i> Message Sent <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <i class="fa fa-tasks fa-fw"></i> New Task <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
              <li> <a href="javascript:void(0)">
                <div> <i class="fa fa-upload fa-fw"></i> Server Rebooted <span class="pull-right text-muted small">4 minutes ago</span> </div>
                </a> </li>
              <li> <a class="text-center" href="javascript:void(0)"> <strong>See All Alerts</strong> <i class="fa fa-angle-right"></i> </a> </li>
            </ul>
          </li>-->
          <!-- /.dropdown -->
          <li class="dropdown"> <a class="dropdown-toggle userdd" data-toggle="dropdown" href="javascript:void(0)">
            <div class="userprofile small "> <span class="userpic"> <img src="uploads/<?php echo $getMe['pix'];?>" alt="" class="userpicimg"> </span>
              <div class="textcontainer">
                <h3 class="username"><?php echo $getMe['username'];?></h3>
                <p><?php echo $getMe['location'];?></p>
              </div>
            </div>
            <i class="caret"></i> </a>
            <ul class="dropdown-menu dropdown-user">
              <li> <a href="profile"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
              <li> <a href="edit-profile"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
              <li> <a href="mint?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
            </ul>
            <!-- /.dropdown-user --> 
          </li>
          <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links --> 
        
      </nav>
    
    <ol class="breadcrumb">
      <li><a href="javascript:void(0)">Unit1Shop</a></li>
      <li class="active"><?php echo $db->title($title);?></li>
    </ol>
    </div>
    <?php $db->showNotification();?>