<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Demands_model');
	}

	public function add_demands (){
		$token = $this->input->get_request_header('token');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('add_demands') ) {
				$database = array(
					'users_id' => $payload['sub'],
					//'image' => $this->input->post('image'),
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'status_id'=> $this->input->post('status_id'),
					'type_problems_id' => $this->input->post('type_problems_id'),
					'type_demand_id' => $this->input->post('type_demand_id'),
					'local_id' => $this->input->post('local_id'),
				);
				if ($this->Demands_model->create_demands($database) ) {
					$this->response['dados'] = 'cadastrado';
					$this->status_header = 200;
				}else {
					$this->response['erro']['cadastro'] = 9;
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

	public function delete_demands() {
		$token = $this->input->get_request_header('token');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			$database = array(
				'demands_id' => $this->input->input_stream('demands_id'),
				'users_id' => $payload['sub'],
				'profile_type_id' => $payload['profile_type_id']
			);
			$this->form_validation->set_data($database);
			if( $this->form_validation->run('delete_demands') ) {
				if($database['profile_type_id']==2){
					if($this->Demands_model->delete_demands($database)){
						$this->response['dados'] = 'excluido';
						$this->status_header = 200;
					}else {
						$this->response['erro']['update'] = 9;
						}

				} else {
					if($this->Demands_model->delete_demands($database, true)){
						$this->response['dados'] = 'excluido';
						$this->status_header = 200;
					}else{
						{
							$this->response['erro']['update'] = 9;
							}

				}
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
