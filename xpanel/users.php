<?php $page = "users"; $subpage = "all"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Users</title>
<?php include("include/head.php");?>
	<div class="col-md-4 c0l-sm-4 col-xs-12">
		<form method="post" action="">
			<input type="text" name="search_text" placeholder="enter keyword(s)" />
			<input type="hidden" name="type" value="user" />
			<input type="submit" name="search" value="Search" class="_btn _t" />
		</form>
	</div>
	<div class="col-md-4 c0l-sm-4 col-xs-12">
		<form method="get" action="">
			<select name="sort" class="select">
				<option value="recent"<?php if($_GET['sort']=="recent"){ echo " selected=\"selected\""; } ?>>Most recent</option>
				<option value="a-z"<?php if($_GET['sort']=="a-z"){ echo " selected=\"selected\""; } ?>>Alphabetically (a-z)</option>
				<option value="z-a"<?php if($_GET['sort']=="z-a"){ echo " selected=\"selected\""; } ?>>Alphabetically (z-a)</option>
				<option value="older"<?php if($_GET['sort']=="older"){ echo " selected=\"selected\""; } ?>>Least recent</option>
			</select>
			<input type="submit" name="sort_btn" value="Sort" class="_btn _t" />
		</form>
	</div>
	<div class="col-md-4 c0l-sm-4 col-xs-12">
		<form method="get" action="">
		<?php 
			if($_POST['search_text']){
				$count = searchIt("user", $_POST['search_text']);
			}
			else{
				$count = countIt("user");
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
	<div class="clearfix space"></div>
	<?php 
		if ($_GET['page'] > $pageNum){
			echo "<p class='nom mb20 alert'>".genericSearchError()."</p>";
		}
		else{
	?>
		<table class="w100p table">
			<thead>
				<tr>
					<th>#</th>
					<th>Username/Fullname</th>
					<th>Email</th>
					<th>Ratings</th>
					<th>Reviews</th>
					<th>Proposed Scenes</th>
					<th>Validated Scenes</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			if(isset($_POST['search']) && ($_POST['search_text'] != "") && ($_POST['search_text'] != NULL)){
				$list = searchAllItems("user",$_POST['search_text'],"20",$_GET['sort'], $_GET['page']);
			}
			else{
				$list = getAllItems("user","20",$_GET['sort'], $_GET['page']);
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
				<td><a href=\"view_user.php?cat=".$key['u_id']."\">".utf8_encode(stripslashes($key['u_username']))."</a>";
				if($key['u_fname'] != "" && $key['u_fname'] != NULL){
					echo "<br /><strong>".strip_tags(utf8_encode($key['u_fname']))." ".strip_tags(utf8_encode($key['u_lastname']))."</strong>";
				}
				if($key['u_mod'] != 0){
					echo "<span class=\"warning\">";
					if($key['u_mod'] == 1){
						echo "<strong>Administrator</strong>";
					}
					else if($key['u_mod'] == 2){
						echo "<strong>Editor</strong>";
					}
					else{
						echo "<strong>Moderator</strong>";
					}
					echo "
					<span>";
				}
				echo "
				</td>
				<td>".strip_tags(utf8_encode($key['u_email']))."</td>
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
					echo "
				</td>
				<td>";
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
					echo "
				</td>
				<td>";
					if ($key['proposed_scenes']==NULL){
						echo "0 proposed scenes";
					}
					else {
						if($key['proposed_scenes'] == 1){
							echo "1 proposed scenes";
						}
						else{
							echo "<strong>".number_format($key['proposed_scenes'])." proposed scenes</strong>";
						}
					}
					echo "
				</td>
				<td>";
					if ($key['validated_scenes']==NULL){
						echo "0 validated scenes";
					}
					else {
						if($key['validated_scenes'] == 1){
							echo "1 validated scenes";
						}
						else{
							echo "<strong>".number_format($key['validated_scenes'])." validated scenes</strong>";
						}
					}
				echo "
				</td>
			</tr>";
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
<?php include("include/foot.php");?>