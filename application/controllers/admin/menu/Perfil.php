<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// function created by www.thewebhelp.com
if(!function_exists("create_square_image")){
	function create_square_image($original_file, $destination_file=NULL, $square_size = 96){

		if(isset($destination_file) and $destination_file != NULL){
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

class Perfil extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/Perfil_model');
		$dados = $this->Perfil_model->get_dados_user($this->session->user_id);
		$this->load->view('admin/menu/perfil',array('dados' => $dados));
	}

	public function update_dados() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('name',      'Nome',              'required|max_length[100]');
		$this->form_validation->set_rules('email',     'Email',             'required|valid_email|max_length[100]|edit_unique[users.email.'.$this->session->user_id.']');
		$this->form_validation->set_rules('identity',  'Identidade',        'required|max_length[20]|is_natural');
		$this->form_validation->set_rules('registry',  'Matrícula',         'required|max_length[20]|is_natural|edit_unique[users.registry.'.$this->session->user_id.']');
		$this->form_validation->set_rules('date_birth','Data de Nascimento','required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Perfil_model');

			$database = array(
				'name'       => $this->input->post('name',TRUE),
				'email'      => $this->input->post('email',TRUE),
				'identity'   => $this->input->post('identity',TRUE),
				'registry'   => $this->input->post('registry',TRUE),
				'date_birth' => $this->input->post('date_birth',TRUE),
			);
			if ($this->Perfil_model->update_dados($database, $this->session->user_id )) {
				$this->session->set_userdata('user_name', $database['name']);
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function update_senhas() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('current_password', 'Senha Atual',     'required|min_length[6]');
		$this->form_validation->set_rules('new_password',     'Nova Senha',      'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirmar Senha', 'required|matches[new_password]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Perfil_model');

			$database = array(
				'current_password'  => $this->input->post('current_password',TRUE),
				'new_password'      => $this->input->post('new_password',TRUE),
			);
			if ($this->Perfil_model->update_senhas($database, $this->session->user_id )) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function update_image() {
		$this->load->library('saida');

		$config['upload_path']   = './uploads/perfil/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '2048';
		$config['remove_spaces'] = TRUE;
		$config['overwrite']     = TRUE;
		$config['encrypt_name']     = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image_profile')) {
			$this->load->model('admin/menu/Perfil_model');

			$fotosqrt = md5(uniqid(time()));
			$foto = $this->upload->data()['file_name'];
			$extensao = $this->upload->data()['file_ext'];
			create_square_image("./uploads/perfil/{$foto}","./uploads/perfil/{$fotosqrt}.png",500);

			if ($this->Perfil_model->update_image( $fotosqrt.'.png', $this->session->user_id )) {
				$this->session->set_userdata('user_image', $fotosqrt.'.png');
				$this->saida->set_dados(array('image_name' => $fotosqrt.'.png' ));
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else{
			$this->saida->set_erro($this->upload->display_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function delete_perfil() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('password','Senha','required|min_length[6]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Perfil_model');
			if ($this->Perfil_model->delete_perfil($this->input->post('password'), $this->session->user_id)) {
				$this->session->sess_destroy();
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao Excluir.');
			}
		}// Formulário com erros
		else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function get_demands(){
		$this->load->library('saida');
		$this->load->model('api/Get_demands_model');

		if ($result = $this->Get_demands_model->profile( $this->session->user_id ) ) {
			$this->saida->set_dados($result);
		}else {
			$this->saida->set_erro('Erro ao pegar demandas.');
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
