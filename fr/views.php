<?php include("xpanel/include/database.php");
include("Encoding.php");
	$slug = $db->clean($_REQUEST['slug']);
	$main = explode("/",$slug);
	$id = $main[0];
	$slg = $main[1];
	$page = $main[2];
	if(!isset($_SESSION['uid'])){
		header('Content-Type: text/html; charset=ASCII');
		$_SESSION['msg'] = "<div class=\"alert alert-warning\">". Encoding::toISO8859("S'il vous plaît vous connecter pour utiliser cette fonctionnalité")."</div>";
		header("location: ".$db->dlink());
		exit;
	}?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>
<head>
<?php $story = $db->fetchScene($id);$storys = $db->fetchStID($story['s_id']); $title = $storys['title'];
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
                            	<h1 class="topic"><?php $storys = $db->fetchStID($story['s_id']); echo $storys['title'];?>[<?php if($story['status'] == 1){echo "Valide";}else{echo "Propos&eacute;";}?>] Sc&eacute;ne[<?php echo $story['scene'];?>]</h1>
                                <div><?php echo $story['content'];?></div>
                                <div style="height:15px;"></div>
                                <h2 class="topic">Noter La Sc&eacute;ne</h2>
                                <div class="note" id="note"></div>
                                    <div class='movie_choice'>
                                        <div id="r1" class="rate_widget">
                                            <div class="star_1 ratings_stars" id="1"></div>
                                            <div class="star_2 ratings_stars" id="2"></div>
                                            <div class="star_3 ratings_stars" id="3"></div>
                                            <div class="star_4 ratings_stars" id="4"></div>
                                            <div class="star_5 ratings_stars" id="5"></div>
                                            <input type="hidden" class="rscene" value="".$id."" />
                                            <input type="hidden" class="usrID" value="".$ee[0]."" />
                                            <input type="hidden" class="pscene" value="".$sc."" />
                                            <div class="total_votes"><!--".getUnit1Rating($id, $sc)."--></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>