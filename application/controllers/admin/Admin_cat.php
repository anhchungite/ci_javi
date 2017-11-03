<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin_cat extends CI_Controller {
	public $data;
	function __construct() {
		parent::__construct ();
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
	}
	function index() {
		$this->data ['arrCat'] = $this->Cat_model->getAllCat ();
		$this->data ['title'] = "Quản lý danh mục - Javi Admin";
		$this->load->view ( "layout/admin/layout", $this->data );
	}
	function add() {
		// Nếu người dùng không đủ quyền => không được thêm
		if ($this->session->userdata ( 'ss_UserInfo' ) ['level'] > 1) {
			redirect ( 'admin/admin_cat' );
			exit ();
		}
		if($this->form_validation->run('cat') == TRUE){
			// Xử lý sự kiện button addCat
			if ($this->input->post ( 'addCat' )) {
				
				$arrInsert = array ();
				$arrInput = $this->input->post ();
				$arrInsert ['name_cat'] = $arrInput ['tendm'];
				$arrInsert ['url_cat'] = convertUrl ( $arrInput ['tendm'] );
				$arrInsert ['des_cat'] = $arrInput ['mota'];
				$arrInsert ['key_cat'] = $arrInput ['tukhoa'];
				// Thực hiện thêm danh mục
				$result = $this->Cat_model->a_AddCat ( $arrInsert );
				if ($result) {
					$this->session->set_flashdata ( 'flash_success', 'Thêm danh mục thành công' );
					redirect ( base_url ( 'admin/admin_cat' ) );
					exit ();
				} else {
					$this->session->set_flashdata ( 'flash_error', 'Có lỗi khi thêm danh mục' );
				}
			}
		}
		
		$this->data ['title'] = "Thêm danh mục - Javi Admin";
		$this->load->view ( "layout/admin/layout", $this->data );
	}
	function edit($id_cat) {
		$arrCat = $this->data ['arrCat'] = $this->Cat_model->getCat ( $id_cat );
		// Nếu không tồn tại danh mục || người dùng không đủ quyền => không được sửa
		if (count ( $arrCat ) <= 0 || $this->session->userdata ( 'ss_UserInfo' ) ['level'] > 1) {
			redirect ( 'admin/admin_cat' );
			exit ();
		}
		if($this->form_validation->run('cat') == TRUE){
			// Xử lý sự kiện button editCat
			if ($this->input->post ( 'editCat' )) {
				$arrUpdate = array ();
				$arrInput = $this->input->post ();
				$arrUpdate ['name_cat'] = $arrInput ['tendm'];
				$arrUpdate ['url_cat'] = convertUrl ( $arrInput ['tendm'] );
				$arrUpdate ['des_cat'] = $arrInput ['mota'];
				$arrUpdate ['key_cat'] = $arrInput ['tukhoa'];
				// Xử lý sửa danh mục
				$result = $this->Cat_model->a_EditCat ( $id_cat, $arrUpdate );
				if ($result) {
					$this->session->set_flashdata ( 'flash_success', 'Sửa danh mục thành công' );
					redirect ( base_url ( 'admin/admin_cat' ) );
					exit ();
				} else {
					$this->session->set_flashdata ( 'flash_error', 'Có lỗi khi sửa danh mục' );
				}
			}
		}
		
		$this->data ['title'] = "Sửa danh mục - Javi Admin";
		$this->load->view ( "layout/admin/layout", $this->data );
	}
	function del($id_cat) {
		$arrCat = $this->data ['arrCat'] = $this->Cat_model->getCat ( $id_cat );
		// Nếu không tồn tại danh mục || người dùng không đủ quyền => không được xóa
		if (count ( $arrCat ) <= 0 || $this->session->userdata ( 'ss_UserInfo' ) ['level'] > 1) {
			redirect ( 'admin/admin_cat' );
			exit ();
		}
		$this->load->model('News_model');
		// Lấy mảng chứa hình ảnh của tin thuộc 1 danh mục
		$arrPic_News = $this->News_model->getID($id_cat);
		// Vòng lặp xóa hình ảnh
		foreach ($arrPic_News as $value){
			$pic_old = $value['pic_news'];
			$this->file_library->del_file($pic_old);
		}
		// Thực hiện xóa
		$result = $this->Cat_model->a_DelCat ( $id_cat );
		if ($result) {
			$this->session->set_flashdata ( 'flash_success', 'Xóa danh mục thành công' );
			redirect ( base_url ( 'admin/admin_cat' ) );
			exit ();
		}
	}
}