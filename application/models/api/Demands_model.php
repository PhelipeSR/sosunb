<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function create_demands($data) {
		if ($this->db->insert('demands', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function delete_demands($demands_id, $users_id) {

		$this->db->where('id', $demands_id);
		$this->db->where('users_id', $users_id);
		$this->db->where('status_id', 1);
		if ($this->db->update('demands',array('excluded' => 1))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function report_demands($id) {
		if ($this->db->set('counter', 'counter + 1',FALSE)->where('id',$id)->update('demands')) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
