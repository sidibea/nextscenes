<?php $page = "storylines"; $subpage = "all"; require "functions.php"; isLoggedIn(); isAdmin(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Storylines</title>
<?php include("include/head.php");?>
<div class="">
	<div class="col-md-2 col-sm-2 col-xs-12">
		<p class="nop nom"><?php if($_SESSION['ev_u_auth'] < 3){?><a href="new_storyline.php">+ New Storyline</a><?php }?></p>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<form class="navbar-form" method="post" action="">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="Enter Keyword" style="height:32px;" name="search_text" />
				<input type="hidden" name="type" value="storyline" />
                <div class="input-group-btn">
                    <button class="btn btn-default" name="search" type="submit" style="padding: 5px 5px;"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
	</div>
	<div class="col-md-4 col-sm-4 col-xs-12">
		<form method="get" action="">
			<select name="sort" class="select">
				<option value="recent"<?php if($_GET['sort']=="recent"){ echo " selected=\"selected\""; } ?>>Most recent</option>
				<option value="a-z"<?php if($_GET['sort']=="a-z"){ echo " selected=\"selected\""; } ?>>Alphabetically (a-z)</option>
				<option value="z-a"<?php if($_GET['sort']=="z-a"){ echo " selected=\"selected\""; } ?>>Alphabetically (z-a)</option>
				<option value="older"<?php if($_GET['sort']=="older"){ echo " selected=\"selected\""; } ?>>Least recent</option>
			</select>
			<input type="submit" name="sort_btn" value="Sort" class="btn" style="padding:5px;" />
		</form>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-12">
		<form method="get" action="">
		<?php 
			if(isset($_REQUEST['search_text'])){
				$count = searchIt("storyline", $_REQUEST['search_text']);
			}
			else{
				$count = countIt("storyline");
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
					echo "<span class=\"mr10\"><a href=\"?page=".$bpager; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } echo"\" >&laquo;</a></span>";
				}
				echo "
				<input type=\"text\" value=\""; if(!isset($_GET['page'])){ echo "1";} else{ if (is_numeric($_GET['page'])){ echo $_GET['page']; }else{ echo "1";} } echo "\" name=\"page\" size=\"2\" class=\"txtcenter\" />";
				
				if ($_GET['page'] && is_numeric($_GET['page']) && $pageNum > 1 ){
					$fpager = $_GET['page']+1;
					if ($fpager < ($realcount+1)){
					echo "<span class=\"ml10\"><a href=\"?page=".$fpager; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } echo"\" >&raquo;</a></span>";
					}
				}
			}
			else{
				echo "
				<input type=\"text\" value=\"1\" name=\"page\" size=\"2\" class=\"txtcenter\" />";
				if ($pageNum > 1 ){
					echo "<span class=\"ml10\"><a href=\"?page=2"; if($_GET['sort']){ echo "&sort=".$_GET['sort']; } echo"\" >&raquo;</a></span>";
				}
			}
		}
		?>
		</form>
	</div>
	<div class="clearfix"></div>
</div>
	<?php 
		if ($_GET['page'] > $pageNum){
			echo "<p class='nom mb20 alert-warning'>".genericSearchError()."</p>";
		}
		else{
	?>
<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Author</th>
				<th>Adoption</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if(isset($_POST['search']) && ($_POST['search_text'] != "")){
			$list = searchAllItems("storyline",$_REQUEST['search_text'],"20",$_GET['sort'], $_GET['page']);
		}
		else{
			$list = getAllItems("storyline","20",$_GET['sort'], $_GET['page']);
		}
		if($_GET['page']){
			$i = (($_GET['page']*20)-20)+1;
		}
		else{
			$i = 1;
		}
		foreach ($list as $cat => $key){
			echo "
		<tr class=\"maxxit\">
			<td>".$i."</td>
			<td><strong><a href=\"read?id=".$key['sl_id']."\">".utf8_encode(stripslashes($key['sl_name']))."</a></strong><br />
			<span class=\"block mt10 _a\" style='font-size:12px;'><!-- <a href=\"approve.php?cat=".$key['sl_id']."\">Approve </a> | --><a href=\"edit_storyline.php?cat=".$key['sl_id']."\">Edit</a>"; if($_SESSION['ev_u_auth'] < 3){echo " | <a href=\"delete_storyline.php?cat=".$key['sl_id']."\">Delete</a>";} echo "</span> 
			</td>
			<td>".strip_tags(utf8_encode($key['u_username']))."</td>
			<td style='font-size:12px;'>";
				if ($key['validated_scenes']==NULL){
					echo "0 validated scenes";
				}
				else {
					if($key['validated_scenes'] == 1){
						echo "1 validated scenes";
					}
					else{
						echo number_format($key['validated_scenes'])." validated scenes";
					}
				}
				echo "<br />";
				if ($key['proposed_scenes']==NULL){
					echo "0 proposed scenes";
				}
				else {
					if($key['proposed_scenes'] == 1){
						echo "1 proposed scenes";
					}
					else{
						echo number_format($key['proposed_scenes'])." proposed scenes";
					}
				}
			echo "</td>
		</tr>";
		$i++;
		}
		?>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	<?php }?>
<?php include("include/foot.php");?>