<?php include("xpanel/include/database.php");
	if(!isset($_SESSION['uid'])){
		header('Content-Type: text/html; charset=ASCII');
		$_SESSION['msg'] = "<div class=\"alert alert-warning\">S'il vous plaît vous connecter pour utiliser cette fonctionnalité</div>";
		header("location: ".$db->dlink());
		exit;
	}?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
<?php $title = "Proposer Une Sc&eacute;ne";
	include("include/head.php");?>
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
                        <?php $story = $db->getStoryID($db->clean($_REQUEST['id']));?>
                        <div class="col-sm-8">
							<div id="tg-content-upper" class="tg-content tg-haslayout">
                            <h2><?php echo $story['title'];?></h2>
                            <form action="mint?action=new-scene" method="post">
                                <label><strong>Contenu:</strong></label>
                                <textarea name="content"></textarea>
                                <input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id']);?>">
                                <div style="height:15px;"></div>
                                <input type="submit" class="btn btn-default" value="Poster Une Sc&eacute;ne &raquo;">
                            </form>
    						</div>
                            
    					</div>
                        <?php include("include/sidebar.php"); $edit = 1;?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>