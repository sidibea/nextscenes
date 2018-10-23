<?php  
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class ControllerBlocksSlideshow2 extends AController {
	public function main() {

        //init controller data
        $this->extensions->hk_InitData($this);
        $this->loadModel('slideshow2/slideshow2');

        if ( !$this->registry->has('jcycle') ) {
            $this->document->addScript( $this->view->templateResource('/javascript/jquery/jquery.cycle.js') );
            $this->registry->set('jcycle', true);
        }
		$this->document->addScript( $this->view->templateResource('/javascript/jquery/jeasing.js') );
		$this->document->addStyle(
			array(
				 'href' => $this->view->templateResource('/stylesheet/slideshow2.css'),
				 'rel' => 'stylesheet',
				 'media' => 'screen',
			)
		);

		$this->view->assign('slides', $this->model_slideshow2_slideshow2->getSlides());
		
        $this->processTemplate('blocks/slideshow2.tpl');

        //init controller data
        $this->extensions->hk_UpdateData($this);
		
	}
}