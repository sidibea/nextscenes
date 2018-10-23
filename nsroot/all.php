<?php
session_start();  
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "administrateur") { 
   header ('Location: index.php'); 
   exit();  
}

 include '../connect_db.php' ;    
?>
<?php include 'inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="author" content="" />

    <title>Admin : lebabi.net</title>

    <link rel="stylesheet" href="../css/general.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen" />
    
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.pack.js"></script> 
	 	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactform").validate();
		});
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactform2").validate();
		});
	</script>
	
	
	<!--<script src="stocks.js" type="text/javascript" language="javascript"></script>-->
<link href="../table.css" rel="stylesheet" type="text/css" />


<!--<script src="jquery.js" type="text/javascript" language="javascript"></script>-->
	<script src="ajax.js" type="text/javascript" language="javascript"></script>

	<script type="text/javascript">
	$().ready(function() {
	loadTable();
	label2value();
	});
	</script>
	
	
<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:5px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #fff;
	border-top: 3px solid #000;
	color: #000;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #ccc;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>	
	
	
	</head>

  <body class="common" onLoad="document.getElementById('searchText').focus();">
    <div id="page-wrapper-1">

      <div id="header-wrapper-1">
      
       

        <!-- ****************** MENUS ****************** -->      
<?php include'../menu.php'; ?>
 <!--main-menu-->

        

      </div> <!--header-wrapper-1 -->


      <!-- ****************** LEFT SIDEBAR ****************** -->
      <!--left-wrapper-->
<div id="content-wrapper-1">
        <div id="squeeze">
          <div id="content">

            <div id="mainTabs" >

              <!-- ****************** MAIN TABS MENU ****************** -->
               <ul id="mainTabsMenu">
			  <li><a href="#mainTab-2" onclick="this.blur();"><strong>ACTUALITE -GESTION</strong></a></li>
               <!-- <li><a href="#mainTab-5" onclick="this.blur();">Liste</a></li>
					<li><a href="#mainTab-3" onclick="this.blur();">Recherche</a></li>-->
                
              </ul>
              <div class="clear"></div>
			  
			  
			  
			  
			  
			  
  
              <!-- ****************** MAIN TAB CONTENT 6 ****************** -->
             
			  
			  <!--mainTab-1-->
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  <!-- ****************** MAIN TAB CONTENT 2 ****************** -->
              <div id="mainTab-2">
            
			<div id="container">
<div class="content-left">

	<div class="ajaxTableHeader">
		<br /><br /><!--<h2>Produits</h2>-->
		
		
		<input type="text" class="ajax" id="searchText" name="searchText" value="Search" size="30" onkeyup="javascript:searchTable(this.value);" />
		
		<div id="ajax_loading_div" style="display:none;"><img src="../ajax-loader.gif" alt="Loading" /></div>
	</div>

	<div id="ajaxTable"></div>
</div>
</div>
                   
              </div> <!--mainTab-2-->
			  
              
             
			 
			 
			 
			  

			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
         </div>  
			  
  </div> <!--mainTabs-->

    </div> <!--content-wrapper-->
  
          <div class="clear"></div>

      </div>
  </div> <!--content-wrapper-->

      <div class="clear"></div>
    </div> <!--page-wrapper-1 -->


    <?php include'../footer.php'; ?>

  </body>

</html>
