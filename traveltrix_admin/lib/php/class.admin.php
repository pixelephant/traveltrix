<?php 

class admin extends db{
	
	protected $_upload_directory;
	protected $_provider_profile_directory;
	protected $_provider_profile_thumbnail_directory;
	
	protected $_services_directory;
	protected $_services_thumbnail_directory;
	
	protected $_siteUrl;

	protected $_system_path;
	
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
	
	//SELECT
	
	public function get_provider($cond=''){

		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
		
		$table = 'providers';
		$col = 'id,password,name,description,email,phone,address,website,is_guide,referal_id,photo,updated_at';
		
		return $this->sql_select($table,$col,$cond);
		
	}
	
	protected function get_categories($cond=''){
		
		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
	
		$table = 'categories';
		$col = 'id,category_name';
		
		return $this->sql_select($table,$col,$cond);
		
	}
	
	public function get_services($cond=''){
	
		if($cond != ''){
			$cond = GUMP::sanitize($cond);
		}
	
		$table = 'services';
		$col = 'id,service_name,short_description,long_description,category_id,duration,price,provider_id,is_tour,updated_at';
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	public function get_service_photos($service_id){
	
		$table = 'service_photos';
		$col = 'service_id,photo';
		
		$cond['service_id'] = (int)$service_id;
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	public function get_guides_tour($tour_id='',$guide_id=''){
	
		if($tour_id == '' && $guide_id == ''){
			return FALSE;
		}
	
		$table = 'guide_to_tour';
		$col = 'id,guide_id,service_id';
		
		if($tour_id != ''){
			$cond['service_id'] = (int)$tour_id;
		}
		
		if($guide_id != ''){
			$cond['guide_id'] = (int)$guide_id;
		}
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	//INSERT
	
	public function insert_provider($params){
		
		if(!is_array($params)){
			return FALSE;
		}
	
		$params = GUMP::sanitize($params);
		
		$filters = array(
			'password'    => 'trim|sanitize_string',
			'name'       => 'trim|sanitize_string',
			'description'       => 'trim|sanitize_string',
			'email'    	  => 'trim|sanitize_email',
			'phone'       => 'trim|sanitize_numbers_only',
			'address'       => 'trim|sanitize_string',
			'website'       => 'trim|sanitize_string',
			'is_guide'       => 'trim|sanitize_numbers_only',
			'referal_id'       => 'trim|sanitize_numbers_only',
			'photo'       => 'trim|sanitize_string'
		);
		
		$rules = array(
			'password'    => 'required|alpha_numeric',
			'name'       => 'required|alpha_dash',
			'email'       => 'required|valid_email',
			'phone'       => 'numeric',
			'address'       => 'alpha_dash',
			'website'       => 'alpha_dash,valid_url',
			'is_guide'       => 'numeric',
			'referal_id'       => 'required|numeric',
			'photo'       => 'valid_email'
		);
		
		$params = GUMP::filter($params, $filters);

		$validate = GUMP::validate($params, $rules);
		
		//Validálás vége
		
		if($validate === TRUE){
			return $this->sql_insert('providers',$params);
		}else{
			print_r($validate);
		}
	}

	public function invite_provider($name,$email,$password,$is_guide){
	
		$params['name'] = $name;
		$params['email'] = $email;
		$params['password'] = $password;
		$params['is_guide'] = $is_guide;
		$params['referal_id'] = $_SESSION['provider_id'];
	
		return $this->insert_provider($params);
	
	}
	
	public function insert_service($params){
		
		if(!is_array($params)){
			return FALSE;
		}
	
		$params = GUMP::sanitize($params);		
		
		$filters = array(
			'service_name'    => 'trim|sanitize_string',
			'short_description'       => 'trim|sanitize_string',
			'long_description'       => 'trim|sanitize_string',
			'category_id'    	  => 'trim|sanitize_numbers_only',
			'duration'       => 'trim|sanitize_numbers_only',
			'price'       => 'trim|sanitize_numbers_only',
			'is_tour'       => 'trim|sanitize_numbers_only',
			'provider_id'       => 'trim|sanitize_numbers_only'
		);
		
		$rules = array(
			'service_name'    => 'required',
			'short_description'       => 'required',
			'long_description'       => 'required',
			'category_id'    	  => 'required|numeric',
			'duration'       => 'required|numeric',
			'price'       => 'required|numeric',
			'is_tour'       => 'required|numeric',
			'provider_id'       => 'required|numeric'
		);
		
		$params = GUMP::filter($params, $filters);

		$validate = GUMP::validate($params, $rules);
		
		//Validálás vége
		
		if($validate === TRUE){
			return $this->sql_insert('services',$params);
		}else{
			print_r($validate);
		}
	}
	
	public function insert_service_photo($service_id,$photo){
	
		$params['service_id'] = (int)$service_id;
		$params['photo'] = $photo;
	
		$params = GUMP::sanitize($params);
		
		return $this->sql_insert('service_photos',$params);
	}
	
	public function insert_guide_to_tour($guide_id,$tour_id){
	
		$params['guide_id'] = (int)$guide_id;
		$params['service_id'] = (int)$tour_id;
	
		$params = GUMP::sanitize($params);
		
		$filters = array(
			'guide_id'       => 'trim|sanitize_numbers_only',
			'service_id'       => 'trim|sanitize_numbers_only'
		);
		
		$rules = array(
			'guide_id'       => 'required|numeric',
			'service_id'       => 'required|numeric'
		);
		
		$params = GUMP::filter($params, $filters);

		$validate = GUMP::validate($params, $rules);
		
		//Validálás vége
		
		if($validate === TRUE){
			return $this->sql_insert('guide_to_tour',$params);
		}else{
			print_r($validate);
		}
	
	}
	
	//UPDATE
	
	public function update_provider($data_array,$cond=''){

		$cond = GUMP::sanitize($cond);
		$data_array = GUMP::sanitize($data_array);		
		
		$filters = array(
			'password'    => 'trim|sanitize_string',
			'name'       => 'trim|sanitize_string',
			'description'       => 'trim|sanitize_string',
			'email'    	  => 'trim|sanitize_email',
			'phone'       => 'trim|sanitize_numbers_only',
			'address'       => 'trim|sanitize_string',
			'website'       => 'trim|sanitize_string',
			'is_guide'       => 'trim|sanitize_numbers_only',
			'referal_id'       => 'trim|sanitize_numbers_only',
			'photo'       => 'trim|sanitize_string'
		);
		
		$rules = array(
			'password'    => 'alpha_numeric',
			'name'       => 'alpha_dash',
			'email'       => 'valid_email',
			'phone'       => 'numeric',
			'address'       => 'alpha_dash',
			'website'       => 'valid_url',
			'is_guide'       => 'numeric',
			'referal_id'       => 'numeric',
		);
		
		
		$data_array = GUMP::filter($data_array, $filters);
		$cond = GUMP::filter($cond, $filters);

		$validate = GUMP::validate($data_array, $rules);
		$validate2 = GUMP::validate($cond, $rules);
		
		//Validálás vége
		
		if($validate === TRUE && $validate2 === TRUE){
			return $this->sql_update('providers',$data_array,$cond);
		}else{
			print_r($validate);
			print_r($validate2);
		}
			
	}
	
	public function update_service($data_array,$cond=''){
		
		if(!is_array($data_array)){
			return FALSE;
		}
	
		$cond = GUMP::sanitize($cond);
		$data_array = GUMP::sanitize($data_array);	
		
		$filters = array(
			'service_name'    => 'trim|sanitize_string',
			'short_description'       => 'trim|sanitize_string',
			'long_description'       => 'trim|sanitize_string',
			'category_id'    	  => 'trim|sanitize_numbers_only',
			'duration'       => 'trim|sanitize_numbers_only',
			'price'       => 'trim|sanitize_numbers_only',
			'is_tour'       => 'trim|sanitize_numbers_only',
			'provider_id'       => 'trim|sanitize_numbers_only'
		);
		
		$rules = array(
			'category_id'    	  => 'numeric',
			'duration'       => 'numeric',
			'price'       => 'numeric',
			'is_tour'       => 'numeric',
			'provider_id'       => 'numeric'
		);
		
		$data_array = GUMP::filter($data_array, $filters);
		$cond = GUMP::filter($cond, $filters);

		$validate = GUMP::validate($data_array, $rules);
		$validate2 = GUMP::validate($cond, $rules);
		
		//Validálás vége
		
		if($validate === TRUE && $validate2 === TRUE){
			return $this->sql_update('services',$data_array,$cond);
		}else{
			print_r($validate);
			print_r($validate2);
		}
	}
	
	public function update_service_by_id($data_array,$id){
	
		if(!is_providers_service($id,$_SESSION['provider_id'])){
			return FALSE;
		}
	
		$cond['id'] = $id;
		return $this->update_service($data_array,$cond);
	
	}
	
	//DELETE
	
	public function delete_provider($cond=''){
	
		if(!is_array($cond)){
			return FALSE;
		}
		
		$cond = GUMP::sanitize($cond);
		
		$filters = array(
			'password'    => 'trim|sanitize_string',
			'name'       => 'trim|sanitize_string',
			'description'       => 'trim|sanitize_string',
			'email'    	  => 'trim|sanitize_email',
			'phone'       => 'trim|sanitize_numbers_only',
			'address'       => 'trim|sanitize_string',
			'website'       => 'trim|sanitize_string',
			'is_guide'       => 'trim|sanitize_numbers_only',
			'referal_id'       => 'trim|sanitize_numbers_only',
			'photo'       => 'trim|sanitize_string'
		);
		
		$rules = array(
			'password'    => 'alpha_numeric',
			'name'       => 'alpha_dash',
			'email'       => 'valid_email',
			'phone'       => 'numeric',
			'address'       => 'alpha_dash',
			'website'       => 'alpha_dash,valid_url',
			'is_guide'       => 'numeric',
			'referal_id'       => 'numeric',
			'photo'       => 'valid_email'
		);
		
		$cond = GUMP::filter($cond, $filters);

		$validate = GUMP::validate($cond, $rules);
		
		//Validálás vége
		
		if($validate === TRUE){
			return $this->sql_delete('providers',$cond);
		}else{
			print_r($validate);
		}	
		
	}	

	public function delete_provider_photo($provider_id){
	
		$data['photo'] = '';
		$cond['id'] = (int)$provider_id;
		
		return $this->update_provider($data,$cond);
	
	}

	public function delete_service($service_id){
	
		$cond['provider_id'] = (int)$_SESSION['provider_id'];
		$cond['id'] = (int)$service_id;
	
		if($this->sql_delete('services',$cond)){
			return $this->delete_all_service_photos($service_id);
		}else{
			return FALSE;
		}
	
	}
	
	public function delete_service_photo($photo,$service_id){
	
		if($photo == '' || $service_id == ''){
			return FALSE;
		}
	
		$cond['photo'] = $photo;
		$cond['service_id'] = (int)$service_id;
	
		return $this->sql_delete('service_photos',$cond) && $this->delete_service_photo_files($photo);
	
	}

	protected function delete_all_service_photos($service_id){
	
		$cond['service_id'] = (int)$service_id;
		
		$p = $this->get_service_photos($service_id);
		$photos = array();
		
		for($i = 0; $i < $p['count']; $i++){
			$photos[] = $p[$i]['photo'];
		}
		
		return $this->sql_delete('service_photos',$cond) && $this->delete_service_photo_files($photos);
	
	}
	
	public function delete_guide_to_tour($guide_id,$tour_id){
	
		$cond['guide_id'] = (int)$guide_id;
		$cond['service_id'] = (int)$tour_id;
	
		return $this->sql_delete('guide_to_tour',$cond);
	
	}
	
	protected function delete_service_photo_files($photos){
		
		if(is_array($photos)){
			foreach($photos as $photo){
				if(!unlink($this->_services_directory . $photo) || !unlink($this->_services_thumbnail_directory . $photo)){
					return FALSE;
				}
			}
		}else{
			return unlink($this->_services_directory . $photos) && unlink($this->_services_thumbnail_directory . $photos);
		}
	
	}
	
	//RENDER
	
	public function render_categories_option($selected_value='',$return=FALSE){
	
		$categories = $this->get_categories();
		
		$html = '';
		
		for($i = 0; $i < $categories['count']; $i++){
		
			$html .= '<option value="' . $categories[$i]['id'] . '"';
			if($selected_value == $categories[$i]['id']){
				$html .= ' selected="selected"';
			}
			$html .= '>' . $categories[$i]['category_name'] . '</option>';
			
		}
		
		if($return){
			return $html;
		}else{
			echo $html;
		}
	}
	
	public function render_duration_option($selected_value='',$return=FALSE){
		
		$html = '';
		
		for($i = 30; $i <= 600; $i += 30){
			
			$html .= '<option value="' . $i . '"'; 
			if($selected_value == $i){
				$html .= ' selected="selected"';
			}
			$html .= '>' . $i / 60 . ' óra</option>';
		}
		
		if($return){
			return $html;
		}else{
			echo $html;
		}
	}

	public function render_services($cond=''){
	
		$services = $this->get_services($cond);
		
		$html = '';
		
		for($i = 0;$i < $services['count']; $i++){
			$html .= '<div class="service">';
			$html .= '<div class="formrow">' . $services[$i]['service_name'] . '</div>';
			$html .= '<div class="formrow">' . $services[$i]['short_description'] . '</div>';
			$html .= '<div class="formrow">' . $services[$i]['long_description'] . '</div>';
			$html .= '<div class="formrow">' . $this->category_name_by_id($services[$i]['category_id']) . '</div>';
			$html .= '<div class="formrow">' . ($services[$i]['duration'] / 60) . ' óra</div>';
			$html .= '<div class="formrow">' . $this->provider_name_by_id($services[$i]['provider_id']) . '</div>';
			$html .= '<div class="formrow">' . $services[$i]['price'] . ' / fő</div>';
			
			$photos = $this->render_service_photos($services[$i]['id'],TRUE);
			
			if($photos != ''){
				$html .= '<div class="formrow">' . $photos . '</div>';
			}
			
			if($_SESSION['is_guide'] == 1 && $services[$i]['is_tour'] == 1 && $services[$i]['provider_id'] != $_SESSION['provider_id']){
				if($this->guiding_tour($services[$i]['id'])){
					$html .= '<div class="formrow"><a href="lib/php/guide_tour.php?action=drop&service_id=' . $services[$i]['id'] . '">Inkább nem vinném</a></div>';
				}else{
					$html .= '<div class="formrow"><a href="lib/php/guide_tour.php?action=add&service_id=' . $services[$i]['id'] . '">ÉnIsÉnIs</a></div>';
				}
			}
			
			if($services[$i]['provider_id'] == $_SESSION['provider_id']){
				$html .= '<div class="formrow"><a href="editservice?service_id=' . $services[$i]['id'] . '">Edit</a></div>';
			}
		}
		
		echo $html;
	
	}
	
	public function render_my_services(){
	
		$cond['provider_id'] = $_SESSION['provider_id'];
		return $this->render_services($cond);
	
	}
	
	public function render_all_services(){
	
		return $this->render_services();
	
	}
	
	public function render_service_photos($service_id,$return=FALSE){
	
		$photos = $this->get_service_photos($service_id);
		$html = '';
		
		for($i=0;$i<$photos['count'];$i++){
		
			$html .= '<img src="uploads/services_thumbnail/' . $photos[$i]['photo'] . '" />';
		
		}
		
		if($return){
			return $html;
		}else{
			echo $html;
		}
	
	}
	
	public function render_edit_provider_form(){
	
		$cond['id'] = $_SESSION['provider_id'];
		$provider = $this->get_provider($cond);
		
		$html = '';
	
		$html .= '<input type="hidden" name="action" id="action" value="edit_provider" />';
		$html .= '<div class="formrow">';
		$html .= '<label for="name">Name</label><input type="text" id="name" name="name" value="' . $provider[0]['name'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="description">Description</label><textarea id="description" name="description">' . $provider[0]['description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="email">E-mail</label><input type="text" id="email" name="email" value="' . $provider[0]['email'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="phone">Phone</label><input type="text" id="phone" name="phone" value="' . $provider[0]['phone'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="address">Address</label><input type="text" id="address" name="address" value="' . $provider[0]['address'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="website">Website</label><input type="text" id="website" name="website" value="' . $provider[0]['website'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="old_password">Old password</label><input type="text" id="old_password" name="old_password" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="password">New password</label><input type="text" id="password" name="password" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="password_retype">Confirm new password</label><input type="text" id="password_retype" name="password_retype" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="photo">Photo</label><input type="file" id="photo" name="photo" />';
		$html .= '</div>';
		
		if($provider[0]['photo'] != '' && is_file($this->_provider_profile_thumbnail_directory . $provider[0]['photo'])){
		
			$html .= '<div class="formrow">';
			$html .= '<img src="' . $this->_provider_profile_thumbnail_directory . $provider[0]['photo'] . '" />';
			$html .= '</div>';
		
		}
		
		echo $html;
	
	}

	public function render_edit_service_form($service_id){
	
		$cond['id'] = $service_id;
		$service = $this->get_services($cond);
	
		if($service[0]['provider_id'] != $_SESSION['provider_id']){
			echo 'Nem jogosult';
			return FALSE;
		}
		
		$html = '';
		
		$html .= '<form action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="edit_service" />';
		$html .= '<input type="hidden" name="id" id="id" value="' . $service[0]['id'] . '" />';
		$html .= '<div class="formrow">';
		$html .= '<label for="service_name">Name</label><input type="text" value="' . $service[0]['service_name'] . '" id="service_name" name="service_name"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="short_description">Short description</label><textarea id="short_description" name="short_description">' . $service[0]['short_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="long_description">Long description</label><textarea id="long_description" name="long_description">' . $service[0]['long_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="category_id">Category</label><select id="category_id" name="category_id">' . $this->render_categories_option($service[0]['category_id'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="duration">Duration</label><select id="duration" name="duration">' . $this->render_duration_option($service[0]['duration'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<label for="price">Price</label><input type="text" value="' . $service[0]['price'] . '" id="price" name="price"/> / person<span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<input type="submit" class="btn primary" value="Submit" />';
		$html .= '</div>';
		$html .= '</form>';

		$html .= '<form action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="delete_service" />';
		$html .= '<input type="hidden" name="service_id" id="service_id" value="' . $service[0]['id'] . '" />';
		$html .= '<div class="formrow">';
		$html .= '<input type="submit" class="btn primary" value="Delete" />';
		$html .= '</div>';
		$html .= '</form>';
		
		$html .= $this->render_service_photos($service[0]['id'],TRUE);
		
		echo $html;
	
	}

	public function render_service_photo_form($service_id){
	
		$html = '';
	
		$html .= '<form enctype="multipart/form-data" action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="add_service_photo" />';
		$html .= '<input type="hidden" name="service_id" id="service_id" value="' . $service_id . '" />';
		$html .= '<div class="formrow">';
		$html .= '<label for="photo">Fotó</label><input type="file" id="photo" name="photo" />';
		$html .= '</div>';
		$html .= '<div class="formrow">';
		$html .= '<input type="submit" class="btn primary" value="Upload image"/>';
		$html .= '</div>';
		$html .= '</form>';
		
		echo $html;
	
	}
	
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

	protected function is_providers_service($service_id,$provider_id){
	
		$cond['id'] = $service_id;
		$cond['provider_id'] = $provider_id;
		$service = $this->get_services($cond);
		
		if($service['count'] == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	
	}

	protected function guiding_tour($tour_id){
	
		$tour_id = (int)$tour_id;
		
		$guiding = $this->get_guides_tour($tour_id,$_SESSION['provider_id']);
		
		if($guiding['count'] == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	
	}
	
	public function isAjax(){
   		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
	
	public function randomString($length){

	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $string = '';    
	    for ($p = 0; $p < $length; $p++) {
	        $string .= $characters[mt_rand(0, strlen($characters))];
	    }
	    return $string;
	}
	
}

?>