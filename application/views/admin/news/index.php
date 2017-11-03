
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
		<div class="row">
			
			<div class="col-md-12">
				<div class="form-group" style="margin-bottom: 45px;">
				<form action="" method="post">
					<div class="col-md-2">
						<select id="select_cat" class="form-control input-sm m-bot15" name="danhmuc"
							required>
							<option value="all">Tất cả</option>
							<?php 
							if(isset($arrCat)){
								foreach ($arrCat as $key => $value){
									$selected = "";
									$id_cat = $value['id_cat'];
									$name_cat = $value['name_cat'];
									if(isset($_GET['select_id']) && $_GET['select_id'] == $id_cat){
										$selected = 'selected';
									}
							?>
							<option value="<?php echo $id_cat?>" <?php if(isset($selected))echo $selected?>><?php echo $name_cat?></option>
							<?php 
								}
							}
							?>
						</select>
					</div>
					<label class="control-label col-md-1"
						style="margin-top: 5px; font-weight: bold">Tìm kiếm:</label>
					<div class="col-sm-3">
						
							<div class="input-group">
								<input type="search" name="txtSearch" class="form-control input-sm"
									placeholder="Nhập từ khóa..."> 
								<span class="input-group-btn">
									<input type="submit" name="btnSearch" class="btn btn-default btn-sm" value="Tìm kiếm"/>
								</span>
							</div>
					</div>
					</form>

					<a class="btn btn-default btn-sm" id="showall">Hiển thị tất cả</a>
                                  
				</div>
			</div>
			
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
		<script type="text/javascript">
		var current_url = '<?php echo current_url()?>';
		$("#select_cat").change(function(){
			var id_cat = $("#select_cat").val();
			$(location).attr('href', current_url+'?select_id='+id_cat);
		});
		$("#showall").click(function(){
			$(location).attr("href", current_url);
		});
		</script>
		<form action="" method="post">
			<section class="panel">
				<header class="panel-heading"> Danh sách tin </header>
				<div class="panel-body">
					<a class="btn btn-default add-btn"
						href="<?php echo base_url()?>admin/admin_news/add"><span
						class="fa fa-plus"></span> Thêm tin</a>
					<table class="table table-striped table-advance table-hover">
						<tbody>
							<tr>

								<th><input type="checkbox" class="chkbox_all"></th>
								<th>Tên</th>
								<th>Danh mục</th>
								<th>Ngày đăng</th>
								<th>Người đăng</th>
								<th>Hình ảnh</th>
								<th>Trạng thái</th>
								<th>Chức năng</th>
							</tr>
								  <?php
										if (isset ( $arrNews )) {
											foreach ( $arrNews as $key => $value ) {
												$id_news = $value ['id_news'];
												$name_news = $value ['name_news'];
												$name_cat = $value ['name_cat'];
												$date_public = $value ['date_public'];
												$fullname = $value ['fullname'];
												$pic_news = $value ['pic_news'];
												$status_news = $value ['status_news'];
												if ($pic_news == "") {
													$pic_news = "Không có hình";
												} else {
													$url_img = IMG_UPLOAD . '/' . $pic_news;
													$pic_news = "<img src='{$url_img}' width='100px'/>";
												}
												?>
								  	
								  <tr>
								<td class="col-lg-1"><input class="chkbox" type="checkbox"
									name="checklist[]" value="<?php echo $id_news?>"></td>
								<td class="col-lg-3"><?php echo $name_news?></td>
								<td class="col-lg-2"><?php echo $name_cat?></td>
								<td class="col-lg-1"><?php echo $date_public?></td>
								<td class="col-lg-1"><?php echo $fullname?></td>
								<td class="col-lg-1"><?php echo $pic_news?></td>
								<td class="col-lg-1"><?php echo $status_news?></td>
								<td class="col-lg-1">
									<div class="btn-group">
										<a class="btn btn-primary"
											href="<?php echo base_url()?>admin/admin_news/edit/<?php echo $id_news ?>"><i
											class="icon_pencil-edit"></i></a> <a class="btn btn-danger"
											data-toggle="confirmation" data-popout="true"
											data-placement="left" data-singleton="true"
											data-title="Bạn chắc chắn xóa?"
											href="<?php echo base_url()?>admin/admin_news/del/<?php echo $id_news ?>"><i
											class="icon_close_alt2"></i></a>
									</div>
								</td>
							</tr>
								  <?php
											}
										}
										?>                        
							   </tbody>
					</table>

				</div>
			</section>
			<div class="form-group">
				<div class="col-lg-2">
					<select class="form-control m-bot15" name="tacvu" required>
						<option value="">- Tác vụ -</option>
						<option value="post">Đăng</option>
						<option value="save">Lưu nháp</option>
						<option value="delete">Xóa</option>
					</select>
				</div>
				<div class="col-lg-1">
				<input type="submit" class="btn btn-default" name="apdung"
					value="Áp dụng" />
				</div>
				
					<div class="col-lg-9 text-right">
                                  <ul class="pagination" style="margin: 0px 20px 0px 0px;">
                                      <?php echo $this->pagination->create_links();?>
                      				</ul>
                      				</div>
					
			</div>
		</form>
		<script
			src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
