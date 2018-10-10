<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Likes_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_like($data) {
		if ($this->db->insert('likes', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}



	public function delete_like($id) {
		$this->db->where('id', $id);
		if ($this->db->update('likes',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
