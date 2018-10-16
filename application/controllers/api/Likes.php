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


	// public function get_user() {
	// 	$token = $this->input->get_request_header('token');
	// 	$payload = (array) $this->jwt->decode($token);
	// 	if ($payload === FALSE) {
	// 		$this->response['erro'] = 'token_invalido';
	// 		$this->status_header = 401;
	// 	}else{
	// 		if ($result = $this->User_model->get_info_user($payload['sub'])) {
	// 			$this->response['dados'] = $result;
	// 			$this->status_header = 200;
	// 		}else{
	// 			$this->response['erro'] = 9;
	// 		}
	// 	}
	// 	$this->output
	// 		->set_content_type('application/json')
	// 		->set_status_header($this->status_header)
	// 		->set_output(json_encode($this->response));
	// }

	// Cadastra novo tipo de problema
	public function add_like() {
		$token = $this->input->get_request_header('token');
		$payload = (array) $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('add_like') ) {
				$database = array(
					// 'date' => $this->input->post('date'),
	        'users_id' => $payload['sub'],
	        'demands_id' => $this->input->post('demands_id')
				);
				if ($this->Likes_model->create_like($database) ) {
					$this->response['dados'] = 'cadastrado';
					$this->status_header = 200;
				}else {
					$this->response['erro']['cadastro'] = 9;
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


	 public function delete_like() {
	 	$database = array(
	 	 'id' => $this->input->input_stream('id'),
  	 			);
	 	$this->form_validation->set_data($database);
	 	if( $this->form_validation->run('delete_like') ) {
	 		if ($this->Likes_model->delete_like($database['id']) ) {
	 					$this->response['dados'] = 'excluido';
	 					$this->status_header = 200;
	 			} else {
	 					$this->response['erro']['update'] = 9;
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
}
