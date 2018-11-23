<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* DATATABLES
	* =====================================================================
	*/

	private $table        = 'local';
	private $colunas      = array('local.id','local.local','campus.campus','local.campus_id','local.excluded');
	private $order_column = array('local.id','local.local','campus.campus',null);

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);
		$this->db->join('campus', 'local.campus_id = campus.id');

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'local.local',             $this->input->post('search')['value'] )
						->or_like( 'campus.campus',           $this->input->post('search')['value'] )
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
			->from($this->table)
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

	public function update_local($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('local',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_local($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('local',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_campus(){
		$this->db->select('id,campus')->where('excluded !=', 1)->order_by('campus', 'ASC');
		if ( $result = $this->db->get('campus')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}