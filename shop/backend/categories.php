<?php include("include/database.php"); $db->authenticateUser(); $title = "Categories"; include("include/header.php");?>
<h1>Categories</h1>
<h3>New Category</h3>
<form action="mint?action=new-category" method="post">
    <div class="input-group">
        <input type="text" name="name" placeholder="Category Title" class="form-control" />
        <span class="input-group-btn"><button class="btn btn-default" type="submit">Add Category</button></span>
    </div>
</form>
<h3>All Categories</h3>
<table class="table">
    <thead style="font-weight:bold;">
            <td>#</td>
            <td>Title</td>
            <td>Slug</td>
            <td>Action</td>
    </thead>
    <tbody>
    	<?php
			$cat = $db->getCategories("gh");
			foreach($cat as $category){
				echo "<tr>
					<td>".$category['id']."</td>
					<td>".$category['name']."</td>
					<td>".$category['slug']."</td>
					<td><a href=\"mint?action=delete-category&id=".$category['id']."\">Delete</a></td>
				</tr>";
			}
		?>
	</tbody>
</table>
<?php include("include/footer.php");?>