<?php include'includes/global.inc.php'; ?>
<?php  if(empty($_SESSION['idsession'])) { redirect_to('connexion.php');  exit();} ?>
<?php
$id = $_GET['id'];
$sql0 = 'SELECT * FROM storylines WHERE IdForum = "'.mysql_clean($id).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
$data0 = mysql_fetch_array($req0);

if(reecUrl($data0["Forum"]) != $_GET["url"]) {
//redirect_to('forums.php');
header('location: forums.php');
}

//$url =''.REP_ACTU.''.reecUrl($data0['titre']).'-'.$data1['idnews'].'.html';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : <?php echo $data0['Forum'] ;  ?> Forums</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>
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
		<div class="note"><?php echo $data0['Forum'] ;  ?> Story Lines (<?php 
									$query = 'SELECT COUNT(*) FROM storylines';
									$total = mysql_fetch_array(mysql_query($query));
									echo $total[0] ;
									?>)</div>
		<div class="site-map">
    	You are here :<a href="index.html">Home</a> &gt; <a href="forums.html">Forums</a>  &gt; <strong><?php echo $data0['Forum'] ;  ?> Story Lines </strong>
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
  //   $urlSansLeGet = $urlGet[0];
	// echo $urlSansLeGet; tbl_articles WHERE rub="sa-transp"


 	$tableName1="storylines";
	$tableName="storylines";		
	$targetpage = "" ;
	//$rub = CONST_sa_bien ;  
	//$targetpage = $urlSansLeGet ; 
	$limit = 5; 
	
	$query = 'SELECT COUNT(*)  as id FROM '.$tableName.' WHERE IdForum="'.mysql_clean($id).'" ORDER BY id DESC ';
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['id'];
		
	
	$stages = 3;
	@$page = mysql_escape_string(intval($_GET['page']));
	
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}

	$query1 = 'SELECT * FROM '.$tableName.' WHERE IdForum="'.mysql_clean($id).'" ORDER BY idstory DESC  LIMIT '.$start.', '.$limit.'';// WHERE date <= "'.$datelocal.'" DESC limit 0,1		
	//$query1 = 'SELECT * FROM '.$tableName.' WHERE position="ph" ORDER BY idnews DESC  LIMIT '.$start.', '.$limit.''; // WHERE CURRENT_DATE BETWEEN date AND date2  
	$result = mysql_query($query1);
while($data1 =mysql_fetch_assoc($result)){

$sql4 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($data1['idstory']).'" ORDER BY id ASC LIMIT 0,1';
//$sql4 = 'SELECT * FROM scenes_valides WHERE id=LAST_INSERT_ID() '; //  AND idstory = "'.mysql_clean($id).'" 
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
$data4 = mysql_fetch_array($req4);

$query = 'SELECT COUNT(*) FROM scenes_proposes WHERE idstory = "'.mysql_clean($data1['idstory']).'"';
$total = mysql_fetch_array(mysql_query($query));

									

echo '
<div class="blog-box">';

 if(empty($data1['Filename']))  { echo '<img src="pictures/avatar.jpg" alt="">'; } else { echo ' <img src="/image.php?width=275&height=300&cropratio=3:2&image=/pictures/'.$data1['Filename'].'" alt=""></a>'; }
			
				echo'
				<div class="blog-text-mscenes">
					<h4>'.ucfirst(html_entity_decode(coupechaine($data1['Title'], 100))).'</h4>
					<div class="border"></div>
					<div class="post-meta">
						<div class="post-comment">('.$total[0].')  Proposed Scenes</div>
					  <div class="post-date">Created : '.$data1['DateCreate'].'</div>
                     
						<div class="clear"></div>
					</div>
                   
					<div class="post-text"> '.ucfirst(html_entity_decode(coupechaine($data1['Description'], 200))).'</div>
                     <div class="mscenes"><ul>
					<li><a href="scenes-'.$data4['scenes'].'-'.reecUrl($data1["Title"]).'-'.$data1['idstory'].'.html">View Proposed Scenes and Write Yours</a></li>
					

';
                     
                     if ($dataUser['Account'] == 'Power') { echo '<li><a href="scenes-validate.php">View All Validated Scenes</a></li> ' ; } 
                    
                   
                    
                  echo'  
                    </ul></div>
				</div>
			</div>

';


}

include 'paginate.php'; 
?>
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