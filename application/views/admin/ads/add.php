
              
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
									<form class="form-validate form-horizontal" id="ads_form" method="post" action="" enctype="multipart/form-data">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          	  <ul class="form_error">
                                              <?php echo form_error('name_ads','<li>','</li>')?>
                                              </ul>
                                              <input class="form-control" name="name_ads" type="text" value="<?php echo set_value('name_ads') ?>" />
                                              
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Liên kết</label>
                                          <div class="col-lg-6">
                                             <ul class="form_error">
                                              <?php echo form_error('link_ads','<li>','</li>')?>
                                              </ul>
                                              <input class="form-control" name="link_ads" type="url" value="<?php echo set_value('link_ads') ?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hình ảnh</label>
                                          <div class="col-lg-5">
                                              <input class="form-control" type="file" name="hinhanh" required/>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hiển thị </label>
                                          <div class="col-lg-5">
                                              <input class="form-control" style="display: inline; width: 20px;height: 20px;margin: 0px;" name="trangthai" type="radio" value="1" checked> Yes 
                                              <input class="form-control" style="display: inline; width: 20px;height: 20px;margin: 0px;" name="trangthai" type="radio" value="0" > No
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Thứ tự </label>
                                          <div class="col-lg-5">
                                              <input type="number" min="1" max="20" value="1" name="sapxep" required/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="addAds" value="Thêm"/>
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