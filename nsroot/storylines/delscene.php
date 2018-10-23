<?php
/*
session_start();  
if (!isset($_SESSION['admin_session_id'])) { 
   header ('Location: ./index.php'); 
   exit();  
} 
*/ 
?>
<html>
<head>
<title>Suppression</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
function confirmer () {
rep=confirm("Confirmer la suppression ?");
if (rep==true) 
	document.formulaire.reponse.value="vrai";
	else document.formulaire.reponse.value="faux";
return document.formulaire.reponse.value;
}
</script>
</head>

<body>
<form name="formulaire" action="delscene2.php" method="POST">
  <input type="hidden" name="op" value="<?php echo $_GET['op'];?>">
  <input type="hidden" name="reponse">
</form>

<script language="JavaScript" type="text/JavaScript">
confirmer ();
document.formulaire.submit();
</script>

</body>
</html>
