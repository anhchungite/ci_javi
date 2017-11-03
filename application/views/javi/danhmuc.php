
<div class="news-block">
   <h2 class="title-cat">
   <?php 
   if(isset($arrCat)){
   	 $id_cat 	= $arrCat['id_cat'];
   	 $name_cat  = $arrCat['name_cat'];
   	 $url_cat 	= $arrCat['url_cat'];
   }
   ?>
      <a href="<?php echo base_url().$url_cat.'/'.$id_cat?>" title="<?php if(isset($name_cat))echo $name_cat?>"><?php if(isset($name_cat))echo $name_cat?></a>
   </h2>
   <div class="content-cat1">
   <?php 
   if(isset($arrNews)):
   	foreach ($arrNews as $key => $value):
   		$id_news 		= $value['id_news'];
   		$name_news 		= $value['name_news'];
   		$url_news 		= $value['url_news'];
   		$pic_news 		= $value['pic_news'];
   		if($pic_news == ""){
   			$pic_news = "noimage.jpg";
   		}
   		$detail_news 	= strip_tags($value['detail_news']);
   		$preview_news =  text_limit($detail_news);

   		if($key == 0):
   ?>
      <div class="item-top">
         <div class="item-left fl">
            <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>">
            <img src="<?php echo IMG_UPLOAD.'/'.$pic_news?>" alt="<?php echo $name_news?>">
            </a>
         </div>
         <div class="item-right-cat fr">
            <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>" class="title"><?php echo $name_news?></a>
            <div style="margin: 10px;"></div>
            <p class="preview"><?php echo $preview_news ?></p>
         </div>
         <div class="clr"></div>
      </div>
      <?php 
      endif;
      if($key > 0):
      ?>
      <div class="item">
         <div class="item-left fl">
            <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>">
            <img src="<?php echo IMG_UPLOAD.'/'.$pic_news?>" alt="<?php echo $name_news?>">
            </a>
         </div>
         <div class="item-right-cat fr">
            <a href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>" title="<?php echo $name_news?>" class="title"><?php echo $name_news?></a>
            <div style="margin: 10px;"></div>
            <p class="preview"><?php echo $preview_news ?></p>
         </div>
         <div class="clr"></div>
      </div>
      
  <?php
	  	endif;
	  endforeach;
  endif;
  ?>
   </div>
   <div class="pager">
      <style>
         .page-blue a {
         padding: 3px 7px;
         border: 1px solid green;
         background: green;
         color: #FFF;
         font-weight: bold;
         text-decoration: none;
         }
         .page-blue a:hover {
         padding: 3px 7px;
         border: 1px solid #144879;
         background: #144879;
         color: #FFF;
         font-weight: bold;
         text-decoration: none;
         }
         .page-blue .nav-current-page {
         padding: 3px 7px;
         border: 1px solid #144879;
         background: #144879;
         color: #FFF;
         font-weight: bold;
         }
      </style>
      <div class="page-blue">
         <?php echo $this->pagination->create_links()?>
      </div>
   </div>
</div>