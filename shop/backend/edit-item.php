<?php include("include/database.php"); $db->authenticateUser(); $title = "Edit Item"; include("include/header.php"); $item = $db->getItemByID($db->clean($_REQUEST['id']));?>
<form action="mint?action=edit-item" method="post" class="form">
<label><strong>Item Title</strong></label>
<input type="text" name="title" class="form-control" value="<?php echo $item['title']?>" placeholder="Enter Item Title" />
<div style="height:20px;"></div>
<label><strong>Item Description</strong></label>
<textarea name="description" class="form-control"><?php echo $item['description']?></textarea>
<div style="height:20px;"></div>
<strong>Stock: </strong><input type="text" name="stock" placeholder="Stock" value="<?php echo $item['stock']?>" /> <strong>Amount: ₦</strong><input type="text" name="amount" placeholder="Amount" value="<?php echo $item['amount']?>" /> <strong>Discount: ₦</strong><input type="text" name="discount" placeholder="Discount" value="<?php echo $item['discount']?>" /> <strong>SKU: </strong><?php echo $item['sku']?>
<input type="hidden" name="id" value="<?php echo $db->clean($_REQUEST['id']);?>" />
<div style="height:20px;"></div>
<div align="right"><input type="submit" value="Edit Item" class="btn btn-success" /></div>
</form>
<?php include("include/footer.php");?>