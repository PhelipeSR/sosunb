<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Environment extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/Environment_model');
		$area = $this->Environment_model->get_area();
		$this->load->view('admin/menu/environment',array(
			'area' => $area,
		));
	}

	public function get_environment() {
		$this->load->model('admin/menu/Environment_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Environment_model->count_all_data(),
			"recordsFiltered" => $this->Environment_model->count_filtered_data(),
			"data"            => $this->Environment_model->data(),
		);
		echo json_encode($output);
	}

	public function create_environment() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('environment', 'Environment', 'required|max_length[100]');
		$this->form_validation->set_rules('area',        'Área',        'required|integer');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Environment_model');

			$database = array(
				'environment' => $this->input->post('environment',TRUE),
				'area_id'     => $this->input->post('area',TRUE),
			);
			if ($this->Environment_model->create_environment($database) ) {
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

	public function update_environment() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',          'ID',          'required|integer');
		$this->form_validation->set_rules('environment', 'Environment', 'required|max_length[100]');
		$this->form_validation->set_rules('area',        'Área',        'required|integer');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Environment_model');

			$database = array(
				'environment'  => $this->input->post('environment',TRUE),
				'area_id'      => $this->input->post('area',TRUE),
			);
			if ($this->Environment_model->update_environment($database, $this->input->post('id')) ) {
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

	public function delete_environment() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Environment_model');
			if ($this->Environment_model->delete_environment($this->input->post('excluded'), $this->input->post('id'))) {
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
