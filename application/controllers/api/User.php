<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// function created by www.thewebhelp.com
if(!function_exists("create_square_image")){
	function create_square_image($original_file, $destination_file=NULL, $square_size = 96){
		
		if(isset($destination_file) and $destination_file!=NULL){
			if(!is_writable($destination_file)){
				//echo $destination_file;
				//echo '<p style="color:#FF0000">Oops, the destination path is not writable. Make that file or its parent folder wirtable.</p>'; 
			}
		}
		
		// get width and height of original image
		$imagedata = getimagesize($original_file);
		$original_width = $imagedata[0];	
		$original_height = $imagedata[1];
		
		if($original_width > $original_height){
			$new_height = $square_size;
			$new_width = $new_height*($original_width/$original_height);
		}
		if($original_height > $original_width){
			$new_width = $square_size;
			$new_height = $new_width*($original_height/$original_width);
		}
		if($original_height == $original_width){
			$new_width = $square_size;
			$new_height = $square_size;
		}
		
		$new_width = round($new_width);
		$new_height = round($new_height);
		
		// load the image
		if	(
				substr_count(strtolower($original_file), ".jpg") 
				or substr_count(strtolower($original_file), ".jpeg")
				or substr_count($original_file, ".JPG")
				
			){
			$original_image = imagecreatefromjpeg($original_file);
		}
		if(substr_count(strtolower($original_file), ".gif")){
			$original_image = imagecreatefromgif($original_file);
		}
		if(substr_count(strtolower($original_file), ".png")){
			$original_image = imagecreatefrompng($original_file);
		}
		
		$smaller_image = imagecreatetruecolor($new_width, $new_height);
		$square_image = imagecreatetruecolor($square_size, $square_size);
		
		imagecopyresampled($smaller_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
		
		if($new_width>$new_height){
			$difference = $new_width-$new_height;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0-$half_difference+1, 0, 0, 0, $square_size+$difference, $square_size, $new_width, $new_height);
		}
		if($new_height>$new_width){
			$difference = $new_height-$new_width;
			$half_difference =  round($difference/2);
			imagecopyresampled($square_image, $smaller_image, 0, 0-$half_difference+1, 0, 0, $square_size, $square_size+$difference, $new_width, $new_height);
		}
		if($new_height == $new_width){
			imagecopyresampled($square_image, $smaller_image, 0, 0, 0, 0, $square_size, $square_size, $new_width, $new_height);
		}
		
		// if no destination file was given then display a png		
		if(!$destination_file){
			imagepng($square_image,NULL,9);
		}
		
		// save the smaller image FILE if destination file given
		if(substr_count(strtolower($destination_file), ".jpg")){
			imagejpeg($square_image,$destination_file,100);
		}
		if(substr_count($destination_file, ".JPG")){
			imagejpeg($square_image,$destination_file,100);
		}
		if(substr_count(strtolower($destination_file), ".gif")){
			imagegif($square_image,$destination_file);
		}
		if(substr_count(strtolower($destination_file), ".png")){
			imagepng($square_image,$destination_file,9);
		}
		imagedestroy($original_image);
		imagedestroy($smaller_image);
		imagedestroy($square_image);
	}
}

class User extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/User_model');
	}

	// Cadastra novo usuário
	public function register_user() {

		if( $this->form_validation->run('register') ) {

			$url = 'https://aluno.unb.br/alunoweb/default/sca/solicitarsenha';
			$dados = array(
				'nome' => $this->input->post('name'),
				'matricula' => $this->input->post('registry'),
				'identidade' => $this->input->post('identity'),
				'data_nascimento' => $this->input->post('date_birth')
			);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($dados)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			if (mb_strpos($result,'alternativo informado abaixo')) {

				//add foto:
				if ($dados = $this->input->post('image')) {
					if(strpos($dados, 'jpeg') !== false){
						$dados = str_replace('data:image/jpeg;base64,', '', $dados);
						$extensao = 'jpeg';
					}else{
						$dados = str_replace('data:image/png;base64,', '', $dados);
						$extensao = 'png';
					}
					$dados = base64_decode($dados);
					$foto = md5(uniqid(time()));
					$fotosqrt = md5(uniqid(time()));
					file_put_contents("./uploads/perfil/{$foto}.{$extensao}", $dados);
					create_square_image("./uploads/perfil/{$foto}.{$extensao}","./uploads/perfil/{$fotosqrt}.png",500);
					$fotosqrt .= ".png";
					
				}else{
					$fotosqrt = 'default.png';
				}

				$var = $this->input->post('date_birth');
				$date = str_replace('/', '-', $var);
				$database = array(
					'image_profile' => $fotosqrt,
					'name'       => $this->input->post('name'),
					'email'      => $this->input->post('email'),
					'registry'   => $this->input->post('registry'),
					'identity'   => $this->input->post('identity'),
					'date_birth' => date('Y-m-d', strtotime($date)),
					'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'profile_type_id' => $this->input->post('profile_type_id') ? $this->input->post('profile_type_id') : 1,
				);
				if ($this->User_model->create_user($database) ) {
					$this->response['dados'] = 'cadastrado';
					$this->status_header = 200;
				}else {
					$this->response['erro']['cadastro'] = 9;
				}
			}else{
				$this->response['erro']['cadastro'] = 8;
			}
		}
		else {
			$this->response['erro'] = $this->form_validation->error_array();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	// Pega informações do usuário
	public function get_user() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if ($result = $this->User_model->get_info_user($payload['sub'])) {
				$this->response['dados'] = $result;
				$this->status_header = 200;
			}else{
				$this->response['erro'] = 9;
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	// Atualiza dados do usuário
	public function update_user() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('update_user') ) {
				$database = array(
					'email' => $this->input->input_stream('email'),
				);
				if ($dados = $this->input->post('image')) {
					if(strpos($dados, 'jpeg') !== false){
						$dados = str_replace('data:image/jpeg;base64,', '', $dados);
						$extensao = 'jpeg';
					}else{
						$dados = str_replace('data:image/png;base64,', '', $dados);
						$extensao = 'png';
					}
					$dados = base64_decode($dados);
					$foto = md5(uniqid(time()));
					$fotosqrt = md5(uniqid(time()));
					file_put_contents("./uploads/perfil/{$foto}.{$extensao}", $dados);
					create_square_image("./uploads/perfil/{$foto}.{$extensao}","./uploads/perfil/{$fotosqrt}.png",500);
					$fotosqrt .= ".png";
					$database = array(
						'email' => $this->input->input_stream('email'),
						'image_profile' => $fotosqrt
					);
				}
				if ($result = $this->User_model->update_user($database, $payload['sub'])) {
					$this->response['dados'] = 'Atualizado';
					$this->status_header = 200;
				}else{
					$this->response['erro']['update'] = 9;
				}
			}
			else {
				$this->response['erro'] = $this->form_validation->error_array();
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	// Deleta um usuário
	public function delete_user() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if ($this->User_model->delete_user($payload['sub']) ) {
				$this->response['dados'] = 'excluido';
				$this->status_header = 200;
			}else {
				$this->response['erro']['excluido'] = 9;
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}


	// Troca de senha
	public function update_password() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{		
			if( $this->form_validation->run('update_password') ) {
				$database = array(
					'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					);
				if ($result = $this->User_model->update_password($database, $payload['sub'])) {
					$this->response['dados'] = 'Atualizado';
					$this->status_header = 200;
				}else{
					$this->response['erro']['update'] = 9;
				}
			}
			else {
				$this->response['erro'] = $this->form_validation->error_array();
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	} 


}
