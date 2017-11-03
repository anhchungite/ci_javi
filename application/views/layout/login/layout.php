<?php $this->load->view("layout/login/inc/header"); ?>
<style>
.alert-login{
	webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border: 2px solid #ffd0e1; 
    opacity: 0.8;
    padding: 5px;
    width: 100%;
    border-radius: 20px;
    margin: 0 auto 10px auto;
    color: #ff2d55;
}
ul.login_error{
	padding: 0px;
	font-size: 12px;
	color: red;
}
ul.login_error li{
	list-style: circle;
	list-style-position:inside;
}
</style>
	<form class="login-form" action="" method="post">
	    
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            
            <?php if($this->session->flashdata('flash_error')){?>
            <div class="alert-login"><strong>Error!</strong> <?php echo $this->session->flashdata('flash_error')?>.
					  </div>
			<?php }?>
			<ul class="login_error">
			<?php echo form_error('username','<li>','</li>')?> 
			</ul>   
			
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username')?>" autofocus>
            </div>
            <ul class="login_error">
            <?php echo form_error('password', '<li>', '</li>')?> 
            </ul>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password" >

            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name="login" value="Đăng nhập"/>
        </div>
      </form>
<?php $this->load->view("layout/login/inc/footer"); ?>