<?php $page = "login"; require "functions.php"; ?>
<?php if(isset($_POST['login_site'])){ loginUser($_POST['username'], $_POST['password']); } ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nextscenes &bull; Login</title>
<link href="css/xpanel.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="formLogin">
        <div class="intExtra">
            <div class="loginInfo">NEXTSCENES SUPER ADMIN LOGIN</div>
            <?php if (isset($_GET['login']) && $_GET['login'] == "fail"){ echo "<p class='alert txtcenter'>Please enter valid login credentials</p>";} ?>
            <form id="contactForm" novalidate class="e-form wow zoomInUp into" data-wow-delay="0.5s" method="post" action="" name="login_form" class="login_form">
                <input type="text" placeholder="*Username" value="" name="username" id="user-name" required="required" />
                <input type="password" placeholder="Passord" value="" name="password" id="user-phone" required="required" />
				<input type="hidden" name="login_attempt" value="1" />
                <button type="submit" class="btn m-btn" name="login_site">LOGIN NOW<span class="fa fa-angle-right"></span></button>
            </form>
        </div>
    </div>
</body>
</html>