<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_pagi extends CI_Controller{
	public $data;
	function __construct(){
		parent::__construct();
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
		// Người dùng không đủ quyền => Không được truy cập
		if($this->session->userdata('ss_UserInfo')['level'] > 1){
			redirect('admin');
			exit();
		}
	}
	function index(){
		$this->data['arrPagi'] = $this->Pagi_model->getAllPagi();
		if($this->input->post('btn_admin')){
			$arrUpdate = array();
			$arrInsert = $this->input->post();
			$layout = $arrInsert['layout'];
			$arrUpdate['number'] = $arrInsert['number'];
			$result = $this->Pagi_model->a_UpdatePagi($layout, $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_success', 'Cập nhật thành công');
				redirect('admin/admin_pagi');
				exit();
			}else{
				$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi cập nhật');
			}
		}
		if($this->input->post('btn_public')){
			$arrUpdate = array();
			$arrInsert = $this->input->post();
			$layout = $arrInsert['layout'];
			$arrUpdate['number'] = $arrInsert['number'];
			$result = $this->Pagi_model->a_UpdatePagi($layout, $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_success', 'Cập nhật thành công');
				redirect('admin/admin_pagi');
				exit();
			}else{
				$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi cập nhật');
			}
		}
		$this->data['title'] = "Quản lý phân trang - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	
}