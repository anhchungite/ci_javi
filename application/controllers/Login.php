<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Login extends TAC_Controller{
	function __construct(){
		parent::__construct();
		$this->load->Model('User_model');
	}
	function index(){
		// Kiểm tra login
		if($this->auth->checkLogged()){
			redirect('admin');
			exit();
		}
		
		$this->form_validation->set_rules('username','Username','callback_regex_username|required');
		$this->form_validation->set_rules('password','Password','callback_regex_password|required');
		//$this->form_validation->set_message('required', '')
		if($this->form_validation->run() == TRUE){
			// Xử lý đăng nhập
			if($this->input->post('login')){
				$arrInput = $this->input->post();
				$username = $arrInput['username'];
				$password = md5($arrInput['password']);
				$arrInfo = $this->User_model->a_Login($username, $password);
				if(count($arrInfo) > 0){
					$this->auth->setLogin($arrInfo);
					redirect(base_url('admin/admin_index'));
					exit();
				}else {
					$this->session->set_flashdata('flash_error', 'Sai username hoặc password');
				}
			}
			
		}
		$this->data['title'] = "Đăng nhập | Javi Admin";
		$this->load->view("layout/login/layout", $this->data);
	}
	function logout(){
			$this->auth->setLogout();
			redirect('login');
			exit();
	}
	// Hàm Callback Validation
	function regex_username($username){
		if(preg_match('/^[a-z_][a-z0-9_\.\s]{2,31}$/', $username) == true){
			return true;
		}else {
			$this->form_validation->set_message('regex_username','%s không hợp lệ');
			return false;
		}
	}
	function regex_password($password){
		if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}$/', $password) == true){
			return true;
		}else {
			$this->form_validation->set_message('regex_password','%s không hợp lệ');
			return false;
		}
	}
}