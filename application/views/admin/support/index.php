
              
            <div class="row">
                  <div class="col-lg-12">
                  <?php if($this->session->flashdata('flash_success')){?>
				<div class="alert alert-success fade in">
						  <strong>Success!</strong> <?php echo $this->session->flashdata('flash_success')?>.
					  </div>
					  <?php }?>
                      <section class="panel">
                          <header class="panel-heading">
                              Danh sách hỗ trợ
                          </header>
                          <div class="panel-body">
							
							  <table class="table table-striped table-advance table-hover">
							   <tbody>
								  <tr>
									 <th>STT</th>
									 <th>Họ tên</th>
									 <th>Facebook</th>
									 <th>Skype</th>
									 <th>Chức năng</th>
								  </tr>
								  <?php
								  $stt = 1;
								  if(isset($arrSP)){
								  	foreach ($arrSP as $key => $value){
								  		$id_support 		= $value['id_support'];
								  		$name_support		= $value['name_support'];
								  		$facebook_support	= $value['facebook_support'];
								  		$skype_support		= $value['skype_support'];
								  ?>	
								  
								  <tr>
									 <td class="col-lg-1"><?php echo $stt ?></td>
									 <td class="col-lg-2"><?php echo $name_support ?></td>
									 <td class="col-lg-3"><?php echo $facebook_support ?></td>
									 <td class="col-lg-3"><?php echo $skype_support ?></td>
									 <td class="col-lg-2">
									  	<a class="btn btn-primary" href="<?php echo base_url()?>admin/admin_support/edit/<?php echo $id_support ?>"><span class="icon_pencil-edit"></span> Sửa</a>
									  </td>
								  </tr>
								  <?php
								  $stt++;
								  	}
								  }
								  ?>   
							   </tbody>
							</table>
						</div>
                      </section>
                  </div>
              </div>

          </section>
      </section>
      <!--main content end-->