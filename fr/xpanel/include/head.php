<meta charset="ASCII">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" />
</head>
<body>
<div class="container white">
	<div class="row">
    	<header>
			<div align="center"><a href="http://www.nextscenes.com/fr/"><img class="herald-logo" width="20%" src="http://www.nextscenes.com/imgs/next-scenes_logo.png" alt="Nextscenes" ></a></div>
		</header>
        <div align="center"><?php header('Content-Type: text/html; charset=ASCII'); $db->showNotification();?></div>
    	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <!-- Menu Nav -->
        <div class="hidden-xs">
        	<div class="navli"><a href="./">Tableau de bord</a></div>
            <div class="bigTag">Histoires</div>
            <div class="navli"><a href="histoires">Toutes les histoires</a></div>
            <div class="space1"></div>
            <div class="navli"><a href="nouvelle-histoire">Nouveau histoire</a></div>
            <div class="space1"></div>
            <div class="bigTag">Forum</div>
            <div class="navli"><a href="forums">Tous les Forums</a></div> 
            <div class="space1"></div>
            <div class="navli"><a href="nouveau-forum">Nouveau Forum</a></div>
            <div class="space1"></div>
            <div class="bigTag">Sc&egrave;nes</div>
            <div class="navli"><a href="scenes">Toutes les sc&egrave;nes</a></div>
            <div class="space1"></div>
        </div>
        <div class="visible-xs"></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">