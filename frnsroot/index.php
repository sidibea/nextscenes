<?php
// include'connect_db.php';
 include '../includes/connect_db.php' ;
 function mysql_clean($id){
	//$id = mysql_escape_string($id);
	$id = mysql_real_escape_string($id);
	return $id;
}
function redirect_to($url){
		echo '<script type="text/javascript">
		window.location = "'.$url.'"
		</script>';
}
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>NEXTSCENES.COM ADMIN</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<script type="text/javascript" src="js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/custom/general.js"></script>
<script type="text/javascript" src="js/custom/index.js"></script>
<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body class="loginpage">

	<div class="loginbox">
    	<div class="loginboxinner">
        	
            <div class="logo">
            	
                <p>My Space Admin</p>
                 <div align="center"> <img src="   http://www.nextscenes.com/img/logo.png" alt="">
            </div><!--logo-->
            
          
            
            <div class="nousername">
				<div class="loginmsg"><?php
if (isset($erreur)) echo '<br />',$erreur;  
?></div>
            </div><!--nousername-->
            
            <div class="nopassword">
				<div class="loginmsg"><?php
if (isset($erreur)) echo '<br />',$erreur;  
?></div>
                
            </div><!--nopassword-->
            
            <form id="login" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            	
                <div class="username">
                	<div class="usernameinner">
                    	<input type="text" name="login" id="login" />
                    </div>
                </div>
                
                <div class="password">
                	<div class="passwordinner">
                    	<input type="password" name="password" id="password" />
                    </div>
                </div>
                
                <button name="connexion" value="Connexion" >Sign In</button>
                
              
            
            </form>
            
        </div><!--loginboxinner-->
    </div><!--loginbox-->


</body>

</html>
