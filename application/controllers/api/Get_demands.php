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
		if (!$payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			$campus = $this->input->get('campus');
			if ($result = $this->Get_demands_model->ranking(1,$campus) ) {
			// if ($result = $this->Get_demands_model->ranking($payload['sub'],$campus) ) {
				$this->response['dados'] = $result;
				$this->status_header = 200;
			}else {
				$this->response['erro']['get_ranking'] = 9;
			}
			echo '<pre>';
			print_r($this->response);
			echo '</pre>';
		}
		// $this->output
		// 	->set_content_type('application/json')
		// 	->set_status_header($this->status_header)
		// 	->set_output(json_encode($this->response));
	}
}
