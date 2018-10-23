<?php include("xpanel/include/database.php");
	$slug = $db->clean($_REQUEST['slug']);
	$slug = str_replace(".php","",$slug);
	$main = explode("/",$slug);
	$page = $main[0];
	if($page == "" || $page == 0){
		$page = 1;
	}
	$limit = 30;
?>
    <!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<style>.tg-content{padding:0px;}</style>
<head>
<?php $title = "Scenes";
	$scenes = $db->fetchScenesAuthor($_SESSION['uid'], $limit, $page);
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
                            	<h1 class="topic">Scenes</h1>
                                <table class="table">
                                    <tr>
                                        <th>Titre</th>
                                        <th>La Description</th>
                                        <th>Action</th>
                                    </tr>
                                <?php foreach($scenes as $history){?>
                                	<tr>
                                        <td style="font-size:14px;"><?php $str = $db->getStoryID($history['s_id']); echo $str['title'];?></td>
                                        <td><?php echo substr(strip_tags($history['content']),0,75);?>...<a href="scene/<?php echo $history['id'];?>">More &raquo;</a></td>
                                        <td style="font-size:12px;"><a href="edit-scene?id=<?php echo $history['id'];?>">Edit</a> &bull; <a href="mint?action=deleteScene&id=<?php echo $history['id'];?>"><i style="font-weight:bold; color:#F00;">Delete</a></td>
                                    </tr>
                                <?php }?>
                               </table>
                            </div>
                        </div>
                        <?php include("include/sidebar.php");?>
    				</div>
                </div>
            </div>
        </main>
<?php include("include/foot.php");?>