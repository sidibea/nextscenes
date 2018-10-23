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

$sql4 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" ORDER BY id DESC LIMIT 1';
$req4 = mysql_query($sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysql_error()); 
$data4 = mysql_fetch_array($req4);

if(reecUrl($data1["Title"]) != $_GET["url"]) {
//redirect_to('forums.php');
header('location: forums.php');
}

if($data4["scenes"] != $_GET["sc"]) {
//redirect_to('forums.php'); echo "here it is"; exit;
//header('location: forums.php');
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


<link rel="stylesheet" href="jsnodal/popupwindow.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="jsnodal/popupwindow.js"></script>
<script src="jsnodal/demo.js"></script>



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


<style>

#carousel {
  position: relative;
  width: 60%;
  margin: 0 auto;
}

#slides {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 250px;
}

#slides ul {
  list-style: none;
  width: 100%;
  height: 200px;
  margin: 0;
  padding: 0;
  position: relative;
}

#slides li {
  width: 100%;
  height: 200px;
  float: left;
  text-align: center;
  position: relative;
  font-family: lato, sans-serif;
}

/* Styling for prev and next buttons */

.btn-bar {
  width: 60%;
  margin: 0 auto;
  display: block;
  position: relative;
 /* top: 40px; */
}

#buttons {
  padding: 0 0 5px 0;
  float: left; 
}

#buttons a {
  text-align: center;
  display: block;
  font-size: 50px;
  float: left;
  outline: 0;
  margin: 0 90px;
  color: #b14943;
  text-decoration: none;
  display: block;
  padding: 9px;
  width: 35px;
}

a#prev:hover,
a#next:hover {
  color: #FFF;
  text-shadow: .5px 0px #b14943;
}

.quote-phrase,
.quote-author {
  font-family: sans-serif;
  font-weight: 300;
  display: table-cell;
  vertical-align: middle;
  padding: 5px 20px;
  font-family: 'Lato', Calibri, Arial, sans-serif;
}

.quote-phrase {
  height: 200px;
  font-size: 24px;
 /* color: #FFF; */
  font-style: italic;
  text-shadow: .5px 0px #b14943;
}

.quote-marks {
  font-size: 30px;
  padding: 0 3px 3px;
  position: inherit;
}

.quote-author {
  font-style: normal;
  font-size: 20px;
  color: #b14943;
  font-weight: 400;
  height: 30px;
}

.quoteContainer,
.authorContainer {
  display: table;
  width: 100%;
}
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
             <blockquote><div class="post-fieldset">
           
			 <?php echo $data4['Text'] ; ?>
           
             </div><br />
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
            
            
            <div class="btn-bar">
  <div id="buttons">
    <a id="prev" href="#">&lt;</a>
    <a id="next" href="#">&gt;</a> 
  </div>
</div>
        
        
        <div id="slides">
        
        
        
        <ul>
     
<?php
			
$sql3 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'" ORDER By id DESC';
$req3 = mysql_query($sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysql_error()); 
//$data1 = mysql_fetch_array($req1);
$data3 =mysql_fetch_array($req3);

echo'
 <li class="slide">
  <div class="quoteContainer">
          <p class="quote-phrase"><span class="quote-marks">"</span> 
'.ucfirst(html_entity_decode(coupechaine($data3['Text'], 100))).'
<span class="quote-marks">"</span> <a id="open-pop-up-100" href="#pop-up-100"> <br> Read  this proposed  Next Scene </a></p>
        </div>
        <div class="authorContainer">
          <p class="quote-author">By '.$data3['Login'].'</p>
        </div>
		
		<div id="pop-up-100" class="pop-up-display-content">
           
		   <h2> This Next Scene proposed by '.$data3['Login'].' for Scene '.$data3['scenes'].' </h2>
		 <div class=border></div>
            <p> '.$data3['Text'].'</p>
			
			<br><br> <div class="srtgs" id="'.$data3['id'].'"></div>
			
        </div>
		
		</li>
		
		

';

?>     
     
       
          <?php
			
			$sql2 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'" ORDER By id DESC';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
