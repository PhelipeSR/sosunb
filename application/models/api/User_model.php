<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_user($data) {
		if ($this->db->insert('users', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_user($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_user($id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}