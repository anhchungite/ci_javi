<?php
if(isset($arrNews)){
	$name_news 		= $arrNews['name_news'];
	$detail_news 	= $arrNews['detail_news'];
	$date_update 	= $arrNews['date_update'];
	$id_cat 		= $arrNews['id_cat'];
	$name_cat 		= $arrNews['name_cat'];
	$url_cat 		= $arrNews['url_cat'];
	
}
?>
<div class="news-block detail">
   <h1 class="title"><?php echo $name_news?></h1>
   <p class="cat-date">
      <a title="<?php echo $name_news?>" href="<?php echo base_url().$url_cat.'/'.$id_cat?>"><?php echo $name_cat?></a> <span>Cập nhật: <?php echo $date_update?></span>
   </p>
   <!-- Like/Share FB -->
   <div class="fb-like" data-href="<?php echo current_url()?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
   <div style="margin: 6px 0 20px 0;border-bottom: 1px solid #e9ebee;"></div>
   <!-- End Like/Share FB -->
   <div class="content-detail"><?php echo $detail_news?></div>
   <!-- Comment FB -->
   <div class="fb-comments" data-href="<?php echo current_url()?>" data-width="auto" data-numposts="5"></div>
   <!-- End Comment FB -->
   <div class="orther-detail">
      <div class="orther-news">
         <p class="title orther-icon">Các tin khác</p>
         <div class="items">
            <ul>
            <?php 
   				if(isset($arrRelated)):
   					foreach ($arrRelated as $key => $value):
   						$id_news 	= $value['id_news'];
   						$name_news 	= $value['name_news'];
   						$pic_news 	= $value['pic_news'];
   						$url_news 	= $value['url_news'];
   						if($key <= 3):
   			?>
               <li>
                  <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>">
                  <img alt="" src="<?php echo IMG_UPLOAD.'/'.$pic_news?>"/>
                  </a>
                  <p>
                     <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>"><?php echo $name_news?></a>
                  </p>
               </li>
               <?php 
               		endif;
               	endforeach;
               endif;
               ?>
            </ul>
            <div class="clr"></div>
         </div>
         <div class="items-noimg">
            <ul>
            
            <?php 
   				if(isset($arrRelated)):
   					foreach ($arrRelated as $key => $value):
   						$id_news 	= $value['id_news'];
   						$name_news 	= $value['name_news'];
   						$pic_news 	= $value['pic_news'];
   						$url_news 	= $value['url_news'];
   						if($key > 3):
   			?>
               <li><a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>"><?php echo $name_news?></a></li>
             <?php 
               		endif;
               	endforeach;
               endif;
              ?>
            </ul>
            <div class="clr"></div>
         </div>
      </div>
   </div>
</div>