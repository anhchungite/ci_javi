<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Contact_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "contact";
	}
	
	// Gửi thông tin
	function send($arrData){
		return $this->db->insert($this->table, $arrData);
	}
	// Hiển thị các contact
	function show($page, $rows_page, $status){
		$offset = $page * $rows_page - $rows_page;
		$this->db->select('id_contact,name,email,date_format(date, "%d-%m-%Y") as date,status');
		if($status != 'all'){
			$this->db->where('status', $status);
		}
		$this->db->order_by('id_contact', 'desc');
		$this->db->limit($rows_page, $offset);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Phân trang
	function NumRow($status){
		if($status != 'all'){
			$this->db->where('status', $status);
		}
		$query = $this->db->get($this->table);
		return  $query->num_rows();
	}
	// Hiển thị chi tiet contact
	function detail($id_contact){
		$this->db->select('id_contact,name,email,date_format(date, "%H:%i:%s | %d-%m-%Y") as date,phone,website,content');
		$query = $this->db->get_where($this->table, array('id_contact' => $id_contact));
		return $query->row_array();
	}
	// Update trạng thái contact
	function update($id_contact, $arrData){
		$this->db->where('id_contact', $id_contact);
		return $this->db->update($this->table, $arrData);
	}
	// Update trạng thái contact hàng loạt
	function updateAll($arrID, $arrData){
		$this->db->where_in('id_contact', $arrID);
		return $this->db->update($this->table, $arrData);
	}
	// Xóa contact
	function del($id_contact){
		$this->db->where('id_contact', $id_contact);
		return $this->db->delete($this->table);
	}
	// Xóa hàng loạt
	function delAll($arrID){
		$this->db->where_in('id_contact', $arrID);
		return $this->db->delete($this->table);
	}
	// Hiển thị các trạng thái chưa đọc
	function unread(){
		$this->db->where('status',0);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
}