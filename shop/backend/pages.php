<?php include("include/database.php"); $db->authenticateUser(); $title = "Pages"; include("include/header.php");?>
<h1>Pages</h1>
<h3>New Page</h3>
<form action="mint?action=new-page" method="post">
	<label><strong>Title:</strong></label>
	<input type="text" name="title" placeholder="Page Title" class="form-control" />
    <div style="height:20px;"></div>
    <label><strong>Content:</strong></label>
    <textarea name="content"></textarea>
    <div style="height:10px;"></div>
    <button class="btn btn-default" type="submit">Add Page</button>
</form>
<h3>All Pages</h3>
<table class="table">
    <thead style="font-weight:bold;">
            <td>#</td>
            <td>Title</td>
            <td>Slug</td>
            <td>Action</td>
    </thead>
    <tbody>
    	<?php
			$pag = $db->getPages("bk");
			foreach($pag as $page){
				echo "<tr>
					<td>".$page['id']."</td>
					<td>".$page['title']."</td>
					<td>".$page['slug']."</td>
					<td><a href=\"mint?action=delete-page&id=".$page['id']."\">Delete</a></td>
				</tr>";
			}
		?>
	</tbody>
</table>
<?php include("include/footer.php");?>