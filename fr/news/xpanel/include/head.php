<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
</head>
<body>
<div class="container white">
	<div class="row">
    	<header>
			<div align="center"><a href="http://www.nextscenes.com/"><img class="herald-logo" width="20%" src="http://www.nextscenes.com/imgs/next-scenes_logo.png" alt="Nextscenes" ></a></a></div>
		</header>
    	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <!-- Menu Nav -->
        <div class="hidden-xs">
        	<div class="navli"><a href="dashboard">Dashboard</a></div>
            <div class="bigTag">Posts</div>
            <div class="navli"><a href="all-posts">All Posts</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new-post">New Post</a></div>
			<?php  $query = $db->query($db->findUser($_SESSION['username'])); $row = $db->fetch_array($query);
			if($row['role'] > 0){?>
            <div class="bigTag">Profile</div>
            <div class="navli"><a href="users">All Users</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new-user">Add New Users</a></div>
			<div style="height:5px;"></div>
			<?php }?>
            <div class="navli"><a href="edit-profile">Edit Profile</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="../action.php?action=logout">Logout</a></div>
        </div>
        <div class="visible-xs"></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">