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
$sc = $_GET['sc']; 
?>
<?php include '../meta2.php' ; ?>

<body class="withvernav">


    <?php include '../header.php' ; ?>
    <?php include '../menu2.php' ; ?>
    <!--leftmenu-->
        
    <div class="centercontent">
    
         <div class="pageheader">
            
            <h1 class="pagetitle">MANAGE SCENES OF</h1>
            
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
					

//$sql1 = 'SELECT item, (totalrate / nrrates) AS rank, @curRank := @curRank + 1 AS ranking FROM rtgitems, (SELECT @curRank := 0) r WHERE item REGEXP 111 ORDER BY (totalrate / nrrates) DESC LIMIT 10';				  
$sql1 = 'SELECT id,Date,Login,Text, scenes, valide, (totalrate / nrrates) AS rank FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY rank DESC LIMIT 0,1'; // ( totalrate / nrrates) 
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data1 =mysql_fetch_assoc($req1))
{
//echo' '.$data1["rank"].' - '.$data1["id"].' ';
$scenes_suiv= ''.$data1["scenes"].'' +1;
echo'

<div class="scenes">
         <fieldset>
              <blockquote>
			  
			   <h3>Scenes by '.$data1["Login"].' - Posted : '.$data1["Date"].'  </h3> 
                        
                        
                       
                        
                       <div class="profile_about">
                        <p>'.$data1["Text"].'</p> 
						 Vote : '.$data1["rank"].' 
                    </div> 
					
					 </blockquote>
       </fieldset>
        </div>	
';
if ( empty($data1['valide']) ){ echo '<a href=valide.php?op='.$data1["id"].'> <strong><h5>>>Validate this scenes for scene '.$scenes_suiv.' - [X] <a href=delscene.php?op='.$data1["id"].'> Delete this scene </a>  </h5></strong> </a>'; } else { echo' <strong><h5>This scenes is Validated for scenes '.$scenes_suiv.' </h5></strong> '; }


}
					  
		echo'<br>---------------------------------------------------------------------------------------------------------------
		<br><br>';		  
					  
					  ?>         	
                    
                  
                   <?php
					

//$sql1 = 'SELECT item, (totalrate / nrrates) AS rank, @curRank := @curRank + 1 AS ranking FROM rtgitems, (SELECT @curRank := 0) r WHERE item REGEXP 111 ORDER BY (totalrate / nrrates) DESC LIMIT 10';				  
$sql1 = 'SELECT id,Date,Login,Text, (totalrate / nrrates) AS rank FROM scenes_proposes WHERE idstory = "'.mysql_clean($id).'" AND scenes="'.mysql_clean($sc).'" ORDER BY rank DESC LIMIT 1,10'; // ( totalrate / nrrates) 
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
//$data0 = mysql_fetch_array($req0); 
while($data1 =mysql_fetch_assoc($req1))
{
//echo' '.$data1["rank"].' - '.$data1["id"].' ';
echo'
<div class="scenes">
         <fieldset>
              <blockquote>
                            <h3>Scenes by '.$data1["Login"].' - Posted : '.$data1["Date"].'  </h3> 
                       
                        
                       
                        
                       <div class="profile_about">
                        <p>'.$data1["Text"].'</p> 
                    </div>
					
					 </blockquote>
       </fieldset>
        </div>	
';
echo'<strong><h5>[X] <a href=delscene.php?op='.$data1["id"].'> Delete this scene </a> </h5></strong> <br>';

echo'<br>---------------------------------------------------------------------------------------------------------------
		<br><br>';	

}
					  
				  
					  
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
