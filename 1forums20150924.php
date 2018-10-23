<?php include'includes/global.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : All Forums</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>
<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	/*
	li{
		padding:4px;
		margin-bottom:3px;
	
		list-style:none;}
		
	ul{margin:6px;
	padding:0px;}	 */
	
</style> 
</head>
<body>

	<!-- Start Header -->
	<header id="header">
		
		<!-- Start Header -->
	
       <?php include 'date-subheader.php' ; ?> 
        

		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note">All Forums</div>
		<div class="site-map">
    	You are here : <a href="index.html">Home</a> &gt; <strong>Forums</strong>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
        
        
        <?php

	$mon_url = $_SERVER['REQUEST_URI'] ;
     $urlGet = explode("?",$mon_url);

 	$tableName1="forums";
	$tableName="forums";		
	$targetpage = "" ;
	$limit = 10; 
	
	$query = 'SELECT COUNT(*)  as id FROM '.$tableName.' ORDER BY id DESC ';
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['id'];
		
	
	$stages = 3;
	@$page = mysql_escape_string(intval($_GET['page']));
	
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}
		
			
	
    // Get page data
	$query1 = 'SELECT * FROM '.$tableName.' ORDER BY Title ASC  LIMIT '.$start.', '.$limit.'';// WHERE date <= "'.$datelocal.'" DESC limit 0,1		
	//$query1 = 'SELECT * FROM '.$tableName.' WHERE position="ph" ORDER BY idnews DESC  LIMIT '.$start.', '.$limit.''; // WHERE CURRENT_DATE BETWEEN date AND date2  
	$result = mysql_query($query1);
	
while($data1 =mysql_fetch_assoc($result)){
echo '
<div class="blog-box">';
  if(empty($data1['Filename']))  { echo '<img src="pictures/avatar.jpg" alt="">'; } else { echo '<img src="/image.php?width=275&height=300&cropratio=3:2&image=/pictures/'.$data1['Filename'].'" alt="">'; }
				
				 
				echo' <div class="blog-text">
					<h4>'.ucfirst(html_entity_decode(coupechaine($data1['Title'], 100))).'</h4>
					<div class="border"></div>
					<div class="post-meta">
						<div class="post-comment">'.$data1['storylines'].' Story Line(s)</div>
						<!--<div class="post-date">Date Created : '.$data1['DateCreate'].'</div>-->
						<div class="clear"></div>
					</div>
					<div class="post-text">'.ucfirst(html_entity_decode(coupechaine($data1['Descriptions'], 350))).'</div>';
					
  if(empty($_SESSION['idsession']))  // Si Idsession est vide
   { echo ' <a href="connexion.php">Enter this forum</a>'; } // Se connecter
    else {  if($data1['storylines']=='0') // sinon id session n'est pas vide mais si la variable scene egale a 0
	{ echo ' <div class="blog-text2"><a href="#">Inactive Forum</a></div>'; } // Lien InActif
		else {echo ' <a href="storylines-'.reecUrl($data1['Title']).'-'.$data1['IdForum'].'.html">View all '.$data1['Title'].' Story Lines</a>'; }  // Sinon lien Actif
										 
	 }
              
              echo' </div>
			</div>';

                
              
}

include 'paginate.php'; 

?>
        
        
  <br /><br />      
        
			
            
            
			<div class="clear"></div>
		</div>
		<!-- Aside Blog -->
        
        
		<?php include 'bloc-right.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>


	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>