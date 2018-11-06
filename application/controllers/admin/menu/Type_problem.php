<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_problem extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/Type_problem_model');
		$category = $this->Type_problem_model->get_category();
		$this->load->view('admin/menu/type_problem',array(
			'category' => $category,
		));
	}

	public function get_type_problem() {
		$this->load->model('admin/menu/Type_problem_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->Type_problem_model->count_all_data(),
			"recordsFiltered" => $this->Type_problem_model->count_filtered_data(),
			"data"            => $this->Type_problem_model->data(),
		);
		echo json_encode($output);
	}

	public function create_type_problem() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('type_problem', 'Tipo de Problema', 'required|max_length[100]');
		$this->form_validation->set_rules('category',        'Categoria',        'required|integer');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Type_problem_model');

			$database = array(
				'type'        => $this->input->post('type_problem',TRUE),
				'category_id' => $this->input->post('category',TRUE),
			);
			if ($this->Type_problem_model->create_type_problem($database) ) {
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

	public function update_type_problem() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',           'ID',               'required|integer');
		$this->form_validation->set_rules('type_problem', 'Tipo de Problema', 'required|max_length[100]');
		$this->form_validation->set_rules('category',     'Categoria',        'required|integer');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Type_problem_model');

			$database = array(
				'type'        => $this->input->post('type_problem',TRUE),
				'category_id' => $this->input->post('category',TRUE),
			);
			if ($this->Type_problem_model->update_type_problem($database, $this->input->post('id')) ) {
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

	public function delete_type_problem() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Type_problem_model');
			if ($this->Type_problem_model->delete_type_problem($this->input->post('excluded'), $this->input->post('id'))) {
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
