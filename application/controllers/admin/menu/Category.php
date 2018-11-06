<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function render() {
		$this->load->view('admin/menu/category');
	}

	public function get_category() {
		$this->load->model('admin/menu/Category_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Category_model->count_all_data(),
			"recordsFiltered" => $this->Category_model->count_filtered_data(),
			"data"            => $this->Category_model->data(),
		);
		echo json_encode($output);
	}

	public function create_category() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('category', 'Categoria', 'required|max_length[100]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Category_model');

			$database = array(
				'category' => $this->input->post('category',TRUE),
			);
			if ($this->Category_model->create_category($database) ) {
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

	public function update_category() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',   'ID',   'required|integer');
		$this->form_validation->set_rules('category', 'Categoria', 'required|max_length[100]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Category_model');

			$database = array(
				'category'    => $this->input->post('category',TRUE),
			);
			if ($this->Category_model->update_category($database, $this->input->post('id')) ) {
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

	public function delete_category() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Category_model');
			if ($this->Category_model->delete_category($this->input->post('excluded'), $this->input->post('id'))) {
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
