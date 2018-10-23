<?php
include'includes/global.inc.php';
require_once('lib/recaptchalib.php');
$publickey = "6Lf7xAsTAAAAAJjD4eU4cBMh1RgTo6RG1UShxbND";
//require_once('lib/recaptchalib.php');
//require_once('lib/keys.php');
?>
<?php
	
	if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
		
		?>
        <?php
	
	//require_once('lib/recaptchalib.php');
$privatekey = "6Lf7xAsTAAAAALsIW37MWU4omEqoITpHUwpXk_ag";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

$resp = recaptcha_check_answer (
$privatekey,
$_SERVER["REMOTE_ADDR"],
$_POST["recaptcha_challenge_field"],
$_POST["recaptcha_response_field"]
);
//var_dump($resp);

if($resp->is_valid) {
	
	$date = date("Y-m-d");
	
	
	 $sql0 = 'SELECT count(*) FROM members WHERE Login="'.mysql_clean(@$_POST['login']).'" AND Password="'.mysql_clean(@$_POST['password']).'"'; 
      $req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
      $data0 = mysql_fetch_array($req0); 
	  
	    if ($data0[0] == 0) { 
		
		
	$sql = 'INSERT INTO members (Date,LastName,FirstName,Login,Password,Email,Account) 
			             VALUES
			              ("'.$date.'", "'.mysql_clean($_POST['lastname']).'", "'.mysql_clean($_POST['firstname']).'", "'.mysql_clean($_POST['login']).'", "'.mysql_clean($_POST['password']).'", "'.mysql_clean($_POST['email']).'", "'.mysql_clean($_POST['account']).'")'; 
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
			        //$_SESSION['cel'] = $data1['cel'];
		        //	$_SESSION['login'] = $data1['login'];
					
						redirect_to('myaccount.php');
			//header('Location:mc_main.php');
				exit;
			
			}
			elseif ($data0[0] == 0) { 
redirect_to('index.php');
        // $erreur = '<font color=#ff0000><b>Compte non reconnu</b></font>';
		// $erreur = '<b>VOTRE MESSAGE A ETE POSTE AVEC SUCCES, NOUS VOUS CONTACTERONS TRES RAPIDEMENT</b>';
      } 
	  
			
						

	
	?>
    
  
    
    <?php } else { 
    
    $erreur = '<b><font color=#ff0000>The text in captcha is incorrect Seized</font></b><br>';
	  $error = $resp->error;
    
     } ?>
	
	 <?php } 
	 
	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes : Register</title>
<?php include'css.php'; ?>
<?php include'fonts.php'; ?>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<SCRIPT type="text/javascript" src="files/jquery.validate.js"></SCRIPT>
<SCRIPT type="text/javascript" src="files/jquery.metadata.js"></SCRIPT>
<SCRIPT type="text/javascript" src="files/jscal2.js"></SCRIPT>
<SCRIPT src="files/cmxforms.js" type="text/javascript"></SCRIPT> 
<SCRIPT src="files/additional-methods.js" type="text/javascript"></SCRIPT>
	

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
	
       <?php include 'date-subheader.php' ; ?> 
        

		<?php include 'menu.php' ; ?>
       <!-- End Row2 -->

	</header>
	<!-- End Header -->
	<!-- End Header -->
	<div class="banner">
	<div class="inner-banner">
		<div class="note">Registration   &nbsp;&nbsp;  <?php
	  
 if (isset($erreur)) echo '',$erreur;
?></div>
		<div class="site-map">
    	You are here :<a href="index.html">Home</a> &gt; Registration
		</div>
	<div class="clear"></div>
	</div>
	</div>

	<!-- Container -->
	<div class="wrapper dark">

		<div class="main-blog column9">
        
        <div class="contact-row dark">
	  <div class="msg-form column8">
        <form  class="formular" name="captchaform" id="captchaform" method="post" action="">
               <div class="homeform">LAST NAME</div><input name="lastname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['lastname'])) echo stripslashes(htmlentities(trim($_POST['lastname']))); ?>" minlength="3" id="lastname" type="text">
             
					<div class="homeform">FIRST NAME</div><input name="firstname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['firstname'])) echo stripslashes(htmlentities(trim($_POST['firstname']))); ?>" minlength="3" id="firstname" type="text">
                    
					<div class="homeform">EMAIL</div> <input name="email" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>"  class="{validate:{required:true, email:true, messages:{required:&#39;* This field is required&#39;, email:&#39; * Enter a valid email&#39;}}}" type="text">
                    
                    
					<div class="homeform">LOGIN</div> <input name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Enter at least 6 characters&#39;}}}" minlength="6" type="text" >
                   
                 
               <div class="homeform">SELECT ACCOUNT </div>  <select name="account">
               
<option value="Regular" selected="selected">Regular User</option>
<option value="Power">Power User</option>

</select>

<div class="homeform">PASSWORD</div> <input name="password" value="<?php if (isset($_POST['password'])) echo stripslashes(htmlentities(trim($_POST['password']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Entrer 6 caracteres minimum&#39;}}}" minlength="6" id="password" type="password" >

<div class="homeform">REPEAT PASSWORD</div> <input name="confirm_password" value="<?php if (isset($_POST['confirm_password'])) echo stripslashes(htmlentities(trim($_POST['confirm_password']))); ?>" id="confirm_password" type="password">
                    
                  <!-- <div class="homeform">PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">
                   <div class="homeform">REPEAT PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">-->
                   
                    <fieldset>
                   
            	<legend>Enter what you see below in form</legend>
            <?php
			echo recaptcha_get_html($publickey);
			?>
			</fieldset>
					
		      <br><input class="submit" type="submit" name="submit" value="Submit">
                <br>
	  				<div id="msg" class="message"></div>
				</form>
                  <br>  <br>
                </div></div>
		  <div class="clear"></div>
		</div>
		<!-- Aside Blog -->
        
        
		<div class="side-blog column3">
			<!-- Tabs -->
            
              <?php include 'form_right.php' ; ?> 
            <br>
            
			<div class="tabs">					
			<div class="tabs-widget clearfix">
	    		<ul class="tab-links clearfix">
	    			<li class="active"><a href="#popular-tab">Last Membres</a></li>
	    			
	    		</ul>

	    		<div id="popular-tab" style="display: block;">
	    			<ul>
	    				<li><a href="#">
	    					<img src="images/tabs3.jpg" alt="">
	    					<p>Sababou<br>
	    					  Register : 2015/09/08    					    
                              </p>
	    					</a>
	    				</li>
	    				<li><a href="#">
	    					<img src="images/tabs3.jpg" alt="">
	    					<p>Lebeni<br>
	    					  Register : 2015/09/07    					    
                              </p>
	    					</a>
	    				</li>
	    				<li><a href="#">
	    					<img src="images/tabs3.jpg" alt="">
	    					<p>boga<br>
	    					  Register : 2015/09/06    					    
                              </p>
	    					</a>
	    				</li>
	    			</ul>
	    		</div>

	    		
			</div>
			<!-- End Tabs -->
            

			

			<div class="widget-text">
				<h3>Text Widget</h3>
				<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet </p>
			</div>
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