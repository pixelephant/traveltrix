<?php 

class admin extends db{
	
	public function __construct($debug=false){
		parent::__construct('','','','','',$debug);
	}
	
	//SELECT
	
	public function get_guide($cond=''){
		
		$table = 'guides';
		$col = 'id,password,name,description,email,phone,referal_id,photo,updated_at';
			
		return $this->sql_select($table,$col,$cond);
		
	}
	
	protected function get_categories($cond=''){
		
		$table = 'categories';
		$col = 'id,category_name';
		
		return $this->sql_select($table,$col,$cond);
		
	}
	
	public function get_tours($cond=''){
	
		$table = 'tours';
		$col = 'id,tourname,short_description,long_description,category_id,duration,guide_id,updated_at';
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	public function get_tour_photos($tour_id){
	
		$table = 'tour_photos';
		$col = 'tour_id,photo';
		
		$cond['tour_id'] = $tour_id;
		
		return $this->sql_select($table,$col,$cond);
	
	}
	
	//INSERT
	
	public function insert_guide($params){
		
		if(!is_array($params)){
			return FALSE;
		}
	
		//Validálás vége
		
		if($this->sql_insert('guides',$params)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}
	}

	public function invite_guide($name,$email,$password){
	
		$params['name'] = $name;
		$params['email'] = $email;
		$params['password'] = $password;
	
		return $this->insert_guide($params);
	
	}
	
	public function insert_tour($params){
		
		if(!is_array($params)){
			return FALSE;
		}
	
		//Validálás vége
		
		if($this->sql_insert('tours',$params)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}
	}
	
	public function insert_tour_photo($tour_id,$photo){
	
		$params['tour_id'] = $tour_id;
		$params['photo'] = $photo;
	
		if($this->sql_insert('tour_photos',$params)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}
	
	}
	
	//UPDATE
	
	public function update_guide($adat_array,$cond=''){

		if($this->sql_update('guides',$adat_array,$cond)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}
	}
	
	public function update_tour($adat_array,$cond=''){

		if($this->sql_update('tours',$adat_array,$cond)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}
	}
	
	public function update_tour_by_id($data_array,$id){
	
		if(!is_guides_tour($id,$_SESSION['guide_id'])){
			return FALSE;
		}
	
		$cond['id'] = $id;
		return $this->update_tour($data_array,$cond);
	
	}
	
	//DELETE
	
	public function delete_guide($cond=''){
	
		if(!is_array($cond) && $cond != ''){
			return FALSE;
		}
		
		if($this->sql_delete('guides',$cond)){
			return 'Sikeres';
		}else{
			return 'Sikertelen';
		}	
		
	}	

	public function delete_guide_photo($guide_id){
	
		$data['photo'] = '';
		$cond['id'] = $guide_id;
		
		return $this->update_guide($data,$cond);
	
	}

	public function delete_tour($tour_id){
	
		$cond['guide_id'] = $_SESSION['guide_id'];
		$cond['id'] = $tour_id;
	
		if($this->sql_delete('tours',$cond)){
			return TRUE;
		}else{
			return 'Sikertelen';
		}
	
	}
	
	public function delete_tour_photo($photo,$tour_id){
	
		$cond['photo'] = $photo;
		$cond['tour_id'] = $tour_id;
	
		if($this->sql_delete('tour_photos',$cond)){
			return TRUE;
		}else{
			return 'Sikertelen';
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

	public function render_tours($cond=''){
	
		$tours = $this->get_tours($cond);
		
		$html = '';
		
		for($i = 0;$i < $tours['count']; $i++){
			$html .= '<div class"tour">';
			$html .= '<div class="row">' . $tours[$i]['tourname'] . '</div>';
			$html .= '<div class="row">' . $tours[$i]['short_description'] . '</div>';
			$html .= '<div class="row">' . $tours[$i]['long_description'] . '</div>';
			$html .= '<div class="row">' . $this->category_name_by_id($tours[$i]['category_id']) . '</div>';
			$html .= '<div class="row">' . ($tours[$i]['duration'] / 60) . ' óra</div>';
			$html .= '<div class="row">' . $this->guide_name_by_id($tours[$i]['guide_id']) . '</div>';
			
			$photos = $this->render_tour_photos($tours[$i]['id'],TRUE);
			
			if($photos != ''){
				$html .= '<div class="row">' . $photos . '</div>';
			}
			
			if($tours[$i]['guide_id'] == $_SESSION['guide_id']){
				$html .= '<div class="row"><a href="edit_tour.php?tour_id=' . $tours[$i]['id'] . '">Edit</a></div>';
			}
			
			$html .= '<br /><br />';
		}
		
		echo $html;
	
	}
	
	public function render_my_tours(){
	
		$cond['guide_id'] = $_SESSION['guide_id'];
		return $this->render_tours($cond);
	
	}
	
	public function render_all_tours(){
	
		return $this->render_tours();
	
	}
	
	public function render_tour_photos($tour_id,$return=FALSE){
	
		$photos = $this->get_tour_photos($tour_id);
		$html = '';
		
		for($i=0;$i<$photos['count'];$i++){
		
			$html .= '<img src="uploads/tours_thumbnail/' . $photos[$i]['photo'] . '" />';
		
		}
		
		if($return){
			return $html;
		}else{
			echo $html;
		}
	
	}
	
	public function render_edit_guide_form(){
	
		$cond['id'] = $_SESSION['guide_id'];
		$guide = $this->get_guide($cond);
		
		$html = '';
	
		$html .= '<input type="hidden" name="action" id="action" value="edit_guide" />';
		$html .= '<div class="row">';
		$html .= '<label for="name">Név</label><input type="text" id="name" name="name" value="' . $guide[0]['name'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="description">Leírás</label><textarea id="description" name="description">' . $guide[0]['description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="email">E-mail</label><input type="text" id="email" name="email" value="' . $guide[0]['email'] . '"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="phone">Telefon</label><input type="text" id="phone" name="phone" value="' . $guide[0]['phone'] . '"/><span style="display:none;" class="error">Hiba!</span>';
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
		
		if($guide[0]['photo'] != '' && is_file('uploads/guide_profile_thumbnail/' . $guide[0]['photo'])){
		
			$html .= '<div class="row">';
			$html .= '<img src="uploads/guide_profile_thumbnail/' . $guide[0]['photo'] . '" />';
			$html .= '</div>';
		
		}
		
		echo $html;
	
	}

	public function render_edit_tour_form($tour_id){
	
		$cond['id'] = $tour_id;
		$tour = $this->get_tours($cond);
	
		if($tour[0]['guide_id'] != $_SESSION['guide_id']){
			echo 'Nem jogosult';
			return FALSE;
		}
		
		$html = '';
		
		$html .= '<form action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="edit_tour" />';
		$html .= '<input type="hidden" name="id" id="id" value="' . $tour[0]['id'] . '" />';
		$html .= '<div class="row">';
		$html .= '<label for="tourname">Név</label><input type="text" value="' . $tour[0]['tourname'] . '" id="tourname" name="tourname"/><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="short_description">Rövid leírás</label><textarea id="short_description" name="short_description">' . $tour[0]['short_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="long_description">Hosszú leírás</label><textarea id="long_description" name="long_description">' . $tour[0]['long_description'] . '</textarea><span style="display:none;" class="error">Hiba!</span>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="category_id">Kategória</label><select id="category_id" name="category_id">' . $this->render_categories_option($tour[0]['category_id'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<label for="duration">Hossza</label><select id="duration" name="duration">' . $this->render_duration_option($tour[0]['duration'],TRUE) . '</select>';
		$html .= '</div>';
		$html .= '<div class="row">';
		$html .= '<input type="submit" value="Elküld" />';
		$html .= '</div>';
		$html .= '</form>';

		$html .= '<form action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="delete_tour" />';
		$html .= '<input type="hidden" name="tour_id" id="tour_id" value="' . $tour[0]['id'] . '" />';
		$html .= '<div class="row">';
		$html .= '<input type="submit" value="Töröl" />';
		$html .= '</div>';
		$html .= '</form>';
		
		$html .= $this->render_tour_photos($tour[0]['id'],TRUE);
		
		echo $html;
	
	}

	public function render_tour_photo_form($tour_id){
	
		$html = '';
	
		$html .= '<form enctype="multipart/form-data" action="lib/php/admin_process.php" method="POST">';
		$html .= '<input type="hidden" name="action" id="action" value="add_tour_photo" />';
		$html .= '<input type="hidden" name="tour_id" id="tour_id" value="' . $tour_id . '" />';
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

	protected function guide_name_by_id($id){
	
		$cond['id'] = $id;
		$guide = $this->get_guide($cond);
	
		return $guide[0]['name'];
		
	}

	protected function is_guides_tour($tour_id,$guide_id){
	
		$cond['id'] = $tour_id;
		$cond['guide_id'] = $guide_id;
		$tour = $this->get_tours($cond);
		
		if($tour['count'] == 1){
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
