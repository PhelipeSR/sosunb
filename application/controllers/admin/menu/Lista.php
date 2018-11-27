<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista extends CI_Controller {

	public function render() {
		$this->load->model('api/Campus_model');
		$this->load->model('api/Status_model');
		$this->load->model('api/Area_model');
		$this->load->model('api/Type_problem_model');
		$this->load->model('api/Status_model');

		$campus = $this->Campus_model->get_campus();
		$status = $this->Status_model->get_status();
		$area = $this->Area_model->get_area();
		$type_problem = $this->Type_problem_model->get_type_problem();
		$status = $this->Status_model->get_status();
		$this->load->view('admin/menu/lista', array(
			'campus' => $campus,
			'status' => $status,
			'area' => $area,
			'type_problem' => $type_problem,
			'status' => $status,
		));
	}

	public function get_lista() {
		$this->load->model('admin/menu/Lista_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Lista_model->count_all_data(),
			"recordsFiltered" => $this->Lista_model->count_filtered_data(),
			"data"            => $this->Lista_model->data(),
		);
		echo json_encode($output);
	}

	public function get_environment() {
		$this->load->library('saida');
		$this->load->library('form_validation');
		$this->load->model('api/Local_model');

		if( $this->form_validation->run('get_local') ) {
			$campus = $this->input->post('campus');
			$area = $this->input->post('area');
			if ($result = $this->Local_model->get_local($campus,$area) ) {
				$this->saida->set_dados($result);
			}else {
				$this->saida->set_erro('Erro ao pegar local.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function edit_local() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',     'required|integer');
		$this->form_validation->set_rules('campus_id', 'Campus', 'required|integer');
		$this->form_validation->set_rules('area_id', 'Área', 'required|integer');
		$this->form_validation->set_rules('environment_id', 'Ambiente', 'required|integer');
		$this->form_validation->set_rules('local_id', 'Local', 'integer');
		$this->form_validation->set_rules('comment', 'Comentário', 'required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Lista_model');

			$database = array(
				'id'    => $this->input->post('id',TRUE),
				'campus_id'    => $this->input->post('campus_id',TRUE),
				'area_id'    => $this->input->post('area_id',TRUE),
				'environment_id'    => $this->input->post('environment_id',TRUE),
				'local_id'    => ($this->input->post('local_id',TRUE)) ? $this->input->post('local_id',TRUE) : NULL,
				'comment'    => $this->input->post('comment',TRUE),
			);
			if ($this->Lista_model->update_local($database,$this->session->user_id) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function edit_problema() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',     'required|integer');
		$this->form_validation->set_rules('type_problems_id', 'Tipo de Problema', 'required|integer');
		$this->form_validation->set_rules('comment', 'Comentário', 'required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Lista_model');

			$database = array(
				'id'    => $this->input->post('id',TRUE),
				'type_problems_id'    => $this->input->post('type_problems_id',TRUE),
				'comment'    => $this->input->post('comment',TRUE),
			);
			if ($this->Lista_model->update_problema($database,$this->session->user_id) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function edit_status() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',     'required|integer');
		$this->form_validation->set_rules('status_id', 'Status', 'required|integer');
		$this->form_validation->set_rules('comment', 'Comentário', 'required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Lista_model');

			$database = array(
				'id'    => $this->input->post('id',TRUE),
				'status_id'    => $this->input->post('status_id',TRUE),
				'comment'    => $this->input->post('comment',TRUE),
			);
			if ($this->Lista_model->update_status($database,$this->session->user_id) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function delete_lista() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Lista_model');
			if ($this->Lista_model->delete_demand($this->input->post('excluded'), $this->input->post('id'))) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao trocar visibilidade.');
			}
		}// Formulário com erros
		else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
