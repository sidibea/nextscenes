<?php 

include("central/fr_functions.php")

?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>Nextscenes.com - <?php echo $result[2][$lang."_".title];?></title>
<?php include("fr_head.php");?>
	<div class="herald-section container">
		<div class="row">
			<div class="herald-main-content col-lg-9 col-md-9 col-mod-main">
				<div class="row">							
				   <div class="herald-module col-lg-12 col-md-12 col-sm-12" id="herald-module-3-0" data-col="12">
					<div class="herald-mod-wrap"><div class="herald-mod-head herald-cat-2"><div class="herald-mod-title"><h2 class="h6 herald-mod-h herald-color"><?php echo $result[2][$lang."_".title];?></h2></div></div></div>
					<div class="row herald-posts row-eq-height">
					<div class="panel-group" id="accordion">
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								
								<?php echo $result3[49][$lang."_".title];?>
								
								</a>
							  </h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse in">
							  <div class="panel-body">
								<?php
									$page1 = "principle";
									$info1 = getInfo(1);
									if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
										echo "
										<h3 class=\"h3\">".utf8_encode((stripslashes($info1['Title']))."</h3>
										<div class=\"justify\">".utf8_encode(stripslashes($info1['Descriptions'])))."</div>";
									}
										else{
										echo "
										<h3 class=\"h3\">".utf8_encode(stripslashes($info1['Titlefr']))."</h3>
										<div class=\"justify\">".utf8_encode(stripslashes($info1['Descriptionsfr']))."</div>";
									}
								?>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><?php echo $result3[50][$lang."_".title];?></a>
							  </h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
							  <div class="panel-body">
								<?php
								$page2 = "how";
								$info2 = getInfo(2);
								if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
									echo "
									<h3 class=\"h3\">".utf8_encode(stripslashes($info2['Title']))."</h3>
									<div class=\"justify\">".utf8_encode(stripslashes($info2['Descriptions']))."</div>";
										}
										else{
											echo "
									<h3 class=\"h3\">".utf8_encode(stripslashes($info2['Titlefr']))."</h3>
									<div class=\"justify\">".utf8_encode(stripslashes($info2['Descriptionsfr']))."</div>";
								}
							?>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">FAQ</a>
							  </h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
							  <div class="panel-body">
								<?php
									$page3 = "faqs";
									$info3 = getInfo(3);
									if(!isset($_SESSION['language']) || ($_SESSION['language'] == "en")){
										echo "
										<h3 class=\"h3\">".utf8_encode(stripslashes($info3['Title']))."</h3>
										<div class=\"justify\">".utf8_encode(stripslashes($info3['Descriptions']))."</div>";
											}
											else{
												echo "
										<h3 class=\"h3\">".utf8_encode(stripslashes($info3['Titlefr']))."</h3>
										<div class=\"justify\">".utf8_encode(stripslashes($info3['Descriptionsfr']))."</div>";
									}
								?>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default" id="howto">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><?php echo $result3[51][$lang."_".title];?></a>
							  </h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse">
							  <div class="panel-body">
							  <div class="table-responsive">
								The rating system for determining the proposed scenes with the highest interest will work based on the highest cumulative vote per proposed scene.<br />
								<div style="height:10px;"></div>
								<div style="height:10px;"></div>
								<strong>Example</strong>
								<div style="height:10px;"></div>
								<strong>Story 1 – ABEL GOES TO SCHOOL</strong>
								<div style="height:10px;"></div>
								<strong>Available Proposed scene 2</strong>
								<div style="height:10px;"></div>
								<table class="table table-striped table-hover">
									<tr style="font-weight:bold;">
										<th><strong>Scenes / User Votes</strong></th><th><strong>User 1</strong></th><th><strong>User 2</strong></th><th><strong>User 3</strong></th><th><strong>User4</strong></th><th><strong>User 5</strong></th><th><strong>User 6</strong></th><th><strong>Total votes</strong></th><th><strong>% displayed Online</strong></th>
									</tr>
									<tr>
										<td>Proposed scene A</td><td>2star</td><td>4star</td><td>3star</td><td>1star</td><td>5star</td><td>4star</td><td>19 Points</td><td>22.4%</td>
									</tr>
									<tr>
										<td>Proposed scene B</td><td>1star</td><td>5star</td><td>3star</td><td>3star</td><td>2star</td><td>3star</td><td>17 Points</td><td>20%</td>
									</tr>
									<tr style="background:#006600; color:#FFF;">
										<td>Proposed scene C</td><td>5star</td><td>4star</td><td>4star</td><td>4star</td><td>5star</td><td>4star</td><td>26 Points</td><td>30.6%</td>
									</tr>
									<tr>
										<td>Proposed scene D</td><td>2star</td><td>1star</td><td>3star</td><td>1star</td><td>2star</td><td>2star</td><td>11 Points</td><td>12.9%</td>
									</tr>
									<tr>
										<td>Proposed scene E</td><td>5star</td><td>1star</td><td>1star</td><td>1star</td><td>2star</td><td>2star</td><td>12 Points</td><td>14.1%</td>
									</tr>
									<tr>
										<td></td><td></td><td></td><td></td><td></td><td></td><td><strong>TOTAL</strong></td><td><strong>85 Points</strong></td><td><strong>100%</strong></td>
									</tr>
								</table>
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>COMPUTATION OF WEBSITE DISPLAYED FIGURES</strong>
								<div style="height:10px;"></div><div style="height:10px;"></div>
								
								Proposed scene A 19/85 x 100 = 22.4 %
								<div style="height:10px;"></div>
								Proposed scene B 17/85 x 100 = 20 %
								<div style="height:10px;"></div>
								<div style="color:#006600; font-weight:bold;">Proposed scene C 26/85 x 100 = 30.6% &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qualifies as Next Official Scene.</div>
								<div style="height:10px;"></div>
								Proposed scene D 11/85 x 100 = 12.9 %
								<div style="height:10px;"></div>
								Proposed scene E 12/85 x 100 = 14.1%
								<div style="height:10px;"></div>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total 100%
								<div style="height:10px;"></div><div style="height:10px;"></div><div style="height:10px;"></div>
								Proposes Scene 2 Will then be chosen to be the next scene for the story under which it has been proposed.
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>RATTING RULES</strong>
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>FIRST VOTE</strong>
								<div style="height:10px;"></div>
								Every User’s vote is only accounted as one value regardless of how many clicks/entries. However this vote can be varied based on the voter’s interest and existing realities.
								<br />Eg. Story A Having 3 proposed scenes. Scenes might have been voted by User Z in the order :
								<div style="height:10px;"></div>
								<strong>Story 1</strong> - Proposed 1 – 3 Star Vote<br />
								<strong>Story 1</strong> - Proposed 2 – 2 Star Vote<br />
								<strong>Story 1</strong> - Proposed 3 - 5 Star Vote
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>UPDATING OF VOTE</strong>
								<div style="height:10px;"></div>
								voter has the privileged to revisit Previous proposed scene and update their vote.<br />
								Most recent voted value is applied and entered against voter’s name.<br />
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>Example</strong>
								<div style="height:10px;"></div>
								Upon introduction of proposed scene D to the same story, User Z can revisit Previous proposed scenes and update his vote if preference changes due to newly entered proposed scenes or other personal reasons.
								<div style="height:10px;"></div>
								<strong>Story 1</strong> - Proposed A – 2 star<br />
								<strong>Story 1</strong> - Proposed B – 2 star<br />
								<strong>Story 1</strong> - Proposed C- 3 star<br /> 
								<strong>Story 1</strong> - Proposed D – 5 
								<div style="height:10px;"></div>
								After Updating Vote, User Z is still recorded as having one valid vote casted by him which is now the Modified vote entry
								<div style="height:10px;"></div><div style="height:10px;"></div>
								<strong>Conclusion</strong><div style="height:10px;"></div>
								No scene can be clearly said to have won the slot to become next scene until the moderator closes votes and approves the highest voted scene as the Official Next scene.
							  </div>
							  </div>
							</div>
						  </div>
						</div> 
					</div>						
				</div>
			</div></div>
			<?php echo side2();?>
		</div>
	</div>
<?php echo footer($page,null,$result3,$lang); ?>
</body>
</html>