<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus extends CI_Controller {

	public function render() {
		$this->load->view('admin/menu/campus');
	}

	public function get_campus() {
		$this->load->model('admin/menu/Campus_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Campus_model->count_all_data(),
			"recordsFiltered" => $this->Campus_model->count_filtered_data(),
			"data"            => $this->Campus_model->data(),
		);
		echo json_encode($output);
	}

	public function create_campus() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('campus', 'Campus', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Campus_model');

			$database = array(
				'campus' => $this->input->post('campus',TRUE),
			);
			if ($this->Campus_model->create_campus($database) ) {
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

	public function update_campus() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',     'required|integer');
		$this->form_validation->set_rules('campus', 'Campus', 'required|max_length[50]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Campus_model');

			$database = array(
				'campus'    => $this->input->post('campus',TRUE),
			);
			if ($this->Campus_model->update_campus($database, $this->input->post('id')) ) {
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

	public function delete_campus() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Campus_model');
			if ($this->Campus_model->delete_campus($this->input->post('excluded'), $this->input->post('id'))) {
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
