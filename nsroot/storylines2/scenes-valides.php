<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ; 
include '../../includes/functions.inc.php' ;

$id = $_GET['idstory'];
//$sc = $_GET['sc']; 
?>
<?php include '../meta2.php' ; ?>

<body class="withvernav">


    <?php include '../header.php' ; ?>
    <?php include '../menu2.php' ; ?>
    <!--leftmenu-->
        
    <div class="centercontent">
    
         <div class="pageheader">
            
            <h1 class="pagetitle">VALIDATES SCENES OF</h1>
            
            <ul class="hornav">
              
                <li class="current">
                
                <li class="current"><a href="#"><?php
$sql21 = 'SELECT * FROM storylines WHERE idstory = "'.mysql_clean($id).'"';
$req21 = mysql_query($sql21) or die('Erreur SQL !<br />'.$sql21.'<br />'.mysql_error()); 
$data21 = mysql_fetch_array($req21);
echo'<h3>'.$data21['Title'].'</h3>';
?></a></li>
                </li>
                 
              
                
               
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                    
                    <div class="two_third dashboard_left">
                    
                    <?php
$sql1 = 'SELECT * FROM scenes_valides WHERE idstory = "'.mysql_clean($id).'" ORDER BY id ASC LIMIT 5  ';
$result1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
//$data0 = mysql_fetch_array($req0);
//$result = mysql_query($query1);
while($data1 =mysql_fetch_assoc($result1))
{
echo'

<div class="scenes">
         <fieldset>
                   
           	
             
       
              <blockquote><strong>Scene '.$data1["scenes"].'</strong><p class="post-text2">'.$data1["Text"].' </p> <div class="post-user">By <strong>'.$data1["Login"].'</strong> </div> <div class="post-date">Proposed : 18 September, 2015  - Validate : '.$data1["Date"].'</div> <br></blockquote>
       
		
        </fieldset>
        </div>	



           ';
}
?>
                    
                   
                   <?php
					/*

//$sql1 = 'SELECT item, (totalrate / nrrates) AS rank, @curRank := @curRank + 1 AS ranking FROM rtgitems, (SELECT @curRank := 0) r WHERE item REGEXP 111 ORDER BY (totalrate / nrrates) DESC LIMIT 10';				  
$sql1 = 'SELECT id,Login,Text,valide, (totalrate / nrrates) AS rank FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY rank DESC LIMIT 0,1'; // ( totalrate / nrrates) 
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data1 =mysql_fetch_assoc($req1))
{
//echo' '.$data1["rank"].' - '.$data1["id"].' ';
echo'
<div class="contenttitle2 nomargintop">
                            <h3>Scenes by '.$data1["Login"].'  </h3> 
                        </div>
                        
                       
                        
                       <div class="profile_about">
                        <p>'.$data1["Text"].'</p> 
						 Vote : '.$data1["rank"].' 
                    </div> 
';
if ( empty($data1['valide']) ){ echo '<a href=valide.php?op='.$data1["id"].'>[ <strong>Validate this scenes</strong> ]</a>'; } else { echo' <strong>This scenes is Validated</strong> '; }

}
					  
		echo'<br><br>';		  
					  */
					  ?>         	
                    
                  
                   <?php
				/*	

//$sql1 = 'SELECT item, (totalrate / nrrates) AS rank, @curRank := @curRank + 1 AS ranking FROM rtgitems, (SELECT @curRank := 0) r WHERE item REGEXP 111 ORDER BY (totalrate / nrrates) DESC LIMIT 10';				  
$sql1 = 'SELECT id,Login,Text, (totalrate / nrrates) AS rank FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY rank DESC LIMIT 1,10'; // ( totalrate / nrrates) 
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data1 =mysql_fetch_assoc($req1))
{
//echo' '.$data1["rank"].' - '.$data1["id"].' ';
echo'
<div class="contenttitle2 nomargintop">
                            <h3>Scenes by '.$data1["Login"].'  </h3> 
                        </div>
                        
                       
                        
                       <div class="profile_about">
                        <p>'.$data1["Text"].'</p> 
                    </div>
';
}
					  
				*/  
					  
					  ?>         	
                       
                     
                     
                     
                     
                     
                     
                     
                     
                     
                        
                       
                        <?php
					
					/*
$sql0 = 'SELECT * FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ';
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data0 =mysql_fetch_assoc($req0))
{

//$query = 'SELECT COUNT(*) FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes ="'.$data0["scenes"].'"';
//$total = mysql_fetch_array(mysql_query($query));

									
echo'

 <div class="contenttitle2 nomargintop">
                            <h3>Scenes by '.$data0["Login"].'</h3>
                        </div>
                        
                       
                        
                       <div class="profile_about">
                        <p>'.$data0["Text"].'</p> 
                    </div>



    '; 
}

 */
					
					?>
                        
                        
                      
                    
       <?php
					
/*
//$sql1 = 'SELECT item, (totalrate / nrrates) AS rank, @curRank := @curRank + 1 AS ranking FROM rtgitems, (SELECT @curRank := 0) r WHERE item REGEXP 111 ORDER BY (totalrate / nrrates) DESC LIMIT 10';				  
$sql1 = 'SELECT (totalrate / nrrates) AS rank FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY rank DESC'; // ( totalrate / nrrates) 
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data1 =mysql_fetch_assoc($req1))
{
echo' '.$data1["rank"].' ';
}
					  
		*/			  
					  ?>              
               
                    
                    
                   
                    
                    
                    
                    
                    
                        
                        
                        <div class="widgetbox">
                          <div class="widgetcontent"><!--#scroll1-->
                            </div><!--widgetcontent-->
                      </div><!-- widgetbox -->                            
                        
                        
                    </div>
                    
            </div><!-- #default -->
            
            
            <div id="tabbed" class="subcontent" style="display: none">
            
                    
                                        
                    <!-- END OF TABBED WIZARD -->
                                
            </div><!-- #tabbed -->
            
            <div id="vertical" class="subcontent" style="display: none">
            
                    <!-- START OF VERTICAL WIZARD -->
                    
                    
                    <br clear="all" /><br />
                    
                    <!-- END OF VERTICAL WIZARD -->
                    
            </div><!--#vertical-->
            
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

</html>
