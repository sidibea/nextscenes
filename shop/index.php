<?php include("backend/include/database.php"); $title = "Shop"; include("include/header.php");?>
<!--BANNER-->
		<div id="main-slider" class="main-slider">

			<!-- Item -->
			<div class="item">
				<img src="images/banner/bg-1.jpg" alt="">
				<div class="banner-overlay">
					<div class="container p-relative">
						
						<!-- Layer Img -->
						<div class="layer-img">
							<img src="images/banner/layer-1.png" alt="">
						</div>
						<!-- Layer Img -->

						<!-- caption -->
						<div class="caption style-1 position-center-x">
							<h1>I love this idea!</h1>
							<b>Cover up front of book and leave summary</b>
							<p>Booking is Australia’s number-one source of news about the book industry, keeping subscribers</p>
							<a href="#" class="btn-1">Learn more<i class="fa fa-arrow-circle-right"></i></a> 
						</div>
						<!-- caption -->

					</div>
				</div>
			</div>
			<!-- Item -->

			<!-- Item -->
			<div class="item">
				<img src="images/banner/bg-2.jpg" alt="">
				<div class="banner-overlay">
					<div class="container position-center-center">

						<!-- caption -->
						<div class="caption style-2">
							<h1>Reading a book is like <span>Re Writing it for yourself</span></h1>
							<p>A Cambridge academic claims to have found the first use of a ‘brilliant innovation’ that has endured as a mark of incomplete speech</p>
						</div>
						<!-- caption -->

					</div>
				</div>
			</div>
			<!-- Item -->
		</div>
		<!--BANNER-->
        <!-- Main Content -->
	<main class="main-content">
		<!-- Upcoming Release -->
		<section class="upcoming-release">
			<!-- Heading -->
			<div class="container-fluid p-0">
		  	<div class="release-heading pull-right h-white">
		  		<h5>New and Upcoming Release</h5>
		  	</div>
			</div>
			<!-- Heading -->
			<!-- Upcoming Release Slider -->
			<div class="upcoming-slider">
				<div class="container">
					<!-- Release Book Detail -->
					<div class="release-book-detail h-white p-white">
						<div class="release-book-slider">
                        <?php $query = $db->query("SELECT * FROM items LIMIT 0,5");
								while($item = $db->fetch_array($query)){?>
							<div class="item">
								<div class="detail">
									<h5><a href="<?php echo $item['id']?>/<?php echo $item['slug'];?>"><?php echo substr($item['title'],0,25);?>...</a></h5>
									<p><?php echo substr($item['description'],0,120);?>...</p>
									<span>₦<?php echo $item['amount'];?>.<sup>00</sup></span>
									<i class="fa fa-angle-double-right"></i>
								</div>
								<div class="detail-img">
									<img src="backend/<?php $img = explode(',',$item['images']); echo $img[0];?>" alt="">
								</div>
							</div>
                         <?php }?>
						</div>
					</div>
					<!-- Release Book Detail -->

					<!-- Thumbs -->
					<div class="release-thumb-holder">
						<ul id="release-thumb" class="release-thumb">
                        	<?php $query = $db->query("SELECT * FROM items LIMIT 0,5"); $a = 1;
								while($item1 = $db->fetch_array($query)){?>
							<li>
								<a data-slide-index="0" href="<?php echo $item1['id']?>/<?php echo $item1['slug'];?>">
									<span><?php echo substr($item1['title'],0,10);?>...</span>
									<img class="smImg" src="backend/<?php $img = explode(',',$item1['images']); echo $img[0];?>" alt="">
									<img class="b-shadow" src="images/upcoming-release/b-shadow.png" alt="">
									<span data-toggle="modal" data-target="#quick-view<?php echo $a;?>" class="plus-icon">+</span>
								</a>
							</li>
                            <?php $a++;}?>
						</ul>
					</div>
					<!-- Thumbs -->

				</div>
			</div>
			<!-- Upcoming Release Slider -->

		</section>
		<!-- Upcoming Release -->
        <!-- Best Seller Products -->
		<section class="best-seller tc-padding">
			<div class="container">
				
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading style-1">
						<h2>Best <span class="theme-color">Seller</span> Books</h2>
					</div>
				</div>
				<!-- Main Heading -->
				<!-- Best sellers Tabs -->
				<div id="best-sellers-tabs" class="best-sellers-tabs">
			  	<!-- Tab panes -->
			  	<div class="tab-content">

			  		<!-- Best Seller Slider -->
			    	<div id="tab-1">
			    		<div class="best-seller-slider">
							<?php $page = $db->clean($_REQUEST['page']); $limit = 20;
								if(empty($page) || $page == 0){$page = 1;} $startpoint = ($page * $limit) - $limit;
								$query = $db->query("SELECT * FROM items ORDER BY views DESC LIMIT {$startpoint} , {$limit}");
								while($row = $db->fetch_array($query)){?>
			    			<!-- Product Box -->
			    			<div class="item">
			    				<div class="product-box">
			    					<div class="product-img">
			    						<img src="backend/<?php $img = explode(',',$row['images']); echo $img[0];?>" alt="" class="chImg">
			    						<ul class="product-cart-option position-center-x">
			    							<li><a href="<?php echo $row['id']?>/<?php echo $row['slug'];?>"><i class="fa fa-eye"></i></a></li>
			    							<li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
			    							<li><a href="#"><i class="fa fa-share-alt"></i></a></li>
			    						</ul>
			    						<!--<span class="sale-bacth">sale</span>-->
			    					</div>
			    					<div class="product-detail">
			    						<span>Novel</span>
			    						<h5><a href="book-detail.html"><?php echo $row['title'];?></a></h5>
			    						<p><?php echo substr($row['description'],0,26);?>...</p>
			    						<div class="rating-nd-price">
			    							<strong>₦<?php echo number_format($row['amount']);?></strong>
			    						</div>
			    					</div>
			    				</div>
			    			</div>
			    			<!-- Product Box -->
                            <?php }?>
			    		</div>
			    	</div>
			    	<!-- Best Seller Slider -->
			  	</div>
			  	<!-- Tab panes -->
				</div>
				<!-- Best sellers Tabs -->
			</div>
		</section>
		<!-- Best Seller Products -->
        <!-- Recomend products -->
		<div class="recomended-products tc-padding">
			<div class="container">
				
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2>Staff <span class="theme-color">Recomended </span> Books</h2>
						<p>Whether you’re a large or small employer, enterpreneur, educational institution, professional</p>
					</div>
				</div>
				<!-- Main Heading -->

				<!-- Recomend products Slider -->
				<div class="recomend-slider">
					<?php $rec = $db->fetchRecomend(); $ia = 1;
						foreach($rec as $recs){?>
					<!-- Item -->
					<div class="item">
						<a href="<?php echo $recs['slug'];?>" data-toggle="modal" data-target="#open-book-view<?php echo $ia;?>">
                        	<img class="slImg" src="backend/<?php $img = explode(',',$recs['image']); echo $img[0];?>" alt="">
                        </a>
					</div>
					<!-- Item -->
					<?php $ia++;}?>
				</div>
				<!-- Recomend products Slider -->

			</div>
		</div>
		<!-- Recomend products -->
        <!-- Book Collections -->
		<section class="book-collection">
			<div class="container">
				<div class="row">

					<!-- Book Collections Tabs -->
					<div id="book-collections-tabs">

						<!-- collection Name -->
						<div class="col-lg-3 col-sm-12">
							<div class="sidebar">
								<h4>Sponsored</h4>
								
							</div>
						</div>
						<!-- collection Name -->

						<!-- Collection Content -->
						<div class="col-lg-9 col-sm-12">
							<div class="collection">

								<!-- Secondary heading -->
								<div class="sec-heading">
									<h3>Shop <span class="theme-color">Books</span> Collection</h3>
								</div>
								<!-- Secondary heading -->

								<!-- Collection Content -->
								<div class="collection-content">
									<ul>
                                    <?php $page = $db->clean($_REQUEST['page']); $limit = 20; 
									if(empty($page) || $page == 0){$page = 1;} $startpoint = ($page * $limit) - $limit;
									$query = $db->query("SELECT * FROM items ORDER BY views DESC LIMIT {$startpoint} , {$limit}");
									while($rows = $db->fetch_array($query)){?>
										<li>
											<div class="s-product">
												<div class="s-product-img">
													<img class="smImg" src="backend/<?php $img = explode(',',$rows['images']); echo $img[0];?>" alt="">
													<div class="s-product-tooltip">
														<ul class="book-detail-list">
															<li><?php echo $rows['title'];?></li>
															<li>Novel by <span class="theme-color">
															<?php $me =$db->userByID($rows['author']); echo $me['name'];?></span></li>
                                                            <li><?php echo $rows['pages'];?> pages</li>
														</ul>
														<p><span>Summary</span><?php echo strip_tags(substr($rows['description'],0,280));?></p>
													</div>
												</div>
												<h6><a href="<?php echo $rows['id']?>/<?php echo $rows['slug'];?>">
												<?php echo substr($rows['title'],0,20);?>...</a></h6>
												<span><?php echo substr($me['name'],0,20);?></span>
											</div>
										</li><?php }?>
									</ul>
								</div>
								<!-- Collection Content -->

								<!-- Pagination -->
								<div class="pagination-holder">
									<ul class="pagination">
										<?php $db->pagindex($page, $limit);?>
									</ul>
								</div>
								<!-- Pagination -->

							</div>
						</div>
						<!-- Collection Content -->

					</div>
					<!-- Book Collections Tabs -->

				</div>
			</div>
		</section>
		<!-- Book Collections --> 
<?php include("include/footer.php");?>