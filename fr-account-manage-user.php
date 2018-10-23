<?php include'includes/global.inc.php'; ?>
<?php  if(empty($_SESSION['idsession'])) { redirect_to('connect.html');  exit();} ?>
<?php

// connexion à la db
// on selection la session id et l'expiration du timestamp dans notre bd
@$sql0 = 'SELECT * FROM members WHERE Idsession="'.mysql_clean($_SESSION['idsession']).'" AND Login ="'.mysql_clean($_SESSION['login']).'" '; 
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
$data0 = mysql_fetch_array($req0);

//$_SESSION['email'] = $data0['email'];

// si le timestamp actuel est superieur au timestamp c'est que sa session est dépassé 
//if (time() > $data0['sessionexpire']) {
//$_SESSION['sessionexpire'] = "1";
//header('Location: connexion.php');
//redirect_to('connexion.php');
//exit();
//}
?>


<?php

if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

$sql='UPDATE members SET Account="'.mysql_clean(@$_POST['account']).'" WHERE Idsession="'.mysql_clean($_SESSION['idsession']).'" AND Login ="'.mysql_clean($_SESSION['login']).'" ';mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

  $erreur = '<font color=#ff0000><b> Successfully changed</b></font>'; 

/*		
$sql0 = 'SELECT count(*) FROM members WHERE Login="'.mysql_clean(@$_POST['login']).'" AND Password="'.mysql_clean(@$_POST['password']).'"'; 
$req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
$data0 = mysql_fetch_array($req0); 
*/
	  
 } 
	 
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NextScenes : All Forums</title>

	<link rel="stylesheet" href="/css/bootstrap.html" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/bootstrap-responsive.html" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/dr-framework.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/navigation.css" type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="/css/fullwidth.html" media="screen" />
	<link rel="stylesheet" href="/css/revslider.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/jquery.bxslider.css" type="text/css" media="screen">
	<link rel="stylesheet" href="/css/responsive.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Philosopher:400,700,400italic' rel='stylesheet' type='text/css'>


<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

<SCRIPT type="text/javascript" src="/files/jquery.validate.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/files/jquery.metadata.js"></SCRIPT>
<SCRIPT type="text/javascript" src="/files/jscal2.js"></SCRIPT>
<SCRIPT src="/files/cmxforms.js" type="text/javascript"></SCRIPT> 
<SCRIPT src="/files/additional-methods.js" type="text/javascript"></SCRIPT>
	

	<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<!-- html5.js for IE less than 9 -->
	<!-- css3-mediaqueries.js for IE less than 9 -->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
 	<link rel="stylesheet" type="text/css" href="css/ie8-and-down.css" />
	<![endif]-->
    
    <SCRIPT type="text/javascript">
/*
 $(function(){
	$("#refreshimg").click(function(){
		$.post('newsession.php');
		$("#captchaimage").load('image_req.php');
		return false;
	});
	
	$("#captchaform").validate({
		rules: {
			captcha: {
				required: true,
				remote: "process.php"
			}
		},
		messages: {
			captcha: "Correct captcha is required. Click the captcha to generate a new one"	
		},
		submitHandler: function() {
			alert("Correct captcha!");
		},
		success: function(label) {
			label.addClass("valid").text("Valid captcha!")
		},
		onkeyup: false
	});
	
});
 */
 
 
 	  
	  $(document).ready(function(){
	  
	  $("#refreshimg").click(); // initialiser le premier
	  
	  /*

			$("#refreshimg").click(function(){
				$.post('captcha/newsession.php');
				$("#captchaimage").find("a#refreshimg").load('captcha/image_req.php');
				return false;
			});
	
			*/
		
			var validator = $("#captchaform").submit(function() {
				// update underlying textarea before submit validation
				//tinyMCE.triggerSave();
			}).validate({							   
				meta: "validate",
				errorPlacement: function(label, element) {
					// position error label after generated textarea
					if (element.is("textarea")) {
						label.insertAfter(element.next());
					} else {
						label.insertAfter(element)
					}
				},
				
				
				rules: {
					captcha: {
						required: true,
						remote: "captcha/process.php"
					},
					
					password: {
				required: true,
				minlength: 6
			},
			confirm_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
				
			}
					
										
					
				},
				messages: {
					captcha: {
						required: "Veuillez taper les lettres qui apparaissent dans l'image.",
						remote: "Erreur, Veuillez retaper les lettres"	
					},
					
					password: {
				required: " *This field is required",
				minlength: "Enter at least 6 characters"
			},
			confirm_password: {
				required: "Confirm your Password",
				minlength: "Enter at least 6 characters",
				equalTo: "Enter the same password as above"
				
				
			}
					
					
					
					
				},
								
								
				success: function(label) {
				// set &nbsp; as text for IE
					label.html("&nbsp;").addClass("checked");
				},
				onkeyup: false
			});	
		});	
		
		
		
		
		
		
		
		
		 
		 
		 
    </SCRIPT>
</head>
<body>

	<!-- Start Header -->
	<header id="header">
		
		<!-- Start Header -->
	
       <?php include 'fr-date-subheader.php' ; ?> 
        

		<?php include 'fr-menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note"><strong>Mon Compte</strong>  -    <?php include 'fr-account-manage-menu.php' ; ?></div>
	    <div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
         <div class="note"><strong>Manage  User Profile </strong>
         <?php
	  
 if (isset($erreur)) echo '',$erreur;
?>
         </div>
       <div class="contact-row dark">
         <div class="msg-form column8">
        <div class="headings">
         <blockquote>
         
          <div class="profile">YOUR USER PROFILE</div> <h5 class="hprofile">
		  
		  <?php echo $data0['Account'] ; ?> User
          <br />
          
          
          </h5>
               
                    
                 <br /> 
                
                    
            </blockquote>
          </div>
        </div></div>
          <div class="contact-row dark">
	  <div class="msg-form column8">
        <form  class="formular" name="captchaform" id="captchaform" method="post" action="">
       
                 
                    <fieldset>
                   
            	<legend><strong>Change your user profile</strong></legend>
                
                
                <select name="account">

<option value="<?php echo $data0['Account'] ; ?>" selected="selected"><?php echo $data0['Account'] ; ?> User</option>               
<option value="Regular">Regular User</option>
<option value="Power">Power User</option>

</select>
          
			</fieldset>
            
            
            
            
                   
                 
              


                    
                  <!-- <div class="homeform">PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">
                   <div class="homeform">REPEAT PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">-->
                  
					
		      <br><input class="submit" type="submit" name="submit" value="Submit">
                <br>
	  				<div id="msg" class="message"></div>
		</form>
                  <br>  <br>
            </div></div>
		  <div class="clear"></div>
		</div>
<!-- Aside Blog -->
        
        
		<?php include 'fr-bloc-right2.php' ; ?>
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'fr-footer.php' ; ?>

	


</body>
</html>