<?php
session_start();
/*
include('config.php');
include('Hybrid/Auth.php');
if(isset($_GET['provider']))
{
$provider = $_GET['provider'];
try{
    $hybridauth = new Hybrid_Auth( $config );
    $authProvider = $hybridauth->authenticate($provider);
    $user_profile = $authProvider->getUserProfile();
    if($user_profile && isset($user_profile->identifier))
    {
        echo "<b>Name</b> :".$user_profile->displayName."<br>";
        echo "<b>Profile URL</b> :".$user_profile->profileURL."<br>";
        echo "<b>Image</b> :".$user_profile->photoURL."<br> ";
        echo "<img src='".$user_profile->photoURL."'/><br>";
        echo "<b>Email</b> :".$user_profile->email."<br>";
        echo "<br> <a href='logout.php'>Logout</a>";
    }           
 
    }
    catch( Exception $e )
    { 
         switch( $e->getCode() )
         {
                case 0 : echo "Unspecified error."; break;
                case 1 : echo "Hybridauth configuration error."; break;
                case 2 : echo "Provider not properly configured."; break;
                case 3 : echo "Unknown or disabled provider."; break;
                case 4 : echo "Missing provider application credentials."; break;
                case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                         break;
                case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                         $authProvider->logout();
                         break;
                case 7 : echo "User not connected to the provider.";
                         $authProvider->logout();
                         break;
                case 8 : echo "Provider does not support this feature."; break;
        }
 
        echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();
 
        echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
 
    }
 
}
*/

if(isset($_REQUEST["provider"]))  
{  
     
   //On appelle la librairie  
   $config = $_SERVER['DOCUMENT_ROOT']."/hybridauth/hybridauth/config.php";  
   require_once( $_SERVER['DOCUMENT_ROOT']."/hybridauth/hybridauth/Hybrid/Auth.php" );  
   //Initialisation  
   try{$hybridauth = new Hybrid_Auth( $config );  
      //On  affecte le provider  
      $provider = @ trim( strip_tags( $_GET["provider"] ) );  
      // On tente une authentification  
      $adapter = $hybridauth->authenticate( $provider );  
      $adapter = $hybridauth->getAdapter( $provider );  
      //On récupère les informations du profile  
      $user_data = $adapter->getUserProfile();  
      /* les variables sont stockées dans $user_data. 
      On interroge notre base de données pour voir si l'adresse email($user_data->email) est déjà attachée à un compte*/  
      if($user)//Si le compte existe on authentifie  
      {  
         //Création des variables de session   
      }  
      else  
      {  
	  /* on linserre dans la bd, on ouvre une session et on le redirige vers bienvenue de nouvel inscripttion  */
         /*Sinon on redirige le visiteur vers le formulaire d'inscription en récupérant au préalable les données qui nous intéressent en vue de pré-remplir les champs*/  
         header('location:/connect.html');  
		 //header('location:/register.html?email='.$user_data->email);  
         exit;   
      }  
   }  
catch( Exception $e ){    
  
    // In case we have errors 6 or 7, then we have to use Hybrid_Provider_Adapter::logout() to   
    // let hybridauth forget all about the user so we can try to authenticate again.  
    // Display the recived error,   
    // to know more please refer to Exceptions handling section on the userguide  
    switch( $e->getCode() ){   
        case 0 : echo "Unspecified error."; break;  
        case 1 : echo "Hybriauth configuration error."; break;  
        case 2 : echo "Provider not properly configured."; break;  
        case 3 : echo "Unknown or disabled provider."; break;  
        case 4 : echo "Missing provider application credentials."; break;  
        case 5 : echo "Authentication failed. "   
                  . "The user has canceled the authentication or the provider refused the connection.";   
        case 6 : echo "User profile request failed. Most likely the user is not connected "  
                  . "to the provider and he should to authenticate again.";   
               $adapter->logout();   
               break;  
        case 7 : echo "User not connected to the provider.";   
               $adapter->logout();   
               break;  
    }   
    echo "  
  
<b>Original error message:</b> " . $e->getMessage();  
    echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";    
}  
}  
?>