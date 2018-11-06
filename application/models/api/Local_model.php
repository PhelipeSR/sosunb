<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_local($data) {
		if ($this->db->insert('local', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_local($campus,$area) {
		$this->db
			->select('id AS local_id, local')
			->where('excluded !=', 1)
			->where('campus', $campus)
			->where('area', $area);
		if ( $result = $this->db->get('local')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function update_local($data) {
		$this->db->where('id', $data['id']);
		if ($this->db->update('local',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_local($id) {
		$this->db->where('id', $id);
		if ($this->db->update('local',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
