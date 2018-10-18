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
	name

*/


$config = array(
	// user
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
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'date_birth',
			'label' => 'Data de Aniversário',
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
			'label' => 'Senha',
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

	// type-problem
	'add_type_problem' => array(
		array(
			'field' => 'type',
			'label' => 'Tipo de Problema',
			'rules' => 'required|max_length[50]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
	),
	'update_type_problem' => array(
		array(
			'field' => 'type',
			'label' => 'Tipo de Problema',
			'rules' => 'required|max_length[50]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
		array(
			'field' => 'id',
			'label' => 'id do Tipo de Problema',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'delete_type_problem' => array(
		array(
			'field' => 'id',
			'label' => 'id do Tipo de Problema',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// status
	'add_status' => array(
		array(
			'field' => 'name',
			'label' => 'Nome Status',
			'rules' => 'required|max_length[50]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
	),
	'update_status' => array(
		array(
			'field' => 'name',
			'label' => 'Nome do Status',
			'rules' => 'required|max_length[50]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
		array(
			'field' => 'id',
			'label' => 'id do Status',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'delete_status' => array(
		array(
			'field' => 'id',
			'label' => 'id do Status',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// type-demand
	'add_type_demand' => array(
		array(
			'field' => 'demands',
			'label' => 'Tipo de Demanda',
			'rules' => 'required|max_length[100]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
	),
	'update_type_demand' => array(
		array(
			'field' => 'demands',
			'label' => 'Tipo de Demanda',
			'rules' => 'required|max_length[100]',
			'errors' => array(
				'required' => 1,
				'max_length' => 2,
			),
		),
		array(
			'field' => 'id',
			'label' => 'ID do Tipo de Demanda',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'delete_type_demand' => array(
		array(
			'field' => 'id',
			'label' => 'id do Tipo de Demanda',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),

	// Like
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

	// Coments
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
		array(
			'field' => 'users_id',
			'label' => 'ID do Usuário',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'update_coments' => array(
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
		array(
			'field' => 'users_id',
			'label' => 'ID do Usuário',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
	'delete_coments' => array(
		array(
			'field' => 'coment_id',
			'label' => 'ID do Comentário',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
		array(
			'field' => 'users_id',
			'label' => 'ID do Usuário',
			'rules' => 'required|numeric',
			'errors' => array(
				'required' => 1,
				'numeric' => 4,
			),
		),
	),
//demamds
	'add_demands' => array(
		array(
			'field' => 'title',
			'label' => 'Título da Demanda',
			'rules' => 'max_length'[50],
			'errors' => array(
				'max_length' => 2,
			),
		),
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
	array(
				'field' => 'status_id',
				'label' => 'Id do Status',
				'rules' => 'required|numeric',
				'errors' => array(
					'required' => 1,
					'numeric' => 4,
				),
			),

		),
);
