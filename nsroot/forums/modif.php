<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ; 
$t3="forums";

$op1=$_GET['op1'];
$sql='select * from '.$t3.' where IdForum = '.$op1.'';
$req=mysql_query($sql);
$result=mysql_fetch_array($req);


$sql1= 'SELECT*FROM '.$t3.'  WHERE IdForum="'.$op1.'"' ; 
$req1=mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
$info = mysql_fetch_assoc($req1);

$Date = $info['DateCreate'];
$Date = date("d/m/Y", strtotime($Date));
$Date = str_replace("-","/",$Date);
 
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
                <li class=""><a href="create.php">CREATE FORUM</a></li>
                <li class=""><a href="manage.php">MANAGE  CREATED FORUMS</a></li>
                <li class="current"><a href="#">CHANGE FORUM</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                  
                  
                  <form class="stdform" action="modif2.php" enctype="multipart/form-data" method="post">
                  <input name="op1" type="hidden" id="op1" value="<?php echo $result['IdForum']; ?>">
                    	
                        
                        <p>
                        	<label>Title</label>
                            <span class="field"><input type="text" name="titre" value="<?php echo $result['Title']; ?>" class="smallinput"></span>
                        <br />
                        
                       <!--
                        	<label>French Title</label>
                            <span class="field"><input type="text" name="titrefr" value="<?php // echo $result['Titlefr']; ?>" class="smallinput"></span>
                        <br />
                        
                        <label>File Upload</label>
                    
                   	<input type="file" name="urlimage[0]" size="19" >
                        </p>
                        
                        
                     -->   
                       
                        
                        <p>
                        	<label>Text</label>
                            <span class="field">
                            
                            <?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = '../fckeditor/' ; 
//$oFCKeditor->Value = ''.html_entity_decode($result['Texte']).'';
$oFCKeditor->Value = ''.$result['Descriptions'].'';
//$oFCKeditor->Value = ''.htmlspecialchars(stripslashes($result['Texte'])).'';
//$oFCKeditor->Value = ''.html_entity_decode(trim($result['Texte'])).'' ;
// $oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;

?>
							
							</span> 
                        </p>
                        
                        
                 <!--       <p>
                        	<label>French Text</label>
                            <span class="field">
                            
                            <?php
							/*
$oFCKeditor = new FCKeditor('FCKeditor1fr') ;
$oFCKeditor->BasePath = '../fckeditor/' ; 
//$oFCKeditor->Value = ''.html_entity_decode($result['Texte']).'';
$oFCKeditor->Value = ''.$result['Descriptionsfr'].'';
//$oFCKeditor->Value = ''.htmlspecialchars(stripslashes($result['Texte'])).'';
//$oFCKeditor->Value = ''.html_entity_decode(trim($result['Texte'])).'' ;
// $oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;
*/

?>
							
							</span> 
                        </p>
                       --> 
                        
                         
                        
                    
                                                                        
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
