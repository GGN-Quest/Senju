 <?php
	
	$return = false;


	if(isset($context->appCodeNameConcatenate)){
		$return = (isset($context->appCodeNameConcatenate[1])) ? $context->appCodeNameConcatenate[1]: null;
 		if(!is_string($context->appCodeNameConcatenate[1])){ settype($context->appCodeNameConcatenate[1], 'string');}
 	} else{$return = null; }



?>