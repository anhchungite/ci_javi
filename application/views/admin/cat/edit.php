
              
            <div class="row">
				<div class="col-lg-12">
					<?php if($this->session->flashdata('flash_error')){?>
				<div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_error')?>.
					  </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                             <?php if(isset($title))echo $title?>
                          </header>
                          <?php 
                          if(isset($arrCat)){
                          	$name_cat 	= $arrCat['name_cat'];
                          	$des_cat 	= $arrCat['des_cat'];
                          	$key_cat 	= $arrCat['key_cat'];
                          }
                          ?>
                          <div class="panel-body">
                              <div class="form">
									<form class="form-validate form-horizontal" id="cat_form" method="post" action="">
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Tên danh mục <span class="required">*</span></label>
                                          <div class="col-lg-6">
                                          <ul class="form_error">
                                          <?php echo form_error('tendm', '<li>', '</li>')?>
                                          </ul>
                                              <input class="form-control" name="tendm" type="text" value="<?php echo $name_cat ?>" required />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Description (SEO)</label>
                                          <div class="col-lg-10">
                                          <ul class="form_error">
                                          <?php echo form_error('mota', '<li>', '</li>')?>
                                          </ul>
                                              <textarea class="form-control" name="mota" rows="2"><?php echo $des_cat ?></textarea>
                                          </div>
                                      </div>
                                     <div class="form-group ">
                                          <label class="control-label col-lg-2">Keyword (SEO)</label>
                                          <div class="col-lg-10">
                                          <ul class="form_error">
                                          <?php echo form_error('tukhoa', '<li>', '</li>')?>
                                          </ul>
                                              <textarea class="form-control" name="tukhoa" rows="1"><?php echo $key_cat ?></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input class="btn btn-primary" type="submit" name="editCat" value="Sửa"/>
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