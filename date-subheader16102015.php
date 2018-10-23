<div class="subheader clearfix">
			<div class="inner-subheader">
				<div class="phone"><strong>NextScenes</strong> - <?php echo date('l j F Y'); ?> - 
                Welcome  
				
				<?php 
				
				
				
if (!empty($_SESSION['idsession']) ) {
@$sqlUser = 'SELECT * FROM members WHERE Idsession="'.mysql_clean($_SESSION['idsession']).'"'; 
$reqUser = mysql_query($sqlUser) or die('Erreur SQL !<br />'.$sqlUser.'<br />'.mysql_error()); 
$dataUser = mysql_fetch_array($reqUser);

if ($dataUser['Account']=='Regular' ) echo ' <strong> '.$dataUser['Login'].' </strong> !  You are a <div class="colorred">'.$dataUser['Account'].' User</div>, you cannot write scenes.';
if ($dataUser['Account']=='Power' ) echo '  <strong> '.$dataUser['Login'].' </strong> !  You are a <div class="colorred">'.$dataUser['Account'].' User </div>, you can write scenes on all forums.';

}	?>
                  </div>

				<div class="subheader2">
              <?php  
                if(empty($_SESSION['idsession'])) 
{
echo ' <ul>
<li><a href="register.html">NEW MEMBER ?  REGISTER</a></li>
<li><a href="connect.html">SIGN IN</a></li>
</ul> ';
}
else
{
echo '
<ul>
<li><a href="account-manage.php">MANAGE YOUR ACCOUNT</a></li>
<li><a href="logout.php">SIGN OUT</a></li>
</ul>
';
}

?>
                    
                    				
</div>
                
                
			</div>
		</div>