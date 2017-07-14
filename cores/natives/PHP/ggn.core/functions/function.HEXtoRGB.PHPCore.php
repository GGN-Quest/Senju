<?php

	   $hex = str_replace("#", "", $args[0]);
	   $row = strlen($hex);
	   $x3 = ($row===3);
	   $x6 = ($row===6);
	   $r=false;$g=false;$b=false;

	   if($x3===true){
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));} 
		if($x6===true){
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));}
	   
	   return [$r,$g,$b];
	   
?>