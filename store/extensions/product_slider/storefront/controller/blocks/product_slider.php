<?php  
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class ControllerBlocksProductSlider extends AController {
	public function main() {

        //init controller data
        $this->extensions->hk_InitData($this);

        $this->loadLanguage('blocks/product_slider');
        $this->view->batchAssign(  $this->language->getASet() );
        $this->view->assign( 'heading_title', $this->language->get('text_'.$this->config->get('product_slider_type')) );
        $this->load->model('tool/image');

        if ( !$this->registry->has('jcarousel') ) {
            $this->document->addScript( $this->view->templateResource('/javascript/jquery/jquery.jcarousel.min.js') );
            $this->document->addStyle(
                array(
                     'href' => $this->view->templateResource('/stylesheet/jc_skin.css'),
                     'rel' => 'stylesheet',
                     'media' => 'screen',
                )
            );
            $this->registry->set('jcarousel', true);
        }

        $this->view->assign('product_slider_url', $this->html->getSecureURL('r/blocks/product_slider') );

        $this->processTemplate('blocks/product_slider.tpl');

        //init controller data
        $this->extensions->hk_UpdateData($this);
		
	}
}
?>