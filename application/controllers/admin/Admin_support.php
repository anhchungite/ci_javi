<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_support extends CI_Controller{
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
		$this->load->model('Support_model');
	}
	function index(){
		$this->data['arrSP'] = $this->Support_model->getAll();
		$this->data['title'] = "Cài đặt hỗ trợ - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function edit($id_support){
		$this->data['arrSP'] = $this->Support_model->getSupport($id_support);
		// Kiểm tra tồn tại
		if(count($this->data['arrSP']) <=0){
			redirect('admin/admin_support');
			exit();
		}
		if($this->input->post('editSupport')){
			$arrInput = $this->input->post();
			$arrUpdate = array();
			$arrUpdate['name_support'] = $arrInput['name_sp'];
			$arrUpdate['facebook_support'] = $arrInput['facebook_sp'];
			$arrUpdate['skype_support'] = $arrInput['skype_sp'];
			$result = $this->Support_model->a_Update($id_support, $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_success', 'Sửa thông tin thành công');
				redirect('admin/admin_support');
				exit();
			}else{
				$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa thông tin');
			}
		}
		$this->data['title'] = "Cài đặt hỗ trợ - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
}