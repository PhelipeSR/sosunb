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
		if ($this->db->insert('type_problem', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_type_problem() {
		$this->db
			->select('*');
		  // ->where(1);
		if ( $result = $this->db->get('type_problem')->row()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

}
