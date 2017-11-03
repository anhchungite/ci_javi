
<!DOCTYPE html public>
<html>
   <head>
      <title><?php echo $title.' | Dự án Javi' ?></title>
      <meta name="keywords" content="<?php echo $keyword ?>" />
	  <meta name="description" content="<?php echo $description ?>" />
      <meta content="text/html; charset=UTF-8" http-equiv="Content-type"/>
      <link rel="icon" type="image/png" href="<?php echo TEMPLATE_PUBLIC?>/images/ci-icon.png" />
      <link href="<?php echo TEMPLATE_PUBLIC ?>/style/reset.css" rel="stylesheet" type="text/css"/>
      <link href="<?php echo TEMPLATE_PUBLIC ?>/style/style.css" rel="stylesheet" type="text/css"/>
      <link href="http://javionline.vinaenter.com/templates/public/css/style.css" rel="stylesheet" type="text/css"/>
      
      <script type="text/javascript" src="<?php echo TEMPLATE_PUBLIC ?>/js/jquery-2.2.1.min.js"></script>
   </head>
   <body>
   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=675551105929898";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
      <div id="wrapper">
         <!-- =============================== HEADER =============================== -->
         <div id="top-nav">
			<div class="main-content">
				<p class="fl">
					<a href="<?php echo base_url().'page/lien-he/2'?>" title="">[+] Gửi ý kiến phản hồi cho chúng tôi</a>
				</p>
				<p class="fr mail-icon">
					<a href="<?php echo base_url().'page/lien-he/2'?>" title="">HOT line: 0909.123.456 - 064.3456.789</a>
				</p>
				<div class="clr"></div>
			</div>
		</div>
         <div id="header">
         	<style>
	            .main-content ul li.current a {
				  background: none repeat scroll 0 0 #05559C;
				  border-radius: 6px;
				  color: #fff !important;
				  padding: 3px 14px 5px;
				}
				.main-content ul li.current a:hover {
				  color: #FFE4F3;
				}
            </style>
            <div class="main-content">
	            
               <ul style="margin-top: 145px">
                  <li class="<?php if(!isset($current_page))echo 'current'?>">
                     <a title="" href="<?php echo base_url()?>">Trang chủ</a>
                  </li>
                  <?php 
                  if(isset($arrPage)){
                  	foreach ($arrPage as $value){
                  		$current = '';
                  		$id_page 	= $value['id_page'];
                  		$name_page 	= $value['name_page'];
                  		$url_page 	= $value['url_page'];
                  		if(isset($current_page) && $current_page == $id_page){
                  			$current = 'current';
                  		}
                  ?>
                  <li class="<?php echo $current?>">
                     <a title="<?php echo $name_page?>" href="<?php echo base_url().'page/'.$url_page.'/'.$id_page?>"><?php echo $name_page?></a>
                  </li>
                  <?php
                  	}
                  }
                  ?>
               </ul>
               <div class="clr"></div>
            </div>
         </div>
