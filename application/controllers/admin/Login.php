<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->logado == true) {
			if ($this->session->user_type == 1) {
				$this->load->view('admin/user');
			}else if ($this->session->user_type == 2) {
				$this->load->view('admin/admin');
			}else if ($this->session->user_type == 3) {
				$this->load->view('admin/manager');
			}
		}else{
			$this->load->view('admin/login');
		}
	}

	public function sign_in() {
		$this->load->model('admin/login_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Senha', 'required|min_length[6]');

		if ( $this->form_validation->run() ) {

			$database = array(
				'email' => $this->input->post('email',TRUE),
				'password' => $this->input->post('password',TRUE)
			);

			if ($result = $this->login_model->verify_login($database) ) {
				$this->session->set_userdata(array(
					'logado' => TRUE,
					'user_id' => $result->id,
					'user_type' => $result->profile_type_id
				));
				$this->saida->set_dados(array('user_type' => $result->profile_type_id));
			}else{
				$this->saida->set_erro('Usuário ou senha inválido');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}

		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function sign_out() {
		$this->session->sess_destroy();
		redirect(base_url('admin/login/'));
	}
}
