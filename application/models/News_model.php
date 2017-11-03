<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class News_model extends CI_Model{
	public $table;
	function __construct(){
		parent::__construct();
		$this->table = "news";
	}
	// Hiển thị tin ra trang chủ
	function showIndex($id_cat){
		$this->db->select("id_news,name_news,url_news,date_format(date_update, '%d-%m-%Y') as date_update,pic_news, detail_news");
		$this->db->from($this->table);
		$this->db->join('category', 'category.id_cat = news.id_cat');
		$this->db->where(array('news.id_cat'=> $id_cat, 'status_news' => 1));
		$this->db->order_by('id_news', 'DESC');
		$this->db->limit(4, 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Hiển thị chi tiết tin
	function showDetail($id_news){
		$this->db->select("id_news,name_news,date_format(date_update, '%d-%m-%Y') as date_update, detail_news, des_news, key_news, status_news, name_cat, news.id_cat, url_cat");
		$this->db->from($this->table);
		$this->db->join('category', 'category.id_cat = news.id_cat');
		$this->db->where(array('id_news'=> $id_news, 'status_news' => 1));
		$query = $this->db->get();
		return $query->row_array();
	}
	// Hiển thị tin liên quan
	function showRelated($id_news, $id_cat){
		$this->db->select('id_news, name_news, pic_news, url_news');
		$this->db->order_by('id_news', 'DESC');
		$this->db->limit(10, 0);
		$query = $this->db->get_where($this->table, array('id_news !='=>$id_news, 'id_cat'=>$id_cat, 'status_news'=> 1));
		return $query->result_array();
	}
	// Hiển thị tin theo từng danh mục
	function showCat($id_cat, $page, $per_page){
		$offset = ($page * $per_page) - $per_page;
		$this->db->select("id_news,name_news,pic_news,detail_news,url_news");
		$this->db->from($this->table);
		$this->db->join('category', 'category.id_cat = news.id_cat');
		$this->db->where(array('news.id_cat'=> $id_cat, 'status_news' => 1));
		$this->db->order_by('id_news', 'DESC');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Lấy số lượng bài viết trong 1 danh mục
	function get_num_row_cat($id_cat){
		$this->db->where(array('id_cat'=> $id_cat, 'status_news' => 1));
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	// Truy vấn tất cả tin
	function getAll($page, $per_page, $level, $id_user, $id_cat, $keyword){
		$offset = ($page * $per_page) - $per_page;
		$this->db->select("id_news,name_news,name_cat,date_format(date_public, '%d-%m-%Y') as date_public,fullname,pic_news, CASE status_news WHEN 1 THEN 'Publish' ELSE 'Draft' END AS status_news");
		$this->db->from($this->table);
		$this->db->join('category', 'category.id_cat = news.id_cat');
		$this->db->join('users', 'users.id_user = news.id_user');
// 		if($id_cat != 'all' && $level > 1){
// 			$this->db->where(array('news.id_cat'=> $id_cat, 'id_user'=>$id_user));
// 		}
// 		$this->db->like('name_news', $keyword, 'both');
		if($level <= 1 && $id_cat == 'all'){
			$this->db->like('name_news', $keyword, 'both');
			//$query = $this->db->get($this->table);
			//return $query->num_rows();
		}else if($level <= 1 && $id_cat != 'all'){
			$this->db->where(array('news.id_cat'=> $id_cat));
			$this->db->like('name_news', $keyword, 'both');
			//$query = $this->db->get($this->table);
			//return $query->num_rows();
		}else if($level > 1 && $id_cat == 'all'){
			$this->db->where('news.id_user', $id_user);
			$this->db->like('name_news', $keyword, 'both');
			//$query = $this->db->get($this->table);
			//return $query->num_rows();
		}else {
			$this->db->where(array('news.id_user'=> $id_user,'news.id_cat'=> $id_cat));
			$this->db->like('name_news', $keyword, 'both');
			//$query = $this->db->get($this->table);
			//return $query->num_rows();
		}
		$this->db->order_by('news.id_news', 'DESC');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Truy vấn tin theo id
	function getNews($id_news){
		$query = $this->db->get_where($this->table, array('id_news' => $id_news));
		return $query->row_array();
	}
	
	/*======================= ADMIN ==========================*/
	// Thống kê bài viết
	function count(){
		$this->db->where('status_news',1);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	// Thêm tin
	function a_Add($arrData){
		return $this->db->insert($this->table, $arrData);
	}
	// Sửa tin
	function a_Edit($id_news, $arrData){
		$this->db->where('id_news', $id_news);
		return $this->db->update($this->table, $arrData);
	}
	// Xóa tin
	function a_Del($id_news){
		$this->db->where('id_news', $id_news);
		return $this->db->delete($this->table);
	}
	// Sửa tin hàng loạt (Chức năng tác vụ hàng loạt)
	function a_MulEdit($arrID, $arrData){
		$this->db->where_in('id_news', $arrID);
		return $this->db->update($this->table, $arrData);
	}
	// Truy vấn link hình của các tin đã chọn (Chức năng tác vụ hàng loạt)
	function a_MulGet($arrID){
		$this->db->select('pic_news');
		$this->db->where_in('id_news', $arrID);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	// Xóa tin hàng loạt (Chức năng tác vụ hàng loạt)
	function a_MulDel($arrID){
		$this->db->where_in('id_news', $arrID);
		return $this->db->delete($this->table);
	}
	// Lấy tất cả các hình ảnh của 1 danh mục
	function getPic($id_cat){
		$this->db->select('pic_news');
		$query = $this->db->get_where($this->table, array('id_cat'=>$id_cat));
		return $query->result_array();
	}
	//==> PHÂN TRANG
	// Lấy số bài viết 
	function getNumRow($level, $id_user, $id_cat, $keyword){
		if($level <= 1 && $id_cat == 'all'){
			$this->db->like('name_news', $keyword, 'both');
			$query = $this->db->get($this->table);
			return $query->num_rows();
		}else if($level <= 1 && $id_cat != 'all'){
			$this->db->where(array('id_cat'=> $id_cat));
			$this->db->like('name_news', $keyword, 'both');
			$query = $this->db->get($this->table);
			return $query->num_rows();
		}else if($level > 1 && $id_cat == 'all'){
			$this->db->where('id_user', $id_user);
			$this->db->like('name_news', $keyword, 'both');
			$query = $this->db->get($this->table);
			return $query->num_rows();
		}else {
			$this->db->where(array('id_user'=> $id_user,'id_cat'=> $id_cat));
			$this->db->like('name_news', $keyword, 'both');
			$query = $this->db->get($this->table);
			return $query->num_rows();
		}
	}
	//=> Thống kê
	public function get_post_by_month($month, $year){
		$this->db->where(array('status_news' => 1, 'date_format(date_public, "%m")=' => $month, 'date_format(date_public, "%Y")=' => $year));
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	
	//==> MENU DANH MỤC
	
// 	function get_news_by_cat($id_cat, $level, $id_user, $page, $per_page){
// 			$offset = ($page * $per_page) - $per_page;
// 			$this->db->select("id_news,name_news,name_cat,date_format(date_public, '%d-%m-%Y') as date_public,fullname,pic_news,status_news");
// 			$this->db->from($this->table);
// 			$this->db->join('category', 'category.id_cat = news.id_cat');
// 			$this->db->join('users', 'users.id_user = news.id_user');
// 			$this->db->where('id_cat',$id_cat);
// 			if($level > 1){
// 				$this->db->where('id_user',$id_user);
// 			}
// 			$this->db->order_by('id_news', 'DESC');
// 			$this->db->limit($per_page, $offset);
// 			$query = $this->db->get();
// 			return $query->result_array();
// 		}
}