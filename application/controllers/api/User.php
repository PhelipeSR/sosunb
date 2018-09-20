<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function post() {
		$data = array();
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules('nome',            'Nome',                 'required|max_length[100]');
		$this->form_validation->set_rules('email',           'Email',                'required|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('matricula',       'Matrícula',            'required|numeric|is_unique[usuarios.matricula]');
		$this->form_validation->set_rules('rg',              'RG',                   'required|numeric');
		$this->form_validation->set_rules('data_nascimento', 'Data de Nascimento',   'required');
		$this->form_validation->set_rules('senha',           'Senha',                'required|min_length[6]');
		$this->form_validation->set_rules('conf_senha',      'Confirmação de Senha', 'required|matches[senha]');

		if ( $this->form_validation->run() ) {
			$this->load->model('api/User_model');
			$url = 'https://aluno.unb.br/alunoweb/default/sca/solicitarsenha';
			$dados = array(
				'nome' => $this->input->post('nome'),
				'matricula' => $this->input->post('matricula'),
				'identidade' => $this->input->post('rg'),
				'data_nascimento' => $this->input->post('data_nascimento')
			);
			$options = array(
				'http' => array(
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($dados)
				)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);

			$database = array(
				'nome'            => $this->input->post('nome',TRUE),
				'email'           => $this->input->post('email',TRUE),
				'matricula'       => $this->input->post('matricula',TRUE),
				'rg'              => $this->input->post('rg',TRUE),
				'data_nascimento' => $this->input->post('data_nascimento',TRUE),
				'senha'           => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
				'tipo_perfil_id'  => 1,
			);
			if (strpos($result,'Acesso negado') === FALSE) {
				if ($this->User_model->create_user($database) ) {
					$data['dados'] = 'Cadastrado';
				}else {
					$data['erro']['cadastro'] = 'Erro ao realizar adição de usuário.';
				}
			}else{
				$data['erro']['aluno'] = 'Não é aluno da UnB';
			}
		}
		else {
			$data['erro'] =  $this->form_validation->error_array();
		}

		echo json_encode($data);
	}

	public function get() {
		$data = array(
			'mensagem' => 'request get',
		);
		echo json_encode($data);
	}

	public function put($id = null) {
		$data = array(
			'mensagem' => 'Atualizar user com id = ' . $id,
		);
		echo json_encode($data);
	}

	public function delete($id) {
		$data = array(
			'mensagem' => 'Deletar user com id = ' . $id,
		);
		echo json_encode($data);
	}
}
