<?php include("../action.php"); if(isset($_SESSION['admin'])){header("location: dashboard");}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>News Login</title>
<link href="css/xpanel.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="formLogin">
        <div class="intExtra">
            <div class="loginInfo">NEXTSCENES BLOG ADMIN LOGIN</div>
            <?php $db->incorrectcombination();?>
            <form id="contactForm" novalidate class="e-form wow zoomInUp into" data-wow-delay="0.5s" method="post" action="../action.php?action=login">
                <input type="text" placeholder="*Username" value="" name="username" id="user-name" required="required" />
                <input type="password" placeholder="Passord" value="" name="password" id="user-phone" required="required" />
                <button type="submit" class="btn m-btn">LOGIN NOW<span class="fa fa-angle-right"></span></button>
            </form>
        </div>
    </div>
</body>
</html>