<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Pagi_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "pagi";
	}
	// Truy vấn phân trang
	function getAllPagi(){
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Cập nhật phân trang
	function a_UpdatePagi($layout, $arrData){
		$this->db->where('layout',$layout);
		return $this->db->update($this->table, $arrData);
	}
	// Lấy số lượng bài viết / trang admin
	function getPagiAdmin(){
		$this->db->select('number');
		$query = $this->db->get_where($this->table, array('layout' => 'admin'));
		return $query->row_array();
	}
	// Lấy số lượng bài viết / trang public
	function getPagiPublic(){
		$this->db->select('number');
		$query = $this->db->get_where($this->table, array('layout' => 'public'));
		return $query->row_array();
	}
}