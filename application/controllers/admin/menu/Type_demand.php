<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_demand extends CI_Controller {

	public function render() {
		$this->load->view('admin/menu/type_demand');
	}

	public function get_type_demand() {
		$this->load->model('admin/menu/Type_demand_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Type_demand_model->count_all_data(),
			"recordsFiltered" => $this->Type_demand_model->count_filtered_data(),
			"data"            => $this->Type_demand_model->data(),
		);
		echo json_encode($output);
	}

	public function create_type_demand() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('demands', 'Tipo de Demanda', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Type_demand_model');

			$database = array(
				'demands' => $this->input->post('demands',TRUE),
			);
			if ($this->Type_demand_model->create_type_demand($database) ) {
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

	public function update_type_demand() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',     'ID',              'required|integer');
		$this->form_validation->set_rules('demands', 'Tipo de Demanda', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Type_demand_model');

			$database = array(
				'demands'    => $this->input->post('demands',TRUE),
			);
			if ($this->Type_demand_model->update_type_demand($database, $this->input->post('id')) ) {
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

	public function delete_type_demand() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Type_demand_model');
			if ($this->Type_demand_model->delete_type_demand($this->input->post('excluded'), $this->input->post('id'))) {
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
