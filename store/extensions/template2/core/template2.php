<?php
if ( !defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class ExtensionTemplate2 extends Extension {
    
    protected $registry;

    public function  __construct() {
        $this->registry = Registry::getInstance();
		$this->config = $this->registry->get('config');

        //override product image sizes
		if ( $this->config->get('config_storefront_template') == 'template2' ) {
			$this->config->set('config_image_product_width', $this->config->get('template2_product_list_width'));
			$this->config->set('config_image_product_height', $this->config->get('template2_product_list_height'));
			$this->config->set('config_logo', $this->config->get('template2_logo'));
			$this->config->set('config_icon', $this->config->get('template2_favicon'));
		}
    }

    /**
     * update currencies array - add currency symbol
     *
     * @return void
     */
    public function onControllerBlocksCurrency_UpdateData() {
	    if ( !$this->_processHooks()) return;

		if ( !isset($this->baseObject->data['currencies']) ) {

			$get_vars = $this->baseObject->request->get;
			$unset = array('currency');
			if(isset($get_vars['product_id'])){
				$unset[] = 'path';
			}

			$URI = $this->baseObject->html->filterQueryParams($_SERVER['REQUEST_URI'], $unset );
			$results = $this->baseObject->model_localisation_currency->getCurrencies();

			$currencies = array();
			foreach ($results as $result) {
				if ($result['status']) {
					$currencies[] = array(
						'title' => $result['title'],
						'code'  => $result['code'],
						'symbol' => ( !empty( $result['symbol_left'] ) ? $result['symbol_left'] : $result['symbol_right'] ),
						'href'  => $URI.'&currency='.$result['code']
					);
				}
			}

			$this->baseObject->view->assign('currencies', $currencies );
		}
    }

    /**
     *
     * @return void
     */
    public function onControllerBlocksLatest_InitData() {

	    if ( !$this->_processHooks()) return;

        $this->baseObject->loadLanguage('template2/template2');
        $this->baseObject->view->batchAssign( $this->baseObject->language->getASet() );
    }

    public function onControllerPagesProductCategory_InitData() {
		$this->baseObject->loadLanguage('template2/template2');
	}
    public function onControllerPagesProductCategory_UpdateData() {

	    if ( !$this->_processHooks()) return;

        $this->baseObject->view->assign( 'text_buy_now', $this->baseObject->language->get('text_buy_now') );
        $this->baseObject->view->assign( 'text_pages', $this->baseObject->language->get('text_pages') );
        $this->baseObject->view->assign( 'text_next_page', $this->baseObject->language->get('text_next_page') );
        $this->baseObject->view->assign( 'text_prev_page', $this->baseObject->language->get('text_prev_page') );

        $products = $this->baseObject->view->data['products'];
        $_p = array();
        foreach ( $products as $p ) {

            $p['title'] = $p['name'];
            $p['image'] = $p['thumb'];
			$p['info_url'] = $p['href'];
			$p['buy_url'] = $p['add'];
            $p['buy'] = true;
	        $p['display_price'] = $this->baseObject->view->data['display_price'];

            $this->baseObject->view->assign('item', $p);
            $_p[] = $this->baseObject->view->fetch('blocks/product_template.tpl');
        }

        $this->baseObject->view->assign('products', $_p);

	    if (isset($this->baseObject->request->get['page'])) {
			$page = $this->baseObject->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->baseObject->request->get['sort'])) {
			$url .= '&sort=' . $this->baseObject->request->get['sort'];
		}
		if (isset($this->baseObject->request->get['order'])) {
			$url .= '&order=' . $this->baseObject->request->get['order'];
		}

	    if (isset($this->baseObject->request->get['path'])) {
			$path = '';

			$parts = explode('_', $this->baseObject->request->get['path']);

			foreach ($parts as $path_id) {
				$category_info = $this->baseObject->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					if (!$path) {
						$path = $path_id;
					} else {
						$path .= '_' . $path_id;
					}
				}
			}

			$category_id = array_pop($parts);
		} else {
			$category_id = 0;
		}

	    $total = $this->baseObject->model_catalog_product->getTotalProductsByCategoryId($category_id);


	    if ( $total ) {
			$pagination = new template2_Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $this->baseObject->config->get('config_catalog_limit');
			$pagination->text = $this->baseObject->language->get('text_pages');
			$pagination->text_next = $this->baseObject->language->get('text_next_page');
			$pagination->text_prev = $this->baseObject->language->get('text_prev_page');
			$pagination->url = $this->baseObject->html->getSEOURL('product/category','&path=' . $this->baseObject->request->get['path'] . $url . '&page={page}');

			$this->baseObject->view->assign('pagination', $pagination->render() );
		}

    }

	public function onControllerPagesProductManufacturer_initData() {
		$this->baseObject->loadLanguage('template2/template2');
	}
	public function onControllerPagesProductManufacturer_UpdateData() {

	    if ( !$this->_processHooks()) return;

        $this->baseObject->view->assign( 'text_buy_now', $this->baseObject->language->get('text_buy_now') );
        $this->baseObject->view->assign( 'text_pages', $this->baseObject->language->get('text_pages') );
        $this->baseObject->view->assign( 'text_next_page', $this->baseObject->language->get('text_next_page') );
        $this->baseObject->view->assign( 'text_prev_page', $this->baseObject->language->get('text_prev_page') );

        $products = $this->baseObject->view->data['products'];
        $_p = array();
        foreach ( $products as $p ) {

            $p['title'] = $p['name'];
            $p['image'] = $p['thumb'];
			$p['info_url'] = $p['href'];
			$p['buy_url'] = $p['add'];
            $p['buy'] = true;
	        $p['display_price'] = $this->baseObject->view->data['display_price'];

            $this->baseObject->view->assign('item', $p);
            $_p[] = $this->baseObject->view->fetch('blocks/product_template.tpl');
        }

        $this->baseObject->view->assign('products', $_p);

	    if (isset($this->baseObject->request->get['page'])) {
			$page = $this->baseObject->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->baseObject->request->get['sort'])) {
			$url .= '&sort=' . $this->baseObject->request->get['sort'];
		}
		if (isset($this->baseObject->request->get['order'])) {
			$url .= '&order=' . $this->baseObject->request->get['order'];
		}

	    $total = $this->baseObject->model_catalog_product->getTotalProductsByManufacturerId($this->baseObject->request->get['manufacturer_id']);


	    if ( $total ) {
			$pagination = new template2_Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $this->baseObject->config->get('config_catalog_limit');
			$pagination->text = $this->baseObject->language->get('text_pages');
			$pagination->text_next = $this->baseObject->language->get('text_next_page');
			$pagination->text_prev = $this->baseObject->language->get('text_prev_page');
			$pagination->url = $this->baseObject->html->getSEOURL('product/manufacturer','&manufacturer_id=' . $this->request->get['manufacturer_id'] . $url . '&page={page}');

			$this->baseObject->view->assign('pagination', $pagination->render() );
		}

    }

	public function onControllerPagesProductSpecial_InitData() {
		$this->baseObject->loadLanguage('template2/template2');
	}
	public function onControllerPagesProductSpecial_UpdateData() {

        if ( !$this->_processHooks()) return;

        $this->baseObject->view->assign( 'text_buy_now', $this->baseObject->language->get('text_buy_now') );
        $this->baseObject->view->assign( 'text_pages', $this->baseObject->language->get('text_pages') );
        $this->baseObject->view->assign( 'text_next_page', $this->baseObject->language->get('text_next_page') );
        $this->baseObject->view->assign( 'text_prev_page', $this->baseObject->language->get('text_prev_page') );

        $products = (array)$this->baseObject->view->data['products'];
        $_p = array();
        foreach ( $products as $p ) {

            $p['title'] = $p['name'];
            $p['image'] = $p['thumb'];
			$p['info_url'] = $p['href'];
			$p['buy_url'] = $p['add'];
            $p['buy'] = true;
	        $p['display_price'] = $this->baseObject->view->data['display_price'];

            $this->baseObject->view->assign('item', $p);
            $_p[] = $this->baseObject->view->fetch('blocks/product_template.tpl');
        }

        $this->baseObject->view->assign('products', $_p);

	    if (isset($this->baseObject->request->get['page'])) {
			$page = $this->baseObject->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->baseObject->request->get['sort'])) {
			$url .= '&sort=' . $this->baseObject->request->get['sort'];
		}
		if (isset($this->baseObject->request->get['order'])) {
			$url .= '&order=' . $this->baseObject->request->get['order'];
		}

	    $total = (array)$this->baseObject->model_catalog_product->getProductSpecials();
		$total = sizeof($total);

	    if ( $total ) {
			$pagination = new template2_Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $this->baseObject->config->get('config_catalog_limit');
			$pagination->text = $this->baseObject->language->get('text_pages');
			$pagination->text_next = $this->baseObject->language->get('text_next_page');
			$pagination->text_prev = $this->baseObject->language->get('text_prev_page');
			$pagination->url = $this->baseObject->html->getURL('product/special', $url . '&page={page}');

			$this->baseObject->view->assign('pagination', $pagination->render() );
		}

    }

	public function onControllerPagesProductSearch_InitData() {
		$this->baseObject->loadLanguage('template2/template2');
	}
	public function onControllerPagesProductSearch_UpdateData() {

		if ( !$this->_processHooks()) return;
        $this->baseObject->view->assign( 'text_buy_now', $this->baseObject->language->get('text_buy_now') );
        $this->baseObject->view->assign( 'text_pages', $this->baseObject->language->get('text_pages') );
        $this->baseObject->view->assign( 'text_next_page', $this->baseObject->language->get('text_next_page') );
        $this->baseObject->view->assign( 'text_prev_page', $this->baseObject->language->get('text_prev_page') );

		$products = $this->baseObject->view->data['products'];
        $_p = array();
        foreach ( $products as $p ) {

            $p['title'] = $p['name'];
            $p['image'] = $p['thumb'];
			$p['info_url'] = $p['href'];
			$p['buy_url'] = $p['add'];
            $p['buy'] = true;
	        $p['display_price'] = $this->baseObject->view->data['display_price'];

            $this->baseObject->view->assign('item', $p);
            $_p[] = $this->baseObject->view->fetch('blocks/product_template.tpl');
        }

        $this->baseObject->view->assign('products', $_p);

		if (isset($this->baseObject->request->get['page'])) {
			$page = $this->baseObject->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		if (isset($this->baseObject->request->get['keyword'])) {
			$url .= '&keyword=' . $this->baseObject->request->get['keyword'];
		}
		if (isset($this->baseObject->request->get['category_id'])) {
			$url .= '&category_id=' . $this->baseObject->request->get['category_id'];
		}
		if (isset($this->baseObject->request->get['description'])) {
			$url .= '&description=' . $this->baseObject->request->get['description'];
		}
		if (isset($this->baseObject->request->get['model'])) {
			$url .= '&model=' . $this->baseObject->request->get['model'];
		}
		if (isset($this->baseObject->request->get['sort'])) {
			$url .= '&sort=' . $this->baseObject->request->get['sort'];
		}
		if (isset($this->baseObject->request->get['order'])) {
			$url .= '&order=' . $this->baseObject->request->get['order'];
		}

		if (isset($this->baseObject->request->get['keyword'])) {
			$total = $this->baseObject->model_catalog_product->getTotalProductsByKeyword(
				$this->baseObject->request->get['keyword'],
				isset($this->baseObject->request->get['category_id']) ? $this->baseObject->request->get['category_id'] : '',
				isset($this->baseObject->request->get['description']) ? $this->baseObject->request->get['description'] : '',
				isset($this->baseObject->request->get['model']) ? $this->baseObject->request->get['model'] : ''
			);
	
			if ( $total ) {
				$pagination = new template2_Pagination();
				$pagination->total = $total;
				$pagination->page = $page;
				$pagination->limit = $this->baseObject->config->get('config_catalog_limit');
				$pagination->text = $this->baseObject->language->get('text_pages');
				$pagination->text_next = $this->baseObject->language->get('text_next_page');
				$pagination->text_prev = $this->baseObject->language->get('text_prev_page');
				$pagination->url = $this->baseObject->html->getURL('product/search',  $url . '&page={page}');
	
				$this->baseObject->view->assign('pagination', $pagination->render() );
			}
		}
    }
	
	public function onControllerPagesProductProduct_InitData() {
		$this->baseObject->loadLanguage('template2/template2');
	}
	public function onControllerPagesProductProduct_UpdateData() {
		if ( !$this->_processHooks()) return;
		
		$related_products = $this->baseObject->view->data['related_products'];
		$resource = new AResource('image');
		
		foreach($related_products as $k => $product) {
			$sizes = array('main'=> array( 'width'=>$this->config->get('config_image_related_width'),
										   'height' => $this->config->get('config_image_related_height')),
						   'thumb'=> array('width'=> 86,
										   'height' => 86));
										   
			$image = $resource->getResourceAllObjects('products',  $product['product_id'], $sizes,1);
												 
			$related_products[$k]['image'] = $image;
		}
		
		$this->baseObject->view->assign('related_products', $related_products);
	}

	private function _processHooks(){
        return $this->config->get('config_storefront_template') == 'template2';
    }


	public function onControllerBlocksAccount_UpdateData() {
		$this->baseObject->view->assign('login', $this->baseObject->html->getSecureURL('account/login'));
		$this->baseObject->view->assign('register', $this->baseObject->html->getSecureURL('account/create'));
		$this->baseObject->view->assign('forgotten', $this->baseObject->html->getSecureURL('account/forgotten/password'));
		$this->baseObject->view->assign('logged', $this->baseObject->customer->isLogged());
	}

	public function onControllerPagesSettingSetting_InitData() {
		if (IS_ADMIN !== TRUE) return null;
		if (($this->baseObject->request->server['REQUEST_METHOD'] == 'POST')
				&& $this->baseObject->request->post['config_storefront_template'] == 'template2'
		) {
			$this->baseObject->loadModel('setting/setting');
			if (isset ($this->baseObject->request->post ['config_logo'])) {
				$this->baseObject->request->post['config_logo'] = html_entity_decode($this->baseObject->request->post['config_logo'], ENT_COMPAT, 'UTF-8');
				$this->baseObject->model_setting_setting->editSetting($this->baseObject->request->post['config_storefront_template'],
					array('config_logo' => $this->baseObject->request->post['config_logo']),
					$this->baseObject->request->get['store_id']);
			}
			if (isset ($this->baseObject->request->post ['config_icon'])) {
				$this->baseObject->request->post['config_icon'] = html_entity_decode($this->baseObject->request->post['config_icon'], ENT_COMPAT, 'UTF-8');
				$this->baseObject->model_setting_setting->editSetting($this->baseObject->request->post['config_storefront_template'],
					array('config_icon' => $this->baseObject->request->post['config_icon']),
					$this->baseObject->request->get['store_id']);
			}
		}

	}

	/**
	 * @deprecated since 1.1.8
	 */
	public function onControllerPagesCheckoutGuestStep2_UpdateData(){
		$action = $this->baseObject->html->getSecureURL('checkout/guest_step_2',($this->baseObject->request->get['mode'] ? '&mode='.$this->baseObject->request->get['mode'] : ''),true);
		$form = new AForm();
		$form->setForm(array( 'form_name' => 'coupon' ));
		$data = $this->baseObject->view->getData();

		$data['form0']['form_open'] = $form->getFieldHtml(
												array( 'type' => 'form',
													   'name' => 'coupon',
													   'action' => $action ));

		$this->baseObject->view->assign('form0',$data['form0']);
	}
	/**
	 * @deprecated since 1.1.8
	 */
	public function onControllerPagesCheckoutCart_UpdateData(){
		$data = $this->baseObject->view->getData();
		$this->baseObject->view->assign('continue', str_replace('&amp;','&',$data['continue']));
	}


	public function onControllerPagesAccountLogin_UpdateData(){
		$this->baseObject->view->assign('forgotten', $this->baseObject->html->getSecureURL('account/forgotten/password'));

	}
}