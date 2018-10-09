<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Status_model');
	}

	// Cadastra novo status
	public function add_status() {
		if( $this->form_validation->run('add_status') ) {
			$database = array(
				'name' => $this->input->post('name')
			);
			if ($this->Status_model->create_status($database) ) {
				$this->response['dados'] = 'cadastrado';
				$this->status_header = 200;
			}else {
				$this->response['erro']['cadastro'] = 9;
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

	//get status
	public function get_status() {
		if ($result = $this->Status_model->get_status() ) {
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

	//Editar status
	public function update_status() {
		$database = array(
			'name' => $this->input->input_stream('name'),
		);
		$id = $this->input->input_stream('id');
		$this->form_validation->set_data($database);
		if($this->form_validation->run('update_status') ) {
			if ($this->Status_model->update_status($database, $id) ) {
				$this->response['dados'] = 'atualizado';
				$this->status_header = 200;
			}else {
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

	// Deletar status
	public function delete_status() {
		$id = $this->input->input_stream('id');
		$this->form_validation->set_data($database);
		if($this->form_validation->run('delete_status')) {
			if ($this->Status_model->delete_status($id)) {
				$this->response['dados'] = 'excluido';
				$this->status_header = 200;
			}else {
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
