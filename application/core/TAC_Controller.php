<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class TAC_Controller extends CI_Controller{
	public $data;
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->data['title'] = "Tin tức Việt - Nhật";
		$this->data['description'] = "Tin tức Việt - Nhật, cập nhật liên tục hằng ngày";
		$this->data['keyword'] = "tin tuc viet nhat, tin tức việt nhật, tin nhật bản, tin nhat ban";
		$this->load->Model('News_model'); // Load News_model
		$this->load->Model('Page_model'); // Load Page_model
		$this->data['arrPage'] = $this->Page_model->showPage();
		$this->data['_arrCat'] = $this->Cat_model->getAllCat();
		$this->data['arrSP'] = $this->Support_model->getAll();
		$this->data['arrAds'] = $this->Ads_model->showAds();
		
	}
}