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
            
             <h1 class="pagetitle">SCENES</h1>         
            
            <ul class="hornav">
                
                  <li class="current"><a href="insert.php">CREATE SCENES</a></li>
                <li class=""><a href="manage.php">MANAGE  CREATED SCENES</a></li>
              
               
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                  
                  
                  <form class="stdform" action="insertion2.php" enctype="multipart/form-data" method="post">
                    	<p>
                        	<label>Forums</label>
                            
                          <select name="forums" id="select" >	  
	<option value="Action">Action</option>
     <option value="Adventure">Adventure</option>
    <option value="Comedy">Comedy</option>
    <option value="Crime">Crime</option>
     <option value="Fantasy">Fantasy</option>
     <option value="Historical">Historical</option>
     <option value="Horror">Horror</option>
    <option value="Mystery">Mystery</option>
    <option value="Romance">Romance</option>
     <option value="Thriller">Thriller</option>
   
  
     
		

      </select>
                            
                        </p>
                        
                        <p>
                        	<label>Title</label>
                            <span class="field"><input type="text" name="titre" class="smallinput"></span>
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
