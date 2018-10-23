<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class ControllerPagesBlocksSlideshow2 extends AController {

	private $error = array();
	public $data = array();

  	public function main() {

          //init controller data
        $this->extensions->hk_InitData($this);

    	$this->loadLanguage('extension/extensions');
    	$this->loadLanguage('slideshow2/slideshow2');
    	$this->loadModel('slideshow2/slideshow2');
        $this->document->setTitle( $this->language->get('heading_title') );

		$this->view->assign('error_warning', $this->error['warning']);
		$this->view->assign('success', $this->session->data['success']);
		if (isset($this->session->data['success'])) {
			unset($this->session->data['success']);
		}

    	$this->document->initBreadcrumb( array (
       		'href'      => $this->html->getSecureURL('index/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		 ));
        $this->document->addBreadcrumb(array(
            'href' => $this->html->getSecureURL('extension/extensions/'.$this->session->data['extension_filter']),
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        ));
		$this->document->addBreadcrumb(array(
            'href' => $this->html->getSecureURL('extension/extensions/edit', '&extension=slideshow2'),
            'text' => $this->language->get('slideshow2_name'),
            'separator' => ' :: '
        ));
   		$this->document->addBreadcrumb( array (
       		'href'      => $this->html->getSecureURL('blocks/slideshow2'),
       		'text'      => $this->language->get('slides_title'),
      		'separator' => ' :: '
   		 ));

		$this->data['images'] = $this->model_slideshow2_slideshow2->getSlides();

		$this->data['delete'] = $this->html->getSecureURL('blocks/slideshow2/delete', '&slide_id=%ID%' );
		$this->data['update'] = $this->html->getSecureURL('blocks/slideshow2/update', '&slide_id=%ID%' );
		$this->data['insert'] = $this->html->getSecureURL('blocks/slideshow2/insert' );

		$this->data['button_remove'] = $this->html->buildButton(array(
			'text' => $this->language->get('button_remove'),
			'style' => 'button2',
		));
		$this->data['button_edit'] = $this->html->buildButton(array(
			'text' => $this->language->get('button_edit'),
			'style' => 'button2',
		));
		$this->data['button_add_slide'] = $this->html->buildButton(array(
			'text' => $this->language->get('button_add_slide'),
			'style' => 'button1',
		));

        $this->view->batchAssign(  $this->language->getASet() );
		$this->view->batchAssign( $this->data );

		$this->processTemplate('pages/blocks/slideshow2_list.tpl' );

          //update controller data
        $this->extensions->hk_UpdateData($this);
	}

  	public function insert() {

        //init controller data
        $this->extensions->hk_InitData($this);

    	$this->loadLanguage('slideshow2/slideshow2');
        $this->loadModel('slideshow2/slideshow2');
    	$this->document->setTitle($this->language->get('heading_title'));

    	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->request->post['slide_image'] = html_entity_decode($this->request->post['slide_image'], ENT_COMPAT, 'UTF-8');
            $this->model_slideshow2_slideshow2->addSlide($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
			$this->redirect( $this->html->getSecureURL('blocks/slideshow2') );
    	}
    	$this->_getForm();

        //update controller data
        $this->extensions->hk_UpdateData($this);
  	}

  	public function update() {

        //init controller data
        $this->extensions->hk_InitData($this);

    	$this->loadLanguage('slideshow2/slideshow2');
        $this->loadModel('slideshow2/slideshow2');
    	$this->document->setTitle($this->language->get('heading_title'));
    	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->request->post['slide_image'] = html_entity_decode($this->request->post['slide_image'], ENT_COMPAT, 'UTF-8');
			$this->model_slideshow2_slideshow2->editSlide($this->request->get['slide_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect( $this->html->getSecureURL('blocks/slideshow2') );
		}
    	$this->_getForm();

        //update controller data
        $this->extensions->hk_UpdateData($this);
  	}

	public function delete() {

        //init controller data
        $this->extensions->hk_InitData($this);

    	$this->loadLanguage('slideshow2/slideshow2');
        $this->loadModel('slideshow2/slideshow2');
    	$this->model_slideshow2_slideshow2->deleteSlide($this->request->get['slide_id']);
        $this->session->data['success'] = $this->language->get('text_success');
		$this->redirect( $this->html->getSecureURL('blocks/slideshow2') );

		//update controller data
        $this->extensions->hk_UpdateData($this);
  	}

  	private function _getForm() {

		$this->view->assign('error_warning', $this->error['warning']);
		$this->view->assign('success', $this->session->data['success']);
		if (isset($this->session->data['success'])) {
			unset($this->session->data['success']);
		}
		$this->view->batchAssign(  $this->language->getASet() );

    	$this->data = array();
		$this->data['error'] = $this->error;
		$this->data['cancel'] = $this->html->getSecureURL('blocks/slideshow2');

		$this->data['heading_title'] = $this->language->get('slides_title');

  		$this->document->initBreadcrumb( array (
       		'href'      => $this->html->getSecureURL('index/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		 ));
        $this->document->addBreadcrumb(array(
            'href' => $this->html->getSecureURL('extension/extensions/'.$this->session->data['extension_filter']),
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        ));
		$this->document->addBreadcrumb(array(
            'href' => $this->html->getSecureURL('extension/extensions/edit', '&extension=slideshow2'),
            'text' => $this->language->get('slideshow2_name'),
            'separator' => ' :: '
        ));
   		$this->document->addBreadcrumb( array (
       		'href'      => $this->html->getSecureURL('blocks/slideshow2'),
       		'text'      => $this->language->get('slides_title'),
      		'separator' => ' :: '
   		 ));


		if (isset($this->request->get['slide_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$item_info = $this->model_slideshow2_slideshow2->getSlide($this->request->get['slide_id']);
    	}

		$fields = array('slide_image', 'slide_title', 'slide_url', 'slide_resource_id');
		foreach ( $fields as $f ) {
			if (isset ( $this->request->post [$f] )) {
				$this->data [$f] = $this->request->post [$f];
			} elseif (isset($item_info[$f])) {
				$this->data[$f] = $item_info[$f];
			} else {
				$this->data[$f] = '';
			}
		}

        if (!isset($this->request->get['slide_id'])) {
			$this->data['action'] = $this->html->getSecureURL('blocks/slideshow2/insert' );
			$this->data['form_title'] = $this->language->get('text_insert') . $this->language->get('text_slide');
		} else {
			$this->data['action'] = $this->html->getSecureURL('blocks/slideshow2/update', '&slide_id=' . $this->request->get['slide_id'] );
			$this->data['form_title'] = $this->language->get('text_edit') . $this->language->get('text_slide');
		}

        $form = new AForm('ST');

		$this->document->addBreadcrumb( array (
			'href'      => $this->data['action'],
			'text'      => $this->data['form_title'],
			'separator' => ' :: '
		 ));

		$form->setForm(array(
		    'form_name' => 'frm',
			'update' => '',
	    ));

        $this->data['form']['id'] = 'frm';
        $this->data['form']['form_open'] = $form->getFieldHtml(array(
		    'type' => 'form',
		    'name' => 'frm',
		    'action' => $this->data['action'],
	    ));
        $this->data['form']['submit'] = $form->getFieldHtml(array(
		    'type' => 'button',
		    'name' => 'submit',
		    'text' => $this->language->get('button_save'),
		    'style' => 'button1',
	    ));
		$this->data['form']['cancel'] = $form->getFieldHtml(array(
		    'type' => 'button',
		    'name' => 'cancel',
		    'text' => $this->language->get('button_cancel'),
		    'style' => 'button2',
	    ));

        $this->data['form']['fields']['image'] = $form->getFieldHtml(
            array(
                'type' => 'hidden',
                'name' => 'slide_image',
                'value' => htmlspecialchars($this->data['slide_image'], ENT_COMPAT, 'UTF-8'),
		    )
        );
        $this->data['form']['fields']['title'] = $form->getFieldHtml(
            array(
                'type' => 'input',
                'name' => 'slide_title',
                'value' => $this->data['slide_title'],
                'style' => 'large-field',
		    )
        );
		$this->data['form']['fields']['url'] = $form->getFieldHtml(
            array(
                'type' => 'input',
                'name' => 'slide_url',
                'value' => $this->data['slide_url'],
                'style' => 'large-field',
		    )
        );

        //if ( isset($this->request->get['slide_id']) ) {
			$rm = new AResourceManager('image');
			$this->data['thumb'] = $this->dispatch(
						'responses/common/resource_library/get_resource_html_single',
					array('type'=>'image',
						  'wrapper_id'=>'slide_image',
						  'resource_id'=> $this->data['slide_resource_id'],
						  'field' => 'slide_image'));
			$this->data['thumb'] = $this->data['thumb']->dispatchGetOutput();
		//}
		
		$resources_scripts = $this->dispatch(
            'responses/common/resource_library/get_resources_scripts',
            array(
                'object_name' => 'slideshow2_banner_item',
                'object_id' => isset($this->request->get['slide_id']) ? $this->request->get['slide_id'] : '0',
                'types' => 'image',
                'mode' => 'url',
            )
        );
        $this->data['resources_scripts'] = $resources_scripts->dispatchGetOutput();
		
        $this->view->batchAssign( $this->data );
        $this->processTemplate('pages/blocks/slideshow2_form.tpl' );
  	}


}