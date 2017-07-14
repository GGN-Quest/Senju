<?php

	$inc = $args;  $numInc = count($args);
	
	for($q=0;$q<$numInc;$q++): 
		if(!file_exists($inc[$q])):
			die('Fichier Introuvable'); return false; 
		endif;
		if(file_exists($inc[$q])):
			include $inc[$q];
		endif;
	endfor;
	
?>