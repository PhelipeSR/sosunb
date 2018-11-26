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
				count(demands.campus_id) AS total_campus,
			')
			->where('demands.excluded',0)
			->group_by("campus.id")
			->join('campus', 'demands.campus_id = campus.id')
			->order_by('total_campus', 'DESC')
			->get('demands')->result_array();

		$category = $this->db->select('id,category')->where('excluded',0)->get('category')->result_array();

		foreach ($category as $key => $value) {
			$aberta = $this->db
				->select('type_problems.type')
				->where('demands.excluded',0)
				->where_in('demands.status_id',array(1,2,3))
				->where('type_problems.category_id',$value['id'])
				->join('type_problems', 'demands.type_problems_id = type_problems.id')
				->join('category', 'type_problems.category_id = category.id')
				->get('demands')->num_rows();
			$fechado = $this->db
				->select('type_problems.type')
				->where('demands.excluded',0)
				->where_in('demands.status_id',array(4,5))
				->where('type_problems.category_id',$value['id'])
				->join('type_problems', 'demands.type_problems_id = type_problems.id')
				->join('category', 'type_problems.category_id = category.id')
				->get('demands')->num_rows();
			$category[$key]['count_aberta'] = $aberta;
			$category[$key]['count_fechado'] = $fechado;
		}

		$type = $this->db->select('id,demands')->where('excluded',0)->get('type_demand')->result_array();

		foreach ($type as $key => $value) {
			$count = $this->db
				->select('type_demand.demands')
				->where('demands.excluded',0)
				->where('type_demand.id',$value['id'])
				->join('type_demand', 'demands.type_demand_id = type_demand.id')
				->get('demands')->num_rows();
			$type[$key]['count'] = $count;
		}

		$dados = array(
			($total_users) ? $total_users : '0',
			($total_demands) ? $total_demands : '0',
			($total_nao_resolvidas) ? $total_nao_resolvidas : '0',
			($demands_campus) ? $demands_campus : '0',
			($category) ? $category : '0',
			($type) ? $type : '0',
		);
		if ($dados){
			return $dados;
		}
		else{
			return FALSE;
		}
	}
}