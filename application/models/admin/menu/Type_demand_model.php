<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_demand_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* DATATABLES
	* =====================================================================
	*/

	private $table        = 'type_demand';
	private $colunas      = array('id','demands','excluded');
	private $order_column = array('id','demands','excluded', null);

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'demands',    $this->input->post('search')['value'] )
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

	public function create_type_demand($data) {
		if ($this->db->insert('type_demand', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_type_demand($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_demand',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_type_demand($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_demand',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}