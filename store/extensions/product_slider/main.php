<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

if(!class_exists('ExtensionProductSlider')){
	include('core/product_slider.php');
}


$controllers = array(
    'storefront' => array(
        'blocks/product_slider',
        'responses/blocks/product_slider',
    ),
    'admin' => array(
    ),
);

$languages = array(
    'storefront' => array(
	    'blocks/product_slider',
    ),
    'admin' => array(
        'product_slider/product_slider',
    ),
);

$templates = array(
    'storefront' => array(
        'blocks/product_slider.tpl',
        'blocks/product_template.tpl',
    ),
    'admin' => array(),
);