<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Support_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "support";
	}
	// Truy vấn support
	function getAll(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Truy vấn support theo id
	function getSupport($id_support){
		$query = $this->db->get_where($this->table, array('id_support' => $id_support));
		return $query->row_array();
	}
	// Cập nhật thông tin
	function a_Update($id_support, $arrData){
		$this->db->where('id_support', $id_support);
		return $this->db->update($this->table, $arrData);
	}
}