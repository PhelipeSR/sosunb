<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands extends CI_Controller {

	public function add_like() {
		$this->load->model('api/Likes_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('add_like') ) {
			$database = array(
				'users_id' => $this->session->user_id,
				'demands_id' => $this->input->post('demands_id')
			);
			if ($this->Likes_model->create_like($database) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao dar like.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function delete_like() {
		$this->load->model('api/Likes_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('delete_like') ) {
			if ($this->Likes_model->delete_like($this->input->post('demands_id'), $this->session->user_id ) ) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao excluir like.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function delete_demands() {
		$this->load->model('api/Demands_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('delete_demands') ) {
			if($this->Demands_model->delete_demands($this->input->post('demands_id'), $this->session->user_id)){
				$this->saida->set_dados('ok');
			}else{
				$this->saida->set_erro('Erro ao excluir demanda.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function report_demands() {
		$this->load->model('api/Demands_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('report_demands') ) {
			if($this->Demands_model->report_demands($this->input->post('demands_id'), $this->session->user_id)){
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao denunciar demanda.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	public function add_coments() {
		$this->load->model('api/Coments_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('add_coments') ) {
			$database = array(
				'comment' => $this->input->post('comment'),
				'demands_id' => $this->input->post('demands_id'),
				'users_id' => $this->session->user_id,
			);
			if ($id = $this->Coments_model->create_coments($database) ) {
				$this->saida->set_dados($id);
			}else {
				$this->saida->set_erro('Erro ao adicionar comentário.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}

	// Deletar comentário
	public function delete_coments() {
		$this->load->model('api/Coments_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		if( $this->form_validation->run('delete_coments') ) {
			$database = array(
				'comment_id' => $this->input->post('comment_id'),
				'users_id' => $this->session->user_id
			);
			if ($this->Coments_model->delete_coments($database)) {
				$this->saida->set_dados('ok');
			}else {
				$this->saida->set_erro('Erro ao excluir comentário.');
			}
		}else {
			$this->saida->set_erro(validation_errors());
		}
		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
