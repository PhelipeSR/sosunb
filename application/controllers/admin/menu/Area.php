<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

	public function render() {
		$this->load->view('admin/menu/area');
	}

	public function get_area() {
		$this->load->model('admin/menu/Area_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Area_model->count_all_data(),
			"recordsFiltered" => $this->Area_model->count_filtered_data(),
			"data"            => $this->Area_model->data(),
		);
		echo json_encode($output);
	}

	public function create_area() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('area', 'Área', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Area_model');

			$database = array(
				'area' => $this->input->post('area',TRUE),
			);
			if ($this->Area_model->create_area($database) ) {
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

	public function update_area() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',   'required|integer');
		$this->form_validation->set_rules('area', 'Área', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Area_model');

			$database = array(
				'area'    => $this->input->post('area',TRUE),
			);
			if ($this->Area_model->update_area($database, $this->input->post('id')) ) {
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

	public function delete_area() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Area_model');
			if ($this->Area_model->delete_area($this->input->post('excluded'), $this->input->post('id'))) {
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
