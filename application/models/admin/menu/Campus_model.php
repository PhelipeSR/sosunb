<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* DATATABLES
	* =====================================================================
	*/

	private $table        = 'campus';
	private $colunas      = array('id','campus','excluded');
	private $order_column = array('id','campus','excluded', null);

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'campus',    $this->input->post('search')['value'] )
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

	public function create_campus($data) {
		if ($this->db->insert('campus', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_campus($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('campus',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_campus($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('campus',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
}