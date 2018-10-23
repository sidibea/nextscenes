<?php $page = "forums"; $subpage = "all"; require "functions.php"; isLoggedIn();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Super User || Forums</title>
<?php include("include/head.php");?>
	<h3>Forums</h3>
	<div class="pull-right col-md-3 col-sm-3">
		<form method="post" action="">
			<div class="input-group">
				<input type="search" class="form-control" name="search_text" placeholder="enter keyword(s)" />
				<input type="hidden" name="type" value="forum" />
				<div class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
	</div>
	<div class="pull-left col-md-6 col-sm-6">
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
	<div class="pull-right col-md-3 col-sm-3">
		<form method="get" action="">
		<?php 
			if(isset($_REQUEST['search_text'])){
				$count = searchIt("forum", $_REQUEST['search_text']);
			}
			else{
				$count = countIt("forum");
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
                    	<th>Name</th>
                    	<th>Description</th>
                    	<th>Adoption</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				if(isset($_REQUEST['search_text'])){
					$list = searchAllItems("forum", $_REQUEST['search_text'], "20", $_REQUEST['sort'], $_REQUEST['page']);
				}
				else{
					$list = getAllItems("forum", "20",$_GET['sort'], $_GET['page']);
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
					<td><strong>".utf8_encode(stripslashes($key['f_name']))."</strong><br />
					<span class=\"block mt10 _a\" style=\"font-size:12px;\"><a href=\"edit_forum.php?cat=".$key['f_id']."\">Edit</a> | <a href=\"delete_forum.php?cat=".$key['f_id']."\">Delete</a></span>
					</td>
					<td>".strip_tags(utf8_encode($key['f_desc']))."</td>
					<td>"; 
						if ($key['story_count']==NULL){
							echo "0 storylines";
						}
						else {
							if($key['story_count'] == 1){
								echo "1 storyline";
							}
							else{
								echo number_format($key['story_count'])." storylines";
							}
						}
						echo "<br />";
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
        <?php
		}
		?>
<?php include("include/foot.php");?>