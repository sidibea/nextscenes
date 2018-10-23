<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

$registry = Registry::getInstance();
$extension_id = $name;

$file = DIR_EXT . $extension_id . '/layout.xml';

$layout = new ALayoutManager();
$layout->loadXml(array('file' => $file));

$language_list = $this->model_localisation_language->getLanguages();

$layout = new ALayoutManager($extension_id);
$block_names = array(ucfirst($extension_id).' Banner 1', ucfirst($extension_id).' Banner 2');
$custom_blocks = $layout->getBlocksList(array('subsql_filter' => 'cb.custom_block_id <> 0'));
foreach($custom_blocks as $block) {
	if(in_array($block['block_name'], $block_names)) {
        foreach($language_list as $lang){
            $block_descriptions = array(
    			'language_id' => $lang['language_id'],
    			'block_framed' => '0'
    		);
            $layout->saveBlockDescription(0, $block['custom_block_id'], $block_descriptions);
        }
	}
}


$icons = array($extension_id.'_logo' => 'store_logo.png');

$rm = new AResourceManager();
$rm->setType('image');

foreach($icons as $k => $icon_name){
	//copy file into RL-directory from extension directory
	$result = copy(DIR_EXT.$extension_id.'/image/'.$icon_name, DIR_RESOURCE.'image/'.$icon_name);

	$resource = array( 'language_id' => $this->config->get('storefront_language_id'),
														   'name' => array(),
														   'title' => $extension_id,
														   'description' => 'images of '.$extension_id.' set extension',
														   'resource_path' => $icon_name,
														   'resource_code' => '');

	foreach($language_list as $lang){
			$resource['name'][$lang['language_id']] = $icon_name;
	}
	$resource_id = $rm->addResource($resource);

	if ( $resource_id ) {
		// $extension_id - known id from parent method "install" of extension manager
		$rm->mapResource('extensions', $extension_id, $resource_id);
		// get hexpath of resource (RL moved given file from rl-image-directory in own dir tree)
		$resource_info = $rm->getResource($resource_id, $this->config->get('admin_language_id'));
		// write it path in settings (array from parent method "install" of extension manager)
		$settings[$k] =  'image/'.$resource_info['resource_path'];
		
		$registry->get('db')->query("UPDATE " . DB_PREFIX . "settings SET `value` = '" . $settings[$k] . "' WHERE `key` = '" . $k . "' ");
	}
}