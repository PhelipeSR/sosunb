<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_demands extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Get_demands_model');
	}

	public function ranking() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('get_ranking') ) {
				$campus = $this->input->post('campus');
				if ($result = $this->Get_demands_model->ranking($payload['sub'],$campus) ) {
					$this->response['dados'] = $result;
					$this->status_header = 200;
				}else {
					$this->response['erro']['get_ranking'] = 9;
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

	public function feed() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('get_feed') ) {
				$limit = $this->input->post('limit');
				$status = $this->input->post('status');
				if ($result = $this->Get_demands_model->feed($payload['sub'],$limit,$status) ) {
					$this->response['dados'] = $result;
					$this->status_header = 200;
				}else {
					$this->response['erro']['get_feed'] = 9;
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

	public function profile() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if ($result = $this->Get_demands_model->profile($payload['sub']) ) {
				$this->response['dados'] = $result;
				$this->status_header = 200;
			}else {
				$this->response['erro']['get_profile'] = 9;
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
