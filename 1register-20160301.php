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
	
	
	 $sql0 = 'SELECT count(*) FROM members WHERE Login="'.mysql_clean(@$_POST['login']).'"'; 
      $req0 = mysql_query($sql0) or die('Erreur SQL !<br />'.$sql0.'<br />'.mysql_error()); 
      $data0 = mysql_fetch_array($req0); 
	  
	    if ($data0[0] == 0) { 
		
		
	$sql = 'INSERT INTO members (Date,LastName,FirstName,Login,Password,Email,Account) 
			             VALUES
			              ("'.$date.'", "'.mysql_clean($_POST['lastname']).'", "'.mysql_clean($_POST['firstname']).'", "'.mysql_clean($_POST['login']).'", "'.mysql_clean($_POST['password']).'", "'.mysql_clean($_POST['email']).'", "'.mysql_clean($_POST['account']).'")'; 
            mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
			
			// Envoi du Mail
			
$to= ''.$_POST['email'].'';
$subj = 'Welcome to Nextscenes.com';
$msg = '
<html> 
     <head> 
     <title>WELCOME NEXTSCENES.COM</title> 
     </head> 
     <body> <center> <img src="http://www.nextscenes.com/images/logo.png" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
	 
	 <div align=left>
	 <h3><font color=#698C00> Hi '.$_POST['firstname'].', </font></h3>
	  We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
</div></body> 
     </html>';
 
// Headers
$headers = 'From: Nextscenes.com <info@nextscenes.com>'."\r\n";
$headers .='Reply-To: info@nextscenes.com'."\n"; 
//$headers .= "\r\n";
$headers .= "MIME-version: 1.0\n";
$headers .= "Content-type: text/html; charset= iso-8859-1\n";
// Function mail()
mail($to, $subj, $msg, $headers);
			
$_SESSION['email'] = $_POST['email'];
						redirect_to('myaccount.php');
			//header('Location:mc_main.php');
				exit;
			
			}
			
			
			 else {
                $erreur = '<font color=#ff0000><b>This login is already used, please change your login.</b></font>';
            }
			/*
			elseif ($data0[0] == 0) { 
redirect_to('index.php');
        // $erreur = '<font color=#ff0000><b>Compte non reconnu</b></font>';
		// $erreur = '<b>VOTRE MESSAGE A ETE POSTE AVEC SUCCES, NOUS VOUS CONTACTERONS TRES RAPIDEMENT</b>';
      } 
	  
	*/		
						

	
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
 
 <script>

//"Accept terms" form submission- By Dynamic Drive
//For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
//This credit MUST stay intact for use

var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return true
else{
alert("Please read/accept terms to submit form")
return false
}
}
}

</script>

         

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
      <div class="div-wrapper">
    <img src="images/free_registration.png" />
</div>
     
        <form  class="formular" name="captchaform" id="captchaform" method="post" action="" onSubmit="return testChamps(this);">
        
         <fieldset>
                   
            	<legend><strong>YOUR ACCOUNT INFORMATIONS</strong></legend>
               
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="27%"><div class="homeform">LAST NAME</div></td>
    <td width="73%"> <input name="lastname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['lastname'])) echo stripslashes(htmlentities(trim($_POST['lastname']))); ?>" minlength="3" id="lastname" type="text"></td>
  </tr>
  <tr>
    <td><div class="homeform">FIRST NAME</div></td>
    <td><input name="firstname" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39;* Enter at least 3 characters&#39;}}}" value="<?php if (isset($_POST['firstname'])) echo stripslashes(htmlentities(trim($_POST['firstname']))); ?>" minlength="3" id="firstname" type="text"></td>
  </tr>
  <tr>
    <td><div class="homeform">EMAIL</div></td>
    <td> <input name="email" value="<?php if (isset($_POST['email'])) echo stripslashes(htmlentities(trim($_POST['email']))); ?>"  class="{validate:{required:true, email:true, messages:{required:&#39;* This field is required&#39;, email:&#39; * Enter a valid email&#39;}}}" type="text"></td>
  </tr>
  
  <tr>
    <td><div class="homeform">LOGIN</div></td>
    <td><input name="login" value="<?php if (isset($_POST['login'])) echo stripslashes(htmlentities(trim($_POST['login']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Enter at least 6 characters&#39;}}}" minlength="6" type="text" ></td>
  </tr>
  
  <tr>
    <td> <div class="homeform">SELECT ACCOUNT </div></td>
    <td> <select name="account">
               
<option value="Regular" selected="selected">Regular User</option>
<option value="Power">Power User</option>

