
              
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
                              if(isset($arrPage)){
						  		$name_page		= $arrPage['name_page'];
						  		$detail_page	= htmlspecialchars($arrPage['detail_page']);
						  		$status_page	= $arrPage['status_page'];
                              }
                              ?>
									<form class="form-validate form-horizontal" id="page_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('tieude')?>
                                              <input class="form-control" name="tieude" type="text" value="<?php if(isset($name_page))echo $name_page ?>" />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Nội dung <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('noidung')?>
                                              <textarea class="form-control ckeditor" name="noidung" rows="5"><?php if(isset($detail_page))echo $detail_page ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hiển thị </label>
                                          <div class="col-lg-5">
                                          	  <?php 
                                          	  $ckYes = "";
                                          	  $ckNo  = "";
                                          	  if(isset($status_page)){
                                          	  	if($status_page == 1){
                                          	  		$ckYes = "checked";
                                          	  	}else {
                                          	  		$ckNo = "checked";
                                          	  	}
                                          	  }
                                          	  ?>
                                              <input class="form-control" style="display: inline; width: 20px;margin: 0px;" name="trangthai" type="radio" value="1" <?php echo $ckYes?>> Yes 
                                              <input class="form-control" style="display: inline; width: 20px;margin: 0px;" name="trangthai" type="radio" value="0" <?php echo $ckNo?>> No
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editPage" value="Sửa"/>
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