<?php

//Last update: 19 Sept 2015

class Fb_ypbox_images extends Fb_ypbox
{
	
	function get_galleries($criteria=array()) {
		$user_id = $criteria['user_id'];
		$token = $criteria['token'];
		$limit = $criteria['limit'];
		
		if($limit=='') $limit = 100;
		if($user_id=='') $user_id = 'me';
		
		$fields = 'id,name,link,from,cover_photo,privacy,count,created_time,can_upload';
		
		$results = parent::get_fb_api_results(array('connection'=>'albums?fields='.$fields, 'object'=>$user_id, 'token'=>$token, 'limit'=>$limit));
		
		return $results;
	}
	
	function get_gallery_images($criteria=array()) {
		$gallery_id = $criteria['gallery_id'];
		$token = $criteria['token'];
		$limit = $criteria['limit'];
		$url = $criteria['url'];
		
		$fields = 'id,name,from,picture,source,height,width,images,likes,comments,link,icon,created_time';
		
		if($url!='') {
			$result = parent::getDataFromUrl($url);
		}
		else if($gallery_id!='') {
			$results = parent::get_fb_api_results(array('connection'=>'photos?fields='.$fields, 'object'=>$gallery_id, 'token'=>$token, 'limit'=>$limit));
		}
		
		return $results;
	}
}

?>