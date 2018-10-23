<?php
session_start(); 
//setcookie(‘membername’, ‘troutgirl’, time() + (60 * 60 * 24), “/”, “www.troutworks.com”, 1); 
if (!isset($_SESSION['login']) || $_SESSION['login'] !== "administrateur") { 
   header ('Location: index.php'); 
   exit();  
}  
?>
<?php include 'inc.php'; ?>
<?php
include_once("./../fckeditor/fckeditor.php") ;

?>

<?php
$mois = date("m");
$annee = date("Y");
$jour = date("d");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="author" content="" />
 <link href="../fckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
    <title>Admin : lebabi.net</title>

   
    <link rel="stylesheet" href="../css/general.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/calendar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/fancybox.css" type="text/css"  media="screen" />
    <link rel="stylesheet" href="../css/message.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/form.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/wysiwyg.css" type="text/css" media="screen" />
  
    <!--[if IE ]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="css/ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.ui.js"></script>
    <script type="text/javascript" src="../js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="../js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="../js/onload-index.js"></script>
	
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
	
  <script language="javascript" type="text/javascript">   
function SetFocus(InputID)   
{   
   document.getElementById(InputID).focus();   
}   
</script> 

	
	
	
	





<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

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

<script type="text/javascript" src="jquery-1.2.1.pack.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("refproduits.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>








	
	
	
	
	
	
	
	
	
	
	
	
</head>

  <body class="common" onLoad="document.getElementById('inputString').focus();" >
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
			  <li><a href="#mainTab-1" onclick="this.blur();"><strong>ACTUALITE - INSERTION</strong></a></li>
               <!-- <li><a href="#mainTab-5" onclick="this.blur();">Liste</a></li>
					<li><a href="#mainTab-3" onclick="this.blur();">Recherche</a></li>-->
                
              </ul>
              <div class="clear"></div>
  
              <!-- ****************** MAIN TAB CONTENT 1 ****************** -->
              <div id="mainTab-1">

                <!-- ****************** SUB TABS MENU ****************** -->
                <div id="insideTabs">
                  

                  <!-- ****************** SUB TAB 1 CONTETN ****************** -->
                  
					
                    
					<table width="100%" border="0" cellspacing="8" cellpadding="8">
            
            <tr>
              <td>
              
              
              <form action="insertion2.php" method="post" enctype="multipart/form-data" name="formu">
  <table width="100%" border="0" align="left" cellpadding="1" cellspacing="1">
    
    
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    
	
	<tr>
      <td><div align="right">Rubriques</div></td>
      <td><select name="rub" id="select" >	  
	<option value="act">Acualité Nationale</option>
     <option value="int">International</option>
      <option value="afrik">Afrique</option>
       <option value="apo">APO</option>
        <option value="spo">Sport</option>
          <option value="aut">Autres Médias</option>
         <option value="eco">Economie</option>
          <option value="dos">Dossiers & Reportages</option>
              <option value="hgt">Higt TECH</option>
             <option value="rel">Religion & Spiritualilé</option>
               <option value="san">Santé</option>
              <option value="vid">Vidéos</option>
               <option value="docs">Documents</option>
          <!-- <option value="int">International</option>
           <option value="spo">Sport</option>
           <option value="" disabled="disabled">-----------</option>
            <option value="biz">Business</option>
           <option value="dos">Dossiers Business</option>	
           -->	
		
		

      </select></td>
      </tr>
	<tr>
	  <td><div align="right">Position</div></td>
	  <td><select name="position" id="sousrubrique" ><br />
      <option value="" selected="selected">Sans</option>  
      <option value="une">Principale</option>
       <option value="v1">Video 1</option>
      <option value="v2">Video bas gauche</option>
            <option value="v3">Video bas droite</option>
           
           
         
         
        
      </select></td>
	  </tr>
