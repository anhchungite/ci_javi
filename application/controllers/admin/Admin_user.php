<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_user extends CI_Controller{
	public $data;
	function __construct(){
		parent::__construct();
		$this->load->Model('User_model');
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
		$this->data['arrLevel'] = array('administrator','admin','moderator');
	}
	function index(){
		$this->data['arrUser'] = $this->User_model->getAllUser();
		$this->data['title'] = "Quản lý người dùng - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	function add(){
		if($this->session->userdata('ss_UserInfo')['level'] > 1){
			redirect(base_url('admin/admin_user'));
			exit();
		}
		if($this->input->post('addUser')){
			$arrInsert = array();
			$arrInput = $this->input->post();
			$arrInsert['username'] 	= strtolower(trim($arrInput['username']));
			$arrInsert['password'] 	= md5(trim($arrInput['password']));
			$arrInsert['email'] 		= trim($arrInput['email']);
			$arrInsert['fullname'] 	= trim($arrInput['fullname']);
		    $arrInsert['level'] 		= $arrInput['quyen'];
		    // VALIDATION
		    $this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
		    $this->form_validation->set_rules('username','Tên người dùng','required|callback_regex_username|trim');
		    $this->form_validation->set_rules('password','Mật khẩu','callback_regex_password|required|trim');
		    $this->form_validation->set_rules('re-password','Xác nhận mật khẩu','required|trim|matches[password]');
		    $this->form_validation->set_rules('email','Email','required|trim|callback_regex_email');
		    $this->form_validation->set_rules('fullname','Họ và tên','required');
			if($this->form_validation->run() == true){
					// Thực hiện thêm
					$result = $this->User_model->a_AddUser($arrInsert);
					if($result){
						$this->session->set_flashdata('flash_success', 'Thêm người dùng thành công');
						redirect(base_url('admin/admin_user'));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi khi thêm người dùng');
					}
			}
			
		}
		$this->data['title'] = "Thêm người dùng - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	
	function edit($id_user){
		// Lấy thông tin user theo id
		$arrData = $this->data['arrUser'] = $this->User_model->getUser($id_user);
		$ss_UserInfo = $this->session->userdata('ss_UserInfo');
		// Nếu không tồn tại người dùng || Cấp cao hơn || Không phải là chính nó => Không được sửa
		if(count($this->data['arrUser']) <= 0 || $ss_UserInfo['level'] > $arrData['level'] || $ss_UserInfo['level'] == $arrData['level'] && $ss_UserInfo['id_user'] != $id_user){
			$this->session->set_flashdata('flash_error', 'Access denied');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		
		// Lấy thông tin đổ vào mảng khi nhấn nút submit
		if($this->input->post('editUser')){
			$arrUpdate = array();
			$arrInput = $this->input->post();
			
			$arrUpdate['email'] 	= $arrInput['email'];
			$arrUpdate['fullname'] 	= $arrInput['fullname'];
			// VALIDATION
			$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			$this->form_validation->set_rules('email','Email','required|trim|callback_regex_email');
			$this->form_validation->set_rules('fullname','Họ và tên','required');
			if($this->form_validation->run() == true){
				// Thực hiện cập nhật
				$result = $this->User_model->a_EditUser($id_user, $arrUpdate);
				if($result){
					$this->session->set_flashdata('flash_success', 'Thêm người dùng thành công');
					redirect(base_url('admin/admin_user'));
					exit();
				}else{
					$this->session->set_flashdata('flash_error', 'Có lỗi khi thêm người dùng');
				}
			}
			
		}
		// Chức năng đổi mật khẩu
		if($this->input->post('editPass')){
			$arrUpdate = array();
			$arrInput = $this->input->post();
			// VALIDATION
			$this->form_validation->set_error_delimiters('<ul class="form_error"><li>','</li></ul>');
			$this->form_validation->set_rules('old-password','Mật khẩu cũ','callback_regex_old_password['.$id_user.']|required|trim');
			$this->form_validation->set_rules('new-password','Mật khẩu mới','callback_regex_password|required|trim');
			$this->form_validation->set_rules('re-password','Xác nhận mật khẩu','required|trim|matches[new-password]');
			if($this->form_validation->run() == true){
				// Kiểm tra trùng khớp mật khẩu cũ.
				$password = md5($arrInput['old-password']);
				$ckPass = $this->User_model->a_ckPass($password, $id_user);
				if(count($ckPass) > 0){ // Nếu trùng khớp tiến hành đổi mật khẩu
					$arrUpdate['password'] = md5($arrInput['new-password']);
					$result = $this->User_model->a_EditPass($id_user, $arrUpdate);
					if($result){
						$this->session->set_flashdata('flash_success', 'Đổi mật khẩu thành công');
						redirect(base_url('admin/admin_user'));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi khi đổi mật khẩu');
					}
				}else { // Ngược lại báo lỗi
					$this->session->set_flashdata('flash_error', 'Mật khẩu cũ không tồn tại');
				}
			}
			
		}
		// Hiển thị title + view
		$this->data['title'] = "Sửa người dùng - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
	// Phương thức xóa người dùng
	function del($id_user){
		// Kiểm tra tồn tại người dùng
		$arrData = $this->User_model->getUser($id_user);
		$ss_UserInfo = $this->session->userdata('ss_UserInfo');
			// Nếu không tồn tại người dùng || Cấp cao hơn || Là chính nó => Không được xóa
		if(count($arrData) <= 0 || $ss_UserInfo['level'] >= $arrData['level'] || $ss_UserInfo['level'] == $arrData['level'] && $ss_UserInfo['id_user'] == $id_user){
			$this->session->set_flashdata('flash_error', 'Access denied');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		// Thực hiện xóa
		$result = $this->User_model->a_DelUser($id_user);
		if($result){
			$this->session->set_flashdata('flash_success', 'Xóa người dùng thành công');
			redirect(base_url('admin/admin_user'));
			exit();
		}
		redirect(base_url('admin/admin_user'));
		exit();
	}
	// CAllBACK VALIDATION
	function regex_username($username){
		if(preg_match('/^[a-z_][a-z0-9_\.\s]{2,31}$/', $username) == true){
			if($this->User_model->a_ckUser($username) == true){
				$this->form_validation->set_message('regex_username','%s đã tồn tại');
				return false;
			}else {
				return true;
			}
		}else {
			$this->form_validation->set_message('regex_username', '%s phải bắt đầu bằng 1 ký tự <li> Chỉ chứa chữ, số, dấu chấm (.), dấu gạch dưới (_)</li><li>Độ dài từ 3 - 32 ký tự</li>');
			return false;
		}
	}
	function regex_password($password){
		if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{6,}$/', $password) == true){
			return true;
		}else {
			$this->form_validation->set_message('regex_password', '%s phải tối thiểu 8 ký tự<li>Chứa ít nhất 1 ký tự đặc biệt, 1 ký tự in hoa và 1 chữ số</li> ');
			return false;
		}
	}
	function regex_email($email){
		if(preg_match('/^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/', $email) == true){
			if($this->User_model->a_ckEmail($email) == true){
				$this->form_validation->set_message('regex_email', '%s đã tồn tại');
				return false;
			}else {
				return true;
			}
		}else {
			$this->form_validation->set_message('regex_email', '%s không hợp lệ');
			return false;
		}
	}
	function regex_old_password($old_password,$id_user){
		if($this->User_model->a_ckPass(md5($old_password), $id_user) == false){
			$this->form_validation->set_message('regex_old_password', '%s không tồn tại');
			return false;
		}else {
			return true;
		}
	}
}