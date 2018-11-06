<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_problem_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	* =====================================================================
	* DATATABLES
	* =====================================================================
	*/

	private $table        = 'type_problems';
	private $colunas      = array('type_problems.id','type_problems.type','category.category','type_problems.category_id','type_problems.excluded');
	private $order_column = array('type_problems.id','type_problems.type','category.category',null);

	public function query_builder(){

		$this->db->select($this->colunas);
		$this->db->from($this->table);
		$this->db->join('category', 'type_problems.category_id = category.id');

		if (isset($_POST['search']['value'])) {
			$this->db
					->group_start()
						->like(    'type_problems.type', $this->input->post('search')['value'] )
						->or_like( 'category.category', $this->input->post('search')['value'] )
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

	public function create_type_problem($data) {
		if ($this->db->insert('type_problems', $data)){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function update_type_problem($data, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_problems',$data)) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete_type_problem($excluded, $id) {
		$this->db->where('id', $id);
		if ($this->db->update('type_problems',array('excluded' => $excluded))) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_category(){
		$this->db->select('id,category')->where('excluded !=', 1)->order_by('category', 'ASC');
		if ( $result = $this->db->get('category')->result()){
			return $result;
		}
		else{
			return FALSE;
		}
	}
}