//$data1 = mysql_fetch_array($req1);
while($data2 =mysql_fetch_assoc($req2)){



echo'
 <li class="slide">
  <div class="quoteContainer">
          <p class="quote-phrase"><span class="quote-marks">"</span> 
'.ucfirst(html_entity_decode(coupechaine($data2['Text'], 200))).'
<span class="quote-marks">"</span> <a id="open-pop-up-'.$data2['id'].'" href="#pop-up-'.$data2['id'].'"> <br> Read  this proposed  Next Scene </a></p>
        </div>
        <div class="authorContainer">
          <p class="quote-author">By '.$data2['Login'].'</p>
        </div>
		
		<div id="pop-up-'.$data2['id'].'" class="pop-up-display-content">
           
		   <h2> This Next Scene proposed by '.$data2['Login'].' for Scene '.$data2['scenes'].' </h2>
		 <div class=border></div>
            <p> '.$data2['Text'].'</p>
			
			<br><br> <div class="srtgs" id="'.$data2['id'].'"></div>
			
        </div>
		
		</li>
		
		

';
}
?>


 


   
    </ul>
    
    


<!--
        
  <ul>
    <li class="slide">
      
       <?php
			
			$sql2 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'" ORDER By id DESC';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
//$data1 = mysql_fetch_array($req1);
while($data2 =mysql_fetch_assoc($req2)){

echo' '.ucfirst(html_entity_decode(coupechaine($data2['Text'], 200))).'';
}

?>
gggggg
      
      
    </li>
  </ul>
  -->
</div>

   
   
  
            
          <div class="headings">
          
           
            <?php
			
			/*
			
			$sql2 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.mysql_clean($sc).'" ORDER By id DESC';
$req2 = mysql_query($sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysql_error()); 
//$data1 = mysql_fetch_array($req1);
while($data2 =mysql_fetch_assoc($req2)){


$query2 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND ( vote ="1" OR vote ="2" OR vote ="3" OR vote ="4" OR vote ="5") '; 
$total2 = mysql_fetch_array(mysql_query($query2));


$query3 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND ( vote ="6" OR vote ="7" OR vote ="8") '; // AND scenes ="'.mysql_clean($sc).'"
$total3 = mysql_fetch_array(mysql_query($query3));

$query4 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND vote ="9" '; // AND scenes ="'.mysql_clean($sc).'"
$total4 = mysql_fetch_array(mysql_query($query4));

$query5 = 'SELECT COUNT(*) FROM rtgvote WHERE item = "'.mysql_clean($data2['id']).'" AND vote ="10" '; // AND scenes ="'.mysql_clean($sc).'"
$total5 = mysql_fetch_array(mysql_query($query5));





									

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
	*/		
			?>
            <?php // echo reecUrl($data1['Forum']) ; ?>
    
           
            </div>
            
           <div class="border"></div>   
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
		<?php include 'bloc-right.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>
    
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--> 
<script>
$(document).ready(function () {
    //rotation speed and timer
    var speed = 4000;
    
    var run = setInterval(rotate, speed);
    var slides = $('.slide');
    var container = $('#slides ul');
    var elm = container.find(':first-child').prop("tagName");
    var item_width = container.width();
    var previous = 'prev'; //id of previous button
    var next = 'next'; //id of next button
    slides.width(item_width); //set the slides to the correct pixel width
    container.parent().width(item_width);
    container.width(slides.length * item_width); //set the slides container to the correct total width
    container.find(elm + ':first').before(container.find(elm + ':last'));
    resetSlides();
    
    
    //if user clicked on prev button
    
    $('#buttons a').click(function (e) {
        //slide the item
        
        if (container.is(':animated')) {
            return false;
        }
        if (e.target.id == previous) {
            container.stop().animate({
                'left': 0
            }, 1500, function () {
                container.find(elm + ':first').before(container.find(elm + ':last'));
                resetSlides();
            });
        }
        
        if (e.target.id == next) {
            container.stop().animate({
                'left': item_width * -2
            }, 1500, function () {
                container.find(elm + ':last').after(container.find(elm + ':first'));
                resetSlides();
            });
        }
        
        //cancel the link behavior            
        return false;
        
    });
    
    //if mouse hover, pause the auto rotation, otherwise rotate it    
    container.parent().mouseenter(function () {
        clearInterval(run);
    }).mouseleave(function () {
        run = setInterval(rotate, speed);
    });
    
    
    function resetSlides() {
        //and adjust the container so current is in the frame
        container.css({
            'left': -1 * item_width
        });
    }
    
});
//a simple function to click next link
//a timer will call this function, and the rotation will begin

function rotate() {
    $('#next').click();
}
</script>


<script src="ratingfiles/ratings.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="js/script.js"></script>


</body>
</html>