<?php 
		$wo = $args;  $wox = count($args); 
		for($x=0; $x<$wox; $x++):
			if(!file_exists($wo[$x])):
				mkdir($wo[$x], 0777, true);
			endif;
		endfor; 
		
?>