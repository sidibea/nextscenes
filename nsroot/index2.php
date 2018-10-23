<?php
 include'include/connect_db.php';
 
// include'../../connect_db.php';
// on teste si le visiteur a soumis le formulaire de connexion  
//if(isset($_POST['connexion']) and !empty($_POST['login']) and !empty($_POST['password']))   { 

if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') { 
if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password']))) { 
  

      $sql = 'SELECT count(*) FROM admins WHERE login="'.mysql_clean($_POST['login']).'" AND password="'.mysql_clean($_POST['password']).'"'; 
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
      $data = mysql_fetch_array($req); 
      
     // mysql_free_result($req); 
     // mysql_close(); 
      
      // si on obtient une réponse, alors l'utilisateur est un membre 
      if ($data[0] == 1) { 
	  
	     session_start(); 
       
	  
	 // include'connect_db.php';
	  // on recherche si ce login est déjà utilisé par un autre membre
            $sql1 = 'SELECT * FROM admins WHERE login="'.addslashes($_POST['login']).'"';
            $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error());
            $data1 = mysql_fetch_assoc($req1);
			
				// on enregistre les parametres du membre dans 2 session pour les utiliser aprs
					
		     $_SESSION['login'] = $data1['login'];
	 
			redirect_to('home.php');
			//header('Location:mc_main.php');
				exit;
          
		
		 
		  
      } 
      // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe 
      elseif ($data[0] == 0) { 
         $erreur = 'Compte non reconnu.'; 
      } 
      // sinon, alors la, il y a un gros problème :) 
      else { 
         $erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.'; 
      } 
   } 
   else { 
      $erreur = 'Au moins un des champs est vide.'; 
   }  
}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GINCO ADMIN</title>
<style type="text/css">
<!--
body {
	background-image: url(img/bckg.jpg);
}
-->
</style>


<STYLE type="text/css">
<!--
.td1 {  font-family: "MS Sans Serif"; font-size: 9pt}
.button {  font-family: "MS Sans Serif"; font-size: 9pt;/*  height: 22px; */ width: 75px}
.input {  font-family: "MS Sans Serif"; font-size: 9pt; height: 16px; width: 200px; margin-left: 10px;}
-->
</STYLE>
<SCRIPT language="JavaScript">
<!--
function set_focus() {
  document.pass.username.focus();
}
// -->
</SCRIPT>



 <link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/general.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/form.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/message.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
    
   

	
	<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.ui.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="js/onload-index.js"></script>
	
	<script type="text/javascript" src="js/jquery.validate.pack.js"></script>  
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#contactform").validate();
		});
	</script>

</head>

<body>

<div id="login-page-wrapper">
      <div id="login-form-wrapper">
				<!-- Logo (310px x 80px) -->
				<h1 align="left">&nbsp;</h1>

	
	<TABLE width="401" style="border:solid #ddd 1px" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#fefefe">
        <TBODY>
        <TR align="center">
          <TD width="304" colspan="2">
            <FORM method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
              <TABLE border="0"  cellspacing="0" cellpadding="3" width="93%">
                <TBODY><TR>
                  <TD colspan="2" class="td1" height="50">
                  <br />
                  <div align="center"> <img src="   http://gincogroup.com/img/logo.png" alt="">
               
                  <br />
				    <div align="center"><strong>ESPACE ADMIN </strong><br /></div>
				          <strong><font color="#FF0000">
			              <?php
if (isset($erreur)) echo '<br />',$erreur;  
?>
		            </font></strong><br />
				    </div></TD>
                </TR>
                <TR>
                  <TD width="18%" height="34" class="td1">User</TD>
                  <TD width="70%"><input type="login" name="login" size="25" class="input" />
                    </SELECT>	
				  
				  
				  
				  
				  
                   <!-- <INPUT type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" size="25" class="input"> -->                 </TD>
                </TR>
                <TR>
                  <TD class="td1" height="35" width="18%">Password</TD>
                  <TD height="35" width="70%">
                    <INPUT type="password" name="password" size="25" class="input">                  </TD>
                </TR>
              </TBODY></TABLE>
              <TABLE width="100%" border="0" cellspacing="0" cellpadding="1">
                <TBODY><TR>
                  <TD width="49%" height="38" align="right">
                    <INPUT type="submit" name="connexion" value="Connexion" class="button">                  </TD>
                  <TD align="right" width="2%">&nbsp;</TD>
                  <td width="49%">
                    <INPUT type="reset" value="Effacer" class="button">                  </td>
                </TR>
                  <TR>
                    <TD align="right">&nbsp;</TD>
                    <TD align="right">&nbsp;</TD>
                    <TD>&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD colspan="3" align="center">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD colspan="3"></TD>
                  </TR>
              </TBODY></TABLE>
            </FORM>          </TD>
        </TR>
      </TBODY></TABLE>
      <br />
      </div> 
    </div>

</body>
</html>