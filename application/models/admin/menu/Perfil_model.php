<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_dados_user($id = NULL){
		$this->db
			->select('id,name,email,identity,registry,date_birth,image_profile')
			->where('id',$id);
		return $this->db->get('users')->row();
	}

	/*
	* =====================================================================
	* CRUD
	* =====================================================================
	*/

	public function update_dados($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function update_senhas($data, $id) {

		$result = $this->db->select( 'password' )->where('id', $id)->get('users')->row();
		if (password_verify( $data['current_password'], $result->password)) {
			$this->db->where('id', $id);
			if ($this->db->update('users',array('password' => password_hash($data['new_password'], PASSWORD_DEFAULT)))) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function update_image($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',array('image_profile' => $data))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_perfil($senha, $id) {
		$result = $this->db->select('password')->where('id', $id)->get('users')->row();
		if (password_verify( $senha, $result->password)) {

			$result = $this->db->select('*')->where('id',$id)->get('users')->result_array();
			$result[0]['users_id'] = $id;
			$this->db->insert('users_excluded', $result[0]);

			$this->db->where('id', $id);
			if ($this->db->update('users',array(
				'name' => 'Anônimo',
				'registry' => '999999999',
				'identity' => '99999999',
				'date_birth' => '1111-11-11',
				'image_profile' => 'default.png',
				'email' => 'anonimo@anonimo.com',
				'password' => 'vazio',
			))) {
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}