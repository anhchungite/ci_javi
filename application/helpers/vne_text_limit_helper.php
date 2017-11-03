<?php
function text_limit($string,$num=300)
   		{
   			if(strlen($string)<=$num) return $string;
   			$number=strpos($string,' ',$num);
   			$str=substr($string,0,$number)."....";
   			return $str;
   		}
?>