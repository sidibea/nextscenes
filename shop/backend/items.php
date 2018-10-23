<?php include("include/database.php"); $db->authenticateUser(); $title = "All Items"; include("include/header.php");?>
<h1>All Items</h1>
<table class="table">
    <thead style="font-weight:bold;">
            <td>#</td>
            <td>Title</td>
            <td>Description</td>
            <td>SKU</td>
            <td>In Stock</td>
            <td>Amount</td>
            <td>Discount</td>
            <td>Date</td>
            <td>Action</td>
    </thead>
    <tbody>
    	<?php
			$page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
			if($page == ""){
				$page = 1;
			}
			$limit =20;
			$tlink = "items";
			$db->fetchItemsBack($page, $limit);
		?>
	</tbody>
</table>
<?php ?>
<?php include("include/footer.php");?>