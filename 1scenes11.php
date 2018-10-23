<?php include'includes/global.inc.php'; ?>
<?php  if(empty($_SESSION['idsession'])) { redirect_to('connect.html');  exit();} ?>
<?php
$id = $_GET['id'];
$sc = $_GET['sc'];

$sql0 = 'UPDATE storylines SET View=View+1 WHERE idstory= "'.mysql_clean($id).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 

$sql1 = 'SELECT * FROM storylines WHERE idstory = "'.mysql_clean($id).'"';
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
$data1 = mysql_fetch_array($req1);

$sql4 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY id DESC LIMIT 1';
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
$data4 = mysql_fetch_array($req4);

if(reecUrl($data1["Title"]) != $_GET["url"]) {
//redirect_to('forums.php');
header('location: forums.php');
}

if($data4["scenes"] != $_GET["sc"]) {
//redirect_to('forums.php');
header('location: forums.php');
}

//$url =''.REP_ACTU.''.reecUrl($data1['titre']).'-'.$data1['idnews'].'.html';

/*
$extension=strrchr($data1['filename'],'.');
$pos_point = strpos($data1['filename'], '.');
if(reecUrl($data1["titre"]) != $_GET["url"]) {
header('location:'.REP_ACTU.''.reecUrl($data1['titre']).'-'.$data1['idnews'].'.html');
}
function keephtml($string){
          @$res = html_entity_decode($string,ENT_QUOTES,'UTF-8'); 
          $res = str_replace('"','',$res);
          return $res;
  }	
  */  
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Scenes</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>


<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>


<SCRIPT type="text/javascript" src="files/jquery.validate.js"></SCRIPT>
<SCRIPT type="text/javascript" src="files/jquery.metadata.js"></SCRIPT>
<SCRIPT type="text/javascript" src="files/jscal2.js"></SCRIPT>
<SCRIPT src="files/cmxforms.js" type="text/javascript"></SCRIPT> 
<SCRIPT src="files/additional-methods.js" type="text/javascript"></SCRIPT>




<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
$(document).ready(function(){

$('[rel=tooltip]').bind('mouseover', function(){		
	
 if ($(this).hasClass('ajax')) {
	var ajax = $(this).attr('ajax');	
			
  $.get(ajax,
  function(theMessage){
$('<div class="tooltip">'  + theMessage + '</div>').appendTo('body').fadeIn('fast');});

 
 }else{
			
	    var theMessage = $(this).attr('content');
	    $('<div class="tooltip">' + theMessage + '</div>').appendTo('body').fadeIn('fast');
		}
		
		$(this).bind('mousemove', function(e){
			$('div.tooltip').css({
				'top': e.pageY - ($('div.tooltip').height() / 2) - 5,
				'left': e.pageX + 15
			});
		});
	}).bind('mouseout', function(){
		$('div.tooltip').fadeOut('fast', function(){
			$(this).remove();
		});
	});
						   });

</script>

<style>
.tooltip{
	position:absolute;
	width:200px;
	background-image:url(tip-bg.png);
	background-position:left center;
	background-repeat:no-repeat;
	color:#FFF;
	padding:5px 5px 5px 18px;
	font-size:12px;
	font-family:Verdana, Geneva, sans-serif;
	border: solid 1px #ccc;
	background-color:#fdfdfd;
	}
	
.tooltip-image{
	float:left;
	margin-right:5px;
	margin-bottom:5px;
	margin-top:3px;}	
	
	
	.tooltip span{font-weight:700;
color:#ffea00;}





	
	#imagcon{
		overflow:hidden;
		float:left;
		height:100px;
		width:100px;
		margin-right:5px;
	}
	#imagcon img{
		max-width:100px;
	}
	#wrapper{
		margin:0 auto;
		width:500px;
		margin-top: 99px;
	}
</style>
<link href="ratingfiles/ratings.css" rel="stylesheet" type="text/css" />

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
	<div class="banner">
	<div class="inner-banner">
		<div class="note"><?php echo $data1['Title'] ; ?></div>
		<div class="site-map">
    	You are here : <a href="index.html">Home</a> &gt; <a href="forums.html">Forums</a> &gt; <a href="storylines-<?php echo reecUrl($data1['Forum']) ; ?>-<?php echo $data1['IdForum'] ; ?>.html"><?php echo $data1['Forum'] ; ?> Story Lines</a> &gt; <strong>Read Scene</strong>
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">
		
		<div class="main-testimonials column9">
       
       
       <div class="scenes">
         <fieldset>
                   
           	 <legend><strong>Scene <?php echo $data4['scenes'] ; ?></strong></legend>
             
       
       <?php 
	   /*
	   $sql4 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY id DESC LIMIT 0,1';
//$sql4 = 'SELECT * FROM scenes_valides WHERE id=LAST_INSERT_ID() '; //  AND idstory = "'.mysql_clean($id).'" 
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
$data4 = mysql_fetch_array($req4);
*/
	   ?>
             <blockquote><div class="post-text2"><?php echo $data4['Text'] ; ?></div>
             <?php echo'<br><div class=post-user><strong> '.$data4['Date'].' - Proposed by '.$data4['Login'].' </strong> </div> '; ?>
             </blockquote>
       
		
        </fieldset>
        </div>	
        
        
			<br /><br />
		 <div class="border"></div>
         <?php
		 /*
		 $sql4 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY id DESC LIMIT 0,1';
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
$data4 = mysql_fetch_array($req4);
*/
		 ?>
        
			<h4> Proposed  Next Scenes (<?php 
									$query = 'SELECT COUNT(*) FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'"';
									$total = mysql_fetch_array(mysql_query($query));
									echo $total[0] ;
									?>)</h4> 
            <div class="border"></div>
            
          <div class="headings">
          
           
            <?php
			
			$sql2 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'" ORDER By id DESC';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
