<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Likes extends CI_Controller {
	private $status_header = 400;
	private $response = array();
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Likes_model');
	}

	// Cadastra novo like
	public function add_like() {
		$token = $this->input->get_request_header('token');
		$payload = (array) $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('add_like') ) {
				$database = array(
					'users_id' => $payload['sub'],
					'demands_id' => $this->input->post('demands_id')
				);
				if ($this->Likes_model->create_like($database) ) {
					$this->response['dados'] = 'cadastrado';
					$this->status_header = 200;
				}else {
					$this->response['erro']['cadastro'] = 9;
				}
			}else {
				$this->response['erro'] = $this->form_validation->error_array();
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	public function delete_like() {
		$token = $this->input->get_request_header('token');
 		$payload = (array) $this->jwt->decode($token);
 		if ($payload === FALSE) {
 			$this->response['erro'] = 'token_invalido';
 			$this->status_header = 401;
 		}else{
			$database = array(
				'demands_id' => $this->input->input_stream('demands_id'),
				'users_id' => $payload['sub']
			);
			$this->form_validation->set_data($database);
			if( $this->form_validation->run('delete_like') ) {
				if ($this->Likes_model->delete_like($database['demands_id'],$database['users_id'] ) ) {
					$this->response['dados'] = 'excluido';
					$this->status_header = 200;
				}else {
					$this->response['erro']['update'] = 9;
				}
			}else {
				$this->response['erro'] = $this->form_validation->error_array();
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}