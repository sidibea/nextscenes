<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

// delete block
$layout = new ALayoutManager();
$layout->deleteBlock('slideshow2');

$rm = new AResourceManager();

$slideshow = new ADataset('slideshow', 'slideshow2');
$rows = $slideshow->getRows();

foreach($rows as $row) {
	$rm->deleteResource($row['slide_resource_id']);
}

$slideshow->dropDataset();