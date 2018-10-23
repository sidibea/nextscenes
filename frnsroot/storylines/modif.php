<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ; 
$op1=$_GET['op1'];

$sql='select * from storylines where idstory = '.$op1.'';
$req=mysql_query($sql);
$result=mysql_fetch_array($req);

/*
$Date = $info['DateCreate'];
$Date = date("d/m/Y", strtotime($Date));
$Date = str_replace("-","/",$Date);
*/
 
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
                <li class=""><a href="insert.php">CREATE STORY LINES</a></li>
                <li class=""><a href="manage.php">MANAGE  STORY LINES</a></li>
                <li class="current"><a href="#">MODIFICATION STORY LINES</a></li>
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                  
                  
                  <form class="stdform" action="modif2.php" enctype="multipart/form-data" method="post">
                  <input name="op1" type="hidden" id="op1" value="<?php echo $result['idstory']; ?>">
                    	<p>
                        	<label>Category</label>
                            
                          <select name="IdFor" id="select" >
    <option value="<?php echo $result['IdForum']; ?>" selected><?php echo $result['Forum']; ?></option>	
     <?php
			$rqSql = 'SELECT*FROM forums ORDER BY Title ASC '; // WHERE  activation =1
			$result1 = mysql_query( $rqSql ) or die( "Exécution requête impossible."); ?> 
			<?php
				while ( $row = mysql_fetch_array( $result1)) {
				//echo'<option value="'.$row["Title"].'">'.$row["Title"].'</option>';
				echo'<option value="'.$row["IdForum"].'">'.$row["Title"].'</option>';
				}
				?>
                </select>		  

                            
                        </p>
                        
                        <p>
                        	<label>Title</label>
                            <span class="field"><input type="text" name="title" value="<?php echo $result['Title']; ?>" class="smallinput"></span>
                           
                       
                           
                        <br />
                        <label>File Upload</label>
                    
                   	<input type="file" name="urlimage[0]" size="19" >
                        </p>
                        
                        
                        
                       
                        
                        <p>
                        	<label>Text</label>
                            <span class="field">
                            
                            <?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = '../fckeditor/' ; 
//$oFCKeditor->Value = ''.html_entity_decode($result['Texte']).'';
$oFCKeditor->Value = ''.$result['Description'].'';
//$oFCKeditor->Value = ''.htmlspecialchars(stripslashes($result['Texte'])).'';
//$oFCKeditor->Value = ''.html_entity_decode(trim($result['Texte'])).'' ;
// $oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;

?>
							
							</span> 
                        </p>
                        
                        
                         
                     <p>
                        	<label>Login</label>
                            
                          <select name="login" id="select" >
    <option value="<?php echo $result['Login']; ?>" selected><?php echo $result['Login']; ?></option>	
     <?php
			$rqSql2 = 'SELECT*FROM members WHERE Account="Power" ORDER BY Login ASC '; // WHERE  activation =1
			$result2 = mysql_query( $rqSql2 ) or die( "Exécution requête impossible."); ?> 
			<?php
				while ( $row2 = mysql_fetch_array( $result2)) {
				echo'<option value="'.$row2["Login"].'">'.$row2["Login"].'</option>';
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
