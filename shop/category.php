<?php include("backend/include/database.php"); $slug = $db->clean($_GET['link']); $cat = $db->getCategoryBySlug($slug); $title = $cat['name']; $cats = $cat['id']; include("include/header.php");?>
<!-- Main Content -->
	<main class="main-content">
		<!-- Shop Grid -->
		<div class="product-grid-holder tc-padding">
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2><?php echo $title;?> <span class="theme-color">Books </span></h2>
					</div>
				</div>
				<!-- Main Heading -->
			<div class="container">
				<div class="row">
                	<div class="col-md-8  pull-right pull-none">
						<?php $page = $db->clean($_REQUEST['page']); $limit = 20; 
                        if(empty($page) || $page == 0){$page = 1;} $startpoint = ($page * $limit) - $limit;
                        $query = $db->query("SELECT * FROM items WHERE category=\"$cats\" ORDER BY id DESC LIMIT {$startpoint} , {$limit}");
                        while($rows = $db->fetch_array($query)){?>
							<div class="col-lg-4 col-xs-6 r-full-width">
								<div class="product-box">
			    					<div class="product-img">
			    						<img class="chImg" src="<?php echo $db->flink();?>/backend/<?php $img = explode(',',$rows['images']); echo $img[0];?>" alt="">
			    						<ul class="product-cart-option position-center-x">
			    							<li><a href="<?php echo $db->flink();?>/<?php echo $rows['id']?>/<?php echo $rows['slug'];?>"><i class="fa fa-eye"></i></a></li>
			    							<li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
			    							<li><a href="#"><i class="fa fa-share-alt"></i></a></li>
			    						</ul>
			    					</div>
			    					<div class="product-detail">
			    						<h5><?php echo $rows['title'];?></h5>
			    						<p><?php echo strip_tags(substr($rows['description'],0,26));?>...</p>
			    						<div class="rating-nd-price">
			    							<strong>₦<?php echo number_format($rows['amount']);?></strong>
			    						</div>
			    					</div>
			    				</div>
							</div>
                            <?php }?>
						<!-- Pagination -->
		           		<div class="pagination-holder">
		           			<ul class="pagination">
							    <?php $db->pagindex($page, $limit);?>
							</ul>
		           		</div>
		           		<!-- Pagination -->
						</div>
						<!-- Products -->
                        <!-- Aside -->
					<aside class="col-lg-3 col-md-4 pull-left pull-none">

						<!-- Aside Widget -->
						<div class="aside-widget">
							<form class="search-bar style-2 style-3">
								<input type="text" class="form-control" required="required" placeholder="Search...">
								<button class="sub-btn fa fa-search"></button>
							</form>
						</div>
						<!-- Aside Widget -->
                    </aside>
                </div>
            </div>
        </div>
        <!-- Shop Grid Ends -->
    </main>
<?php include("include/footer.php");?>