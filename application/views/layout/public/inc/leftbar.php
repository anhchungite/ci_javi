<!-- =============================== CONTENT [LEFT] =============================== -->
                  <div class="left-menu">
                     <ul>
                     <?php 
                     if(isset($_arrCat)){
                     	foreach ($_arrCat as $value){
                     		$id_cat 	= $value['id_cat'];
                     		$url_cat 	= $value['url_cat'];
                     		$name_cat 	= $value['name_cat'];
                     	?>
                     
                        <li>
                           <a title="<?php echo $name_cat?>" href="<?php echo base_url().$url_cat.'/'.$id_cat?>"><?php echo $name_cat?></a>
                        </li>
                        <?php 
                     		}
	                     }
	                     ?>
                     </ul>
                  </div>
                  
                 
                  <div class="support">
                     <p>Hỗ trợ trực tuyến</p>
                     <?php if(isset($arrSP)){
                 	foreach ($arrSP as $value){
                 		$name_sp 	= $value['name_support'];
                 		$fb_sp 		= $value['facebook_support'];
                 		$sk_sp 		= $value['skype_support'];
                 ?>
                     <div class="facebook" style="width: 45%; float: left">
                        <ul>
                           <li>
                              <a title="Chat with <?php echo $name_sp?>" href="http://fb.com/<?php echo $fb_sp?>" target="_blank"><?php echo $name_sp?></a>
                           </li>
                        </ul>
                     </div>
                     <div class="skype" style="width: 45%; float: right; margin: 0px">
                        <ul>
                           <li>
                              <a title="Chat with <?php echo $name_sp?>" href="skype:live:<?php echo $sk_sp?>?chat"><?php echo $name_sp?></a>
                           </li>
                        </ul>
                     </div>
                     <div style="margin: 10px 0; clear: both"></div>
                     <?php 
                 	}
                  }?>
                     <div class="orther">
                        <p>
                           Email:
                           <span>chungta@javionline.net</span>
                        </p>
                        <p>
                           Số điện thoại:
                           <span>01665.263646</span>
                        </p>
                     </div>
                  </div>
                  <div class="advs">
                  <?php if(isset($arrAds)){
                  	foreach ($arrAds as $value){
                  		$link_ads = $value['link_ads'];
                  		if($link_ads == ""){
                  			$link_ads = "javascript:void(0)";
                  		}
                  		$pic_ads = $value['pic_ads'];
                  ?>
                  
                     <a title="" href="<?php echo $link_ads?>" target="_blank" rel="nofollow">
                     <img alt="" src="<?php echo IMG_UPLOAD.'/'.$pic_ads?>" width="230px"/>
                     </a>
                    <?php 
                  	}
                  }?> 
                  </div>
  