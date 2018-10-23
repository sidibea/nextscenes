<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

$controllers = array(
    'storefront' => array(
        'blocks/slideshow2',
    ),
    'admin' => array(
        'pages/blocks/slideshow2',
    ),
);

$models = array(
    'storefront' => array(
        'slideshow2/slideshow2',
    ),
    'admin' => array(
        'slideshow2/slideshow2',
    ),
);

$languages = array(
    'storefront' => array(),
    'admin' => array(
        'slideshow2/slideshow2',
    ),
);

$templates = array(
    'storefront' => array(
        'blocks/slideshow2.tpl',
    ),
    'admin' => array(
        'pages/blocks/slideshow2_list.tpl',
        'pages/blocks/slideshow2_form.tpl',
    ),
);