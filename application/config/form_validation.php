<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	required => 1 (o campo é obrigatório)
	max_length => 2 (tamanho máximo incorréto)
	min_length => 3 (tamanho mínimo incorréto)
	numeric => 4 (Não é numérico)
	is_unique => 5 (já existe um registro igual no banco)
	valid_email => 6 (imail inválido)
	matches => 7 (campos não são iguáis)
	not_unb => 8 (não é aluno da UnB)
	erro_banco => 9 (erro genérico do banco)
	login_erro => 10 (dados incorrétos ou usuário excluído)
	exit_field => 11 (Dado não está cadastrado no banco de dados)
*/


$config = array(

	// ========================================
	// User
	// ========================================
	'register' => array(
		array(
			'field'  => 'name',
			'label'  => 'Nome',
			'rules'  => 'required|max_length[100]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2
			),
		),
		array(
			'field' => 'registry',
			'label' => 'Matrícula',
			'rules' => 'required|numeric|is_unique[users.registry]',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
				'is_unique' => 5
			),
		),
		array(
			'field' => 'identity',
			'label' => 'Identidade',
			'rules' => 'required',
			'errors' => array(
				'required' => 1,
			),
		),
		array(
			'field' => 'date_birth',
			'label' => 'Data de Nascimento',
			'rules' => 'required',
			'errors' => array(
				'required' => 1,
			),
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email|is_unique[users.email]',
			'errors' => array(
				'required' => 1,
				'valid_email' => 6,
				'is_unique' => 5
			),
		),
		array(
			'field' => 'password',
			'label' => 'Senha',
			'rules' => 'required|min_length[6]',
			'errors' => array(
				'required' => 1,
				'min_length' => 3,
			),
		),
		array(
			'field' => 'conf_password',
			'label' => 'Confirmação de Senha',
			'rules' => 'required|matches[password]',
			'errors' => array(
				'required' => 1,
				'matches' => 7,
			),
		),
	),
	'update_user' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email',
			'errors' => array(
				'required' => 1,
				'valid_email' => 6,
			),
		),
	),
	'sign_in' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'password',
			'label' => 'Senha',
			'rules' => 'required|min_length[6]',
			'errors' => array(
				'required' => 1,
				'min_length' => 3,
			),
		),
	),
	'recover_password' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|valid_email|exit_field[users.email]',
			'errors' => array(
				'required' => 1,
				'valid_email' => 6,
				'exit_field' => 11,
			),
		),
	),

	// ========================================
	// like
	// ========================================
	'add_like' => array(
		array(
			'field' => 'demands_id',
			'label' => 'id da demanda curtida',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'delete_like' => array(
		array(
			'field' => 'demands_id',
			'label' => 'id da demanda descurtida',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// ========================================
	// coments
	// ========================================
	'add_coments' => array(
		array(
			'field' => 'demands_id',
			'label' => 'id da demanda',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'comment',
			'label' => 'Comentário',
			'rules' => 'required',
			'errors' => array(
				'required' => 1,
			),
		),
	),
	'delete_coments' => array(
		array(
			'field' => 'comment_id',
			'label' => 'ID do Comentário',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// ========================================
	// demands
	// ========================================
	'add_demands' => array(
		array(
			'field' => 'type_problems_id',
			'label' => 'Id do tipo de Problema',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'type_demand_id',
			'label' => 'Id do Tipo de Demanda',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'local_id',
			'label' => 'Id do Local',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		// array(
		// 	'field' => 'image',
		// 	'label' => 'Foto da demanda',
		// 	'rules' => 'max_length[100]',
		// 	'errors' => array(
		// 		'max_length' => 2
		// 	),
		// )
		// array(
		// 	'field' => 'status_id',
		// 	'label' => 'Id do Status',
		// 	'rules' => 'numeric',
		// 	'errors' => array(
		// 		'required' => 1,
		// 		'numeric' => 4,
		// 	),
		// ),
	),
	'delete_demands' => array(
		array(
			'field' => 'demands_id',
			'label' => 'Id da demanda',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// ========================================
	// Pegar Ranking
	// ========================================
	'get_ranking' => array(
		array(
			'field' => 'campus',
			'label' => 'Id do tipo de Problema',
			'rules' => 'numeric',
			'errors' => array(
				'numeric' => 4,
			),
		),
	),
);
