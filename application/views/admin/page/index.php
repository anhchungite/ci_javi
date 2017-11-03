
              
            <div class="row">
                  <div class="col-lg-12">
                  <?php if($this->session->flashdata('flash_success')){?>
				<div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_success')?>.
					  </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                              Danh sách trang
                          </header>
                          <div class="panel-body">
                           <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
							<a class="btn btn-default add-btn" href="<?php echo base_url()?>admin/admin_page/add"><span class="fa fa-plus"></span> Thêm trang mới</a>
							<?php }?>
							  <table class="table table-striped table-advance table-hover">
							   <tbody>
								  <tr>
									 <th>STT</th>
									 <th>Tên trang</th>
									 <th>Trạng thái</th>
									  <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
									 <th>Chức năng</th>
									 <?php }?>
								  </tr>
								  <?php
								  $stt = 1;
								  if(isset($arrPage)){
								  	foreach ($arrPage as $key => $value){
								  		$id_page 		= $value['id_page'];
								  		$name_page		= $value['name_page'];
								  		$status_page	= $value['status_page'];
								  ?>	
								  
								  <tr>
									 <td class="col-lg-1"><?php echo $stt ?></td>
									 <td class="col-lg-4"><?php echo $name_page ?></td>
									 <td class="col-lg-3">
									 <?php 
									 if($status_page == 1){
									 ?>
									<i class="fa fa-eye" aria-hidden="true"></i> Hiển thị
									 <?php 
									 }else {
									 ?>
									 <i class="fa fa-eye-slash" aria-hidden="true"></i> Không hiển thị
									 <?php 
									 }
									 ?>
									 </td>
									  <?php if($this->session->userdata('ss_UserInfo')['level'] <= 1){?>
									 <td class="col-lg-2">
									  <div class="btn-group">
										  <a class="btn btn-primary" href="<?php echo base_url()?>admin/admin_page/edit/<?php echo $id_page ?>"><i class="icon_pencil-edit"></i></a>
										  <a class="btn btn-danger" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?" href="<?php echo base_url()?>admin/admin_page/del/<?php echo $id_page ?>"><i class="icon_close_alt2"></i></a>
									  </div>
									  </td>
									  <?php }?>
								  </tr>
								  <?php
								  $stt++;
								  	}
								  }
								  ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="http://bootstrap-confirmation.js.org/assets/js/docs.min.js"></script>
  <script src="http://bootstrap-confirmation.js.org/dist/bootstrap-confirmation2/bootstrap-confirmation.min.js"></script>
	<script>
	  $('[data-toggle=confirmation]').confirmation();
	  $('[data-toggle=confirmation-singleton]').confirmation({ singleton: true });
	  $('[data-toggle=confirmation-popout]').confirmation({ popout: true });
	
	  $('[data-toggle=confirmation-custom]').confirmation({
	    buttons: [
	      {
	        label: 'Approved',
	        class: 'btn btn-xs btn-success',
	        icon: 'glyphicon glyphicon-ok'
	      },
	      {
	        label: 'Rejected',
	        class: 'btn btn-xs btn-danger',
	        icon: 'glyphicon glyphicon-remove'
	      },
	      {
	        label: 'Need review',
	        class: 'btn btn-xs btn-warning',
	        icon: 'glyphicon glyphicon-search'
	      },
	      {
	        label: 'Decide later',
	        class: 'btn btn-xs btn-default',
	        icon: 'glyphicon glyphicon-time'
	      }
	    ]
	  });
	</script>        
							   </tbody>
							</table>
						</div>
                      </section>
                  </div>
              </div>

          </section>
      </section>
      <!--main content end-->