</select></td>
  </tr>
  
  <tr>
    <td><div class="homeform">PASSWORD</div></td>
    <td> <input name="password" value="<?php if (isset($_POST['password'])) echo stripslashes(htmlentities(trim($_POST['password']))); ?>" class="{validate:{required:true, nowhitespace:true, messages:{required:&#39;* This field is required&#39;, minlength:&#39; * Entrer 6 caracteres minimum&#39;}}}" minlength="6" id="password" type="password" ></td>
  </tr>
  
  <tr>
    <td><div class="homeform">REPEAT PASSWORD</div></td>
    <td><input name="confirm_password" value="<?php if (isset($_POST['confirm_password'])) echo stripslashes(htmlentities(trim($_POST['confirm_password']))); ?>" id="confirm_password" type="password"></td>
  </tr>
  
  <!-- <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
</table>
</fieldset>
        
        
              
             
	 <fieldset>
                   
            	<legend><strong>ENTER WHAT YOU SEE IN FORM - CAPTCHA SECURITY</strong></legend>
            <?php
			echo recaptcha_get_html($publickey);
			?>
			</fieldset>				
                    
					
                    
                    
					 
                   
                 
               



 



                    
                  <!-- <div class="homeform">PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">
                   <div class="homeform">REPEAT PASSWORD</div> <input name="password" id="subject" type="password" data-value="Password">-->
                   
                   
            
     
      <fieldset>
                   
            	<legend><strong>NEXTSCENES TERMS</strong></legend>       
            
            
<textarea rows="5" name="S1" cols="30" style="width:95%" wrap="virtual">

By using this website and the services contained therein (services) you agree to comply with and be bound by the following terms and conditions (“terms of use”). If you do not agree to and accept these terms of use, you should not use this website. All references within these terms of use to we/us/our refer to NextScenes.com.

Terms of Use 
Nextscenes Interactive is pleased to provide to you its sites, software, applications, content, products and services (“Nextscenes Services”), These terms govern your use and our provision of the Nextscenes Services on which these terms are posted, as well as Nextscenes Services we make available on third-party sites and platforms if these terms are disclosed to you in connection with your use of the Nextscenes Services. 

PLEASE READ THESE TERMS CAREFULLY BEFORE USING THE NEXTSCENES SERVICES.

NOTHING IN THESE TERMS IS INTENDED TO AFFECT YOUR RIGHTS UNDER THE LAW IN YOUR USUAL PLACE OF RESIDENCE. IF THERE IS A CONFLICT BETWEEN THOSE RIGHTS AND THESE TERMS, YOUR RIGHTS UNDER APPLICABLE LOCAL LAW WILL PREVAIL.

1. Contract between You and Us
This is a contract between you and Nextscenes (state your Local address of business & country) or between you and any different service provider identified for a particular Nextscenes Service. You must read and agree to these terms before using the Nextscenes Services. If you do not agree, you may not use the Nextscenes Services. These terms describe the limited basis on which the Nextscenes Services are available and supersede prior agreements or arrangements.

Supplemental terms and conditions may apply to some Nextscenes Services, such as rules for a particular competition, service or other activity, or terms that may accompany certain content or software accessible through the Nextscenes Services. Supplemental terms and conditions will be disclosed to you in connection with such competition, service or activity. Any supplemental terms and conditions are in addition to these terms and, in the event of a conflict, prevail over these terms.
We may amend these terms. Any such amendment will be effective thirty (30) days following either our dispatch of a notice to you or our posting of the amendment on the Nextscenes Services. If you do not agree to any change to these terms, you must discontinue using the Nextscenes Services. 

