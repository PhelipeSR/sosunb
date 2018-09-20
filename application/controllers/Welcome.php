<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$this->load->helper('url');
		$this->load->view('welcome_message');
	}

	public function not_found() {
		$data = array(
			'mensagem' => 'Erro 404',
		);
		$this->output
				->set_content_type('application/json')
				->set_status_header(400)
				->set_output(json_encode($data));
	}
}
