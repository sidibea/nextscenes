<?php
session_start();
setlocale (LC_TIME, 'fr_FR','fra');
date_default_timezone_set("Africa/Abidjan");

@ini_set('session.use_trans_sid', '0');
include'functions.inc.php';
include'connect_db.php';


$jour= array("Dimanche","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
		$mois= array("","Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "Décembre");
		
		$mois2= array("","01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		
		$lejour= $jour[date("w")];
		$lejournum= date("j");
		$lemois= $mois[date("n")];
		$lannee= date("y");
		
		$lemois2= $mois2[date("n")];
		$datelocal = "20$lannee-$lemois2-$lejournum" ;
		//$datelocal2 = "20$lannee-$lemois2-$lejournum" ;
?>