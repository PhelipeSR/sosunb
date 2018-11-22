<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
				$var = $this->input->post('date_birth');
				$date = str_replace('/', '-', $var);
				$database = array(
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
}
