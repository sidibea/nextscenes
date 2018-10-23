<?php $page = "forums"; $subpage = "lang"; require "functions.php"; ?>
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
                	<p class="nop nom"><a href="new_language.php">+ Add new language</a></p>
                </div>
            	<div class="clear pb10"></div>
                <div class="right">
                    <form method="get" action="">
                    <?php 
						$count = countIt("language");
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
                    	<th>Abbreviation</th>
                    	<th>Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$list = getAllItems("language","20",$_GET['sort'], $_GET['page']);
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
					<td><a href=\"edit_language.php?cat=".$key['l_id']."\">".utf8_encode(stripslashes($key['l_name']))."</a>
					<span class=\"block mt10 _a\"><a href=\"edit_language.php?cat=".$key['l_id']."\">Edit</a> | <a href=\"delete_language.php?cat=".$key['l_id']."\">Delete</a></span>
					</td>
					<td>".$key['l_desc']."</td>
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
