<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Public_javi extends TAC_Controller{
	function __construct(){
		parent::__construct();	
		//$this->session->unset_userdata('ss_counter');
		$this->load->library('user_agent');
		$this->load->model('Counter_model');
		$arrAgent = array();
		if ($this->agent->is_browser())
		{
			$browser = $this->agent->browser();
			$arrAgent['browser'] = $browser;
		}
		$platform = $this->agent->platform();
		$ip = $this->input->ip_address();
		$time = time();
		$arrAgent['platform'] 	=  $platform;
		$arrAgent['time'] 		=  $time;
		$arrAgent['ip'] 		=  $ip;
		if(!$this->session->userdata('ss_counter')){
			$this->session->set_userdata('ss_counter', $arrAgent);
			$arrSS = $this->session->userdata('ss_counter');
			$arrInsert = array();
			$arrInsert['session_id'] 	= $arrAgent['time'];
			$arrInsert['ip'] 			= $arrAgent['ip'];
			$arrInsert['browser'] 		= $arrAgent['browser'];
			$arrInsert['platform'] 		= $arrAgent['platform'];
			$arrInsert['date'] 			= date('Y-m-d H:i:s');
			$this->Counter_model->counter($arrInsert);
		}
	}
	function index(){
		
		//$this->output->enable_profiler(true);
		$arrCat = $this->data['_arrCat'];
		foreach ($arrCat as $key => $value){
			$id_cat = $value['id_cat'];
			$arrNews = $this->News_model->showIndex($id_cat);
			$arrCat[$key]['news'] = $arrNews;
		}
		$this->data['arrNews'] = $arrCat; 
		$this->load->view("layout/public/layout", $this->data);
	}
	function danhmuc($id_cat, $page = 1){
		//$this->output->enable_profiler(true);
		$arrCat = $this->data['arrCat'] = $this->Cat_model->getCat($id_cat);
		// Kiểm tra tồn tại
		if(count($arrCat) <=0){
			redirect('error_404');
			exit();
		}
		$arrNumPagi = $this->Pagi_model->getPagiPublic();
		$per_page = $arrNumPagi['number']; // Số dòng / trang
		// Phân trang
		$total_rows = $this->News_model->get_num_row_cat($id_cat); // Tổng số dòng của danh mục
		if($total_rows > 0){
			$maxpage = ceil($total_rows / $per_page);
			// Kiểm tra số trang hợp lệ
			if($page < 1)$page = 1;
			if($page > $maxpage)$page = $maxpage;
			$this->data['arrNews'] = $this->News_model->showCat($id_cat, $page, $per_page);
			
			$config['first_tag_open'] = '';
			$config['first_link'] = 'Trang đầu';
			$config['first_tag_close'] = '';
			
			$config['last_tag_open'] = '';
			$config['last_link'] = 'Trang cuối';
			$config['last_tag_close'] = '';
				
			
			$config['next_tag_open'] = '';
			$config['next_link'] = '»';
			$config['next_tag_close'] = '';
			
			
			$config['prev_tag_open'] = '';
			$config['prev_link'] = '«';
			$config['prev_tag_close'] = '';
			
			$config['num_tag_open'] = '';
			$config['num_tag_close'] = '';
			
			$config['cur_tag_open'] = '<a class="active">';
			$config['cur_tag_close'] = '</a>';
			$config['base_url'] = base_url($arrCat['url_cat'].'/'.$id_cat);
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
		}
		
		$this->data['title'] = $arrCat['name_cat'];
		$this->data['description'] = $arrCat['des_cat'];
		$this->data['keyword'] = $arrCat['key_cat'];
		$this->load->view("layout/public/layout", $this->data);
	}
	function chitiet($id_news){
		//$this->output->enable_profiler(true);
		$arrNews = $this->data['arrNews'] = $this->News_model->showDetail($id_news);
		// Kiểm tra tồn tại
		if(count($arrNews) <=0){
			redirect('error_404');
			exit();
		}
		$this->data['arrRelated'] = $this->News_model->showRelated($arrNews['id_news'], $arrNews['id_cat']);
		$this->data['title'] 		= $arrNews['name_news'];
		$this->data['description'] 	= $arrNews['des_news'];
		$this->data['keyword'] 		= $arrNews['key_news'];
		$this->load->view("layout/public/layout", $this->data);
	}
	function trang($id_page){
		//$this->output->enable_profiler(true);
		$this->load->Model('Contact_model');
		$arrDetail = $this->data['arrDetail'] = $this->Page_model->showDetail($id_page);
		$this->data['current_page'] = $arrDetail['id_page'];
		// Kiểm tra tồn tại
		if(count($arrDetail) <=0){
			redirect('error_404');
			exit();
		}
		if($id_page == 2){
			$config = array(
					array(
							'field' => 'HO_VA_TEN',
							'label' => 'Họ và tên',
							'rules' => 'required|min_length[5]'
					),
					array(
							'field' => 'EMAIL',
							'label' => 'Email',
							'rules' => 'required|valid_email'
					),
					array(
							'field' => 'PHONE',
							'label' => 'Số điện thoại',
							'rules' => 'numeric|min_length[10]|max_length[15]'
					),
					array(
							'field' => 'WEBSITE',
							'label' => 'Website',
							'rules' => 'valid_url'
					),
					array(
							'field' => 'CONTENT',
							'label' => 'Nội dung',
							'rules' => 'required|prep_for_form'
					)
			);
			$this->form_validation->set_rules($config);
			if($this->form_validation->run() == TRUE){
				if($this->input->post('sendContact')){
					$arrInput = $this->input->post();
					$arrInsert = array();
					$arrInsert['name'] 		= $arrInput['HO_VA_TEN'];
					$arrInsert['email'] 	= $arrInput['EMAIL'];
					$arrInsert['phone'] 	= $arrInput['PHONE'];
					$arrInsert['website'] 	= $arrInput['WEBSITE'];
					$arrInsert['content'] 	= $arrInput['CONTENT'];
					$result = $this->Contact_model->send($arrInsert);
					if($result){
						$this->session->set_flashdata('flash_success', 'Thông điệp của bạn đã được gửi đi');
						redirect(base_url(uri_string()));
						exit();
					}else{
						$this->session->set_flashdata('flash_error', 'Có lỗi xảy ra');
						redirect(base_url(uri_string()));
						exit();
					}
				}
			}
			
		}
		$this->data['title'] = $arrDetail['name_page'];
		$this->load->view("layout/public/layout", $this->data);
	}
}