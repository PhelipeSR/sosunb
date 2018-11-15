<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_info() {

		$total_users = $this->db->select('id')->where('excluded', 0)->get('users')->num_rows();
		$total_demands = $this->db->select('id')->where('excluded', 0)->get('demands')->num_rows();
		$total_nao_resolvidas = $this->db->select('id')->where('excluded', 0)->where('status_id !=', 4)->where('status_id !=', 5)->get('demands')->num_rows();

		$demands_campus = $this->db
			->select('
				campus.campus,
				count(demands.local_id) AS total_campus,
			')
			->where('demands.excluded',0)
			->group_by("campus.id")
			->join('local', 'demands.local_id = local.id')
			->join('campus', 'local.campus_id = campus.id')
			->order_by('total_campus', 'DESC')
			->get('demands')->result_array();


		$category = $this->db->select('id,category')->where('excluded',0)->get('category')->result_array();

		// foreach ($category as $key => $value) {
		// 	$fechado = $this->db
		// 		->select('demands.id')
		// 		->where('demands.excluded',0)
		// 		->where('type_problems.category_id',$value['id'])
		// 		->join('type_problems', 'demands.type_problems_id = type_problems.id')
		// 		->join('category', 'type_problems.category_id = category.id')
		// 		->get('demands')->result_array();
		// }
		$category_aberta = $this->db
			->select('
				category.category,
				count(demands.type_problems_id) AS category_aberta,
			')
			->where('demands.excluded',0)
			->where_in('demands.status_id',array(1,2,3))
			->group_by("category.id")
			->join('type_problems', 'demands.type_problems_id = type_problems.id')
			->join('category', 'type_problems.category_id = category.id')
			->order_by('category_aberta', 'DESC')
			->get('demands')->result_array();

		$category_resolvida = $this->db
			->select('
				category.category,
				count(demands.type_problems_id) AS category_resolvida,
			')
			->where('demands.excluded',0)
			->where_in('demands.status_id',array(4,5))
			->group_by("category.id")
			->join('type_problems', 'demands.type_problems_id = type_problems.id')
			->join('category', 'type_problems.category_id = category.id')
			->order_by('category_resolvida', 'DESC')
			->get('demands')->result_array();

		$dados = array(
			($total_users) ? $total_users : '0',
			($total_demands) ? $total_demands : '0',
			($total_nao_resolvidas) ? $total_nao_resolvidas : '0',
			($demands_campus) ? $demands_campus : '0',
			($category_aberta) ? $category_aberta : '0',
			($category_resolvida) ? $category_resolvida : 0,
		);
		if ($dados){
			return $dados;
		}
		else{
			return FALSE;
		}
	}
}