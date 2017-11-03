<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admin_index extends CI_Controller{
	public $data;
	function __construct(){
		parent::__construct();
		// Kiểm tra login
		if(!$this->auth->checkLogged()){
			redirect('login');
			exit();
		}
	}
	function index(){
		//$this->output->enable_profiler(true);
		$this->load->model(array('News_model','User_model','Page_model','Counter_model'));
		$this->data['countNews'] = $this->News_model->count();
		$this->data['countUser'] = $this->User_model->count();
		$this->data['countPage'] = $this->Page_model->count();
		$this->data['countCat'] = $this->Cat_model->count();
		$arrMonth = range(1, 12);
		$arrCount = array();
		$year = date('Y');
		foreach ($arrMonth as $month){
			if($month < 10){
				$month = '0'.$month;
			}
			$arrCount[$month] = array(
					'num_post'  => $this->News_model->get_post_by_month($month, $year),
					'num_access' => $this->Counter_model->get_access_by_month($month, $year)
			);
			
		}
		$this->data['arrCount'] = $arrCount;
		$this->data['title'] = "Quản lý tin tức - Javi Admin";
		$this->load->view("layout/admin/layout", $this->data);
	}
}