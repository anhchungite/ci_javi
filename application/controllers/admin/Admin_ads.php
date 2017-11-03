<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_ads extends CI_Controller{
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
		$this->load->model('Ads_model');
	}
	function index(){
		// Truy vấn hiển thị tất cả QC
		$this->data['arrAds'] = $this->Ads_model->getAll();
		if($this->input->post('apdung')){
			$arrInput = $this->input->post();
				
				if($arrInput['tacvu'] == "delete"){
					if(isset($arrInput['checklist'])){
						$arrID =  $arrInput['checklist'];
						$result = $this->Ads_model->a_MulUnlink($arrID); // Lấy mảng chứa hình ảnh
						foreach ($result as $value){
							$picture_old = $value['pic_ads'];
							$this->file_library->del_file($picture_old);
						}
						// Thực hiện xóa hàng loạt
						$result = $this->Ads_model->a_MulDelete($arrID);
						if($result){
							$this->session->set_flashdata('flash_success', 'Đã xóa các mục đã chọn');
							redirect('admin/admin_ads');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi xóa các mục này');
							redirect('admin/admin_ads');
							exit();
						}
					}
					$this->session->set_flashdata('flash_error', 'Chọn 1 vài mục để có thể thực hiện tác vụ này');
				}
				if($arrInput['tacvu'] == "hide"){
					if(isset($arrInput['checklist'])){
						$arrID =  $arrInput['checklist'];
						$arrUpdate = array('status_ads' => 0);
						$result = $this->Ads_model->a_MulUpdate($arrID, $arrUpdate);
						if($result){
							$this->session->set_flashdata('flash_success', 'Đã vô hiệu hóa các mục đã chọn');
							redirect('admin/admin_ads');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi vô hiệu hóa các mục này');
							redirect('admin/admin_ads');
							exit();
						}
					}
					$this->session->set_flashdata('flash_error', 'Chọn 1 vài mục để có thể thực hiện tác vụ này');
				}
				if($arrInput['tacvu'] == "display"){
					if(isset($arrInput['checklist'])){
						$arrID =  $arrInput['checklist'];
						$arrUpdate = array('status_ads' => 1);
						$result = $this->Ads_model->a_MulUpdate($arrID, $arrUpdate);
						if($result){
							$this->session->set_flashdata('flash_success', 'Đã vô hiệu hóa các mục đã chọn');
							redirect('admin/admin_ads');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi vô hiệu hóa các mục này');
							redirect('admin/admin_ads');
							exit();
						}
					}
					$this->session->set_flashdata('flash_error', 'Chọn 1 vài mục để có thể thực hiện tác vụ này');
				}
				
		}
		$this->data['title'] = "Cài đặt hỗ trợ - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function add(){
		if($this->form_validation->run('ads') == TRUE){ // Validation
			// Xử lý sự kiên button addAds
			if($this->input->post('addAds')){
				$arrInput = $this->input->post();
				$arrInsert = array();
				$arrInsert['name_ads'] 		= $arrInput['name_ads'];
				$arrInsert['link_ads'] 		= $arrInput['link_ads'];
				$arrInsert['status_ads'] 	= $arrInput['trangthai'];
				$arrInsert['order'] 		= $arrInput['sapxep'];
				// Xử lý upload hình
				$result_upload = $this->file_library->upload_file("hinhanh");
				if(count($result_upload) <= 1){
					$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload');
				}else {
					$arrInsert['pic_ads'] = strtolower($result_upload['arrFile']['file_name']);
					// Xử lý insert dữ liệu
					$result = $this->Ads_model->a_Add($arrInsert);
					if($result){
						$this->session->set_flashdata('flash_success', 'Thêm QC thành công');
						redirect('admin/admin_ads');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm QC');
						redirect(base_url(uri_string()));
						exit();
					}
				}
			}
		}
		$this->data['title'] = "Thêm quảng cáo - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function edit($id_ads){
		$this->data['arrAds'] = $this->Ads_model->getAds($id_ads);
		// Kiểm tra tồn tại
		if(count($this->data['arrAds']) <=0){
			redirect('admin/admin_ads');
			exit();
		}
		if($this->form_validation->run('ads') == TRUE){ // Validation
			// Xử lý sự kiên button addAds
			if($this->input->post('editAds')){
				$arrInput = $this->input->post();
				$arrUpdate = array();
				$arrUpdate['name_ads'] 		= $arrInput['name_ads'];
				$arrUpdate['link_ads'] 		= $arrInput['link_ads'];
				$arrUpdate['status_ads'] 	= $arrInput['trangthai'];
				$arrUpdate['order'] 		= $arrInput['sapxep'];
				$picture_old = $this->data['arrAds']['pic_ads'];
				$picture_new = $_FILES['hinhanh']['name'];
				if($picture_new == ""){ // Xử lý cập nhật không có hình
					$result = $this->Ads_model->a_Update($id_ads,$arrUpdate);
					if($result){
						$this->session->set_flashdata('flash_success', 'Sửa QC thành công');
						redirect('admin/admin_ads');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa QC');
					}
				}else { // Xử lý cập nhật có hình ảnh
					// Xử lý upload hình
					$result_upload = $this->file_library->upload_file("hinhanh");
					if(count($result_upload) <= 1){
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload');
					}else {
						$this->file_library->del_file($picture_old);
						$arrUpdate['pic_ads'] = strtolower($result_upload['arrFile']['file_name']);
						// Xử lý cập nhật dữ liệu
						$result = $this->Ads_model->a_Update($id_ads,$arrUpdate);
						if($result){
							$this->session->set_flashdata('flash_success', 'Sửa QC thành công');
							redirect('admin/admin_ads');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa QC');
						}
					}
				}
					
			}
		}
		
		$this->data['title'] = "Sửa quảng cáo - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function del($id_ads){
		$arrAds = $this->Ads_model->getAds($id_ads);
		// Kiểm tra tồn tại
		if(count($arrAds) <=0){
			redirect('admin/admin_ads');
			exit();
		}
		$result = $this->Ads_model->a_Delete($id_ads);
		if($result){
			$this->session->set_flashdata('flash_success', 'Xóa QC thành công');
			redirect('admin/admin_ads');
			exit();
		}else{
			$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi xóa QC');
			redirect('admin/admin_ads');
			exit();
		}
	}
}