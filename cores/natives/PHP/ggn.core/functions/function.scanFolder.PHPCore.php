<?php
	
	$f = $args[0]; 
	
	$content = [];
	
	$f = ((substr($f,-1)=='/')? $f: $f.'/'); 
	
	$Dir = opendir($f);
		
	while ($rF = readdir($Dir)): 
	
		$e = $f.$rF;
	
		$bn = basename($e);

		if($bn!='.' && $bn!='..'):
	
			array_push($content, $e);
	
		endif;
		
	endwhile;
	
	return $content;
	
?>

