       
            <div class="row">
                  <div class="col-lg-12">
					  <?php if($this->session->flashdata('flash_success')){?>
					  <div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_success')?>.
					  </div>
				     <?php }?>
				     <?php if($this->session->flashdata('flash_error')){?>
					  <div class="alert alert-danger fade in">
						  <strong>Error!</strong> <?php echo $this->session->flashdata('flash_error')?>.
					  </div>
				     <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                              Danh sách người dùng
                          </header>
                          <div class="panel-body">
                          <?php 
                          if($this->session->userdata('ss_UserInfo')['level'] <= 1){
                          	
                          ?>
						  <a class="btn btn-default add-btn" href="<?php echo base_url('admin/admin_user/add')?>"><span class="fa fa-plus"></span> Thêm người dùng</a>
						  <?php 
                          }
						  ?>
							  <table class="table table-striped table-advance table-hover">
							   <tbody>
								  <tr>
									 <th>STT</th>
									 <th>Tên người dùng</th>
									 <th>Tên đầy đủ</th>
									 <th>Email</th>
									 <th>Chức vụ</th>
									 <th>Chức năng</th>
								  </tr>
								  <?php 
								  $stt = 1;
								  if(isset($arrUser)){
								  	foreach ($arrUser as $key => $value){
								  		$id_user 		= $value['id_user'];
								  		$username 		= $value['username'];
								  		$email 			= $value['email'];
								  		$fullname 		= ucfirst($value['fullname']);
								  		$level 			= $value['level'];
								  		
								  ?>
								  
								  <tr>
									 <td class="col-lg-1"><?php echo $stt ?></td>
									 <td class="col-lg-2"><?php echo $username ?></td>
									 <td class="col-lg-2"><?php echo $fullname ?></td>
									 <td class="col-lg-2"><?php echo $email ?></td>
									 <td class="col-lg-2"><?php foreach ($arrLevel as $key => $value){if($key == $level)echo $value;}?></td>
									 <td class="col-lg-1">
									  <div class="btn-group">
									  <?php 
									  $btnEdit = "enabled";
									  $btnDel = "enabled";
									  $ss_UserInfo = $this->session->userdata('ss_UserInfo');
									  if($ss_UserInfo['level'] <= $level){
										  if($ss_UserInfo['level'] > $level || $ss_UserInfo['level'] == $level && $ss_UserInfo['id_user'] != $id_user){
										  	$btnEdit = "disabled";
										  }
										  
										  if($ss_UserInfo['level'] >= $level || $ss_UserInfo['level'] == $level && $ss_UserInfo['id_user'] == $id_user){
										  	$btnDel = "disabled";
										  }
										  ?>
										  <a class="btn btn-primary <?php echo $btnEdit?>" href="<?php echo base_url().'admin/admin_user/edit/'.$id_user?>"><i class="icon_pencil-edit"></i></a>
										  <a class="btn btn-danger <?php echo $btnDel?>" data-toggle="confirmation" data-popout="true" data-placement="left" data-singleton="true" data-title="Bạn chắc chắn xóa?" href="<?php echo base_url().'admin/admin_user/del/'.$id_user?>"><i class="icon_close_alt2"></i></a>
									  <?php 
									  }
									  ?>
									  </div>
									  </td>
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