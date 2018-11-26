<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

	public function render() {
		$this->load->model('api/Status_model');
		$status = $this->Status_model->get_status();
		$this->load->view('admin/menu/feed', array('status' => $status));
	}

	public function get_feed() {
		$this->load->model('api/Get_demands_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('get_feed') ) {
			$limit = $this->input->post('limit');
			$status = $this->input->post('status');
			if ($result = $this->Get_demands_model->feed($this->session->user_id,$limit,$status) ) {
				$this->saida->set_dados($result);
			}else {
				$this->saida->set_erro('Sem demandas para mostrar.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
