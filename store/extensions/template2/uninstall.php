<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

$registry = Registry::getInstance();
$extension_id = $name;

if ( $registry->get('config')->get('config_storefront_template') == $extension_id ) {
	$registry->get('db')->query("UPDATE " . DB_PREFIX . "settings SET `value` = 'default' WHERE `key` = 'config_storefront_template' ");
}

// delete template layouts
$layout = new ALayoutManager($extension_id);
$layout->deleteTemplateLayouts();

$block_names = array(ucfirst($extension_id).' Banner 1', ucfirst($extension_id).' Banner 2');
$custom_blocks = $layout->getBlocksList(array('subsql_filter' => 'cb.custom_block_id <> 0'));
foreach($custom_blocks as $block) {
	if(in_array($block['block_name'], $block_names)) {
		$layout->deleteCustomBlock($block['custom_block_id']);
	}
}

$rm = new AResourceManager();
$rm->setType('image');
	
$resources = $rm->getResources('extensions', $extension_id);

foreach($resources as $resource){
	$rm->deleteResource($resource['resource_id']);
}