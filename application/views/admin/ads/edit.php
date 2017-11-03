
              
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
                              if(isset($arrAds)){
						  		$name_ads	= $arrAds['name_ads'];
						  		$link_ads	= $arrAds['link_ads'];
						  		$status_ads	= $arrAds['status_ads'];
						  		$pic_ads	= $arrAds['pic_ads'];
						  		$order		= $arrAds['order'];
                              }
                              ?>
									<form class="form-validate form-horizontal" id="ads_form" method="post" action="" enctype="multipart/form-data">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                              <?php echo form_error('name_ads','<li>','</li>')?>
                                              </ul>
                                              <input class="form-control" name="name_ads" type="text" value="<?php if(isset($name_ads))echo $name_ads ?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Link</label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                              <?php echo form_error('link_ads','<li>','</li>')?>
                                              </ul>
                                              <input class="form-control" name="link_ads" type="url" value="<?php if(isset($link_ads))echo $link_ads ?>" />
                                          </div>
                                      </div>
                                      <?php if (isset($pic_ads)){?>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2"></label>
                                          <div class="col-lg-5">
                                             
	                                      	<img src="<?php echo IMG_UPLOAD?>/<?php echo $pic_ads?>" width="150px"/>
	                                      
                                          </div>
                                      </div>
                                      <?php }?>
                                      <div class="form-group">
                                          <label class="control-label col-lg-2">Hình ảnh</label>
                                          <div class="col-lg-5">
                                              <input class="form-control" type="file" name="hinhanh" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hiển thị </label>
                                          <div class="col-lg-5">
                                          	  <?php 
                                          	  $ckYes = "";
                                          	  $ckNo  = "";
                                          	  if(isset($status_ads)){
                                          	  	if($status_ads == 1){
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
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Thứ tự </label>
                                          <div class="col-lg-5">
                                              <input type="number" min="1" max="20" value="<?php if(isset($order))echo $order ?>" name="sapxep" required/>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editAds" value="Sửa"/>
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