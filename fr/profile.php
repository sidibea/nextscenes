<?php include("xpanel/include/database.php");
$me = $db->getUser($_SESSION['uid']);?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}.spacer{padding:5px; font-size:18px;}</style>
<head>
<?php $title = $me['u_username']." Profile";
	include("include/head.php");?>
<style>.tg-content{padding:0px;}</style>
    <!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<div class="container">
				<div class="row">
					<div id="tg-twocolumns-upper" class="tg-twocolumns tg-haslayout">
						<!--************************************
								Content Start
						*************************************-->
                        <div class="col-sm-8">
							<div id="tg-content-upper" class="tg-content tg-haslayout">
                            	<h1 class="topic"><?php echo $me['u_username'];?> Profile</h1>
                                <div class="spacer col-md-4 col-sm-4 col-xs-12">
                    	<div class="c_label"></div>
                        <div class="c_input">
                        	<img src="<?php echo $db->dlink()."/".$me['u_avatar']; ?>" alt="" class="img img-responsive">
                        </div>
						<div style="height:10px;"></div>
                    </div>
					<div class="col-md-8 col-sm-8 col-xs-12">
					<div style="height:70px;" class="hidden-xs"></div>
                    <div class="spacer">
                        <div class="c_label">Username: <strong><?php echo $me['u_username']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">First name: <strong><?php echo $me['u_fname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">Last name: <strong><?php echo $me['u_lastname']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">Email: <strong><?php echo $me['u_email']; ?></strong></div>
                    </div>
                    <div class="spacer">
                        <div class="c_label">
                        	<a href="manage-account-user" class="btn btn-success">Edit profile</a>
                        </div>
                    </div></div>
				<div style="clear:both;"></div>
                <div style="height:20px;"></div>
                		<h1 class="topic">Activities</h1>
                        <a href="histoires"><button class="btn btn-default">My Storylines</button></a>
                        <a href="scenes"><button class="btn btn-default">My Scenes</button></a>
                <div style="height:40px;"></div>
                            </div>
                        </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>