<?php include("include/database.php"); $db->authenticateUser(); $title = "New Item"; include("include/header.php");?>
<form action="mint?action=new-item" method="post" class="form" enctype="multipart/form-data">
<label><strong>Item Title</strong></label>
<input type="text" name="title" class="form-control" placeholder="Enter Item Title" />
<div style="height:20px;"></div>
<label><strong>Images</strong></label><br />
<input type="file" name="upload[]" />
<div class="addMoreImage"></div>
<input type="button" id="addMoreImage" class="btn btn-default" value="Add More Image" />
<div style="height:20px;"></div>
<label><strong>Category:</strong></label>
<select name="category" class="selectpicker">
	<optgroup label="Select Most Appropriate Category">
    	<?php $ct = $db->getCategories("back");
			foreach($ct as $cat){
				echo "<option value=\"".$cat['id']."\">".$cat['name']."</option>";
			}
		?>
	</optgroup>
</select> 
<div style="height:20px;"></div>
<label><strong>Item Description</strong></label>
<textarea name="description" class="form-control"></textarea>
<div style="height:20px;"></div>
<strong>Stock: </strong><input type="text" name="stock" placeholder="Stock" /> <strong>Amount: ₦</strong><input type="text" name="amount" placeholder="Amount" /> <strong>Discount: ₦</strong><input type="text" name="discount" placeholder="Discount" /> <strong>Pages: </strong><input type="text" name="pages" placeholder="Number Of Pages" /><br />
<strong>Audience: </strong><input type="text" name="audience" placeholder="Ex: General, Educational, Professors" /> <strong>Format</strong> <select name="format" class="selectpicker"><optgroup label="Select Format"><option value="pdf">PDF</option><option value="ePUB">ePUB</option></optgroup></select> <strong>Language: </strong><select name="language" class="selectpicker"><optgroup label="Select Language"><option value="English">English</option><option value="French">French</option></optgroup></select> <strong>Country Of Pub.: </strong><select name="country" class="selectpicker"><optgroup label="Select Country"><option value="Nigeria">Nigeria</option><option value="Mali">Mali</option></optgroup></select> <strong>Edition: </strong><select name="edition" class="selectpicker"><optgroup label="Book Edition"><option value="1">1st</option><option value="2">2nd</option><option value="3">3rd</option><option value="4">4th</option><option value="5">5th</option><option value="6">6th</option><option value="7">7th</option><option value="8">8th</option><option value="9">9th</option><option value="10">10th</option></optgroup></select>
<div style="height:20px;"></div>
<input type="hidden" name="author" value="<?php $is = $db->userByMail($_SESSION['email']); echo $is['id'];?>" />
<div align="right"><input type="submit" value="Add Item" class="btn btn-success" /></div>
</form>
<?php include("include/footer.php");?>