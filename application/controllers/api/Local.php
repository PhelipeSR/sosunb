<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Local_model');
	}

	public function get_local() {
		$campus = $this->input->get('campus');
		$area = $this->input->get('area');

		if ($result = $this->Local_model->get_local($campus,$area) ) {
			$this->response['dados'] = $result;
			$this->status_header = 200;
		}else {
			$this->response['erro']['get_status'] = 9;
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
