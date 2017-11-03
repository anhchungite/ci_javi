<?php
$config = array(
		'ads' => array(
				array(
						'field' => 'name_ads',
						'label' => 'Tiêu đề',
						'rules' => 'required'
				),
				array(
						'field' => 'link_ads',
						'label' => 'Liên kết',
						'rules' => 'valid_url'
				)
		),
		'cat' => array(
				array(
						'field' => 'tendm',
						'label' => 'Tên danh mục',
						'rules' => 'required|max_length[100]'
				),
				array(
						'field' => 'mota',
						'label' => 'Mô tả',
						'rules' => 'min_length[100]|prep_for_form'
				),
				array(
						'field' => 'tukhoa',
						'label' => 'Từ khóa',
						'rules' => 'min_length[50]|prep_for_form'
				)
		),
		'news' => array(
				array(
						'field' => 'tieude',
						'label' => 'Tiêu đề',
						'rules' => 'required'
				),
				array(
						'field' => 'danhmuc',
						'label' => 'Danh mục',
						'rules' => 'required'
				),
				array(
						'field' => 'chitiet',
						'label' => 'Chi tiết',
						'rules' => 'required|min_length[200]'
				),
				array(
						'field' => 'mota',
						'label' => 'Mô tả',
						'rules' => 'min_length[100]|prep_for_form'
				),
				array(
						'field' => 'tukhoa',
						'label' => 'Từ khóa',
						'rules' => 'min_length[50]|prep_for_form'
				)
		),
		'page' => array(
				array(
						'field' => 'tieude',
						'label' => 'Tiêu đề trang',
						'rules' => 'required'
				),
				array(
						'field' => 'noidung',
						'label' => 'Nội dung',
						'rules' => 'required|min_length[200]'
				)
		),
		'user' => array(
				array(
						'field' => 'username',
						'label' => 'Tên người dùng',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'password',
						'label' => 'Mật khẩu',
						'rules' => 'required|matches[re-password]|md5'
				),
				array(
						'field' => 're-password',
						'label' => 'Xác nhận mật khẩu',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required|valid_email'
				),
				array(
						'field' => 'fullname',
						'label' => 'Họ và tên',
						'rules' => 'required'
				)
		)
);