<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function render() {
		$this->load->model('admin/menu/Perfil_model');
		$dados = $this->Perfil_model->get_dados_user($this->session->user_id);
		$this->load->view('admin/menu/perfil',array('dados' => $dados));
	}

	public function update_dados() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('name',      'Nome',              'required|max_length[100]');
		$this->form_validation->set_rules('email',     'Email',             'required|valid_email|max_length[100]|edit_unique[users.email.'.$this->session->user_id.']');
		$this->form_validation->set_rules('identity',  'Identidade',        'required|max_length[20]|is_natural');
		$this->form_validation->set_rules('registry',  'Matrícula',         'required|max_length[20]|is_natural|edit_unique[users.registry.'.$this->session->user_id.']');
		$this->form_validation->set_rules('date_birth','Data de Nascimento','required');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Perfil_model');

			$database = array(
				'name'       => $this->input->post('name',TRUE),
				'email'      => $this->input->post('email',TRUE),
				'identity'   => $this->input->post('identity',TRUE),
				'registry'   => $this->input->post('registry',TRUE),
				'date_birth' => $this->input->post('date_birth',TRUE),
			);
			if ($this->Perfil_model->update_dados($database, $this->session->user_id )) {
				$this->session->set_userdata('user_name', $database['name']);
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

	public function update_senhas() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('current_password', 'Senha Atual',     'required|min_length[6]');
		$this->form_validation->set_rules('new_password',     'Nova Senha',      'required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Confirmar Senha', 'required|matches[new_password]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			// Carrega o arquivo de conexão com o db
			$this->load->model('admin/menu/Perfil_model');

			$database = array(
				'current_password'  => $this->input->post('current_password',TRUE),
				'new_password'      => $this->input->post('new_password',TRUE),
			);
			if ($this->Perfil_model->update_senhas($database, $this->session->user_id )) {
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

	public function update_image() {
		$this->load->library('saida');

		$config['upload_path']   = './uploads/perfil/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '2048';
		$config['remove_spaces'] = TRUE;
		$config['overwrite']     = TRUE;
		$config['encrypt_name']     = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image_profile')) {
			$this->load->model('admin/menu/Perfil_model');
			if ($this->Perfil_model->update_image( $this->upload->data()['file_name'], $this->session->user_id )) {
				$this->session->set_userdata('user_image', $this->upload->data()['file_name']);
				$this->saida->set_dados(array('image_name' => $this->upload->data()['file_name'] ));
			}else {
				$this->saida->set_erro('Erro ao editar.');
			}
		}
		else{
			$this->saida->set_erro($this->upload->display_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function delete_perfil() {
		$this->load->library('saida');
		$this->load->library('form_validation');

		// Regras de validação do formulário
		$this->form_validation->set_rules('password','Senha','required|min_length[6]');

		// Valida as informações do formulário
		if ( $this->form_validation->run() ) {
			$this->load->model('admin/menu/Perfil_model');
			if ($this->Perfil_model->delete_perfil($this->input->post('password'), $this->session->user_id)) {
				$this->session->sess_destroy();
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao Excluir.');
			}
		}// Formulário com erros
		else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
