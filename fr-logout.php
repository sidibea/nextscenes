<?php include'includes/global.inc.php'; ?>
<?php
//session_start();

$sql0 = 'SELECT login FROM members WHERE idsession="'.mysql_clean($_SESSION['idsession']).'" '; 
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
$data0 = mysql_fetch_array($req0);

// je vide lidsession
$sql2=' UPDATE members SET idsession = ""  WHERE login = "'.mysql_clean($data0['login']).'"';
@$req2= mysql_query($sql2)or die('Erreur SQL!<br>'.$sql2.'<br>'.mysql_error());

// Je detruis la session
session_destroy();

//session_destroy($_SESSION['idsession']);

//$_SESSION['logout'] = "logout"; 

$referer = getenv("HTTP_REFERER");
redirect_to($referer);

// redirect_to('index.html');


/*
$referer = getenv("HTTP_REFERER");
//redirect_to($referer);

if ($referer == 'http://127.0.0.1/Projet%20Moov/mc_main.php') {
redirect_to('index.php');
}
else
{
redirect_to($referer);
}
 */
exit();  
?> 

