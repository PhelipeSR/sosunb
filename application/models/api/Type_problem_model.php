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

	public function create_type_problem($data) {
		if ($this->db->insert('type_problems', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_type_problem() {
		$this->db
			->select('*')
			->where('excluded !=', 1);
		if ( $result = $this->db->get('type_problems')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function update_type_problem($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_problems',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
