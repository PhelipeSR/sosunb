<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Session_model');
	}

	// Verifica login do usuário
	public function post() {
		if ( $this->form_validation->run('sign_in') ) {

			$database = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			if ($result = $this->Session_model->verify_login($database) ) {
				$payload = array(
					'iss' => base_url(),
					'sub' => $result->id,
					'exp' => strtotime('1 day'),
					'iat' => time(),
					'user' => $result->name,
					'profile_type_id' => $result->profile_type_id,
				);
				$jwt = $this->jwt->encode($payload);
				$this->response['dados'] = 'logado';
				$this->response['type_user'] = $result->profile_type_id;
				$this->response['token'] = $jwt;
				$this->status_header = 200;
			}else{
				$this->response['erro']['login'] = 10;
			}
		}else {
			$this->response['erro'] = $this->form_validation->error_array();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
