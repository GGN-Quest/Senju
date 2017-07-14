<?php

	$inc = $args;  $numInc = count($args);
	
	for($q=0;$q<$numInc;$q++): 
		if(file_exists($inc[$q]) or die(__SERVER_DIAL_INC_FAILED__)):
			return file_get_contents($inc[$q]);
		endif;
	endfor;

?>