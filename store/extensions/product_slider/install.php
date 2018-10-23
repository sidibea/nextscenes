<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

$layout = new ALayoutManager();
$block_data = array(
    'block_txt_id' => 'product_slider',
    'controller' => 'blocks/product_slider',
    'templates' => array(
        array(
            'parent_block_txt_id' => 'content_top',
            'template' => 'blocks/product_slider.tpl',
        ),
    ),
);
$layout->saveBlock( $block_data );