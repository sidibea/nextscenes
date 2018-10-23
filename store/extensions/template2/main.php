<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

if(!class_exists('ExtensionTemplate2')){
	include('core/template2.php');
}
if(!class_exists('template2_Pagination')){
	include('core/template2_pagination.php');
}

$languages = array(
    'storefront' => array(
	    'template2/template2',
    ),
    'admin' => array(
        'template2/template2',
    ),
);

$templates = array(
    'storefront' => array(
        'common/header.tpl',
        'common/footer.tpl',

        'blocks/currency.tpl',
        'blocks/language.tpl',
		'blocks/cart_top.tpl',
        'blocks/latest_home.tpl',
        'blocks/product_template.tpl',

        'pages/index/home.tpl',

        'pages/account/account.tpl',
        'pages/account/address.tpl',
        'pages/account/addresses.tpl',
        'pages/account/create.tpl',
        'pages/account/download.tpl',
        'pages/account/edit.tpl',
        'pages/account/forgotten.tpl',
        'pages/account/history.tpl',
        'pages/account/invoice.tpl',
        'pages/account/newsletter.tpl',
        'pages/account/pssword.tpl',
        'pages/account/login.tpl',

        'pages/content/content.tpl',
        'pages/content/sitemap.tpl',

        'pages/checkout/address.tpl',
        'pages/checkout/cart.tpl',
        'pages/checkout/confirm.tpl',
        'pages/checkout/guest_step_1.tpl',
        'pages/checkout/guest_step_2.tpl',
        'pages/checkout/payment.tpl',
        'pages/checkout/shipping.tpl',

        'pages/product/category.tpl',
        'pages/product/manufacturer.tpl',
        'pages/product/product.tpl',
        'pages/product/search.tpl',
        'pages/product/special.tpl',
    ),
    'admin' => array(),
);