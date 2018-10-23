<?php include'includes/global.inc.php'; ?>
<?php
// Si  le formulaire est soumis et on a entr� un identifiant et un mot de passe...
if(isset($_POST['connexion']) and !empty($_POST['login']) and !empty($_POST['password']))  
	
	{
	// On temporise un peu ^pour eviter les flood massifs.
	//sleep(1);

// On se connecte � notre db
// include'includes/functions.inc.php'; 
//include'includes/config/connect_db.php';
 
// on teste si une entr�e de la base contient ce couple mobile / pass 
      $sql0 = 'SELECT count(*) FROM members WHERE login="'.mysql_clean(@$_POST['login']).'" AND password="'.mysql_clean(@$_POST['password']).'"'; 
      $req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
      $data0 = mysql_fetch_array($req0); 
      
 
      // si on obtient une r�ponse, alors l'utilisateur est un membre 
      if ($data0[0] == 1) { 
	  
	  
	                 $sql1 = 'SELECT * FROM members WHERE Login="'.mysql_clean(@$_POST['login']).'" AND Password="'.mysql_clean(@$_POST['password']).'"'; 
					  $req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
					  $data1 = mysql_fetch_array($req1); 
                    
					// on enregistre les parametres du membre dans 2 session pour les utiliser apr�s
					//$_SESSION['cel'] = $data1['cel'];
		        	$_SESSION['login'] = $data1['Login'];
					//$_SESSION['User'] = $data1['Account'];
	 
              
				//$_SESSION['nombre'] = 0;  // On initialise une variable pour eviter les flood 
				//$_SESSION['nombre']++;  // on incr�mente notre variable
				

			// ...on g�n�re alors un identifiant de session qui expirera dans quelques jours ( 2 semaines)
			@$idsession = outils::gen_key();
			// $session_expire = 3600 * 24 * 14;
		//	$expire = time() + $session_expire; // temps d'expiration 
			$_SESSION['idsession'] = $idsession;  // on enregistre cet identifiant dans une session
			
			
		$sql = 'UPDATE members SET Idsession="'.$idsession.'" , Ip= "'.$_SERVER['REMOTE_ADDR'].'" , Lastvisite="'.date("Y-m-d H:i:s").'"  WHERE login="'.mysql_clean($_POST['login']).'" '; 
		 mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
		 
    		
		// on redirige le membre vers sa page de mebre
		
// $referer = getenv("HTTP_REFERER");
// redirect_to($referer);
			
			redirect_to('forums.html');
			
				exit;
			
			}
			elseif ($data0[0] == 0) { 
         $erreur = '<font color=#ff0000><b>Login or Password you entered did not match.</b></font>';
      } 
			
			
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Connexion</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>

	<!-- Start Header -->
	<header id="header">
		
		<!-- Start Header -->
	
       <?php include 'date-subheader.php' ; ?> 
        

		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note">Connexion</div>
		<div class="site-map">
    	You are here :<a href="index.html">Home</a> &gt; Connexion
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
        
         <img src="images/ns728x90.jpg" alt="">
      
       
        <br /><br />
        
        <div class="contact-row dark">
	  <div class="msg-form column8">
      <div class="scenes">
       <fieldset>
            	<legend>Enter your login and Password</legend>
                
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%">
    <div class="search">
				<p>  <?php
	  
 if (isset($erreur)) echo '',$erreur;
?>
          <form id="searchform" action="" method="post">
				  <input type="text" name="login" data-value="login">
		    <br />
		    <input type="password" name="password" data-value="password">
	</p>
		<p>			  
				  <input name="connexion" type="submit">
			            </p>
          </form>
        </div>
    
    </td>
    <td width="50%">
    
    <div align="center">
	
	
	<!--<a href="oauth/hybridauth/login-with.php?provider=Facebook">--><img src='images/facebook.png'></img><!--</a>--> <br><br>
	<br><br>
	</div>
    
    </td>
  </tr>
</table>

        
        
        </fieldset>
        </div>
<br>  <br>

 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- nsads_728X90 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-7956928456310977"
     data-ad-slot="6740124643"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </div></div>
		  <div class="clear"></div>
		</div>
		<!-- Aside Blog -->
        
        
		<div class="side-blog column3">
			<!-- Tabs -->
            
           
		  <div class="tabs">					
			<div class="tabs-widget clearfix">
	    		<ul class="tab-links clearfix">
	    			<li class="active"><a href="#popular-tab">Last Membres</a></li>
	    			
	    		</ul>

	    		<div id="popular-tab" style="display: block;">
	    			<ul>
	    				 <?php
				
$sql1 = 'SELECT * FROM members Order by IdMembers DESC limit 0,5';
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
while($data1 =mysql_fetch_assoc($req1))
{
echo' <li>
	    					<img src="images/tabs3.jpg" alt="">
	    					<p>'.$data1['Login'].'<br>
	    					  Register : '.$data1['Date'].'    					    
                              </p>
	    					
	    				</li>';

} ?>
	    			</ul>
	    		</div>

	    		
			</div>
			<!-- End Tabs -->
            

			

			
		</div>
		<div class="clear"></div>	
	</div>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>


	


</body>
</html>