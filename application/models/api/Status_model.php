<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_status($data) {
		if ($this->db->insert('status', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function get_status() {
		$this->db
			->select('*')
			->where('excluded !=', 1);
		if ( $result = $this->db->get('status')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function update_status($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('status',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_status($id) {
		$this->db->where('id', $id);
		if ($this->db->update('status',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
