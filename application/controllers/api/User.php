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
	public function post() {

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

			if (strpos($result,'Acesso negado') === FALSE) {
				$database = array(
					'name'       => $this->input->post('name'),
					'email'      => $this->input->post('email'),
					'registry'   => $this->input->post('registry'),
					'identity'   => $this->input->post('identity'),
					'date_birth' => $this->input->post('date_birth'),
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

	public function get() {
		$this->response = array(
			'mensagem' => 'request get',
		);
		echo json_encode($this->response);
	}

	public function put($id = null) {
		$this->response = array(
			'mensagem' => 'Atualizar user com id = ' . $id,
		);
		echo json_encode($this->response);
	}

	public function delete($id) {
		if ($this->User_model->delete_user($id) ) {
			$this->response['dados'] = 'excluido';
			$this->status_header = 200;
		}else {
			$this->response['erro']['excluido'] = 9;
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
