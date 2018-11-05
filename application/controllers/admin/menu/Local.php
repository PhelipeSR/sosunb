<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/Local_model');
		$campus = $this->Local_model->get_campus();
		$environment = $this->Local_model->get_environment();
		$this->load->view('admin/menu/local',array(
			'campus' => $campus,
			'environment' => $environment,
		));
	}

	public function get_local() {
		$this->load->model('admin/menu/Local_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Local_model->count_all_data(),
			"recordsFiltered" => $this->Local_model->count_filtered_data(),
			"data"            => $this->Local_model->data(),
		);
		echo json_encode($output);
	}

	public function create_local() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('local',       'Local',     'required|max_length[100]');
		$this->form_validation->set_rules('campus',      'Campus',    'required|integer');
		$this->form_validation->set_rules('environment', 'Ambiente',  'required|integer');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Local_model');

			$database = array(
				'local'          => $this->input->post('local',TRUE),
				'campus_id'      => $this->input->post('campus',TRUE),
				'environment_id' => $this->input->post('environment',TRUE),
			);
			if ($this->Local_model->create_local($database) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao adicionar.');
			}
		}
		else { // Formulário com erros
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function update_local() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',          'ID',       'required|integer');
		$this->form_validation->set_rules('campus',      'Campus',   'required|integer');
		$this->form_validation->set_rules('environment', 'Ambiente', 'required|integer');
		$this->form_validation->set_rules('local',       'Local',    'required|max_length[100]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Local_model');

			$database = array(
				'local'          => $this->input->post('local',TRUE),
				'campus_id'      => $this->input->post('campus',TRUE),
				'environment_id' => $this->input->post('environment',TRUE),
			);
			if ($this->Local_model->update_local($database, $this->input->post('id')) ) {
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

	public function delete_local() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Local_model');
			if ($this->Local_model->delete_local($this->input->post('excluded'), $this->input->post('id'))) {
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
