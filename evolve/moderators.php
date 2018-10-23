<?php $page = "moderators"; $subpage = "all"; require "functions.php"; ?>
<?php isLoggedIn(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo siteName(); ?></title>
<link href="stylee/stylee.css" type="text/css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php require "plugins/tinymce_simple.php"; ?>
</head>

<body>

<div class="main">
    <div class="nav">
        <div class="pt10">
        	<?php echo siteVersion(); ?>
        </div>
        <div class="clear ptb10"></div>
        <?php echo generateMenu($page, $subpage); ?>
    </div>
    <div class="content">
    	<?php echo generateHeader(); ?>
    	<div class="clear"></div>
        
        <div class="plr10 bbvg pb10">
        	<div class="">
            	<div class="left">
                	<p class="nop nom"><a href="new_moderator.php">+ Add new moderator</a></p>
                </div>
                <div class="right">
                    <form method="post" action="">
                    	<input type="text" name="search_text" placeholder="enter keyword(s)" />
                        <input type="hidden" name="type" value="moderator" />
                        <input type="submit" name="search" value="Search" class="_btn _t" />
                    </form>
                </div>
            	<div class="clear pb10"></div>
                <div class="left">
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
                <div class="right">
                    <form method="get" action="">
                    <?php 
						if($_POST['search_text']){
							$count = searchIt("moderator", $_POST['search_text']);
						}
						else{
							$count = countIt("moderator");
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
                <div class="clear"></div>
            </div>
        </div>
        <div class="p10">
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
                    	<th>Username</th>
                    	<th>Full name</th>
                    	<th>Footprint</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				if(isset($_POST['search']) && ($_POST['search_text'] != "") && ($_POST['search_text'] != NULL)){
					$list = searchAllItems("moderator",$_POST['search_text'],"20",$_GET['sort'], $_GET['page']);
				}
				else{
					$list = getAllItems("moderator","20",$_GET['sort'], $_GET['page']);
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
					<td><a href=\"edit_moderator.php?cat=".$key['u_id']."\">".utf8_encode(stripslashes($key['u_username']))."</a>
					<span class=\"block mt10 _a\"><a href=\"edit_moderator.php?cat=".$key['u_id']."\">Edit</a></span>
					</td>
					<td>".strip_tags(utf8_encode($key['u_fname']))." ".strip_tags(utf8_encode($key['u_lastname']))."</td>
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
        </div>
        <div class="plr10 ptb10">
        	<div class="">
                <div class="right">
                    <form method="post" action="">
                    <?php 
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
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php ?>
</body>
</html>
