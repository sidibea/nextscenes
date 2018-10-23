<?php  
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}

class ControllerResponsesBlocksProductSlider extends AController {
    public $data = array();

	public function main() {

        //init controller data
        $this->extensions->hk_InitData($this);
        $this->loadLanguage('blocks/product_slider');
        $this->view->batchAssign(  $this->language->getASet() );

        $this->load->model('catalog/product');
		$this->load->model('catalog/review');
		$this->load->model('tool/seo_url');
		$this->load->model('tool/image');

		$first = $this->request->get['first'];
        $last = $this->request->get['last'];

        $first = max(0, intval($first) - 1);
        $last  = max($first + 1, intval($last) - 1);

        switch ( $this->config->get('product_slider_type') ) {
            case 'bestsellers' :
                $results = $this->_getBestSellerProducts($first, $last - $first + 1 );
                break;
            case 'latest' :
                $results = $this->_getLatestProducts($first, $last - $first + 1 );
                break;
            case 'specials' :
                $results = $this->_getSpecialProducts($first, $last - $first + 1 );
                break;
            case 'featured' :
                $results = $this->_getFeaturedProducts($first, $last - $first + 1 );
                break;
            default :
                $results = $this->_getBestSellerProducts($first, $last - $first + 1 );
        }


        $this->data['first'] = $first;
        $this->data['num'] = $last - $first + 1;
        $this->data['total'] = $results['total'];
        $this->data['products'] = array();

		if ($this->config->get('config_customer_price')) {
			$display_price = TRUE;
		} elseif ($this->customer->isLogged()) {
			$display_price = TRUE;
		} else {
			$display_price = FALSE;
		}
		$this->view->assign('display_price', $display_price );

        $resource = new AResource('image');
		
		foreach($results['products'] as $result){
			$product_ids[] = $result['product_id'];
		}
		
		$products_info = $this->model_catalog_product->getProductsAllInfo($product_ids);

		foreach ($results['products'] as $result) {

            $thumbnail = $resource->getMainThumb('products',
			                                     $result['product_id'],
			                                     $this->config->get('config_image_product_width'),
			                                     $this->config->get('config_image_product_height'),true);
			
			$special = FALSE;

			$discount = $products_info[$result['product_id']]['discount'];

			if ($discount) {
				$price = $this->currency->format($this->tax->calculate($discount, $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				$special = $products_info[$result['product_id']]['special'];
				if ($special) {
					$special = $this->currency->format($this->tax->calculate($special, $result['tax_class_id'], $this->config->get('config_tax')));
				}						
			}

			$options = $this->model_catalog_product->getProductOptions($result['product_id']);
			if ($options) {
				$add = $this->html->getSEOURL('product/product', '&product_id=' . $result['product_id']);
			} else {
				$add = $this->html->getSecureURL('checkout/cart', '&product_id=' . $result['product_id']);
			}

			$item = array(
				'product_id'    => $result['product_id'],
				'title'    		=> $result['name'],
				'price'   		=> $price,
				'special'  		=> $special,
				'image'   		=> $thumbnail,
				'info_url'   	=> $this->html->getSEOURL('product/product', '&product_id=' . $result['product_id']),
				'buy_url'  		=> $add,
                'buy'           => false,
				'display_price' => $display_price,
			);

            $this->view->assign('item', $item);
            $this->data['products'][] = $this->view->fetch('blocks/product_template.tpl');
		}

		if (!$this->config->get('config_customer_price')) {
			$this->data['display_price'] = TRUE;
		} elseif ($this->customer->isLogged()) {
			$this->data['display_price'] = TRUE;
		} else {
			$this->data['display_price'] = FALSE;
		}

        //init controller data
        $this->extensions->hk_UpdateData($this);

        $this->load->library('json');
		$this->response->setOutput(AJson::encode($this->data));
		
	}

    private function _getLatestProducts($start, $limit) {

        $sql =  "SELECT *,
							pd.name AS name,
							m.name AS manufacturer,
							ss.name AS stock,
							(SELECT AVG(r.rating)
							FROM " . DB_PREFIX . "reviews r
							WHERE p.product_id = r.product_id
							GROUP BY r.product_id) AS rating 
							FROM " . DB_PREFIX . "products p
				LEFT JOIN " . DB_PREFIX . "product_descriptions pd ON (p.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('storefront_language_id') . "')
				LEFT JOIN " . DB_PREFIX . "products_to_stores p2s ON (p.product_id = p2s.product_id)
				LEFT JOIN " . DB_PREFIX . "manufacturers m ON (p.manufacturer_id = m.manufacturer_id)
				LEFT JOIN " . DB_PREFIX . "stock_statuses ss ON (p.stock_status_id = ss.stock_status_id AND ss.language_id = '" . (int)$this->config->get('storefront_language_id') . "')
							WHERE p.status = '1'
									AND p.date_available <= NOW()
									AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
							ORDER BY p.date_added DESC";

        $query = $this->db->query($sql);
        $total = $query->num_rows;
        $products = array();
        if ( $total ) {
            $query = $this->db->query($sql. " LIMIT " . (int)$start . ', ' . (int)$limit);
            $products = $query->rows;
        }

        return array(
            'total' => $total,
            'products' => $products,
        );
	}

    private function _getSpecialProducts($start, $limit) {
        $this->load->model('catalog/product');
		$promoton = new APromotion();
        $total = $promoton->getTotalProductSpecials();
        $products = array();
        if ( $total ) {
			$products = $promoton->getProductSpecials('p.sort_order', 'ASC', $start, $limit);
        }

        return array(
            'total' => $total,
            'products' => $products,
        );
    }

    private function _getFeaturedProducts($start, $limit) {
		$sql =
            "SELECT *
            FROM " . DB_PREFIX . "products_featured f
                LEFT JOIN " . DB_PREFIX . "products p ON (f.product_id=p.product_id)
                LEFT JOIN " . DB_PREFIX . "product_descriptions pd ON (f.product_id = pd.product_id)
                LEFT JOIN " . DB_PREFIX . "products_to_stores p2s ON (p.product_id = p2s.product_id)
            WHERE pd.language_id = '" . (int)$this->config->get('storefront_language_id') . "'
                AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ";

        $query = $this->db->query($sql);
        $total = $query->num_rows;

        $products = array();
        if ( $total ) {
            $query = $this->db->query($sql. " LIMIT " . (int)$start . ', ' . (int)$limit);
            $products = $query->rows;
        }

        return array(
            'total' => $total,
            'products' => $products,
        );
	}

    private function _getBestSellerProducts($start, $limit) {

        $sql = "SELECT op.product_id, SUM(op.quantity) AS total
                    FROM " . DB_PREFIX . "order_products op
                    LEFT JOIN `" . DB_PREFIX . "orders` o ON (op.order_id = o.order_id)
                    RIGHT JOIN " . DB_PREFIX . "products_to_stores p2s ON (op.product_id = p2s.product_id)
                    WHERE o.order_status_id > '0'
                    GROUP BY op.product_id
                    ORDER BY total DESC";
        $query = $this->db->query($sql);
        $total = $query->num_rows;

        $products = array();
        if ( $total ) {
            $query = $this->db->query($sql. " LIMIT " . (int)$start . ', ' . (int)$limit);
            $product_id = array();
            foreach ($query->rows as $result) {
                $product_id[] = $result['product_id'];
            }
            $query = $this->db->query(
                "SELECT *
                FROM " . DB_PREFIX . "products p
                    LEFT JOIN " . DB_PREFIX . "product_descriptions pd ON (p.product_id = pd.product_id)
                    LEFT JOIN " . DB_PREFIX . "products_to_stores p2s ON (p.product_id = p2s.product_id)
                WHERE p.product_id IN (" . implode(',', $product_id) . ")
                    AND p.status = '1' AND p.date_available <= NOW()
                    AND pd.language_id = '" . (int)$this->config->get('storefront_language_id') . "'
                    AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");
            $products = $query->rows;
        }

        return array(
            'total' => $total,
            'products' => $products,
        );
	}

}
?>