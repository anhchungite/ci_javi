<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_page extends CI_Controller{
	public $data;
	function __construct(){
		parent::__construct();
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
		$this->load->Model('Page_model');
	}
	function index(){
		$this->data['arrPage'] = $this->Page_model->getAllPage();
		$this->data['title'] = "Quản lý trang - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function add(){
		// Người dùng không đủ quyền => Không được truy cập
		if($this->session->userdata('ss_UserInfo')['level'] > 1){
			redirect('admin');
			exit();
		}
		$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
		if($this->form_validation->run('page') == TRUE){
			// Xử lý sự kiện button addPage
			if($this->input->post('addPage')){
				$arrInsert = array();
				$arrInput = $this->input->post();
				$arrInsert['name_page']		= $arrInput['tieude'];
				$arrInsert['url_page']		= convertUrl($arrInput['tieude']);
				$arrInsert['detail_page']	= $arrInput['noidung'];
				$arrInsert['status_page']	= $arrInput['trangthai'];
				// Xử lý thêm mới trang
				$result = $this->Page_model->a_AddPage($arrInsert);
				if($result){
					$this->session->set_flashdata('flash_success', 'Thêm trang thành công');
					redirect('admin/admin_page');
					exit();
				}else{
					$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm trang');
				}
			}
		}
		
		$this->data['title'] = "Thêm trang - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function edit($id_page){
		// Người dùng không đủ quyền => Không được truy cập
		if($this->session->userdata('ss_UserInfo')['level'] > 1){
			redirect('admin');
			exit();
		}
		$this->data['arrPage'] = $this->Page_model->getPage($id_page);
		// Kiểm tra tồn tại
		if(count($this->data['arrPage']) <=0){
			redirect('admin/admin_page');
			exit();
		}
		$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
		
			// Xử lý sự kiện button editPage
			if($this->input->post('editPage')){
				if($this->form_validation->run('page') == TRUE){
					$arrUpdate = array();
					$arrInput = $this->input->post();
					$arrUpdate['name_page']		= $arrInput['tieude'];
					$arrUpdate['url_page']		= convertUrl($arrInput['tieude']);
					$arrUpdate['detail_page']	= $arrInput['noidung'];
					$arrUpdate['status_page']	= $arrInput['trangthai'];
					// Xử lý thêm mới trang
					$result = $this->Page_model->a_EditPage($id_page, $arrUpdate);
					if($result){
						$this->session->set_flashdata('flash_success', 'Sửa trang thành công');
						redirect('admin/admin_page');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa trang');
					}
				}
			}
		
		
		$this->data['title'] = "Sửa trang - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function del($id_page){
		// Người dùng không đủ quyền => Không được truy cập
		if($this->session->userdata('ss_UserInfo')['level'] > 1 || $id_page == 1 || $id_page == 2){
			redirect('admin');
			exit();
		}
		$arrPage = $this->Page_model->getPage($id_page);
		// Kiểm tra tồn tại
		if(count($arrPage) <=0){
			redirect('admin/admin_page');
			exit();
		}
		$result = $this->Page_model->a_DelPage($id_page);
		if($result){
			$this->session->set_flashdata('flash_success', 'Xóa trang thành công');
			redirect('admin/admin_page');
			exit();
		}
	}
}