<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/User_model');
		$tipo_user = $this->User_model->get_tipo_user();
		$this->load->view('admin/menu/user',array(
			'tipo_user' => $tipo_user,
		));
	}

	public function get_user() {
		$this->load->model('admin/menu/User_model');
		$output = array(
			"draw" => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $this->User_model->count_all_data(),
			"recordsFiltered" => $this->User_model->count_filtered_data(),
			"data"            => $this->User_model->data(),
		);
		echo json_encode($output);
	}

	public function create_user() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('name',         'Nome',              'required|max_length[100]');
		$this->form_validation->set_rules('email',        'Email',             'required|valid_email|max_length[100]|is_unique[users.email]');
		$this->form_validation->set_rules('identity',     'Identidade',        'required|max_length[20]|is_natural');
		$this->form_validation->set_rules('registry',     'Matrícula',         'required|max_length[20]|is_natural|is_unique[users.registry]');
		$this->form_validation->set_rules('profile_type', 'Tipo de Perfil',    'required|is_natural');
		$this->form_validation->set_rules('date_birth',   'Data de Nascimento','required');
		$this->form_validation->set_rules('password',     'Senha',             'required|min_length[6]');
		$this->form_validation->set_rules('conf_password','Confirmar Senha',   'required|matches[password]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/User_model');

			$database = array(
				'name'            => $this->input->post('name',TRUE),
				'email'           => $this->input->post('email',TRUE),
				'identity'        => $this->input->post('identity',TRUE),
				'registry'        => $this->input->post('registry',TRUE),
				'date_birth'      => $this->input->post('date_birth',TRUE),
				'profile_type_id' => $this->input->post('profile_type',TRUE),
				'password'        => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			);
			if ($this->User_model->create_user($database) ) {
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

	public function update_user() {
		$this->load->library('saida');
		$this->load->library('form_validation');
		$id =  $this->input->post('id');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',          'ID',                'required|integer');
		$this->form_validation->set_rules('name',        'Nome',              'required|max_length[100]');
		$this->form_validation->set_rules('email',       'Email',             'required|valid_email|max_length[100]|edit_unique[users.email.'.$id.']');
		$this->form_validation->set_rules('identity',    'Identidade',        'required|max_length[20]|is_natural');
		$this->form_validation->set_rules('registry',    'Matrícula',         'required|max_length[20]|is_natural|edit_unique[users.registry.'.$id.']');
		$this->form_validation->set_rules('profile_type','Tipo de Perfil',    'required|is_natural');
		$this->form_validation->set_rules('date_birth',  'Data de Nascimento','required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/User_model');

			$database = array(
				'name'            => $this->input->post('name',TRUE),
				'email'           => $this->input->post('email',TRUE),
				'identity'        => $this->input->post('identity',TRUE),
				'registry'        => $this->input->post('registry',TRUE),
				'date_birth'      => $this->input->post('date_birth',TRUE),
				'profile_type_id' => $this->input->post('profile_type',TRUE),
			);
			if ($this->User_model->update_user($database, $id) ) {
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

	public function delete_user() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('id',      'ID',   'required|integer');
		$this->form_validation->set_rules('excluded','Troca','required|in_list[0,1]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/User_model');
			if ($this->User_model->delete_user($this->input->post('excluded'), $this->input->post('id'))) {
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
