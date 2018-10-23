<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>SocialAuth v5.0 Examples</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="padding: 40px 15px;">
<style>
    .form-signin{
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }


    .login-input {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .btn-center{
        width: 50%;
        text-align: center;
        margin: inherit;
    }
</style>

<div class="container">

    <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>

    <div class="container text-center">
        <form class="form-signin" data-ember-action="2" onsubmit="return false;" action="">
            <h2 class="form-signin-heading">Last Step for Signup</h2>

            <small class="text-muted">Enter your email address.
                <a href="#" id="mail-why" data-toggle="modal" data-target="#email-why-modal">Why?</a></small>
            <br><br>
            <input type="hidden" name="network" value=""/>
            <div class="form-group" id="email-why-div">
                <label class="control-label" for="email-why" style="display: none;">Invalid email</label>
                <input id="email-why" class="ember-view ember-text-field form-control login-input" placeholder="Email Address" type="text" name="email-why" value=""/>
            </div>

            <script id="metamorph-22-start" type="text/x-placeholder"></script><script id="metamorph-22-end" type="text/x-placeholder"></script>
            <br/>
            <button class="btn btn-lg btn-primary btn-block btn-center" type="button" data-bindattr-3="3" id="finish-signup">Finish Signup</button>
        </form>
    </div>
    <div id="email-why-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="padding: 20px">
                <b><?php echo ucfirst($_GET["sa_login_email_verify"]); ?></b> does not provide user's email address, so we need to get your email address for once
            </div>
        </div>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            var emailPattern = /^([\w\.-]{1,64}@[\w\.-]{1,252}\.\w{2,4})$/i;
            $("#finish-signup").on("click", function() {
                var email = $("#email-why").val();
                if (emailPattern.test(email)) {
                    $("#email-why-div").removeClass("has-error");
                    $("#email-why-div .control-label").hide();
                    $.post("finish-signup.php", {check_email: email, network: '<?php echo $_GET["sa_login_email_verify"]; ?>'})
                        .done(function(response) {
                            var response = JSON.parse(response);
                            if (response.result) {
                                window.location.href = '<?php echo $_GET["sa_callback"]; ?>';
                            } else {
                                alert(response.response);
                            }

                        });
                } else {
                    $("#email-why-div").addClass("has-error");
                    $("#email-why-div .control-label").show();
                    return;
                }
            });
        });
    </script>
</body>
</html>