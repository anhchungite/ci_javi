<?php
Class Auth{
	protected $_session_name = 'ss_UserInfo';
	public function setLogin($arrInfo){
		$CI = & get_instance();
		$CI->session->set_userdata($this->_session_name, $arrInfo);
	}
	public function setLogout(){
		$CI = & get_instance();
		$CI->session->unset_userdata($this->_session_name);
	}
	public function getInfo(){
		$CI = & get_instance();
		return $CI->session->userdata($this->_session_name);
	}
	public function checkLogged(){
		$data = $this->getInfo();
		if(isset($data)){
			return true;
		}
		return false;
	}
}