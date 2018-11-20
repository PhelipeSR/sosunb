<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	private $status_header = 400;
	private $response = array();

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('api/Session_model');
	}

	// Verifica login do usuário
	public function login() {
		if ( $this->form_validation->run('sign_in') ) {

			$database = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			if ($result = $this->Session_model->verify_login($database) ) {
				$payload = array(
					'iss' => base_url(),
					'sub' => $result->id,
					'exp' => strtotime('1 day'),
					'iat' => time(),
					'user' => $result->name,
				);
				$jwt = $this->jwt->encode($payload);
				$this->response['dados'] = 'logado';
				$this->response['token'] = $jwt;
				$this->status_header = 200;
			}else{
				$this->response['erro']['login'] = 10;
			}
		}else {
			$this->response['erro'] = $this->form_validation->error_array();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}

	// Verifica se o email existe para recuperação de senha
	public function recover_password() {
		if ( $this->form_validation->run('recover_password') ) {

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
				'link' => base_url('/session/validation/'.$database['token'])
			);
			$this->email->message($this->load->view('email/recuperacao',$dados,TRUE));

			if ($this->email->send()) {
				if ($this->Session_model->insert_token_recover($database) ) {
					$this->response['dados'] = 'enviado';
					$this->status_header = 200;
				}else{
					$this->response['erro']['login'] = 10;
				}
			}else{
				$this->response['erro']['login'] = 'erro_send_email';
			}

		}else {
			$this->response['erro'] = $this->form_validation->error_array();
		}

		$this->output
			->set_content_type('application/json')
			->set_status_header($this->status_header)
			->set_output(json_encode($this->response));
	}
}
