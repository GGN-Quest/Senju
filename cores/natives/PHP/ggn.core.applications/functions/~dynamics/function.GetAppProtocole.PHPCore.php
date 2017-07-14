 <?php
	
	$return = false;


	if(isset($context->appCodeNameConcatenate[0])){
		$return = (isset($context->appCodeNameConcatenate[0])) ? $context->appCodeNameConcatenate[0]: null;
		if(!is_string($context->appCodeNameConcatenate[0])){ settype($context->appCodeNameConcatenate[0], 'string');}
	} else{$return = null; }



?>