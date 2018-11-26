<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		if ($this->session->logado == true) {
			if ($this->session->user_type == 1) {
				$this->load->view('admin/user');
			}else if ($this->session->user_type == 2) {
				$this->load->model('admin/Demands_model');
				$this->load->model('admin/Admin_model');
				$complaint = $this->Demands_model->get_complaint();
				$info = $this->Admin_model->get_info();
				$this->load->view('admin/admin',array(
					'complaint' => $complaint,
					'info' => $info,
				));
			}else if ($this->session->user_type == 3) {
				$this->load->view('admin/manager');
			}
		}else{
			redirect(base_url());
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
					'user_type' => $result->profile_type_id,
					'user_name' => $result->name,
					'user_image' => $result->image_profile,
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

	public function recover_password() {
		$this->load->model('api/Session_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|exit_field[users.email]', array('exit_field' => 'Email não cadastrado.'));

		if ( $this->form_validation->run() ) {

			$database = array(
				'email' => $this->input->post('email'),
				'token' => sha1(uniqid( mt_rand(), true)),
				'expiration_date' => date('Y-m-d H:i:s', strtotime('+1 day'))
			);

			$this->load->library('email');

			$this->email->from('sosunb.comunicacao@gmail.com', 'SOS UnB');
			$this->email->to($database['email']);
			$this->email->subject('Recuperação de Conta - SOS UnB');
			$this->email->message('Testando');

			$dados = array(
				'link' => base_url('/recuperar/'.$database['token'])
			);
			$this->email->message($this->load->view('email/recuperacao',$dados,TRUE));

			if ($this->email->send()) {
				if ($this->Session_model->insert_token_recover($database) ) {
					$this->saida->set_dados('enviado');
				}else{
					$this->saida->set_erro('Erro ao processar pedido.');
				}
			}else{
				$this->saida->set_erro('Erro ao enviar email.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}

		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function sign_out() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
