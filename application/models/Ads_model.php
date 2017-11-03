<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Ads_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "ads";
	}
	function showAds(){
		$this->db->order_by('order','ASC');
		$this->db->where('status_ads', 1);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	//====================> ADMIN <=====================//
	// Truy vấn tất cả ads
	function getAll(){
		$this->db->order_by('order','ASC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Truy vấn ads theo id
	function getAds($id_ads){
		$query = $this->db->get_where($this->table, array('id_ads' => $id_ads));
		return $query->row_array();
	}
	// Thêm quảng cáo
	function a_Add($arrData){
		return $this->db->insert($this->table, $arrData);
	}
	// Cập nhật thông tin
	function a_Update($id_ads, $arrData){
		$this->db->where('id_ads', $id_ads);
		return $this->db->update($this->table, $arrData);
	}
	// Xóa từng ads theo id
	function a_Delete($id_ads){
		$this->db->where('id_ads', $id_ads);
		return $this->db->delete($this->table);
	}
	// Xóa hàng loạt
	function a_MulDelete($arrID){
		$this->db->where_in('id_ads', $arrID);
		return $this->db->delete($this->table);
	}
	// Truy vấn tên hình để unlink hàng loạt
	function a_MulUnlink($arrID){
		$this->db->select('pic_ads');
		$this->db->where_in('id_ads', $arrID);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Vô hiệu hóa hàng loạt
	function a_MulUpdate($arrID, $arrData){
		$this->db->where_in('id_ads', $arrID);
		return $this->db->update($this->table, $arrData);
	}
}