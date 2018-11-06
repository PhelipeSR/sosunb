<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Environment_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* DATATABLES
	* =====================================================================
	*/

	private $table        = 'environment';
	private $colunas      = array('environment.id','environment.environment','area.area','environment.area_id','environment.excluded');
	private $order_column = array('environment.id','environment.environment','area.area',null);

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);
		$this->db->join('area', 'environment.area_id = area.id');

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'environment.environment', $this->input->post('search')['value'] )
						->or_like( 'area.area',               $this->input->post('search')['value'] )
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

	public function create_environment($data) {
		if ($this->db->insert('environment', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_environment($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('environment',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_environment($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('environment',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_area(){
		$this->db->select('id,area')->where('excluded !=', 1)->order_by('area', 'ASC');
		if ( $result = $this->db->get('area')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}