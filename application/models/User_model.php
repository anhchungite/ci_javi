<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class User_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "users";
	}
	// Thống kê người dùng
	function count(){
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	// Truy vấn người dùng theo id / Kiểm tra tồn tại người dùng theo id
	function getUser($id_user){
		$query = $this->db->get_where($this->table, array('id_user' => $id_user));
		return $query->row_array();
	}
	// Truy vấn tất cả người dùng
	function getAllUser(){
		$this->db->order_by('level','ASC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Kiểm tra đăng nhập
	function a_Login($username, $password){
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password));
		return $query->row_array();
	}
	// Kiểm tra tồn tại người dùng theo username
	function a_ckUser($username){
		$query = $this->db->get_where($this->table, array('username' => $username));
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}
	// Tra tồn taik Email (validation)
	function a_ckEmail($email){
		$this->db->where('email',$email);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}
	// Kiểm tra tồn tại password theo id (Chức năng đổi mật khẩu)
	function a_ckPass($password, $id_user){
		$query = $this->db->get_where($this->table, array('password' => $password, 'id_user' => $id_user));
		if($query->num_rows() > 0){
			return true;
		}else {
			return false;
		}
	}
	// Cập nhật mật khẩu (Chức năng đổi mật khẩu)
	function a_EditPass($id_user, $arrData){
		$this->db->where('id_user', $id_user);
		return $this->db->update($this->table, $arrData);
	}
	// Thêm người dùng
	function a_AddUser($arrData){
		return $this->db->insert($this->table, $arrData);
	}
	// Sửa người dùng
	function a_EditUser($id_user, $arrData){
		$this->db->where('id_user', $id_user);
		return $this->db->update($this->table, $arrData);
	}
	// Xóa người dùng
	function a_DelUser($id_user){
		$this->db->where('id_user', $id_user);
		return $this->db->delete($this->table);
	}
}