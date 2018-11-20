<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_problem_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function get_type_problem() {
		$this->db
			->select('type_problems.id, type_problems.type, category.category')
			->join('category', 'type_problems.category_id = category.id')
			->where('type_problems.excluded', 0);
		if ( $result = $this->db->get('type_problems')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}
