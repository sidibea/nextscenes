<?php
/*------------------------------------------------------------------------------
  $Id$

  Abante Cart, E-commerce Solution Done Right
  http://www.AbanteCart.com

  Copyright (c) 2010 Digital Integrated Solution Group, Inc

  Released under the GNU General Public License
  Lincence details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.gnu.org/licenses/>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade Abante Cart to newer
   versions in the future. If you wish to customize Abante Cart for your
   needs please refer to http://www.abantecommerce.com for more information.
------------------------------------------------------------------------------*/
if (! defined ( 'DIR_CORE' )) {
	header ( 'Location: static_pages/' );
}
class ModelSlideshow2Slideshow2 extends Model {

    protected $model_tool_image;
    protected $slide;
    protected $rm;
	protected $slideshow;

    public function __construct($registry) {
        parent::__construct($registry);
        $this->model_tool_image = $this->registry->get('model_tool_image');
	    $this->slide = array(
		    'x' => $this->registry->get('config')->get('slideshow2_x'),
		    'y' => $this->registry->get('config')->get('slideshow2_y'),
			'speed' => $this->registry->get('config')->get('slideshow2_speed'),
		    'timeout' => $this->registry->get('config')->get('slideshow2_timeout'),
	    );
        $this->rm = new AResource('image');
		$this->slideshow = new ADataset('slideshow', 'slideshow2');
	}

    public function getSlides() {
		$result = array();
		$rows = $this->slideshow->getRows();
		
		foreach($rows as $k => $row){
			$result[$k] = $row;
			$result[$k]['thumbnail_url'] = $this->rm->getResourceThumb(
                $row['slide_resource_id'],
                150,
                150,
                $language_id
            );
		}

		return $result;
    }

    public function addSlide($data) {
		$rm = new AResourceManager();
        $rm->setType('image');
        $id = $rm->getIdFromHexPath(str_replace($rm->getTypeDir(), '', $data['slide_image']));
		
		$this->slideshow->addRows(array(
						array(
							'slide_title' => $data['slide_title'], 
							'slide_url' => $data['slide_url'], 
							'slide_image' => $data['slide_image'], 
							'slide_resource_id' => $id
							)
					));
    }

    public function editSlide($slide_id, $data) {
		$rm = new AResourceManager();
        $rm->setType('image');
        $id = $rm->getIdFromHexPath(str_replace($rm->getTypeDir(), '', $data['slide_image']));
		
		$slide = array(
					'slide_title' => $data['slide_title'], 
					'slide_url' => $data['slide_url'], 
					'slide_image' => $data['slide_image'], 
					'slide_resource_id' => $id
				);
		
		//$resource = array('name' => '', 'resource_path' => $data['slide_image']);
		//$rm->updateResource($slide_id, $resource);
		
		$rows = $this->slideshow->updateRows(array('column_name' => 'slide_resource_id',  'operator' => '=',  'value' => $slide_id), $slide);
    }

    public function getSlide($slide_id) {
		$row = $this->slideshow->searchRows(array('column_name' => 'slide_resource_id',  'operator' => '=',  'value' => $slide_id));
		return $row[0];
    }

    public function deleteSlide($slide_id) {
		$this->slideshow->deleteRows(array('column_name' => 'slide_resource_id',  'operator' => '=',  'value' => $slide_id));
    }

}