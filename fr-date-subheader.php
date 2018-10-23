<div class="subheader clearfix">
			<div class="inner-subheader">
				<div class="phone"><strong>NextScenes</strong> - 
				 <?php 

		$jour= array("Dimanche","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
		$mois= array("","Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
		
		$mois2= array("","01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		
		$lejour= $jour[date("w")];
		$lejournum= date("j");
		$lemois= $mois[date("n")];
		$lannee= date("y");
		echo '<span class="date">'.$lejour.' '.$lejournum.' '.$lemois.' 20'.$lannee.'</span>';
		
		//$lemois2= $mois2[date("n")];
		//$datelocal = "20$lannee-$lemois2-$lejournum" ;
		//echo $datelocal;
		?>
				<?php // echo date('l j F Y'); ?> - 
                Bienvenue !  
				
				<?php 
				
				
				
if (!empty($_SESSION['idsession']) ) {
@$sqlUser = 'SELECT * FROM members WHERE Idsession="'.mysql_clean($_SESSION['idsession']).'"'; 
$reqUser = mysql_query($sqlUser) or die('Erreur SQL !<br />'.$sqlUser.'<br />'.mysql_error()); 
$dataUser = mysql_fetch_array($reqUser);

if ($dataUser['Account']=='Regular' ) echo ' <strong> '.$dataUser['Login'].' </strong> !  Vous &ecirc;tes un <div class="colorred"> Utilisateur '.$dataUser['Account'].'</div>'; // , vous ne pouvez pas &ecirc;crire de sc&egrave;nes
if ($dataUser['Account']=='Power' ) echo '  <strong>  '.$dataUser['Login'].' </strong> !  Vous &ecirc;tes  un <div class="colorred"> Utilisateur '.$dataUser['Account'].' </div>'; // , vous pouvez &ecirc;crire des sc&egrave;nes dans les forums.

}	?>
                  </div>

				<div class="subheader2">
              <?php  
                if(empty($_SESSION['idsession'])) 
{
echo ' <ul>
<li><a href="../">EN</a></li>
<li><a href="register.html">NOUVEAU ?  S\'ENREGISTRER</a></li>
<li><a href="connect.html">SE CONNECTER</a></li>
</ul> ';
}
else
{
echo '
<ul>
<li><a href="manage.html">GERER SON COMPTE</a></li>
<li><a href="logout.html">SE DECONNECTER</a></li>
</ul>
';
}

?>
                    
                    				
</div>
                
                
			</div>
		</div>