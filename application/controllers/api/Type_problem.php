<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_problem extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Type_problem_model');
	}

	//get type problem
	public function get_type_problem() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if ($result = $this->Type_problem_model->get_type_problem() ) {
				$this->response['dados'] = $result;
				$this->status_header = 200;
			}else {
				$this->response['erro']['get_problem'] = 9;
			}
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
