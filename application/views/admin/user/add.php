
              
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
									<form class="form-validate form-horizontal" id="user_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tên người dùng <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('username')?>
                                              <input class="form-control" name="username" type="text" value="<?php echo set_value('username')?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('password')?>
                                              <input class="form-control" name="password" type="password" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Xác nhận mật khẩu <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('re-password')?>
                                              <input class="form-control" name="re-password" type="password" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Email <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('email')?>
                                              <input class="form-control" name="email" type="email"  value="<?php echo set_value('email')?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Họ và tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('fullname')?>
                                              <input class="form-control" name="fullname" type="text"  value="<?php echo set_value('fullname')?>"/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Phân quyền <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                          	<div class="row">
                                          		<?php
                                          		if(isset($arrLevel)){
	                                          		foreach ($arrLevel as $key => $value){
	                                          			if($key > 0){
	                                          		?>
	                                          			<div class="col-md-3" style="text-align: center">
	                                          				<input type="radio" name="quyen" value="<?php echo $key ?>" required> <?php echo ucfirst($value)?>
		                                            	</div>
		                                            <?php 
	                                          			}
													}
                                          		}
                                          		
	                                            ?>	
                                             </div>
                                           </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="addUser" value="Thêm"/>
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