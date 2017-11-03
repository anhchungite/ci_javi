<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_news extends CI_Controller{
	public $data;
	function __construct(){
		parent::__construct();
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->load->Model('News_model');
		$this->load->Model('User_model');
		$this->data['arrCat'] = $this->Cat_model->getAllCat();
		
	}
	function index($page = 1){
		$id_cat = 'all';
		//$status = 'all';
		if($this->input->get()){
			$arrGet = $this->input->get();
			if(isset($arrGet['select_id'])){
				$id_cat = $arrGet['select_id'];
			}
			if(isset($arrGet['per_page'])){
				$page = $arrGet['per_page'];
			}
// 			if(isset($arrGet['status'])){
// 				$status = $arrGet['status'];
// 			}
		}
		$keyword = "";
		if($this->input->post('btnSearch')){
			$keyword = $this->input->post()['txtSearch'];
		}
		
		if($this->input->post('apdung')){
			$arrInput = $this->input->post();
			if(!isset($arrInput['checklist'])){
				$this->session->set_flashdata('flash_error', 'Chọn 1 vài mục để thực hiện tác vụ này');
			}else {
				if($arrInput['tacvu'] == 'delete'){
					$arrID = $arrInput['checklist'];
					$result = $this->News_model->a_MulGet($arrID); // Lấy mảng chứa hình ảnh
					foreach ($result as $value){
						$picture_old = $value['pic_news'];
						$this->file_library->del_file($picture_old);
					}
					$result = $this->News_model->a_MulDel($arrID); // Thực thi xóa
					if($result){
						$this->session->set_flashdata('flash_success', 'Hoàn tất xóa các mục đã chọn');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi xóa các mục này');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}
				}
				if($arrInput['tacvu'] == 'save'){
					$arrID = $arrInput['checklist'];
					$arrUpdate['date_update'] = date('Y-m-d H:i:s');
					$arrUpdate['status_news'] = 0;
					$result = $this->News_model->a_MulEdit($arrID, $arrUpdate); // Thực thi cập nhật
					if($result){
						$this->session->set_flashdata('flash_success', 'Đã lưu bản nháp các mục đã chọn');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi lưu các mục này');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}
				}
				if($arrInput['tacvu'] == 'post'){
					$arrID = $arrInput['checklist'];
					$arrUpdate['date_update'] = date('Y-m-d H:i:s');
					$arrUpdate['status_news'] = 1;
					$result = $this->News_model->a_MulEdit($arrID, $arrUpdate); // Thực thi cập nhật
					if($result){
						$this->session->set_flashdata('flash_success', 'Hoàn tất đăng các mục đã chọn');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi đăng các mục này');
						redirect(base_url().ltrim($_SERVER['REQUEST_URI'], '/'));
						exit();
					}
				}
			}
		}
		$arrNumPagi = $this->Pagi_model->getPagiAdmin();
		$per_page = $arrNumPagi['number']; // Số dòng / trang
		$level = $this->session->userdata('ss_UserInfo')['level'];
		$id_user = $this->session->userdata('ss_UserInfo')['id_user'];
		//==> ADMINISTRATOR LOGIN => Thấy tất cả tin tức
		// Phân trang
		$total_rows = $this->News_model->getNumRow($level, $id_user, $id_cat, $keyword); // Tổng số dòng
		if($total_rows > 0){
			$maxpage = ceil($total_rows / $per_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->data['arrNews'] = $this->News_model->getAll($page, $per_page, $level, $id_user, $id_cat, $keyword);
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['base_url'] = base_url('admin/admin_news/index');
			if(isset($arrGet['select_id'])){
				$config['base_url'] = base_url('admin/admin_news/index?select_id='.$id_cat);
			}
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['page_query_string'] = TRUE;
			//$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			
		}
		
		$this->data['title'] = "Quản lý tin tức - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	// PHƯƠNG THỨC THÊM TIN
	function add(){
		$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
		if($this->form_validation->run('news') == TRUE){
			// Xử lý sự kiện button postNews
			if($this->input->post('postNews')){
				$arrInput = $this->input->post();
				$arrInsert = array();
				$arrInsert['name_news']			= $arrInput['tieude'];
				$arrInsert['detail_news']		= $arrInput['chitiet'];
				$arrInsert['des_news']			= $arrInput['mota'];
				$arrInsert['key_news']			= $arrInput['tukhoa'];
				$arrInsert['url_news']			= convertUrl($arrInput['tieude']);
				$arrInsert['id_cat']			= $arrInput['danhmuc'];
				$arrInsert['date_update']		= date('Y-m-d H:i:s');
				$arrInsert['date_public']		= date('Y-m-d H:i:s');
				$arrInsert['id_user']			= $this->session->userdata('ss_UserInfo')['id_user'];
				$arrInsert['status_news'] 		= 1;
				$picture = $_FILES['hinhanh']['name'];
				if($picture == ""){ //Thêm tin không có hình
					$result = $this->News_model->a_Add($arrInsert);
					if($result){
						$this->session->set_flashdata('flash_success', 'Thêm tin thành công');
						redirect('admin/admin_news');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm tin');
					}
				}else { // Thêm tin có upload hình
					$result_upload = $this->file_library->upload_file('hinhanh');
					if(count($result_upload) <= 1){
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload hình');
					}else {
						$arrInsert['pic_news'] = $result_upload['arrFile']['file_name'];
						$result = $this->News_model->a_Add($arrInsert);
						if($result){
							$this->session->set_flashdata('flash_success', 'Thêm tin thành công');
							redirect('admin/admin_news');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm tin');
						}
					}
				}
					
			}
			// Xử lý sự kiên button saveNews
			if($this->input->post('saveNews')){
				$arrInput = $this->input->post();
				$arrInsert = array();
				$arrInsert['name_news']			= $arrInput['tieude'];
				$arrInsert['detail_news']		= $arrInput['chitiet'];
				$arrInsert['des_news']			= $arrInput['mota'];
				$arrInsert['key_news']			= $arrInput['tukhoa'];
				$arrInsert['url_news']			= convertUrl($arrInput['tieude']);
				$arrInsert['id_cat']			= $arrInput['danhmuc'];
				$arrInsert['date_update']		= date('Y-m-d H:i:s');
				$arrInsert['date_public']		= date('Y-m-d H:i:s');
				$arrInsert['id_user']			= $this->session->userdata('ss_UserInfo')['id_user'];
				$arrInsert['status_news'] 		= 0;
				$picture = $_FILES['hinhanh']['name'];
				if($picture == ""){ //Thêm tin không có hình
					$result = $this->News_model->a_Add($arrInsert);
					if($result){
						$this->session->set_flashdata('flash_success', 'Thêm tin thành công');
						redirect('admin/admin_news');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm tin');
					}
				}else { // Thêm tin có upload hình
					$result_upload = $this->file_library->upload_file('hinhanh');
					if(count($result_upload) <= 1){
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload hình');
					}else {
						$arrInsert['pic_news'] = $result_upload['arrFile']['file_name'];
						$result = $this->News_model->a_Add($arrInsert);
						if($result){
							$this->session->set_flashdata('flash_success', 'Thêm tin thành công');
							redirect('admin/admin_news');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi thêm tin');
						}
					}
				}
			
			}
		}
		
		$this->data['title'] = "Thêm tin tức - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	// PHƯƠNG THỨC SỬA TIN
	function edit($id_news){
		// Truy vấn tin theo id
		$this->data['arrNews'] = $this->News_model->getNews($id_news);
		// Nếu không tồn tại id || không chính chủ => không được sửa
		$id_user = $this->data['arrNews']['id_user'];
		$arrUser = $this->User_model->getUser($id_user);
		if(count($this->data['arrNews']) <= 0 || $this->session->userdata('ss_UserInfo')['level'] > $arrUser['level'] || $this->session->userdata('ss_UserInfo')['level'] == $arrUser['level'] && $this->session->userdata('ss_UserInfo')['id_user'] != $id_user){
			$this->session->set_flashdata('flash_error', 'Access denied');
			redirect('admin/admin_news');
			exit();
		}
		// Validation
		
		// Button xóa hình ảnh
		if($this->input->get('delpic')){
			$picture_old = $this->data['arrNews']['pic_news'];
			$this->file_library->del_file($picture_old);
			$arrUpdate = array("pic_news" => "");
			$result = $this->News_model->a_Edit($id_news, $arrUpdate);
			if($result){
				$this->session->set_flashdata('flash_success', 'Đã xóa hình ảnh');
				redirect(base_url(uri_string()));
				exit();
			}
			$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi xóa hình');
		}
		$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
		if($this->form_validation->run('news') == TRUE){
			// Xử lý sự kiện button postNews
			if($this->input->post('postNews')){
				$arrInput = $this->input->post();
				$arrUpdate = array();
				$arrUpdate['name_news']			= $arrInput['tieude'];
				$arrUpdate['detail_news']		= $arrInput['chitiet'];
				$arrUpdate['des_news']			= $arrInput['mota'];
				$arrUpdate['key_news']			= $arrInput['tukhoa'];
				$arrUpdate['url_news']			= convertUrl($arrInput['tieude']);
				$arrUpdate['id_cat']			= $arrInput['danhmuc'];
				$arrUpdate['date_update']		= date('Y-m-d H:i:s');
				$arrUpdate['status_news'] 		= 1;
				$picture_old	= $this->data['arrNews']['pic_news'];
				$picture 		= $_FILES['hinhanh']['name'];
				if($picture == ""){ //Thêm tin không có hình
					$result = $this->News_model->a_Edit($id_news, $arrUpdate);
					if($result){
						$this->session->set_flashdata('flash_success', 'Sửa tin thành công');
						redirect('admin/admin_news');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa tin');
					}
				}else { // Thêm tin có upload hình
					$result_upload = $this->file_library->upload_file('hinhanh');
					if(count($result_upload) <= 1){
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload hình');
					}else {
						$arrUpdate['pic_news'] = $result_upload['arrFile']['file_name'];
						$this->file_library->del_file($picture_old);
						$result = $this->News_model->a_Edit($id_news, $arrUpdate);
						if($result){
							$this->session->set_flashdata('flash_success', 'Sửa tin thành công');
							redirect('admin/admin_news');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa tin');
						}
					}
				}
			
			}
			// Xử lý sự kiện button saveNews
			if($this->input->post('saveNews')){
				$arrInput = $this->input->post();
				$arrUpdate = array();
				$arrUpdate['name_news']			= $arrInput['tieude'];
				$arrUpdate['detail_news']		= $arrInput['chitiet'];
				$arrUpdate['des_news']			= $arrInput['mota'];
				$arrUpdate['key_news']			= $arrInput['tukhoa'];
				$arrUpdate['url_news']			= convertUrl($arrInput['tieude']);
				$arrUpdate['id_cat']			= $arrInput['danhmuc'];
				$arrUpdate['status_news'] 		= 0;
				$picture_old	= $this->data['arrNews']['pic_news'];
				$picture 		= $_FILES['hinhanh']['name'];
				if($picture == ""){ //Thêm tin không có hình
					$result = $this->News_model->a_Edit($id_news, $arrUpdate);
					if($result){
						$this->session->set_flashdata('flash_success', 'Sửa tin thành công');
						redirect('admin/admin_news');
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa tin');
					}
				}else { // Thêm tin có upload hình
					$result_upload = $this->file_library->upload_file('hinhanh');
					if(count($result_upload) <= 1){
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi upload hình');
					}else {
						$arrUpdate['pic_news'] = $result_upload['arrFile']['file_name'];
						$this->file_library->del_file($picture_old);
						$result = $this->News_model->a_Edit($id_news, $arrUpdate);
						if($result){
							$this->session->set_flashdata('flash_success', 'Sửa tin thành công');
							redirect('admin/admin_news');
							exit();
						}else{
							$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi sửa tin');
						}
					}
				}
			
			}	
		}
		
		$this->data['title'] = "Sửa tin tức - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function del($id_news){
		// Truy vấn tin theo id
		$arrNews = $this->News_model->getNews($id_news);
		$id_user = $arrNews['id_user'];
		$arrUser = $this->User_model->getUser($id_user);
		// Nếu không tồn tại id || không chính chủ => không được sửa
		if(count($arrNews) <= 0 || $this->session->userdata('ss_UserInfo')['level'] > $arrUser['level'] || $this->session->userdata('ss_UserInfo')['level'] == $arrUser['level'] && $this->session->userdata('ss_UserInfo')['id_user'] != $id_user){
			$this->session->set_flashdata('flash_error', 'Access denied');
			redirect('admin/admin_news');
			exit();
		}
		$picture_old = $arrNews['pic_news'];
		$this->file_library->del_file($picture_old);
		$result = $this->News_model->a_Del($id_news);
		if($result){
			$this->session->set_flashdata('flash_success', 'Xóa tin thành công');
			redirect('admin/admin_news');
			exit();
		}else{
			$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra khi xóa tin');
			redirect('admin/admin_news');
			exit();
		}
	}
}