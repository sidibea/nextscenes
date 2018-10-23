<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}


class ExtensionProductSlider extends Extension {
    
    protected $registry;

    public function  __construct() {
        $this->registry = Registry::getInstance();
    }

}