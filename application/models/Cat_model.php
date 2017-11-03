<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Cat_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "category";
	}
	// Truy vấn danh mục theo id
	function getCat($id_cat){
		$query = $this->db->get_where($this->table, array('id_cat' => $id_cat));
		return $query->row_array();
	}
	// Truy vấn tất cả danh mục
	function getAllCat(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	//============> ADMIN <=========//
	// Thống kê danh mục
	function count(){
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	// Thêm danh mục
	function a_AddCat($arrData){
		return $this->db->insert($this->table, $arrData);
	}
	// Sửa danh mục
	function a_EditCat($id_cat, $arrData){
		$this->db->where('id_cat', $id_cat);
		return $this->db->update($this->table, $arrData);
	}
	// Xóa danh mục
	function a_DelCat($id_cat){
		$this->db->where('id_cat', $id_cat);
		return $this->db->delete($this->table);
	}
}