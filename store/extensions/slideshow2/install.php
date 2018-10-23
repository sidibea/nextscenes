<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

$layout = new ALayoutManager();
$block_data = array(
    'block_txt_id' => 'slideshow2',
    'controller' => 'blocks/slideshow2',
    'templates' => array(
        array(
            'parent_block_txt_id' => 'content_top',
            'template' => 'blocks/slideshow2.tpl',
        ),
    ),
);
$layout->saveBlock( $block_data );

$slideshow = new ADataset();
$slideshow->createDataset('slideshow', 'slideshow2');
//$slideshow->setDatasetProperties();
$slideshow->defineColumns(array(
				array('name' => 'slide_title', 'type' => 'varchar'), 
				array('name' => 'slide_url', 'type' => 'varchar'), 
				array('name' => 'slide_image', 'type' => 'varchar'), 
				array('name' => 'slide_resource_id', 'type' => 'integer')
      		));
//$slideshow->setColumnProperties();

/*
 * add images to RL
 * */
// images list for adding into resource library
$images = array(
	'slide1.jpg',
	'slide2.jpg',
	'slide3.jpg'
);
// language list for insert RL-object names
//$this->model->loadModel('localisation/language');
$language_list = $this->model_localisation_language->getLanguages();

$rm = new AResourceManager();
$rm->setType('image');
foreach($images as $i => $image_name){
	//copy file into RL-directory from extension directory
	$result = copy(DIR_EXT.'slideshow2/image/slides/'.$image_name, DIR_RESOURCE.'image/'.$image_name);

	$resource = array( 'language_id' => $this->config->get('storefront_language_id'),
														   'name' => array(),
														   'title' => 'slideshow2_slide',
														   'description' => 'slide of slideshow2 extension',
														   'resource_path' => $image_name,
														   'resource_code' => '');
	foreach($language_list as $lang){
			$resource['name'][$lang['language_id']] = $image_name;
	}
	$resource_id = $rm->addResource($resource);

	if ( $resource_id ) {
		// $extension_id - known id from parent method "install" of extension manager
		$rm->mapResource('extensions', $extension_id, $resource_id);
		// get hexpath of resource (RL moved given file from rl-image-directory in own dir tree)
		$resource_info = $rm->getResource($resource_id, $this->config->get('admin_language_id'));
		
		$slideshow->addRows(array(
						array(
							'slide_title' => 'Banner'.($i+1), 
							'slide_url' => 'index.php', 
							'slide_image' => $resource_info['resource_path'], 
							'slide_resource_id' => $resource_id
							)
					));
	}
}