   
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
									<form class="form-validate form-horizontal" id="news_form" method="post" action="" enctype="multipart/form-data">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <?php echo form_error('tieude')?>
                                              <input class="form-control" name="tieude" type="text" value="<?php echo set_value('tieude')?>" required />
                                          </div>
                                      </div>
									  <div class="form-group">
										  <label class="control-label col-lg-2">Danh mục <span class="required">*</span></label>
										  <div class="col-lg-3">
										  <?php echo form_error('danhmuc')?>
											  <select class="form-control m-bot15" name="danhmuc" required>
												  <option value="">-- Chọn danh mục --</option>
												  <?php if(isset($arrCat)){
												  	foreach ($arrCat as $key => $value){
												  ?>
												  <option value="<?php echo $value['id_cat']?>"><?php echo $value['name_cat']?></option>
												  <?php }
												  }
												  ?>
											  </select>
										  </div>
									  </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Hình ảnh</label>
                                          <div class="col-lg-5">
                                              <input class="form-control" type="file" name="hinhanh"/>
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label class="control-label col-lg-2">Chi tiết <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('chitiet')?>
                                              <textarea class="form-control" id="content" name="chitiet" rows="5"><?php echo set_value('chitiet')?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Description (SEO)</label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('mota')?>
                                              <textarea class="form-control" name="mota" rows="2"><?php echo set_value('mota')?></textarea>
                                          </div>
                                      </div>
                                     <div class="form-group ">
                                          <label class="control-label col-lg-2">Keyword (SEO)</label>
                                          <div class="col-lg-10">
                                          <?php echo form_error('tukhoa')?>
                                              <textarea class="form-control" name="tukhoa" rows="1"><?php echo set_value('tukhoa')?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input type="submit" class="btn btn-primary" name="postNews" value="Đăng"/>
                                              <input class="btn btn-danger" type="submit" name="saveNews" value="Lưu nháp"/>
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