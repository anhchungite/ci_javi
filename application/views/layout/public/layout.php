<?php $this->load->view("layout/public/inc/header"); ?>
<div id="content">
            <div class="main-content">
               <!-- =============================== CONTENT [LEFT] =============================== -->
               <div class="body-left fl">
<?php $this->load->view("layout/public/inc/leftbar"); ?>
</div>
               <!-- =============================== CONTENT [RIGHT] =============================== -->
 <div class="body-right fr">
<?php 
	$class 		= $this->router->fetch_class();
	$arrClass 	= explode('_', $class);
	$controller = array_pop($arrClass);
	$method		= $this->router->fetch_method();
	$this->load->view("{$controller}/{$method}"); 
?>
</div>
            </div>
            <div class="clr"></div>
         </div>
<?php $this->load->view("layout/public/inc/footer"); ?>
