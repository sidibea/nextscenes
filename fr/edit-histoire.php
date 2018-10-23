<?php include("xpanel/include/database.php");
	$slug = $db->clean($_REQUEST['slug']);
	$slug = str_replace(".php","",$slug);
	$main = explode("/",$slug);
	$id = $main[0];
	if($page == "" || $page == 0){
		$page = 1;
	}
	$limit = 30;
	$forumes = $db->fetchStID($db->clean($id));
	header('Content-Type: text/html; charset=ASCII');?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>
<head>
<?php $title = "HISTOIRES";
	include("include/head.php");?>
<style>.tg-content{padding:0px;}.nicEdit-panel{display:none;}</style>
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
                            	<h1 class="topic">EDIT HISTOIRES</h1>
                                <form action="<?php echo $db->dlink();?>/mint?action=edit-history" method="post">
                                    <label><strong>Titre:</strong></label>
                                    <input type="text" name="title" value="<?php echo $forumes['title'];?>" class="form-control" />
                                    <div class="space"></div>
                                    <label><strong>Sélectionner Forum</strong></label>
                                    <select name="forum" class="form-control">
                                         <?php $forumd = $db->fetchForum();
                                            foreach($forumd as $forums){?>
                                                <option value="<?php echo $forums['id'];?>" <?php if($forums['id'] == $forumes['category']){echo "selected";}?>><?php echo $forums['title'];?></option>
                                        <?php }?>
                                    </select>
                                    <div class="space"></div>
                                    <label><strong>La Description:</strong></label>
                                    <textarea name="content"><?php echo $forumes['content'];?></textarea>
                                    <div style="height:5px;"></div>
                                    <input type="hidden" name="id" value="<?php echo $db->clean($id); $edit = 1;?>">
                                    <input type="submit" value="Soumettre" class="btn btn-default">
                                </form>
                                <div style="height:15px;"></div>
                            </div>
                        </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>