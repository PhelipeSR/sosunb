<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_demand_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_type_demand($data) {
		if ($this->db->insert('type_demand', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_type_demand() {
		$this->db
			->select('id,demands')
			->where('excluded !=', 1);
		if ( $result = $this->db->get('type_demand')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function update_type_demand($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_demand',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_type_demand($id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_demand',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
