<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function render() {
		$this->load->model('api/Campus_model');
		$this->load->view('admin/menu/ranking', array(
			'campus' => $this->Campus_model->get_campus()
		));
	}

	public function get_ranking() {
		$this->load->model('api/Get_demands_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('get_ranking') ) {
			$campus = $this->input->post('campus');
			if ($result = $this->Get_demands_model->ranking($this->session->user_id, $campus) ) {
				$this->saida->set_dados($result);
			}else {
				$this->saida->set_erro('Erro ao pegar ranking.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
