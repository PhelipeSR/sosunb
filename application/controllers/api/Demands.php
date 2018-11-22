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
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('add_demands') ) {

				$dados = $this->input->post('image');
				$dados = str_replace('data:image/jpeg;base64,', '', $dados);
				$dados = str_replace('data:image/png;base64,', '', $dados);
				$dados = base64_decode($dados);
				$foto = md5(uniqid(time()));
				file_put_contents("./uploads/demandas/{$foto}.png", $dados);

				$database = array(
					'users_id' => $payload['sub'],
					'image' => $foto,
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					// 'status_id'=> $this->input->post('status_id'),
					'type_problems_id' => $this->input->post('type_problems_id'),
					'type_demand_id' => $this->input->post('type_demand_id'),
					'local_id' => $this->input->post('local_id'),
					'campus_id' => $this->input->post('campus_id'),
					'environment_id' => $this->input->post('environment_id'),
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
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('delete_demands') ) {
				if($this->Demands_model->delete_demands($this->input->post('demands_id'),$payload['sub'])){
					$this->response['dados'] = 'excluido';
					$this->status_header = 200;
				}else{
					$this->response['erro']['delete'] = 9;
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

	public function report_demands() {
		$token = $this->input->post('Authorization');
		$payload = $this->jwt->decode($token);
		if ($payload === FALSE) {
			$this->response['erro'] = 'token_invalido';
			$this->status_header = 401;
		}else{
			if( $this->form_validation->run('report_demands') ) {
				if($this->Demands_model->report_demands($this->input->post('demands_id'))){
					$this->response['dados'] = 'reportado';
					$this->status_header = 200;
				}else {
					$this->response['erro']['report'] = 9;
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
