<?php 
if (isset($arrDetail)){
	$name_page = $arrDetail['name_page'];
	$detail_page = $arrDetail['detail_page'];
}

?>
<style>
.msg_ss {
	color: green;
	font-weight: bold;
	font-style: italic
}
.msg_er {
	color: red;
	font-weight: bold;
	font-style: italic
}
ul.contact_error{
	padding: 0px;
	font-size: 12px;
	color: red;
}
ul.contact_error li{
	list-style: circle;
	list-style-position:inside;
}
</style>
<div class="news-block">
   <h2 class="title-cat"><?php if(isset($name_page))echo $name_page?></h2>
   <?php if($this->session->flashdata('flash_success')):?>
   <div class="msg_ss"><?php echo $this->session->flashdata('flash_success'); ?></div>
   <?php endif;?>
   <?php if($this->session->flashdata('flash_error')):?>
   <div class="msg_er"><?php echo $this->session->flashdata('flash_error'); ?></div>
   <?php endif;?>	
   <div class="content-cat1">
   <ul class="contact_error">
   <?php echo validation_errors('<li>','</li>')?>
   </ul>
      <div class="content-detail">
         <p><?php if(isset($detail_page))echo $detail_page?></p>
      </div>
   </div>
</div>
<script type="text/javascript"
	src="<?php echo TEMPLATE_PUBLIC?>/js/validate_form.js"></script>