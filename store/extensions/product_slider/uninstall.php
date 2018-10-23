<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

// delete block
$layout = new ALayoutManager();
$layout->deleteBlock('product_slider');