Our customer service representatives are not authorized to we may immediately terminate this contract with respect to you (including your access to the Nextscenes Services) if you fail to comply with any provision of these terms.
2. The Nextscenes Services 
The Nextscenes Services are (literacy entertainment competition outfit which can yield a participant money under the term and conditions of the outfit.

The Nextscenes Services are our copyrighted property or the copyrighted property of our licensors or licensees and all trademarks, service marks, trade names, trade dress and other intellectual property rights in the Nextscenes Services are owned by us or our licensors or licensees. Except as we specifically agree in writing, no element of the Nextscenes Services may be used or exploited in any way other than as part of the Nextscenes Services offered to you. You may own the physical media on which elements of the Nextscenes Services are delivered to you, but we retain full and complete ownership of the Nextscenes Services. We do not transfer title to any portion of the Nextscenes Services to you.

CONTENT AND SOFTWARE LICENSE
If a Nextscenes Service is configured to enable the use of software, content, virtual items or other materials owned or licensed by us, we grant you a limited, non-exclusive, non-sublicensable, non-transferable license to access and use such software, content, virtual item or other material for your personal, noncommercial use only.

You may not circumvent or disable any content protection system or digital rights management technology used with any Nextscenes Service; decompile, reverse engineer, disassemble or otherwise reduce any Nextscenes Service to a human-readable form; remove identification, copyright or other proprietary notices; or access or use any Nextscenes Service in an unlawful or unauthorized manner or in a manner that suggests an association with our products, services or brands. You may not access or use any Nextscenes Service in violation of United States export control and economic sanctions requirements. By acquiring services, content or software through the Nextscenes Services, you represent and warrant that your access to and use of the services, content or software will comply with those requirements.

DISCLAIMERS AND LIMITATION ON LIABILITY
THE NEXTSCENES SERVICES ARE PROVIDED “AS IS” AND “AS AVAILABLE.” WE DISCLAIM ALL CONDITIONS, REPRESENTATIONS AND WARRANTIES NOT EXPRESSLY SET OUT IN THESE TERMS.
WE SHALL NOT BE LIABLE TO YOU FOR INDIRECT, INCIDENTAL, SPECIAL OR CONSEQUENTIAL DAMAGES, INCLUDING LOST OF PROFITS AND PROPERTY DAMAGE, EVEN IF WE WERE ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, NOR SHALL WE BE HELD LIABLE FOR DELAY OR FAILURE IN PERFORMANCE RESULTING FROM CAUSES BEYOND OUR REASONABLE CONTROL. IN NO EVENT SHALL OUR TOTAL LIABILITY TO YOU FOR ALL DAMAGES, LOSSES AND CAUSES OF ACTION EXCEED ONE THOUSAND U.S. DOLLARS (US $1,000).

THESE DISCLAIMERS AND LIMITATIONS DO NOT AFFECT YOUR RIGHTS AS A CONSUMER OR PURPORT TO LIMIT LIABILITY THAT CANNOT BE EXCLUDED UNDER THE LAW IN YOUR USUAL PLACE OF RESIDENCE.

CHANGES TO THE NEXTSCENES SERVICES
The Nextscenes Services are constantly evolving and will change over time. If we make a material change to the Nextscenes Services, we will provide you with reasonable notice and you will be entitled to terminate this contract.

THIRD-PARTY SERVICES AND CONTENT
The Nextscenes Services may integrate, be integrated into, or be provided in connection with third-party services and content. We do not control t those third-party services and content. You should read the terms of use agreements and privacy policies that apply to such third-party services and content.

If you access a Nextscenes Service using an Apple iOS, Android or Microsoft Windows-powered device or Microsoft Xbox One, Apple Inc., Google, Inc. or Microsoft Corporation, respectively, shall be a third-party beneficiary to this contract. However, these third-party beneficiaries are not a party to this contract and are not responsible for the provision or support of the Nextscenes Services. You agree that your access to the Nextscenes Services using these devices also shall be subject to the usage terms set forth in the applicable third-party beneficiary’s terms of service.

MOBILE NETWORKS
When you access the Nextscenes Services through a mobile network, your network or roaming provider’s messaging, data and other rates and fees will apply. Downloading, installing or using certain Nextscenes Services may be prohibited or restricted by your network provider and not all Nextscenes Services may work with your network provider or device.

3. YOUR CONTENT AND ACCOUNT
USER GENERATED CONTENT
The Nextscenes Services may allow you to communicate, submit, upload or otherwise make available text, images, audio, video, competition entries or other content (“User Generated Content”), which may be accessible and viewable by the public. Access to these features may be subject to age restrictions. You may not submit or upload User Generated Content that is defamatory, harassing, threatening, bigoted, hateful, violent, vulgar, obscene, pornographic, or otherwise offensive or that harms or can reasonably be expected to harm any person or entity, whether or not such material is protected by law.

We do not claim ownership to your User Generated Content; however, you grant us a non-exclusive, sublicensable, irrevocable and royalty-free worldwide license under all copyrights, trademarks, patents, trade secrets, privacy and publicity rights and other intellectual property rights to use, reproduce, transmit, print, publish, publicly display, exhibit, distribute, redistribute, copy, index, comment on, modify, adapt, translate, create derivative works based upon, publicly perform, make available and otherwise exploit such User Generated Content, in whole or in part, in all media formats and channels now known or hereafter devised (including in connection with the Nextscenes Services and on third-party sites and platforms such as Facebook, YouTube and Twitter), in any number of copies and without limit as to time, manner and frequency of use, without further notice to you, with or without attribution, and without the requirement of permission from or payment to you or any other person or entity.

You represent and warrant that your User Generated Content conforms to these terms and that you own or have the necessary rights and permissions, without the need for payment to any other person or entity, to use and exploit, and to authorize us to use and exploit, your User Generated Content in all manners contemplated by these terms. You agree to indemnify and hold us and our subsidiary and affiliated companies, and each of their respective employees and officers, harmless from any demands, loss, liability, claims or expenses (including attorneys’ fees), made against us by any third party arising out of or in connection with our use and exploitation of your User Generated Content. You also agree not to enforce any moral rights, ancillary rights or similar rights in or to the User Generated Content against us or our licensees, distributors, agents, representatives and other authorized users, and agree to procure the same agreement not to enforce from others who may possess such rights.

To the extent that we authorize you to create, post, upload, distribute, publicly display or publicly perform User Generated Content that requires the use of our copyrighted works, we grant you a non-exclusive license to create a derivative work using our copyrighted works as required for the purpose of creating the materials, provided that such license shall be conditioned upon your assignment to us of all rights in the work you create. If such rights are not assigned to us, your license to create derivative works using our copyrighted works shall be null and void.

We have the right but not the obligation to monitor, screen, post, remove, modify, store and review User Generated Content or communications sent through a Nextscenes Service, at any time and for any reason, including to ensure that the User Generated Content or communication conforms to these terms, without prior notice to you. We are not responsible for, and do not endorse or guarantee, the opinions, views, advice or recommendations posted or sent by users.

4. MODUS OF OPERATION
The Nextscenes is a Web based content that receives contributions from different sources – individuals or group of individuals. It provides platforms by creating forum for latent creative writers who may not be able to write a full book on their own. Participants above express their view on story lines through the contributions of story Burst, thus release their latent creative energies, which Nextscenes, harness into very compelling reading materials.

ENTRIES
Members make their submissions in form of story Burst and the audience rates the submissions. Submissions with ratings of TEN points will be adopted as part of the story that will form the books. We may disqualify entries that are late, misdirected, incomplete, corrupted, lost, illegible or invalid or where appropriate parental consent was not provided. Use of automated entries, votes or other programs is prohibited and all such entries (or votes) will be disqualified.

We reserve the right to modify, suspend, cancel or terminate an episode or extend or resume the entry period or disqualify any participant or entry at any time without giving advance notice. We will do so if it cannot be guaranteed the competition can be carried out fairly or correctly for technical, legal or other reasons, or if we suspect that any person has manipulated entries or results, provided false information or acted unethically. If we cancel or terminate a competition, prizes may be awarded in any manner we deem fair and appropriate consistent with local laws governing the competition.

ELIGIBILITY
To enter a group, you must be a registered user of the Nextscenes Services and have an active account with current contact information If you are under age 18 (or the age of majority under applicable law) and the system is open to you, we may need your parent or guardian’s consent before we can accept your entry. We reserve the right to request proof of identity or to verify eligibility conditions and potential winning entries, and to award any prize to a winner in person. Competitions are void where prohibited or restricted by law. Potential winners who are residents in jurisdictions where competitions require an element of skill may be required to answer a mathematical test in order to be eligible to win a prize.



REWARD
Members whose contributions were accepted will be compensated from the sale of the books but in proportion to the value of their contribution. Reward cannot be transferred (except to a child or other family member) or sold by winners. Only members whose contributions were accepted in the manner stated above will receive compensation.

Your acceptance of a reward/compensation as stated above constitutes agreement to participate in reasonable publicity related to the competition and grants us an unconditional right to us to use your name, town or city and state, province or country, likeness, prize information and statements by you about the competition for publicity, advertising and promotional purposes and to comply with applicable law and regulations, all without additional permission or compensation. As a condition of receiving a prize, winners (or their parents or guardians) may be required to sign and return an affidavit of eligibility, liability release and publicity release.

5. ADDITIONAL PROVISIONS

SUBMISSIONS AND UNSOLICITED IDEAS POLICIES
Our long-standing company policy does not allow us to accept or consider unsolicited creative ideas, suggestions or materials. In connection with anything you submit to us – whether or not solicited by us – you agree that creative ideas, suggestions or other materials you submit are not being made in confidence or trust and that no confidential or fiduciary relationship is intended or created between you and us in any way, and that you have no expectation of review, compensation or consideration of any type.

SEVERABILITY
If any provision of these terms shall be unlawful, void or for any reason unenforceable, then that provision shall be deemed severable from these terms and shall not affect the validity and enforceability of any remaining provisions.

SURVIVAL
The provisions of these terms which by their nature should survive the termination of these terms shall survive such termination.

WAIVER
No waiver of any provision of these terms by us shall be deemed a further or continuing waiver of such provision or any other provision, and our failure to assert any right or provision under these terms shall not constitute a waiver of such right or provision.

1. The user confirms that the terms and conditions and use of this website of shall be governed by the Laws of the Federal Republic of Nigeria 2011 and that any dispute arising there from shall be subject to the exclusive jurisdiction of Nigerian courts.

7. INDEMNITY 
You acknowledge that you are solely responsible for the use to wish you put this website and all the result and information you obtain from it and that all warranties, conditions, undertaking, representations and terms whether expressed or implied, statutory or other wise are hereby excluded to the fullest extent permitted by law.

Save in respect of liability for death or personal injury arising out of negligence or for fraudulent misrepresentation, we and all contributors to this website hereby disclaim to the fullest extent permitted by law all liabilities for any loss or damages including any consequential or indirect loss or damages incurred by you, whether arising in tort, contract or otherwise, and arising out of or in relation to or in connection with your access to or use of or inability to we this website.

While we take every care to ensure that the standard of this website remains high and to maintain the continuity of it, we do not accept any going obligation or responsibility to operate this website (or any particular part of it). 

If any part of our terms and conditions is deemed to be unenforceable (including any provision in which we exclude or liability to you) the enforceability of any other part of these conditions will not be affected. 

These terms and conditions and your use of this website are governed exclusively by Nigerian Law.

The disclaimers and limitations do not purport to limit liability that cannot be excluded under the law in your usual place of residence.

8. REGISTRATION 
You must be over eighteen years of age to register on our website and must ensure that the details provided by you on registration are true and accurate, current and complete. Not withstanding the above Nextscene Services will also create a forum where minors who show potentials ability for writing will participate in the above subject to their necessary parental approval as required in law. It is your responsibility to up date and inform us of any changes to the details provided on registration. Although certain parts of our website may be used by anyone who visits without requiring registration some of the services require you to register in order to enable us to verify your identity.

By registering with the service, you agree that we can send you emails about your account, other Nextscene.com services and occasional third party offers.

When registering you will be asked to create a password and will be responsible for maintaining the confidentiality of your password and restricting access to your computer as you will be accountable for any activities to your computer, as you will be accountable for any activities conducted under your password. If you believe that someone has accessed your account without authorization please contact us immediately.

9. MEMBERSHIP 
a. To access or use certain parts of the website you must register as a member of the website.
b. When registering as a member of the website you must provide us with accurate, complete and up-to-date information as requested. It is your responsibility to inform us of any change to that information.
c. You are permitted to create one profile for yourself. You must not create multiple member profiles on the website.
d. All personal information you provide to us will be treated in accordance with our privacy policy.

10. TERMINATION OF MEMBERSHIP
a. You may terminate your membership of the website for any reason provided you send us a written notice. You can provide notice of termination by emailing us via the contact us page.
b. We reserve the right without limitation to do any or all of the following in relation to your membership.
i. Suspend your membership
ii. Terminate your membership for any reason by providing notice to you by email.
iii. Terminate your membership immediately without notice to you if you have committed a breach of the terms of use, and.
iv. Permanently or temporarily block your access to all or part of the website.

11. LAW
The user confirms that the terms and conditions and use of this website shall be governed by the Laws of the Federal Republic of Nigeria 2011 and that any and all disputes arising there from shall be subject to the exclusive jurisdiction of Nigerian courts. 

</textarea><br>
<input name="agreecheck" type="checkbox" onclick="agreesubmit(this)"><b>I agree to the above terms</b><br>

</fieldset><br />

<input type="submit" name="submit" value="Submit" disabled>
            
            
					
		     <!-- <br><input class="submit" type="submit" name="submit" value="Submit">-->
                <br>
	  				<div id="msg" class="message"></div>
                    
                    
                    
                    
				</form>
                  <br>  <br>
                </div></div>
		  <div class="clear"></div>
		</div>
		<!-- Aside Blog -->
        
        
		<?php include 'bloc-right2.php' ; ?>
    
	<!-- End Wrapper -->
	<div class="clear">	</div>
	<!-- Footer -->
	</div>
	<?php include 'footer.php' ; ?>

	


</body>
</html>