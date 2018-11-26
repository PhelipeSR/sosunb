<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands extends CI_Controller {

	public function get_demans_info() {
		$this->load->model('api/Get_demands_model');
		$this->load->library('saida');

		$demands_id = $this->input->post('id',TRUE);

		if ($result = $this->Get_demands_model->single($this->session->user_id, $demands_id, FALSE) ) {
			$this->saida->set_dados($result);
		}else{
			$this->saida->set_erro('Erro ao buscar demanda.');
		}

		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function process_complaint(){
		$this->load->model('admin/Demands_model');
		$this->load->library('saida');

		$id = $this->input->post('id',TRUE);
		$remove = $this->input->post('remove',TRUE);

		if ($this->Demands_model->process_complaint($id,$remove) ) {
			$this->saida->set_dados($id);
		}else{
			$this->saida->set_erro('Erro ao processar reclamação.');
		}

		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
