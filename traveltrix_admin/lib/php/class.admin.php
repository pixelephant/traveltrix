<?php 

class admin extends db{
	
	public function __construct($debug=false){
		parent::__construct('','','','','',$debug);
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
		
		$data = GUMP::filter($data, $filters);

		$validate = GUMP::validate($data, $rules);
		
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
		
		$adatok = GUMP::filter($adatok, $filters);

		$validate = GUMP::validate($adatok, $rules);
		
		//Validálás vége
		
		if($validate === TRUE){
			return $this->sql_update('services',$data_array,$cond);
		}else{
			print_r($validate);
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
	
		return $this->sql_delete('services',$cond);
	
	}
	
	public function delete_service_photo($photo,$service_id){
	
		$cond['photo'] = $photo;
		$cond['service_id'] = (int)$service_id;
	
		return $this->sql_delete('service_photos',$cond);
	
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
			$html .= '<div class"service">';
			$html .= '<div class="row">' . $services[$i]['service_name'] . '</div>';
			$html .= '<div class="row">' . $services[$i]['short_description'] . '</div>';
			$html .= '<div class="row">' . $services[$i]['long_description'] . '</div>';
			$html .= '<div class="row">' . $this->category_name_by_id($services[$i]['category_id']) . '</div>';
			$html .= '<div class="row">' . ($services[$i]['duration'] / 60) . ' óra</div>';
			$html .= '<div class="row">' . $this->provider_name_by_id($services[$i]['provider_id']) . '</div>';
			
			$photos = $this->render_service_photos($services[$i]['id'],TRUE);
			
			if($photos != ''){
				$html .= '<div class="row">' . $photos . '</div>';
			}
			
			if($services[$i]['provider_id'] == $_SESSION['provider_id']){
				$html .= '<div class="row"><a href="edit_service.php?service_id=' . $services[$i]['id'] . '">Edit</a></div>';
			}
			
			$html .= '<br /><br />';
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
		$html .= '<div class="row">';
		$html .= '<label for="name">Név</label><input type="text" id="name" name="name" value="' . $provider[0]['name'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="description">Leírás</label><textarea id="description" name="description">' . $provider[0]['description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="email">E-mail</label><input type="text" id="email" name="email" value="' . $provider[0]['email'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="phone">Telefon</label><input type="text" id="phone" name="phone" value="' . $provider[0]['phone'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="address">Cím</label><input type="text" id="address" name="address" value="' . $provider[0]['address'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="website">Weboldal</label><input type="text" id="website" name="website" value="' . $provider[0]['website'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="old_password">Régi jelszó</label><input type="text" id="old_password" name="old_password" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="password">Új jelszó</label><input type="text" id="password" name="password" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="password_retype">Új jelszó újra</label><input type="text" id="password_retype" name="password_retype" /><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="photo">Fotó</label><input type="file" id="photo" name="photo" />';
		$html .= '</div>';
		
		if($provider[0]['photo'] != '' && is_file('uploads/provider_profile_thumbnail/' . $provider[0]['photo'])){
		
			$html .= '<div class="row">';
			$html .= '<img src="uploads/provider_profile_thumbnail/' . $provider[0]['photo'] . '" />';
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
		$html .= '<div class="row">';
		$html .= '<label for="servicename">Név</label><input type="text" value="' . $service[0]['servicename'] . '" id="servicename" name="servicename"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="short_description">Rövid leírás</label><textarea id="short_description" name="short_description">' . $service[0]['short_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="long_description">Hosszú leírás</label><textarea id="long_description" name="long_description">' . $service[0]['long_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="category_id">Kategória</label><select id="category_id" name="category_id">' . $this->render_categories_option($service[0]['category_id'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="duration">Hossza</label><select id="duration" name="duration">' . $this->render_duration_option($service[0]['duration'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<input type="submit" value="Elküld" />';
		$html .= '</div>';
		$html .= '</form>';

		$html .= '<form action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="delete_service" />';
		$html .= '<input type="hidden" name="service_id" id="service_id" value="' . $service[0]['id'] . '" />';
		$html .= '<div class="row">';
		$html .= '<input type="submit" value="Töröl" />';
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
		$html .= '<div class="row">';
		$html .= '<label for="photo">Fotó</label><input type="file" id="photo" name="photo" />';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<input type="submit" value="Upload image"/>';
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