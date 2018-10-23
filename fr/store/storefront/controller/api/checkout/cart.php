<?php  
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2016 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}
class ControllerApiCheckoutCart extends AControllerAPI {
	
	public function post() {
        $request = $this->rest->getRequestParams();
        
        $this->extensions->hk_InitData($this,__FUNCTION__);
		$this->loadModel('catalog/product');
		$product_id = $request['product_id'];
		
      	if (isset($request['quantity'])) {
		    if (!is_array($request['quantity'])) {
		    	if (isset($request['option'])) {
		    		$options = $request['option'];
		    	} else {
		    		$options = array();
		    	}
		    	if ( $errors = $this->model_catalog_product->validateProductOptions($product_id, $options)) {
					$this->rest->setResponseData( array('error' => implode(' ',$errors)) );
					$this->rest->sendResponse(206);
		    	}

      	    	$this->cart->add($product_id, $request['quantity'], $options);
		    } else {
		    	foreach ($this->request->post['quantity'] as $key => $value) {
	        		$this->cart->update($key, $value);
		    	}
		    }
		    
		    unset($this->session->data['shipping_methods']);
		    unset($this->session->data['shipping_method']);
		    unset($this->session->data['payment_methods']);
		    unset($this->session->data['payment_method']);
      	}

		//request to remove
      	if (isset($request['remove']) && is_array($request['remove']) ) {
	        foreach (array_keys($request['remove']) as $key) {
 	        	if($key) {
     	      		$this->cart->remove($key);
     	      	}
		    }
      	}
				
    	if ($this->cart->hasProducts()) {

			$this->view->assign('error_warning', $this->error['warning'] );
            if (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout')) {
                $this->view->assign('error_warning', $this->language->get('error_stock') );
			}
			
			$this->loadModel('tool/image');
			
      		$products = array();
		    $cart_products = $this->cart->getProducts();

            $product_ids = array();
            foreach($cart_products as $result){
                $product_ids[] = (int)$result['product_id'];
            }

            $resource = new AResource('image');
            $thumbnails = $resource->getMainThumbList(
                            'products',
                            $product_ids,
                            $this->config->get('config_image_cart_width'),
                            $this->config->get('config_image_cart_height')
            );

      		foreach ($cart_products as $result) {
        		$option_data = array();
		        $thumbnail = $thumbnails[ $result['product_id'] ];

        		foreach ($result['option'] as $option) {
          			$option_data[] = array(
            			'name'  => $option['name'],
            			'value' => $option['value']
          			);
        		}

				$price_with_tax = $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
        		$products[] = array(
          			'key'      => $result['key'],
          			'name'     => $result['name'],
          			'model'    => $result['model'],
          			'thumb'    => $thumbnail['thumb_url'],
          			'option'   => $option_data,
          			'quantity' => $result['quantity'],
          			'stock'    => $result['stock'],
					'price'    => $this->currency->format($price_with_tax),
					'total'    => $this->currency->format_total($price_with_tax, $result['quantity'])
        		);
      		}
            $this->data['products'] =  $products ;

			if ($this->config->get('config_cart_weight')) {
				$this->data['weight'] = $this->weight->format($this->cart->getWeight(), $this->config->get('config_weight_class'));
			} else {
				$this->data['weight'] = FALSE;
			}

      		$display_totals = $this->cart->buildTotalDisplay();      				
            $this->data['totals'] = $display_totals['total_data'];
		
		} else {
			//empty cart content
			$this->data['products'] = array();
			$this->data['totals'] = 0;
		}


        $this->extensions->hk_UpdateData($this,__FUNCTION__);

		$this->rest->setResponseData( $this->data );
		$this->rest->sendResponse(200);

	}

	public function delete() {
	    $request = $this->rest->getRequestParams();
      	
      	$count = 0;
      	if (isset($request['remove']) && is_array($request['remove'])) {
	        foreach (array_keys($request['remove']) as $key) {
	        	if($key) {
            		$this->cart->remove($key);
            		$count++;	        	
	        	}
		    }
      	}	

		$this->rest->setResponseData( array('success' => "$count removed" ) );
		$this->rest->sendResponse(200);	
		return null;
	}	
	
	public function put() {
	
	}	
}