<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coments extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Coments_model');
	}

	// Cadastra novo comentário
	public function add_coments() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
 			$this->response['erro'] = 'token_invalido';
 			$this->status_header = 401;
 		}else{
 			if( $this->form_validation->run('add_coments') ) {
				$database = array(
					'comment' => $this->input->post('comment'),
					'demands_id' => $this->input->post('demands_id'),
					'users_id' => $payload['sub'],
				);
				if ($id = $this->Coments_model->create_coments($database) ) {
					$this->response['dados'] = array(
						'comment_id' => $id
					);
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

	// Deletar comentário
	public function delete_coments() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('delete_coments') ) {
				$database = array(
					'comment_id' => $this->input->input_stream('comment_id'),
					'users_id' => $payload['sub']
				);
				if ($this->Coments_model->delete_coments($database)) {
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
