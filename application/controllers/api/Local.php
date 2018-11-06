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

	public function add_local(){
		if( $this->form_validation->run('add_local') ) {
			$database = array(
				'local' => $this->input->post('local'),
				'campus' => $this->input->post('campus'),
				'area'=> $this->input->post('area'),
			);
			if ($this->Local_model->create_local($database) ) {
				$this->response['dados'] = 'cadastrado';
				$this->status_header = 200;
			}else {
				$this->response['erro']['cadastro'] = 9;
			}
		}else {
			$this->response['erro'] = $this->form_validation->error_array();
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
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

	public function update_local() {
		$database = array(
			'id' => $this->input->input_stream('local_id'),
			'local' => $this->input->input_stream('local'),
			'campus' => $this->input->input_stream('campus'),
			'area' => $this->input->input_stream('area')
		);
		$this->form_validation->set_data($database);
		if( $this->form_validation->run('update_local') ) {
			if($this->Local_model->update_local($database)){
				$this->response['dados'] = 'atualizado';
				$this->status_header = 200;
			}else{
				$this->response['erro']['update'] = 9;
			}
		}else {
			$this->response['erro'] = $this->form_validation->error_array();
		}
		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	public function delete_local() {
		$database = array(
			'id' => $this->input->input_stream('local_id'),
		);
		$this->form_validation->set_data($database);
		if( $this->form_validation->run('delete_local') ) {
			if($this->Local_model->delete_local($database['id'])){
				$this->response['dados'] = 'excluido';
				$this->status_header = 200;
			}else{
				$this->response['erro']['update'] = 9;
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
