<?php $page = "scenes"; $subpage = "all"; require "functions.php"; isLoggedIn(); ?>
<?php if (isset($_GET['trash'])){$mssg = trashthis("scene",$_GET['trash']); $trashExists = TRUE;} else if (isset($_GET['restore'])){$mssg = restorethis("scene",$_GET['restore']); $restoreExists = TRUE;}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || My Scenes</title>
<?php include("include/head.php");?>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<p class="nop nom"><?php echo mystatusCount(); ?></p>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<form method="post" action="">
			search: 
			<input type="text" name="text" />
			<input type="submit" name="search" value="Search" class="_btn _t" />
		</form>
	</div>
	<div class="clearfix space"></div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<form method="get" action="">
			<select name="cat" class="select">
				<option value="all" <?php if (isset($_GET['cat']) && $_GET['cat'] == "all"){ echo " selected=\"selected\""; } ?>>All storylines</option>
				<?php 
				$list = getmyStorylines();
				foreach ($list as $option => $key){
				echo"
				<option value=\"".$key['sl_id']."\""; if (isset($_GET['cat']) && is_numeric($_GET['cat']) && $_GET['cat'] == $key['sl_id']){ echo " selected=\"selected\""; } echo ">".stripslashes(utf8_encode($key['sl_name']))."</option>
				";
				}
				?>
			</select>
			<select name="sort" class="select">
			   <option value="recent"<?php if($_GET['sort']=="recent"){ echo " selected=\"selected\""; } ?>>Most recent</option>
				<option value="a-z"<?php if($_GET['sort']=="a-z"){ echo " selected=\"selected\""; } ?>>Alphabetically (a-z)</option>
				<option value="z-a"<?php if($_GET['sort']=="z-a"){ echo " selected=\"selected\""; } ?>>Alphabetically (z-a)</option>
				<option value="older"<?php if($_GET['sort']=="older"){ echo " selected=\"selected\""; } ?>>Least recent</option>
			</select>
			<input type="submit" name="sort_cat" value="Filter" class="_btn _t" />
		</form>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<form method="get" action="">
			<?php
			if(isset($_POST['search']) && ($_POST['text'] != "") && ($_POST['text'] != NULL)){
				$count = searchIt("myscenes",$_POST['text']);
			}
			else{
				$count = countIt("myscenes", $_GET['cat'], $_GET['tag'], $_GET['status'], $_GET['author']);
			}
			?>
			<span class="mr10"><?php echo $count[1]; ?></span>
			<?php 
			$realcount = $count[0]/20;
			$pageNum = ceil($realcount);
			if ($realcount < 1){
			echo "
			<input type=\"text\" value=\""; if(!isset($_GET['page'])){ echo "1";} else{ if (is_numeric($_GET['page'])){ echo $_GET['page']; }else{ echo "1";} } echo "\" name=\"page\" size=\"2\" class=\"txtcenter\" disabled=\"disabled\" />";
		}
			else{
			if (isset($_GET['page'])){
				if ($_GET['page'] && is_numeric($_GET['page']) && $_GET['page'] > 1 ){
					$bpager = $_GET['page']-1;
					echo "<span class=\"mr10\"><a href=\"?page=".$bpager; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } if($_GET['tags']){ echo "&tags=".$_GET['tags']; } if($_GET['cat']){ echo "&cat=".$_GET['cat']; } if($_GET['status']){ echo "&status=".$_GET['status']; } echo"\" >&laquo;</a></span>";
				}
				echo "
				<input type=\"text\" value=\""; if(!isset($_GET['page'])){ echo "1";} else{ if (is_numeric($_GET['page'])){ echo $_GET['page']; }else{ echo "1";} } echo "\" name=\"page\" size=\"2\" class=\"txtcenter\" />";
				
				if ($_GET['page'] && is_numeric($_GET['page']) && $pageNum > 1 ){
					$fpager = $_GET['page']+1;
					if ($fpager < ($realcount+1)){
					echo "<span class=\"ml10\"><a href=\"?page=".$fpager; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } if($_GET['tags']){ echo "&tags=".$_GET['tags']; } if($_GET['cat']){ echo "&cat=".$_GET['cat']; } if($_GET['status']){ echo "&status=".$_GET['status']; } echo"\" >&raquo;</a></span>";
					}
				}
			}
			else{
				echo "
				<input type=\"text\" value=\"1\" name=\"page\" size=\"2\" class=\"txtcenter\" />";
				if ($pageNum > 1 ){
					echo "<span class=\"ml10\"><a href=\"?page=2"; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } if($_GET['tags']){ echo "&tags=".$_GET['tags']; } if($_GET['cat']){ echo "&cat=".$_GET['cat']; } if($_GET['status']){ echo "&status=".$_GET['status']; } echo"\" >&raquo;</a></span>";
				}
			}
		}
			if($_GET['sort']){ echo "<input type='hidden' name='sort' value='".$_GET['sort']."' />"; } 
			if($_GET['tags']){ echo "<input type='hidden' name='tags' value='".$_GET['tags']."' />"; } 
			if($_GET['cat']){ echo "<input type='hidden' name='cat' value='".$_GET['cat']."' />"; } 
			if($_GET['status']){ echo "<input type='hidden' name='status' value='".$_GET['status']."' />"; } 
			?>
		</form>
	</div>
	<div class="clearfix space"></div>
	<?php 
		if ($_GET['page'] > $pageNum){
			echo "<p class='nom mb20 alert'>".genericSearchError()."</p>";
		}
		else{
			if($trashExists == TRUE || $restoreExists == TRUE){
				echo "<p class='nom mb20 alert'>".$mssg."<p>";	
			}
		?>
        	<table class="w100p table">
            	<thead>
                	<tr>
                    	<th>#</th>
                    	<th>Storyline</th>
                        <th>Scene</th>
                    	<th>Forum</th>
                    	<th>Author</th>
                    	<th>Reviews/Ratings</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
					if(isset($_POST['search']) && ($_POST['text'] != "") && ($_POST['text'] != NULL)){
						$list = searchAllItems("myscenes",$_POST['text'],"20",$_GET['sort'], $_GET['page']);
					}
					else{
                    	$list = getAllItems("myscenes","20",$_GET['sort'], $_GET['page'], $_GET['cat'],$_GET['tag'],$_GET['status'],$_GET['author']);
					}
                    if($_GET['page']){
                        $i = (($_GET['page']*20)-20)+1;
                    }
                    else{
                        $i = 1;
                    }
                    foreach ($list as $cat => $key){
                        echo "
                    <tr"; if (($i%2) == 0){ echo " class='vlgreybg'";} echo ">
                        <td>".$i."</td>
                        <td class='w40p'><a href=\"view_scene.php?scene=".$key['scene_id']."&type=".$key['scene_type']."\">".stripslashes($key['sl_name'])."</a>
						<span class='block _t'>".date("l F j, Y H:i:s", strtotime($key['scene_ts']))."</span>
						<span class='block _t capitalize'><strong>".stripslashes($key['s_name'])."</strong></span>
                        <span class=\"block mt10 _a\">";
						if ($key['scene_status']== 3){
							echo "<a href=\"?restore=".$key['scene_id']."\">Restore</a> | <a href=\"delete_scene.php?scene=".$key['scene_id']."&type=".$key['scene_type']."\" class='warn'>Delete permanently</a>";
						}
						else{
							if($key['scene_type'] == "proposed"){
								echo "<a href=\"view_scene.php?scene=".$key['scene_id']."&type=".$key['scene_type']."\">View</a> | <a href=\"?trash=".$key['scene_id']."\">Ban</a>";
							}
							else{
								echo "<a href=\"view_scene.php?scene=".$key['scene_id']."&type=".$key['scene_type']."\">View</a>";
							}
						}
						echo "</span>
                        </td>
                        <td>".$key['scene_number']."";
						if($key['scene_type'] == "proposed"){
							echo "<span class=\"g_alert _t\">Proposed</span>";
						}
						else{
							echo "<span class=\"alert _t\">Valid</span>";
						}
						echo "</td>
						<td>".utf8_encode($key['f_name'])."</td>
                        <td>".utf8_encode($key['u_username'])."</td>
                        <td>";
						if ($key['rating_count']==NULL){
							echo "0 ratings";
						}
						else {
							if($key['rating_count'] == 1){
								echo "1 rating";
							}
							else{
								echo "<strong>".number_format($key['rating_count'])." ratings</strong>";
							}
						}
						echo "<br />";
						if ($key['review_count']==NULL){
							echo "0 reviews";
						}
						else {
							if($key['review_count'] == 1){
								echo "1 review";
							}
							else{
								echo "<strong>".number_format($key['review_count'])." reviews</strong>";
							}
						}
						echo "<br />";
                    $i++;
                    }
                    ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        <?php 
		}
		?>
<style>
select{
	width:110px;
}
</style>
<?php include("include/foot.php");?>