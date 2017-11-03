
              
            <div class="row">
				<div class="col-lg-12">
					<?php if($this->session->flashdata('flash_error')){?>
				<div class="alert alert-danger fade in">
						  <strong>Error!</strong> <?php echo $this->session->flashdata('flash_error')?>.
					  </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                             <?php if(isset($title))echo $title?>
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
                              <?php 
                              if(isset($arrUser)){
                              	$id_user 	= $arrUser['id_user'];
                              	$username 	= $arrUser['username'];
                              	$email 		= $arrUser['email'];
                              	$fullname 	= $arrUser['fullname'];
                              	$level 		= $arrUser['level'];
                              	
                              }
                              ?>
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tên người dùng <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="username" type="text" value="<?php if(isset($username))echo $username?>" disabled />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Email </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('email')?>
                                              <input class="form-control" name="email" type="email"  value="<?php if(isset($email))echo $email?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Họ và tên </label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="fullname" type="text"  value="<?php if(isset($fullname))echo $fullname?>"/>
                                          </div>
                                      </div>
                                      
                                      <?php if ($this->session->userdata('ss_UserInfo')['level'] < $level){?>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân quyền <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                          
                                              <select class="form-control m-bot15" name="quyen" required>
												  <option value="">-- Chọn --</option>
												  <?php
												  
												  if(isset($arrLevel)){
												  	foreach ($arrLevel as $key => $value){
												  		$active = "";
												  		if($key > 0){
													  		if($level == $key){
													  			
													  			$active = 'selected = "selected"';
													  		}
												  ?>
												  <option value="<?php echo $key?>" <?php echo $active?>><?php echo ucfirst($value)?></option>
												  <?php 
												  		}	
												  	}
												  }
												  ?>
												  
											  </select>
                                          </div>
                                      </div>
                                      <?php }?>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editUser" value="Sửa"/>
                                              <input class="btn btn-default" type="reset" value="Nhập lại"/>
                                          </div>
                                      </div>
                                 </form>
                              </div>
                          </div>
                      </section>
                      <section class="panel">
                          <header class="panel-heading">
                              Đổi mật khẩu
                          </header>
                          
                          <div class="panel-body">
                              <div class="form">
                              
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mật khẩu cũ <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('old-password')?>
                                              <input class="form-control" name="old-password" type="password" required />
                                          </div>
                                      </div>
                                      <form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('new-password')?>
                                              <input class="form-control" name="new-password" type="password" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Xác nhận mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('re-password')?>
                                              <input class="form-control" name="re-password" type="password" required />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editPass" value="Đổi mật khẩu"/>
                                              <input class="btn btn-default" type="reset" value="Nhập lại"/>
                                          </div>
                                      </div>
                                 </form>
                              </div>
                          </div>
                      </section>
                  </div>
				</div>

          </section>
      </section>
      <!--main content end-->