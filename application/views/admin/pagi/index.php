
              
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
                              Cài đặt phân trang
                          </header>
                          <div class="panel-body">
							  <table class="table table-striped table-advance table-hover">
							   <tbody>
								  <tr>
									 <th>Khu vực</th>
									 <th>Tin/trang</th>
									 <th>Chức năng</th>
								  </tr>
								 
								  <?php 
								  if(isset($arrPagi)){
								  
								  	foreach ($arrPagi as $value){
								  		$layout = $value['layout'];
								  		$number = $value['number'];
								  ?>
								  <form action="" method="post">
									  <tr>
										  
											 <td class="col-lg-2"><?php if(isset($layout))echo $layout?></td>
											 <td class="col-lg-4">
											 	<input type="hidden" name="layout" value="<?php if(isset($layout))echo $layout?>">
											 	<input name="number" value="<?php if(isset($number))echo $number?>" type="number" min="1" max="50"/>
											 </td>
												
											 <td class="col-lg-2">
												  <input class="btn btn-primary btn-sm" type="submit" name="btn_<?php if(isset($layout))echo $layout?>" value="Cập nhật"/>
											  </td>
										  
									  </tr>
								  </form>
								  <?php 
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