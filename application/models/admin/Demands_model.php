<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demands_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_complaint() {
		$this->db->select('demands.id,demands.title,demands.counter,demands.image');
		$this->db->where('demands.counter >', 4);
		$this->db->where('demands.resolved', 0);
		if ($result = $this->db->get('demands')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
	public function get_demans_info_by_id($id) {
		$this->db->select('demands.id,demands.title,demands.counter,demands.image');
		$this->db->where('demands.id', $id);
		$this->db->join('users', 'users.id = demands.users_id');
		if ($result = $this->db->get('demands')->row()){
			return $result;
		}
		else{
			return FALSE;
		}
	}

	public function process_complaint($id, $remove) {
		if ($remove) {
			if ($this->db->delete('demands', array('id' => $id)) ) {
				return TRUE;
			}
			else{
				return FALSE;
			}
		}else{
			$this->db->where('id', $id);
			if ($this->db->update('demands',array('resolved' => 1))) {
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
}