<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function sign_up() {
		$this->load->model('admin/cadastro_model');
		$this->load->library('form_validation');
		$this->load->library('saida');

		$this->form_validation->set_rules('name',          'Nome',                 'required|max_length[100]');
		$this->form_validation->set_rules('registry',      'Matrícula',            'required|numeric|is_unique[users.registry]');
		$this->form_validation->set_rules('identity',      'Identidade',           'required|numeric');
		$this->form_validation->set_rules('date_birth',    'Data de Nascimento',   'required');
		$this->form_validation->set_rules('email',         'Email',                'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('name',          'Nome',                 'required|max_length[100]');
		$this->form_validation->set_rules('password',      'Senha',                'required|min_length[6]');
		$this->form_validation->set_rules('conf_password', 'Confirmação de Senha', 'required|matches[password]');

		if ( $this->form_validation->run() ) {

			$database = array(
				'name'       => $this->input->post('name'),
				'email'      => $this->input->post('email'),
				'registry'   => $this->input->post('registry'),
				'identity'   => $this->input->post('identity'),
				'date_birth' => $this->input->post('date_birth'),
				'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'profile_type_id' => 1,
			);
			$url = 'https://aluno.unb.br:443/alunoweb/default/sca/solicitarsenha';
			$dados = array(
				'nome' => $database['name'],
				'matricula' => $database['registry'],
				'identidade' => $database['identity'],
				'data_nascimento' => date('d/m/Y',strtotime($database['date_birth']))
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
			if (mb_strpos($result,'alternativo informado abaixo')) {
				if ($result = $this->cadastro_model->create_user($database) ) {
					$this->saida->set_dados('ok');
				}else{
					$this->saida->set_erro('Erro ao Cadastrar');
				}
			}else{
				$this->saida->set_erro('Verifique se os dados estão de acordo com os cadastrados no SAA.');
			}

		}else {
			$this->saida->set_erro(validation_errors());
		}

		// Configuração de saída de dados
		$this->saida->retorno();
	}
}