<!--	<tr>
	  <td>&nbsp;</td>
	  <td><select name="make" style="width:160px;"></select> <select name="type" style="width:160px;"></select> <select name="model" style="width:160px;"></select><input type="button" value="Reset" onClick="resetListGroup('moovfun')"></td>
    </tr>
	-->
	
	
    <tr>
      <td><div align="right">Fichier</div></td>
      <td><input name="urlimage[0]" type="file" /></td>
      </tr>
      
       <tr>
      <td><div align="right">Titre Photo </div></td>
      <td><input type="text" size="160" name="loc" /></td>
      </tr>
      
    <tr>
      <td width="15%"><div align="right"><strong>Titre Principale </strong></div></td>
      <td width="85%" valign="top">
	  <textarea cols="120" rows="2"  name="titre"></textarea></td>
      </tr>
	
	<tr>
      <td width="15%"><div align="right">Titre2 </div></td>
      <td width="85%" valign="middle"><textarea cols="120" rows="2"  name="titre2"></textarea>	   </td>
      </tr>
    
       <tr>
      <td><div align="right">Lien http://</div></td>
      <td><input type="text" size="70" name="lien" />
        <strong>* OBLIGATOIRE POUR AUTRE MEDIA</strong></td>
    </tr>
    <tr>
      <td><div align="right">Target</div></td>
      <td><select name="target" id="target" >
        <option value="" selected="_parent">Parent</option>        
        <option value="_blank" >Blank</option>
      </select></td>
    </tr>
    
    
    <tr>
      <td><div align="right">Texte</div></td>
      <td><?php
$oFCKeditor = new FCKeditor('FCKeditor1') ;
$oFCKeditor->BasePath = '../fckeditor/' ;
$oFCKeditor->Config['EnterMode'] = 'br';
// $oFCKeditor->Value = '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;

?></td>
      </tr>
	
	
	
    <tr>
      <td><div align="right">Source</div></td>
      <td><select name="source1" id="select" >
	
	  
<option value="AIP" >AIP</option>
<option value="AFP" >AFP</option>
<option value="Autre Presse" >Autre Presse</option>
<option value="Fraternite Matin" > Fraternite Matin</option>
<option value="L'Expression" > L'Expression</option>
<option value="L'Intelligent d'Abidjan" >L'Intelligent d'Abidjan</option>
<option value="L'Inter" >L'Inter</option>
<option value="Le Jour Plus" >Le Jour Plus</option>
<option value="Le Patriote" >Le Patriote</option>
<option value="Le Mandat" >Le Mandat</option>
<option value="Le Quotidien" >Le Quotidien</option>
<option value="Le Repère" >Le Repère</option>
<option value="Le Temps" >Le Temps</option>
<option value="Nord-Sud" >Nord-Sud</option>
<option value="Notre Voie" >Notre Voie</option>
<option value="Nouveau Reveil" >Nouveau Reveil</option>
<option value="RFI" >RFI</option>
<option value="Soir Info" >Soir Info</option>
<option value="" selected="selected" >Autre</option>
	  
      </select></td>
      <td>&nbsp;</td>
    </tr>
   
    <tr>
      <td><div align="right">Autre </div></td>
      <td><input type="text" size="50" name="source2" /></td>
      </tr>
   
    <tr>
      <td><div align="right">Date</div></td>
      <td>
	  
	<input type="text" name="date_actu" value="<?php echo "$jour/$mois/$annee" ?>" readonly="readonly"/>
    <a href="#" onClick=" window.open('../include/pop.calendrier.php?frm=formu&amp;ch=date_actu','calendrier','width=415,height=160,scrollbars=0').focus();"><img src="./images/petit_calendrier.gif" border="0" alt="calendrier"/></a>      </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Submit"></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </table>
  
</form>
              
              </td>
            </tr>
          </table>
		  
		  
		  
		 
					
					
					
                    <div class="clear"></div>

                <!--insideTab-1-->
                  
                  
                 
                  
                  
                </div> <!--insideTabs-->

              </div> <!--mainTab-1-->
              
             
              
             
              
              
              
              
              
             
			  

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
