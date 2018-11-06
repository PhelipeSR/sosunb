<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function index() {
		$this->load->view('admin/cadastro',array('navCadastro' => TRUE));
	}

	public function not_found() {
		$this->output
				->set_content_type('application/json')
				->set_status_header(404);
	}
}
