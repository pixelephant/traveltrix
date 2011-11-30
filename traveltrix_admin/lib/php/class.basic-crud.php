<?php 

class crud extends db{

	protected $_upload_directory;
	protected $_provider_profile_directory;
	protected $_provider_profile_thumbnail_directory;
	
	protected $_services_directory;
	protected $_services_thumbnail_directory;
	
	protected $_siteUrl;
	protected $_system_path;
	
	protected $_table_prefix = "traveltrix_";
	
	public function __construct($debug=false){
		
		parent::__construct('','','','','',$debug);
		
		$this->_siteUrl = 'projects/on-going/traveltrix-git/traveltrix_admin/';
		
		$this->_system_path = '/home/pixeleph/public_html/' . $this->_siteUrl;
		
		$this->_upload_directory = $this->_system_path . 'uploads/';
		$this->_provider_profile_directory = $this->_upload_directory . 'provider_profile/';
		$this->_provider_profile_thumbnail_directory = $this->_upload_directory . 'provider_profile_thumbnail/';
		
		$this->_services_directory = $this->_upload_directory . 'services/';
		$this->_services_thumbnail_directory = $this->_upload_directory . 'services_thumbnail/';
		
	}

	//GET
	
	public function get_provider($cond=''){

		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
		
		$table = $this->_table_prefix . 'providers';
		$col = 'id,password,name,description,email,phone,address,website,is_guide,referal_id,photo,updated_at';
		
		return $this->sql_select($table,$col,$cond);
		
	}
	
	protected function get_categories($cond=''){
		
		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
	
		$table = $this->_table_prefix . 'categories';
		$col = 'id,category_name';
		
		return $this->sql_select($table,$col,$cond);
		
	}
	
	public function get_services($cond=''){
	
		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
	
		$table = $this->_table_prefix . 'services';
		$col = 'id,service_name,short_description,long_description,category_id,duration,price,provider_id,is_tour,updated_at';
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	public function get_service_photos($service_id){
	
		$table = $this->_table_prefix . 'service_photos';
		$col = 'service_id,photo';
		
		$cond['service_id'] = (int)$service_id;
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	public function get_guides_tour($tour_id='',$guide_id=''){
	
		if($tour_id == '' && $guide_id == ''){
			return FALSE;
		}
	
		$table = $this->_table_prefix . 'guide_to_tour';
		$col = 'id,guide_id,service_id';
		
		if($tour_id != ''){
			$cond['service_id'] = (int)$tour_id;
		}
		
		if($guide_id != ''){
			$cond['guide_id'] = (int)$guide_id;
		}
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	//RENDER
	
	
	
	//ADDITIONAL
	
	protected function category_name_by_id($id){
	
		$cond['id'] = $id;
		$category = $this->get_categories($cond);
	
		return $category[0]['category_name'];
	}

	protected function provider_name_by_id($id){
	
		$cond['id'] = $id;
		$provider = $this->get_provider($cond);
	
		return $provider[0]['name'];
		
	}
	
	public function isAjax(){
   		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
	
}

?>