<?php include("xpanel/include/database.php");
	$id = $db->clean($_REQUEST['id']);
	$scene = $db->fetchScene($id);
?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>
<head>
<?php
	$title = "Modifier Scenes";
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
                            	<form action="mint?action=edit-scene" method="post">
                                    <label><strong>Titre: <?php $topic = $db->fetchStID($scene['s_id']); echo $topic['title'];?></strong></label>
                                    <label><strong>La Description:</strong></label>
                                    <textarea name="content"><?php echo $scene['content'];?></textarea>
                                    <div style="height:5px;"></div>
                                    <input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id'])?>">
                                    <input type="submit" value="Soumettre" class="btn btn-default">
                                </form>
							<div style="height:20px;"></div>
                            </div>
                        </div>
                        <?php include("include/sidebar.php"); $edit = 1;?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>