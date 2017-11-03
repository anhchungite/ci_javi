<div class="row">
   <div class="col-lg-12">
      <?php if($this->session->flashdata('flash_error')){?>
      <div class="alert alert-danger fade in">
         <strong>Error!</strong> <?php echo $this->session->flashdata('flash_error')?>.
      </div>
      <?php }?>
       <?php if($this->session->flashdata('flash_success')){?>
      <div class="alert alert-success fade in">
         <strong>Success!</strong> <?php echo $this->session->flashdata('flash_success')?>.
      </div>
      <?php }?>
      <section class="panel">
         <header class="panel-heading">
           <?php if(isset($title))echo $title?>
         </header>
         <?php 
            if(isset($arrNews)){
            	$id_cat 		= $arrNews['id_cat'];                        
            	$name_news 		= $arrNews['name_news'];                        
            	$pic_news 		= $arrNews['pic_news'];                        
            	$detail_news 	= $arrNews['detail_news'];                        
            	$des_news 		= $arrNews['des_news'];                        
            	$key_news 		= $arrNews['key_news'];                        
            }
            ?>
         <div class="panel-body">
            <div class="form">
               <form class="form-validate form-horizontal" id="news_form" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                     <label class="control-label col-lg-2">Tiêu đề <span class="required">*</span></label>
                     <div class="col-lg-6">
                     <?php echo form_error('tieude')?>
                        <input class="form-control" name="tieude" type="text" value="<?php if(isset($name_news))echo $name_news?>" required />
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
                              	$selected = "";
                              	if($id_cat == $value['id_cat']){
                              		$selected = 'selected="selected"';
                              	}
                              ?>
                           <option value="<?php echo $value['id_cat']?>" <?php echo $selected?>><?php echo $value['name_cat']?></option>
                           <?php }
                              }
                              ?>
                        </select>
                     </div>
                  </div>
                  <style>
                     .img-wrap {
                     position: relative;
                     display: inline-block;
                     border: 1px #fff solid;
                     font-size: 0;
                     }
                     .img-wrap .close {
                     position: absolute;
                     top: 2px;
                     right: 2px;
                     z-index: 100;
                     background-color: red;
                     padding: 5px 2px 2px;
                     color: #000;
                     font-weight: bold;
                     cursor: pointer;
                     opacity: .2;
                     text-align: center;
                     font-size: 22px;
                     line-height: 10px;
                     border-radius: 50%;
                     }
                     .img-wrap:hover .close {
                     opacity: 1;
                     }
                  </style>
                  <?php if($pic_news != ''):?>
                  <div class="form-group">
                     <label class="control-label col-lg-2"></label>
                     <div class="col-lg-5">
                        <div class="img-wrap">
                           <span class="close">&times;</span>
                           <img src="<?php echo IMG_UPLOAD.'/'.$pic_news?>" width="200px"/>
                        </div>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
                        <script type="text/javascript">
                           $('.img-wrap .close').click(function() {
                               var current_url = '<?php echo current_url()?>';
                               $(location).attr('href', current_url+'?delpic=true');
                           });
                        </script>
                     </div>
                  </div>
                  <?php endif;?>
                  <div class="form-group ">
                     <label class="control-label col-lg-2">Hình ảnh</label>
                     <div class="col-lg-5">
                        <input class="form-control" type="file" name="hinhanh" />
                     </div>
                  </div>
                  <div class="form-group ">
                     <label class="control-label col-lg-2">Chi tiết <span class="required">*</span></label>
                     <div class="col-lg-10">
                     <?php echo form_error('chitiet')?>
                        <textarea class="form-control ckeditor" name="chitiet" rows="5"><?php if(isset($detail_news))echo $detail_news?></textarea>
                     </div>
                  </div>
                  <div class="form-group ">
                     <label class="control-label col-lg-2">Description (SEO)</label>
                     <div class="col-lg-10">
                     <?php echo form_error('mota')?>
                        <textarea class="form-control" name="mota" rows="2"><?php if(isset($des_news))echo $des_news?></textarea>
                     </div>
                  </div>
                  <div class="form-group ">
                     <label class="control-label col-lg-2">Keyword (SEO)</label>
                     <div class="col-lg-10">
                     <?php echo form_error('tukhoa')?>
                        <textarea class="form-control" name="tukhoa" rows="1"><?php if(isset($key_news))echo $key_news?></textarea>
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