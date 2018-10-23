<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ;  
?>
<?php
include_once("./../fckeditor/fckeditor.php") ;

?>

<?php
$mois = date("m");
$annee = date("Y");
$jour = date("d");
?>
<?php include '../meta2.php' ; ?>

<link href="../css/table.css" rel="stylesheet" type="text/css" />
<script src="ajax.js" type="text/javascript" language="javascript"></script>

	<script type="text/javascript">
	$().ready(function() {
	loadTable();
	label2value();
	});
	</script>
 	

</head>


    

<body class="withvernav">


    <?php include '../header2.php' ; ?>
    <?php include '../menu2.php' ; ?>
    <!--leftmenu-->
        
    <div class="centercontent">
    
        <div class="pageheader">
            
           <h1 class="pagetitle">STORY LINES</h1> 
            
            <ul class="hornav">
                
                  <li class=""><a href="manage.php">MANAGE  STORY LINES</a></li>
                  <li class="current"><a href="insert.php">CREATE STORY LINES</a></li>
              
              
               
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                  
                  
                  <form class="stdform" action="insertion2.php" enctype="multipart/form-data" method="post">
                  
                    	<p>
                        	<label>Forums</label>
                            
                          <select name="IdFor" id="select" >
                          
                          <?php
			$rqSql = 'SELECT*FROM forums WHERE lang="fr" ORDER BY Title ASC '; // WHERE  activation =1
			$result = mysql_query( $rqSql ) or die( "Exécution requête impossible."); ?> 
			<?php
				while ( $row = mysql_fetch_array( $result)) {
				echo'<option value="'.$row["IdForum"].'">'.$row["Title"].'</option>';
				}
				
				?>
               
                </select>		
     </p>
                        
                        <p>
                        	<label>Title</label>
                            <span class="field"><input type="text" name="title" class="smallinput"></span>
                           <!-- <small class="desc">Title.</small>-->
                       
                        	<!--<label>Titre (FR)</label>
                            <span class="field"><input type="text" name="titrefr" class="smallinput"></span>
                            -->
                           
                        </p>
                        <p>
                        <label>File Upload</label>
                    
                   	<input type="file" name="urlimage[0]" size="19" >
                        </p>
                        
                        
                        
                      <!--   <p>
                       	  <label>Long Title</label>
                            <span class="field"><input type="text" name="titre2" class="longinput"></span><br />
                            <label>Long Titre (FR)</label>
                            <span class="field"><input type="text" name="titre2fr" class="longinput"></span>
                           
                        </p>
                         -->
                        <p>
                        	<label>Scenes Description</label>
                            <span class="field"><?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = '../fckeditor/' ;
$oFCKeditor->Config['EnterMode'] = 'br';



// $oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;

?></span> 
                        </p>
                        
                        
                <p>
                        	<label>Login</label>
                            
                          <select name="login" id="select" >
                          
                          <?php
			$rqSql = 'SELECT*FROM members WHERE Account="Power" AND lang="fr" ORDER BY Login ASC '; // WHERE  activation =1
			$result = mysql_query( $rqSql ) or die( "Exécution requête impossible."); ?> 
            <option value="Ginco">GINCO</option>
			<?php
				while ( $row = mysql_fetch_array( $result)) {
				echo'<option value="'.$row["Login"].'">'.$row["Login"].'</option>';
				}
				
				?>
               
                </select>		
     </p>       
                        
                    
                                                                        
                    <p>
                    </p>
                        
                        <p>
                        	
                    </span>
                    <p class="stdformbutton">
                       	  <button class="submit radius2">Submit Button</button>
                            <input type="reset" class="reset radius2" value="Reset Button">
                    </p>
                        
                        
              </form>
                    
                    
                  


                    
            </div><!-- #default -->
            
            
            <div id="tabbed" class="subcontent" style="display: none">
            
                   
                                
            </div><!-- #tabbed -->
            
            <div id="vertical" class="subcontent" style="display: none">
            
                   
                    
                    <br clear="all" /><br />
                    
                    <!-- END OF VERTICAL WIZARD -->
                    
            </div><!--#vertical-->
            
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

</html>
