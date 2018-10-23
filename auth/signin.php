<?php
if ( ! session_id() ){
    if( ! session_start() ){
        throw new Exception( "In order to use SocialAuth, you need to start session with 'session_start()'", 1 );
    }
}

/**
 * Check if any error exists
 */
$error = "";
if (!empty($_GET["error"])) {
    $error = trim( strip_tags(  $_GET["error"] ) );
}

if( isset( $_GET["network"] ) && $_GET["network"] ) {
    $config = dirname(__FILE__) . '/config.php';
    require_once( dirname(__FILE__) . '/Social/Auth.php' );

    try{
        $socialAuth = new Social_Auth( $config );

        $network = trim( strip_tags( $_GET["network"] ) );

        $adapter = $socialAuth->authenticate( $network );

    } catch( Exception $e ) {
        $error = $e->getMessage();
    }
}
?>
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
    <link href="assets/css/bootstrap-social.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Css Styles Start-->
    <style>
        .hidden {
            display: none;
        }
    </style>
    <!-- Custom Css Styles End -->
</head>

<body style="padding: 40px 15px;">
<?php if( isset( $_GET["network"] ) && $_GET["network"] ) { ?>
<script>
    if ( window.opener ) {
        window.opener.location.href= "profile.php?network=<?php echo $network; ?>";
        window.close();
    } else {
        window.location = "profile.php?network=<?php echo $network; ?>";
    }
</script>
<?php } ?>
<div class="container">
    <!-- Message Start -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <!-- Message End -->

    <!-- Signin Form Start -->
    <div id="signin-form" style="margin-top:50px;" class="sa-form col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="javascript:;" class="open-forgot-password">Forgot Password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="signin-alert" class="alert alert-danger col-sm-12"></div>

                <form id="signinForm" class="form-horizontal" role="form" autocomplete="off">


                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">@</span>
                        <input id="signin-email" type="email" class="form-control" name="email" value="" placeholder="email" autocomplete="off">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="signin-password" type="password" class="form-control" name="password" placeholder="password" autocomplete="off">
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <a id="btn-signin" href="javascript:;" class="btn btn-success">Signin  </a>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                Don't have an account!
                                <a href="javascript:;" class="signup-open">
                                    Sign Up Here
                                </a>
                                , or signup with social networks below
                            </div>
                        </div>
                    </div>
                    <div class="form-group popup">
                        <div class="col-md-1 control">
                            <a href="?network=facebook" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=twitter" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=linkedin" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=google" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=yahoo" class="btn btn-social-icon btn-yahoo"><i class="fa fa-yahoo"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=foursquare" class="btn btn-social-icon btn-foursquare"><i class="fa fa-foursquare"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=github" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=vkontakte" class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=instagram" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=tumblr" class="btn btn-social-icon btn-tumblr"><i class="fa fa-tumblr"></i></a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <!-- Signin Form End -->

    <!-- Signup Form Start -->
    <div id="signup-form" style="margin-top:50px;display:none;" class="sa-form col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="javascript:;" class="open-forgot-password">Forgot Password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="signup-alert" class="alert alert-danger col-sm-12"></div>

                <form id="signupForm" class="form-horizontal" role="form">



                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="signup-username" type="text" class="form-control" name="username" value="" placeholder="username" autocomplete="off">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">@</span>
                        <input id="signup-email" type="email" class="form-control" name="email" value="" placeholder="email" autocomplete="off">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="signup-password" type="password" class="form-control" name="password" placeholder="password" autocomplete="off">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="signup-password-2" type="password" class="form-control" name="password-2" placeholder="password(again)" autocomplete="off">
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <a id="btn-signup" href="javascript:;" class="btn btn-success">Signup  </a>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                You have already an account!
                                <a href="javascript:;" class="signin-open">
                                    Sign In Here
                                </a>
                                , or signin with social networks below
                            </div>
                        </div>
                    </div>
                    <div class="form-group popup">
                        <div class="col-md-1 control">
                            <a href="?network=facebook" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=twitter" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=linkedin" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=google" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=yahoo" class="btn btn-social-icon btn-yahoo"><i class="fa fa-yahoo"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=foursquare" class="btn btn-social-icon btn-foursquare"><i class="fa fa-foursquare"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=github" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=vkontakte" class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=instagram" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="col-md-1 control">
                            <a href="?network=tumblr" class="btn btn-social-icon btn-tumblr"><i class="fa fa-tumblr"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Signup Form End -->

    <!-- Forgot Password Form Start -->
    <div id="forgot-password-form" style="margin-top:50px;display:none;" class="sa-form col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Forgot Password</div>
            </div>

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="signin-alert" class="alert alert-danger col-sm-12"></div>

                <form id="forgotPasswordForm" class="form-horizontal" role="form" autocomplete="off">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="forgot-email" type="email" class="form-control" name="email" value="" placeholder="username or email" autocomplete="off">
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <a id="btn-reset-password" href="javascript:;" class="btn btn-success">Reset Password  </a>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                You have already an account
                                <a href="javascript:;" class="signin-open">
                                    Sign In Here
                                </a>
                                , or
                                <a href="javascript:;" class="signup-open">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <!-- Forgot Password Form End -->
</div>

<!-- modal for messages -->
<div class="modal fade" id="sa-message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="sa-message-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="assets/js/socialauth.js"></script>
<script>
    jQuery(document).ready(function() {
        SA.init();
    });
</script>
</body>
</html>