//$data1 = mysql_fetch_array($req1);
while($data2 =mysql_fetch_assoc($req2)){

/*
$query1 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND ( vote ="5" OR vote ="4" OR vote ="3" OR vote ="2" OR vote ="1") '; 
$total1 = mysql_fetch_array(mysql_query($query1));
*/
$query2 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND ( vote ="1" OR vote ="2" OR vote ="3" OR vote ="4" OR vote ="5") '; 
$total2 = mysql_fetch_array(mysql_query($query2));


$query3 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND ( vote ="6" OR vote ="7" OR vote ="8") '; // AND scenes ="'.mysql_clean($sc).'"
$total3 = mysql_fetch_array(mysql_query($query3));

$query4 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND vote ="9" '; // AND scenes ="'.mysql_clean($sc).'"
$total4 = mysql_fetch_array(mysql_query($query4));

$query5 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND vote ="10" '; // AND scenes ="'.mysql_clean($sc).'"
$total5 = mysql_fetch_array(mysql_query($query5));


/*
$query3 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND vote ="10" '; // AND scenes ="'.mysql_clean($sc).'"
$total3 = mysql_fetch_array(mysql_query($query3));
*/


									

echo '  <blockquote><p>  '.$data2['Text'].' </p><div class="post-user">By <strong>'.$data2['Login'].'</strong> </div>  <div class="post-date">Proposed : '.$data2['Date'].'</div>
<br><br> <div class="srtgs" id="'.$data2['id'].'">
 
</div>

 
<div class=post-vote>
 <a href=# alt=Image Tooltip rel=tooltip content="

 
 <div class=tt2 id=con><div class=tt2tx> ('.$total2[0].') </div></div>
 <div class=tt3 id=con><div class=tt3tx> ('.$total3[0].') </div></div>
 <div class=tt4 id=con><div class=tt4tx> ('.$total4[0].') </div></div>
 <div class=tt5 id=con><div class=tt5tx> ('.$total5[0].') </div></div>

 ">
 <em>Rating Statistics </em></a>
</div>  

 <br>
 </blockquote>
 
 
 ';
 
// <div class=post-vote> <em>5 stars ('.$total3[0].') </em> &nbsp; |&nbsp;  <em>4-3 stars ('.$total2[0].') </em> &nbsp; |&nbsp;  <em> 2-1 stars ('.$total1[0].')</em></div> 
}
			
			?>
            <!--
            <div class="voting_wrapper" id="'.$data2['id'].'">
            <div class="voting_btn">
                <div class="up_button">&nbsp;</div><span class="up_votes">0</span>
            </div>
            <div class="voting_btn">
                <div class="down_button">&nbsp;</div><span class="down_votes">0</span>
            </div>
        </div>
        --> <?php // echo reecUrl($data1['Forum']) ; ?>
    
           
            </div>
            
             
          <!--           
           
            
            <?php if ($dataUser['Account']=='Power' ) {  ?>
            
            <br /><br />
             <div class="border"></div>
                      <h4>Propose Your Next Scene.</h4>
					<div class="border"></div>
 
 <?php

function CoupeTexte($Texte,$NB) 
{ 
$TabMots=explode(" ",$Texte); 
$NvTexte =""; 
for($i=0;$i<$NB;$i++) 
{ 
@$NvTexte.=' '.$TabMots[$i]; 
} 
return $NvTexte; 
} 
		
 
 if (isset($_POST['submit']) and !empty($_POST['nextscenes']) && $_POST['submit'] == 'Submit') {
 $date = date("Y-m-d");
 
 sleep(1);
 
 $sql = 'INSERT INTO scenes_proposes (Date,idstory,Login,Text,scenes) 
			             VALUES
			              ("'.$date.'", "'.mysql_clean($id).'", "'.$dataUser['Login'].'", "'.mysql_clean(html_entity_decode(nl2br(CoupeTexte($_POST['nextscenes'], 500)))).'", "'.mysql_clean($sc).'")'; // '.html_entity_decode(coupechaine2($_POST['nextscenes'], 500)).'
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
$sql0 = 'UPDATE storylines SET scenes=scenes+1 WHERE idstory= "'.mysql_clean($id).'"';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 

//redirect_to('myaccount.php');
			
			$erreur = '<font color=#ff0000><b>Your scene has been successfully submitted.</b></font>'; 
 }
 ?> 
 
 <?php
	  
 if (isset($erreur)) echo '',$erreur;
?>
 
<form method="post" action="" class="formular">
  <textarea id="message" name="nextscenes"  class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" cols="120" rows="10"></textarea>
  <p id="compteur">0 words / 500</p>
  <input type="submit" name="submit" id="submit" value="Submit">
</form>

<?php } ?>
-->

	<br />
    <p class="user">			
 <?php if ($dataUser['Account'] == 'Power') { echo '<div align=center><div class="blog-text2"><a href="propose-your-nextscenes-'.mysql_clean($sc).'-'.reecUrl($data1['Title']).'-'.mysql_clean($id).'.html">Propose Your Scenes</a></div></div> ' ; } ?>
 <?php  if ($dataUser['Account'] == 'Regular') { echo '<div align=center><div class="blog-text2"><a href="account-manage-user.php">Change your Profile to propose Scenes</a></div></div> ' ; } ?>
 <br />

 </p>		

<!--
		<div class="pagenation clearfix">
			<ul>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">...</a></li>
				<li><a href="#">50</a></li>
			</ul>
		</div>
-->
		</div>
		

		<!-- Aside Testimonials -->
		<?php // include 'bloc-right.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>

<script src="ratingfiles/ratings.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>

</body>
</html>