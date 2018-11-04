<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_demand extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Type_demand_model');
	}

	// Cadastra novo tipo de demanda
	public function add_type_demand() {
		if( $this->form_validation->run('add_type_demand') ) {
			$database = array(
				'demands' => $this->input->post('demands')
			);
			if ($this->Type_demand_model->create_type_demand($database) ) {
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

	//get tipo de demanda
	public function get_type_demand() {
		if ($result = $this->Type_demand_model->get_type_demand() ) {
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

	//Editar tipo de demanda
	public function update_type_demand() {
		$database = array(
			'demands' => $this->input->input_stream('demands'),
			'id' => $this->input->input_stream('id'),
		);
		$this->form_validation->set_data($database);
		if($this->form_validation->run('update_type_demand') ) {
			if ($this->Type_demand_model->update_type_demand($database, $database['id']) ) {
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
	public function delete_type_demand() {
		$database = array(
			'id' => $this->input->input_stream('id')
		);
		$this->form_validation->set_data($database);
		if($this->form_validation->run('delete_type_demand')) {
			if ($this->Type_demand_model->delete_type_demand($database['id'])) {
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