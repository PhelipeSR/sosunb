<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function verify_login($data){

		$this->db->select('
			id,
			name,
			registry,
			identity,
			DATE_FORMAT(`date_birth`, "%d/%m/%Y") AS date_birth,
			email,
			CONCAT("'.base_url('uploads/perfil/').'",image_profile) AS image_profile,
			password
		');
		$this->db->where('email', $data['email']);
		$this->db->where('excluded', 0);
		$result = $this->db->get('users');

		if ($result->num_rows() == 1) {
			$row = $result->row();
			if (password_verify( $data['password'], $row->password)) {
				return $row;
			}else{
				return FALSE;
			}
		}
	}

	public function insert_token_recover($data){
		$this->db->where('email', $data['email'] );
		$this->db->delete('recover');
		if ($this->db->insert('recover', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}