

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
					   <form action="" method="post">
			<section class="panel">
				<header class="panel-heading"> Danh sách quảng cáo </header>
				<div class="panel-body">
					<a class="btn btn-default add-btn"
						href="<?php echo base_url()?>admin/admin_ads/add"><span
						class="fa fa-plus"></span> Thêm quảng cáo</a>

					<table class="table table-striped table-advance table-hover">
						<tbody>
							<tr>
								<th><input class="chkbox_all"
									style="display: inline; width: 20px; margin: 0px;" type="checkbox"/></th>
								<th>STT</th>
								<th>Tên QC</th>
								<th>Link QC</th>
								<th>Banner / hình ảnh</th>
								<th>Trạng thái</th>
								<th>Chức năng</th>
							</tr>
								  <?php
										$stt = 1;
										if (isset ( $arrAds )) {
											foreach ( $arrAds as $key => $value ) {
												$id_ads 	= $value ['id_ads'];
												$name_ads 	= $value ['name_ads'];
												$link_ads 	= $value ['link_ads'];
												$pic_ads 	= $value ['pic_ads'];
												$status_ads = $value ['status_ads'];
												?>	
								  
								  <tr>
								<td class="col-lg-1"><input class="chkbox"
									style="display: inline; width: 20px; margin: 0px;"
									name="checklist[]" type="checkbox" value="<?php echo $id_ads?>"/> </td>
								
								<td class="col-lg-1"><?php echo $stt?></td>
								<td class="col-lg-1"><?php echo $name_ads?></td>
								<td class="col-lg-2"><?php echo $link_ads?></td>
								<td class="col-lg-2"><img src="<?php echo IMG_UPLOAD.'/'.$pic_ads?>" width="100px"/></td>
								<td class="col-lg-2">
									 <?php
												if ($status_ads == 1) {
													?>
									<i class="fa fa-eye" aria-hidden="true"></i> Hiển thị
									 <?php
												} else {
													?>
									 <i class="fa fa-eye-slash" aria-hidden="true"></i> Không hiển thị
									 <?php
												}
												?>
									 </td>
									 
								<td class="col-lg-2">
									<div class="btn-group">
										<a class="btn btn-primary"
											href="<?php echo base_url()?>admin/admin_ads/edit/<?php echo $id_ads ?>"><i
											class="icon_pencil-edit"></i></a> 
											<a class="btn btn-danger"
											data-toggle="confirmation" data-popout="true"
											data-placement="left" data-singleton="true"
											data-title="Bạn chắc chắn xóa?"
											href="<?php echo base_url()?>admin/admin_ads/del/<?php echo $id_ads ?>"><i
											class="icon_close_alt2"></i></a>
									</div>
								</td>
							</tr>
								  <?php
												$stt ++;
											}
										}
										?>
							
							</form>
  							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
							<script
								src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
							<script
								src="http://bootstrap-confirmation.js.org/assets/js/docs.min.js"></script>
							<script
								src="http://bootstrap-confirmation.js.org/dist/bootstrap-confirmation2/bootstrap-confirmation.min.js"></script>
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
			<div class="form-group">
				<div class="col-lg-2">
					<select class="form-control m-bot15" name="tacvu" required>
						<option value=""> - Tác vụ -</option>
						<option value="display">Hiển thị</option>
						<option value="hide">Không hiển thị</option>
						<option value="delete">Xóa</option>
					</select>
				</div>
				<input type="submit" class="btn btn-default" name="apdung"
					value="Áp dụng" />
			</div>
		</form>
		<script type="text/javascript">
	$(function(){
		$(".chkbox_all").click(function(){
			$(".chkbox").prop("checked", this.checked);
		})
		});
	</script>
	</div>
</div>

</section>
</section>
<!--main content end-->