<!-- =============================== CONTENT [RIGHT] =============================== -->
<?php if(isset($arrNews)){
	foreach ($arrNews as $key => $value){
		$id_cat 	= $value['id_cat'];
		$name_cat 	= $value['name_cat'];
		$url_cat 	= $value['url_cat'];
		if (count($arrNews[$key]['news']) > 0){
?>
                  <div class="news-block">
                     <h2 class="title-cat">
                        <a title="<?php echo $name_cat?>" href="<?php echo base_url().$url_cat.'/'.$id_cat?>"><?php echo $name_cat?></a>
                     </h2>
                     <div class="content-cat">
                     <?php
                     foreach ($arrNews[$key]['news'] as $key => $value){
                     	$id_news 		= $value['id_news'];
                     	$name_news 		= $value['name_news'];
                     	$url_news 		= $value['url_news'];
                     	$date_update 	= $value['date_update'];
                     	$detail_news 	= strip_tags($value['detail_news']);
   						$preview_news 	=  text_limit($detail_news,200);
                     	$pic_news 		= $value['pic_news'];
                     	if($key == 0){
                     ?>
                        <div class="item-left fl">
                          <?php if($pic_news != ""):?>
                           <a title="<?php echo $name_news?>" href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>">
                           <img alt="<?php echo $name_news?>" src="<?php echo IMG_UPLOAD.'/'.$pic_news?>"/>
                           </a>
                           <?php endif;?>
                           <a class="title" title="<?php echo $name_news?>" href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>"><?php echo $name_news?></a>
                           <p><?php echo $preview_news?></p>
                        </div>
                       <?php }?>
                        <div class="item-right fr">
                           <ul>
                           <?php 
                           		if($key > 0){
                           	?>
                              <li>
                                 <a class="title" title="<?php echo $name_news?>" href="<?php echo base_url().$url_news.'-post'.$id_news.'.html'?>"><?php echo $name_news?></a>
                                 <p class="cat-date">
                                    <a title="<?php echo $name_cat?>" href="<?php echo base_url().$url_cat.'/'.$id_cat?>"><?php echo $name_cat?></a>
                                    <span>Cập nhật: <?php echo $date_update?></span>
                                 </p>
                                 <p class="preview"><?php echo $preview_news?></p>
                              </li>
                              <?php }?>
                           </ul>
                        </div>
                        <?php }?>
                        <div class="clr"></div>
                        
                     </div>
                  </div>
                  
<?php  
		}
	}
}
?>     
              