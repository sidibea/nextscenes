<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../../includes/connect_db.php' ;  
?>
<?php // include 'inc.php'; ?>
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
            
            <h1 class="pagetitle">Membres</h1>
            
            <ul class="hornav">
              
                
                <li class="current"><a href="manage.php">Membres inscrits</a></li>
                
               
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                    
                    
                  <div id="container">
<div class="content-left">

	<div class="ajaxTableHeader">
		<br /><br /><!--<h2>Produits</h2>-->
		
		
		<input type="text" class="ajax" id="searchText" name="searchText" value="Search" size="30" onKeyUp="javascript:searchTable(this.value);" />
		
		<div id="ajax_loading_div" style="display:none;"><img src="../ajax-loader.gif" alt="Loading" /></div>
	</div>

	<div id="ajaxTable"></div>
</div>



                    
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
