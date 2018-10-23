<?php
	include("../news/xpanel/include/database.php");
	$tlink = $db->clean($_REQUEST['slug']);
	$page = $db->clean($_REQUEST['page']);
	$q2 = $db->query("SELECT * FROM articles WHERE slug=\"$tlink\"");
	$rows = $db->fetch_array($q2);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NextScenes &bull; <?php if($db->num_rows($q2)>0){echo $db->topic($rows);}else{echo "Page Not Found";}?></title>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- All Stylesheets -->
<link href="css/all-stylesheets.css" rel="stylesheet">
<link rel="alternate stylesheet" type="text/css" href="css/colors/red.css" title="red">
<?php include("head.php");?>
<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
			   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
				<div class="row herald-posts row-eq-height">
				<?php if($db->num_rows($q2)>0){?>
					<section class="category img" style="border:1px solid #ECECEC; padding:0px 10px; width:100%;">
							<div class="row">
								<div class="col-lg-12">
									<h2 class="pull-left"><?php echo strtoupper($db->topic($rows));?></h2>
								</div>
							</div>
							<div style="border-bottom:1px solid #ECECEC; height:2px;"></div>
					<!--	Single Post Found	-->
					<div class="description">
						<?php echo $db->content($rows);
						$db->query("UPDATE articles SET views=views+1 WHERE slug=\"$tlink\"");
						?>
					</div>
					<div class="detail">
						<div class="info" style="border-bottom:1px solid #ECECEC;">
							<span class="date"><i class="fa fa-calendar-o"></i> <?php $old = DateTime::createFromFormat('Y-m-d\TH:i:sP',$db->dates($rows));echo $old->format('d/m/Y');?></span>                        
							<span class="comments pull-right"><i class="fa fa-eye"></i> <?php echo $db->views($rows);?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa  fa-hand-o-up point" id="love"></i> <?php echo $db->love($rows)?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-hand-o-down point" id="dislove"></i> <?php echo $db->dislove($rows)?></span>
							<span class="pull-right" id="note"></span>
						</div>
					</div>
					<div style="display:none;" id="slug"><?php echo $tlink;?></div>
					<div style="height:10px;"></div>
					<!-- Share this post starts -->
					<div id="fb-root"></div>
					  <script>(function(d, s, id) {
					  var js, fjs =  d.getElementsByTagName(s)[0];
					  if  (d.getElementById(id)) return;
					  js =  d.createElement(s); js.id = id;
					  js.src =  "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
					  fjs.parentNode.insertBefore(js, fjs);
					  }(document, 'script', 'facebook-jssdk'));</script>
					<div class="sharepost">
						<ul>
							<li>SHARE THIS POST</li>
							<li>
								<span class='st_facebook_hcount' displayText='Facebook'></span>
							</li>
							<li>
								<span class='st_twitter_hcount' displayText='Tweet'></span>
							</li>
							<li>
								<span class='st_email_hcount' displayText='Email'></span>
							</li>
							<li>
								<span class='st_googleplus_hcount' displayText='Google +'></span>
							</li>
							<li>
								<span class='st_youtube_hcount' displayText='Youtube Subscribe'></span>
							</li>
							<li>
								<span class='st_fbrec_hcount' displayText='Facebook Recommend'></span>
							</li>
							<li>
								<span class='st_instagram_hcount' displayText='Instagram Badge'></span>
							</li>
							<li>
								<span class='st_sharethis_hcount' displayText='ShareThis'></span>
							</li>
							<li>
								<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
							</li>
							<li>
								<span class='st_pinterest_hcount' displayText='Pinterest'></span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<div style="height:20px;"></div>
						<script type="text/javascript">var switchTo5x=true;</script>
						<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
						<script type="text/javascript">stLight.options({publisher: "3fb9af65-2b85-4da7-a395-bff81db19307", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
						<div class="fb-comments"  data-href="<?php echo $db->dlink()."/".$db->slug($rows);?>" data-width="740" data-numposts="5"></div>
					</div>
					<!-- Share this post ends -->
					</section><div class="clearfix"></div><div style="height:20px;"></div>
					<?php }else{?>
					
					<?php }?>
				</div>
			   </div>
			</div>
	<?php include("sidebar.php");?>
	</div>
	</div>
<?php include("footer.php");?>
<script type="text/javascript">
	$(document).ready(function(e){
		$('#love').click(function() {
			var slug = $("#slug").text();
			$('#note').html('Loading <i class="fa fa-spin"></i>');
			var dataString = "action=like&slug="+slug;
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "action.php",
				data: dataString,
				cache: false,
				dataType: 'json',
				success: function(result){
					if(result[0] == 1){
						$('#note').html('Thank You For Voting.&nbsp;&nbsp;&nbsp;&nbsp;');
						$('#love').html(result[1]);
					}else
					if(result[0] == 2){
						$('#note').html('You Had Voted This Blog Post.&nbsp;&nbsp;&nbsp;&nbsp;');
					}else{
						$('#note').html('Volting Failed, Please refresh page and try again.&nbsp;&nbsp;&nbsp;&nbsp;');
					}
				}
			});
		});
		$('#dislove').click(function() {
			var slug = $("#slug").text();
			$('#note').html('<span class="glyphicon glyphicon-refresh glyphicon-refresh-animate">');
			var dataString = "action=dislike&slug="+slug;
			// AJAX Code To Submit Form.
			$.ajax({
				type: "POST",
				url: "action.php",
				data: dataString,
				cache: false,
				dataType: 'json',
				success: function(result){
					if(result[0] == 1){
						$('#note').html('Thank You For Voting.&nbsp;&nbsp;&nbsp;&nbsp;');
						$('#love').html(result[1]);
					}else
					if(result[0] == 2){
						$('#note').html('You Had Voted This Blog Post.&nbsp;&nbsp;&nbsp;&nbsp;');
					}else{
						$('#note').html('Volting Failed, Please refresh page and try again.&nbsp;&nbsp;&nbsp;&nbsp;');
					}
				}
			});
		}); 
	});
</script>
</body>
</html>