<?php
$config = require('config.template.php');
$availableNetworks = $config["networks"];
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

    <title>SocialAuth v5.0 Installation</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h2 class="text-success">SocialAuth</h2>
        <p>
            Welcome to SocialAuth installation. In this page you can;
            <ul>
                <li>Configure network credentials</li>
                <li>Enable/Disable network provider</li>
                <li>Test socialauth login for each network</li>
            </ul>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong><i class="fa fa-cog fa-fw"></i> Basic Configurations</strong>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="sa-base-url" class="col-sm-2 control-label">Base Url</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-base-url" placeholder="Base Url">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-log-file" class="col-sm-2 control-label">Log File</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-log-file" placeholder="Log File">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-debug-enabled" class="col-sm-2 control-label">Debug Enabled?</label>
                            <div class="col-sm-6">
                                <input type="checkbox" name="sa-debug-enabled"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-success btn-basic-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                            </div>
                        </div>
                        <input type="hidden" name="method-type" value="basic-save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong><i class="fa fa-tasks fa-fw"></i> Social Nettwork Configurations</strong>
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="accordion">
                        <?php foreach($availableNetworks as $k => $network):?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $k; ?>">
                                            <i class="<?php echo $network["icon_class"]; ?>"></i> <?php echo $network["name"]; ?> Configurations
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?php echo $k; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-info">Learn more about creating <?php echo $network["name"]; ?> app <a href="http://huseyinbabal.net/how-to-create-<?php echo $k; ?>-app-for-your-website/" target="_blank">here</a></div>
                                        <form class="form-horizontal" role="form">
                                            <div class="form-group">
                                                <label for="<?php echo $k; ?>-app-id" class="col-sm-2 control-label">App ID</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control app-id" name="<?php echo $k; ?>-app-id" placeholder="App ID">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="<?php echo $k; ?>-app-secret" class="col-sm-2 control-label">App Secret</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control app-secret" name="<?php echo $k; ?>-app-secret" placeholder="App Secret">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="<?php echo $k; ?>-enabled" class="col-sm-2 control-label">Enabled?</label>
                                                <div class="col-sm-6">
                                                    <input type="checkbox" name="<?php echo $k; ?>-enabled" id="<?php echo $k; ?>-enabled" class="network-enabled"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                                    <a href="../signin.php?network=<?php echo $k; ?>" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                                </div>
                                            </div>
                                            <input type="hidden" name="network-type" value="<?php echo $k; ?>"/>
                                            <input type="hidden" name="method-type" value="network-save"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong><i class="fa fa-database fa-fw"></i> DB Configurations</strong>
                </div>
                <div class="panel-body">
                    <div class="alert alert-warning"><strong>Warning!</strong> If you enable db, social network data will be saved to your db!</div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="sa-db-host" class="col-sm-2 control-label">DB Host</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-host" placeholder="DB Host">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-user" class="col-sm-2 control-label">DB User</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-user" placeholder="DB User">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-password" class="col-sm-2 control-label">DB Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-password" placeholder="DB Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-name" class="col-sm-2 control-label">DB Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-name" placeholder="DB Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-tbl-users" class="col-sm-2 control-label">Users Table Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-tbl-users" placeholder="Users Table Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-clmn-username" class="col-sm-2 control-label">Username Column Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-clmn-username" placeholder="Username Column Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-clmn-password" class="col-sm-2 control-label">Password Column Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-clmn-password" placeholder="Password Column Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-clmn-email" class="col-sm-2 control-label">Email Column Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="sa-db-clmn-email" placeholder="Email Column Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sa-db-enabled" class="col-sm-2 control-label">Enabled?</label>
                            <div class="col-sm-6">
                                <input type="checkbox" name="sa-db-enabled" class="db-enabled"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-success btn-db-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                            </div>
                        </div>
                        <input type="hidden" name="method-type" value="db-save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> <!-- /container -->

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
<script src="../assets/js/installation.js"></script>
<script>
    (function($){
        App.init();
    })(jQuery);
</script>
</body>
</html>
