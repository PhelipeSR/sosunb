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

	// Cadastra novo tipo de problema
	public function add_type_problem() {
		if( $this->form_validation->run('add_type_problem') ) {
			$database = array(
				'type' => $this->input->post('type')
			);
			if ($this->Type_problem_model->create_type_problem($database) ) {
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

//get problem
	public function get_type_problem() {
		if ($result = $this->Type_problem_model->get_type_problem() ) {
			$this->response['dados'] = $result;
			$this->status_header = 200;
		}else {
			$this->response['erro']['get_problem'] = 9;
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	//Editar problema
	public function update_type_problem() {
		$database = array(
		'type' => $this->input->input_stream('type'),
		'id' => $this->input->input_stream('id')
				);
		$this->form_validation->set_data($database);
		if( $this->form_validation->run('update_type_problem') ) {
			if ($this->Type_problem_model->update_type_problem($database, $database['id']) ) {
						$this->response['dados'] = 'atualizado';
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

	public function delete_type_problem() {
		$database = array(
		 'id' => $this->input->input_stream('id')
				);
		$this->form_validation->set_data($database);
		if( $this->form_validation->run('delete_type_problem') ) {
			if ($this->Type_problem_model->delete_type_problem($database['id']) ) {
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
