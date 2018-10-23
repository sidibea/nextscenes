<?php include("xpanel/include/database.php");
	if(!isset($_SESSION['uid'])){
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
<?php header('Content-Type: text/html; charset=ASCII'); $title = "Créer Nouvelle Récit";
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
                        <div class="col-sm-8">
							<div id="tg-content-upper" class="tg-content tg-haslayout">
                            <h2>CREER UNE NOUVELLE HISTOIRE</h2>
                            <form action="mint?action=nouvelle-recit" method="post">
                                <label><strong>Titre:</strong></label>
                                <input type="text" name="title" class="form-control">
                                <div style="height:15px;"></div>
                                <label><strong>Sélectionner Forum</strong></label>
                                <select name="forum" class="form-control">
                                	 <?php $forum = $db->fetchForum();
										foreach($forum as $forums){
											echo "<option value=\"".$forums['id']."\">".$forums['title']."</option>";
										}
									?>
                                </select>
                                <div style="height:15px;"></div>
                                <label><strong>Contenu:</strong></label>
                                <textarea name="content"></textarea>
                                <div style="height:15px;"></div>
                                <input type="submit" class="btn btn-default" value="Poster Des Article » ">
                            </form>
    						</div>
                            
    					</div>
                        <?php include("include/sidebar.php"); $edit = 1;?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>