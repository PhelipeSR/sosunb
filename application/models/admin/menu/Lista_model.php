<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	private $table        = 'users';
	private $colunas      = array('users.id','users.image_profile','users.name','users.email','users.registry','users.identity','DATE_FORMAT(`date_birth`, "%d/%m/%Y") AS date_birth','DATE_FORMAT(`register_date`, "%d/%m/%Y") AS register_date','profile_type.type','users.excluded','users.profile_type_id','users.date_birth AS date_birth_nf');
	private $order_column = array('users.id', NULL,                'users.name','users.email','users.registry','users.identity','users.date_birth','users.register_date','profile_type.type',NULL,'users.excluded','users.profile_type_id');

	private $table_exclude        = 'users_excluded';
	private $colunas_exclude      = array('users_excluded.id','users_excluded.image_profile','users_excluded.name','users_excluded.email','users_excluded.registry','users_excluded.identity','DATE_FORMAT(`date_birth`, "%d/%m/%Y") AS date_birth','DATE_FORMAT(`register_date`, "%d/%m/%Y") AS register_date','profile_type.type','DATE_FORMAT(`date_excluded`, "%d/%m/%Y %H:%i") AS date_excluded','users_excluded.excluded','users_excluded.profile_type_id','users_excluded.date_birth AS date_birth_nf');
	private $order_column_exclude = array('users_excluded.id', NULL,                         'users_excluded.name','users_excluded.email','users_excluded.registry','users_excluded.identity','users_excluded.date_birth','users_excluded.register_date','profile_type.type','users_excluded.date_excluded',NULL,'users_excluded.excluded','users_excluded.profile_type_id');

	/*
	* =====================================================================
	* DATATABLES USUÁRIOS ATIVOS
	* =====================================================================
	*/

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);
		$this->db->where('users.id !=', $this->session->user_id)->where('users.password !=', 'vazio');
		$this->db->join('profile_type', 'users.profile_type_id = profile_type.id', 'left');

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'users.name', $this->input->post('search')['value'] )
						->or_like( 'users.email',$this->input->post('search')['value'] )
					->group_end();
		}

		if ( $this->input->post('order') ) {
			$this->db->order_by( $this->order_column[ $this->input->post('order')['0']['column'] ], $this->input->post('order')['0']['dir'] );
		}else{
			$this->db->order_by( 'id', 'DESC' );
		}
	}

	public function count_filtered_data(){
		$this->query_builder();
		return $this->db->get()->num_rows();
	}

	public function count_all_data(){
		return $this->db
			->from($this->table)->where('users.id !=', $this->session->user_id)->where('users.password !=', 'vazio')
			->count_all_results();
	}

	public function data(){
		if ( $this->input->post( 'length') != -1) {
			$this->db->limit( $this->input->post( 'length'), $this->input->post('start'));
		}
		$this->query_builder();
		return $this->db->get()->result();
	}

	/*
	* =====================================================================
	* DATATABLES USUÁRIOS EXCLUIDOS
	* =====================================================================
	*/

	public function query_builder_exclude(){

		$this->db->select($this->colunas_exclude);
		$this->db->from($this->table_exclude);
		$this->db->join('profile_type', 'users_excluded.profile_type_id = profile_type.id', 'left');

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'users_excluded.name', $this->input->post('search')['value'] )
						->or_like( 'users_excluded.email',$this->input->post('search')['value'] )
					->group_end();
		}

		if ( $this->input->post('order') ) {
			$this->db->order_by( $this->order_column_exclude[ $this->input->post('order')['0']['column'] ], $this->input->post('order')['0']['dir'] );
		}else{
			$this->db->order_by( 'id', 'DESC' );
		}
	}

	public function count_filtered_data_exclude(){
		$this->query_builder_exclude();
		return $this->db->get()->num_rows();
	}

	public function count_all_data_exclude(){
		return $this->db
			->from($this->table_exclude)
			->count_all_results();
	}

	public function data_exclude(){
		if ( $this->input->post( 'length') != -1) {
			$this->db->limit( $this->input->post( 'length'), $this->input->post('start'));
		}
		$this->query_builder_exclude();
		return $this->db->get()->result();
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

	public function delete_user($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('users',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_tipo_user(){
		$this->db->select('id,type')->where('excluded !=', 1)->order_by('type', 'ASC');
		if ( $result = $this->db->get('profile_type')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}