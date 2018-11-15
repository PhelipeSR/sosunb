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
			$database = array(
				'comment' => $this->input->post('comment'),
				'demands_id' => $this->input->post('demands_id'),
				'users_id' => $payload['sub'],
			);
			$this->form_validation->set_data($database);
 			if( $this->form_validation->run('add_coments') ) {
				if ($this->Coments_model->create_coments($database) ) {
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

	//Get comentários
	public function get_coments() {
		$demands_id = $this->input->get('demand');
		if ($result = $this->Coments_model->get_coments($demands_id) ) {
			$this->response['dados'] = $result;
			$this->status_header = 200;
		}else {
			$this->response['erro']['get_coments'] = 9;
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	// Incompleto
	// public function update_coments() {
	// 	$token = $this->input->post('Authorization');
	// 	$payload = $this->jwt->decode($token);
	// 	if ($payload === FALSE) {
 	// 		$this->response['erro'] = 'token_invalido';
 	// 		$this->status_header = 401;
 	// 	}else{
	// 	$database = array(
	// 		'comment' => $this->input->input_stream('comment'),
	// 		'id' => $this->input->input_stream('comment_id'),
	// 		'user_id' => $payload['sub'],
	// 	);
	// 	$this->form_validation->set_data($database);
	// 	if($this->form_validation->run('update_comment') ) {
	// 		if ($this->Coments_model->update_coments($database['comment'], $database['id'],$database['user_id']) ) {
	// 			$this->response['dados'] = 'atualizado';
	// 			$this->status_header = 200;
	// 		}else {
	// 			$this->response['erro']['update'] = 9;
	// 		}
	// 	}
	// 	else {
	// 		$this->response['erro'] = $this->form_validation->error_array();
	// 	}
	// }
	// 	$this->output
	// 		->set_content_type('application/json')
	// 		->set_status_header($this->status_header)
	// 		->set_output(json_encode($this->response));
	// }

	// Deletar comentário
	public function delete_coments() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			$database = array(
				'comment_id' => $this->input->input_stream('comment_id'),
				'users_id' => $payload['sub']
			);
			$this->form_validation->set_data($database);
			if( $this->form_validation->run('delete_coments') ) {
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
