<!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse" style="">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" style="">                
                  <li class="active">
                      <a class="" href="<?php echo base_url('admin')?>">
                          <i class="icon_house_alt"></i>
                          <span>HOME</span>
                      </a>
                  </li>
				  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_plus_alt2"></i>
                          <span>Thêm mới</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub" style="">
                          <li><a class="" href="<?php echo base_url().'admin/admin_news/add'; ?>"><i class="arrow_carrot-right"></i>Thêm tin tức</a></li>
                           <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>                          
                          <li><a class="" href="<?php echo base_url().'admin/admin_cat/add'; ?>"><i class="arrow_carrot-right"></i>Thêm danh mục</a></li>
						  <li><a class="" href="<?php echo base_url().'admin/admin_page/add'; ?>"><i class="arrow_carrot-right"></i>Thêm trang</a></li>
						  <li><a class="" href="<?php echo base_url().'admin/admin_user/add'; ?>"><i class="arrow_carrot-right"></i>Thêm user</a></li>
						  <?php }?>
                      </ul>
                  </li>       
                  
                  <li>
                      <a class="" href="<?php echo base_url().'admin/admin_news'; ?>">
                          <i class="icon_document_alt"></i>
                          <span>Tin tức</span>
                      </a>
                  </li>
                  <li>                     
                      <a class="" href="<?php echo base_url().'admin/admin_cat'; ?>">
                          <i class="icon_genius"></i>
                          <span>Danh mục</span>
                          
                      </a>                   
                  </li>
                  <li>                     
                      <a class="" href="<?php echo base_url().'admin/admin_page'; ?>">
                          <i class="icon_documents_alt"></i>
                          <span>Trang</span>
                          
                      </a>                   
                  </li>
				  <li>                     
                      <a class="" href="<?php echo base_url().'admin/admin_user'; ?>">
                          <i class="icon_id"></i>
                          <span>User</span>
                          
                      </a>                   
                  </li>
                  <li>                     
                      <a class="" href="<?php echo base_url().'admin/admin_contact?select=0'; ?>">
                          <i class="icon_id"></i>
                          
                          <span>Liên hệ <?php if(isset($num_unread) && $num_unread > 0):?><span class="badge bg-important"><?php echo $num_unread?></span><?php endif;?></span>
                          
                      </a>                   
                  </li>
                  <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_cog"></i>
                          <span>Cài đặt</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                      	  <li><a class="" href="<?php echo base_url().'admin/admin_support'; ?>"><i class="arrow_carrot-right"></i>Hỗ trợ</a></li>
                          <li><a class="" href="<?php echo base_url().'admin/admin_ads'; ?>"><i class="arrow_carrot-right"></i>Quảng cáo</a></li>                          
                          <li><a class="" href="<?php echo base_url().'admin/admin_pagi'; ?>"><i class="arrow_carrot-right"></i>Phân trang</a></li>
                          <li><a class="" href="<?php echo base_url().'ckfinder/admin_ckfinder'; ?>"><i class="arrow_carrot-right"></i>Quản lý file</a></li>
						  
                      </ul>
                  </li>       
                 <?php }?>
              </ul>
              <!-- sidebar menu end-->
              
              <div style="color: #d0d8df;margin: 20px 0 20px 10px;font-style: italic;font-size: 12px">Copyright &copy; <?php echo date('Y')?> Javi</div>
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
			  <?php 
					$link = $this->router->fetch_class();
					$method = ucfirst($this->router->fetch_method());
					$arrClass = explode('_', $link);
					$class = ucfirst(array_pop($arrClass));
					$link = base_url()."admin/{$link}";
					
					$arrLink = array("$link" => "$class", "javascript:void(0)" => "$method");
					
					?>
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
					<ol class="breadcrumb">
					<li><i class="fa fa-home"></i><a href="<?php echo base_url('admin')?>">Home</a></li>
					
					<?php 
					if($class != "Index"){
						foreach ($arrLink as $key => $value){?>
						<li><a href="<?php echo $key ?>"><?php echo $value?></a></li>
					<?php 
						}
						}
					?>						  	
					</ol>
					
				</div>
			</div>