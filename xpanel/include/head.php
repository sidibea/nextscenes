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
.clearfix{
	clear:both;
}
</style>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
</head>
<body>
<div class="container white">
	<div class="row">
    	<header>
			<div align="center"><a href="http://www.nextscenes.com/"><img class="herald-logo" width="20%" src="http://www.nextscenes.com/imgs/next-scenes_logo.png" alt="Nextscenes" ></a></div>
		</header>
    	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <!-- Menu Nav -->
        <div class="hidden-xs">
        	<div class="navli"><a href="./">Dashboard</a></div>
			<?php if($_SESSION['ev_u_auth'] == 1){?>
            <div class="bigTag">Forums</div>
            <div class="navli"><a href="forums">All Forums</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new_forums">Add New Forum</a></div>
            <div class="bigTag">Storylines</div>
            <div class="navli"><a href="storylines">All Storylines</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new_storyline">Add New Storyline</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="scenes">Scenes</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="articles">Articles</a></div>
            <div class="bigTag">Personal Storylines</div>
            <div class="navli"><a href="personal">All Stories</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="pending">Pending</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="approved">Approved</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="declined">Declined</a></div>
			<div style="height:5px;"></div>
            <div class="bigTag">Moderators</div>
            <div class="navli"><a href="moderators">All Moderators</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new_moderator">Add New Moderator</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="users">Users</a></div>
			<div class="bigTag">Edit Pages</div>
            <div class="navli"><a href="page?id=1">Principles</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="page?id=2">How It Works</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="page?id=3">FAQ</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="page?id=4">Privacy</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="page?id=5">Terms Of Use</a></div>
			<div style="height:5px;"></div>
			<?php }elseif($_SESSION['ev_u_auth'] == 2){?>
            <div class="bigTag">Storylines</div>
            <div class="navli"><a href="storylines">All Storylines</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="new_storyline">Add New Storyline</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="scenes">Scenes</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="articles">Articles</a></div>
            <div class="bigTag">Personal Storylines</div>
            <div class="navli"><a href="personal">All Stories</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="pending">Pending</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="approved">Approved</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="declined">Declined</a></div>
			<div style="height:5px;"></div>			
			<?php }elseif($_SESSION['ev_u_auth'] == 3){?>
            <div class="bigTag">Storylines</div>
            <div class="navli"><a href="storylines">All Storylines</a></div>
			<div style="height:5px;"></div>
			<?php }?>
            <div class="bigTag">Settings</div>
            <div class="navli"><a href="settings">Edit Profile</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="password-change">Update Password</a></div>
			<div style="height:5px;"></div>
            <div class="navli"><a href="?doLogout=true">Logout</a></div>
        </div>
        <div class="visible-xs"></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">