
              
            <div class="row">
				<div class="col-lg-12">
					<?php if($this->session->flashdata('flash_error')){?>
				<div class="alert alert-success fade in">
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
                              if(isset($arrSP)){
						  		$name_support		= $arrSP['name_support'];
						  		$facebook_support	= $arrSP['facebook_support'];
						  		$skype_support		= $arrSP['skype_support'];
                              }
                              ?>
									<form class="form-validate form-horizontal" id="support_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Họ tên <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="name_sp" type="text" value="<?php if(isset($name_support))echo $name_support ?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Facebook <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="facebook_sp" type="text" value="<?php if(isset($facebook_support))echo $facebook_support ?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Skype <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                              <input class="form-control" name="skype_sp" type="text" value="<?php if(isset($skype_support))echo $skype_support ?>" required />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editSupport" value="Sửa"/>
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