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

	public function get_local($campus,$area) {
		$this->db->select('id,environment')->where('excluded', 0)->where('area_id', $area);
		$environment = $this->db->get('environment')->result();


		if ($area == '2') {
			$this->db->select('id,local')->where('excluded', 0)->where('campus_id', $campus);
			$local = $this->db->get('local')->result();
		}else{
			$local = array();
		}

		return array(
			'environment' => $environment,
			'local' => $local
		);
	}

	public function get_environment($data) {
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
