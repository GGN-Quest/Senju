<?php
	
	$return = false;
	
	$reader = (isset($args[0]))?$args[0]:false;
	$option = (isset($reader['option']))?$reader['option']:'{}';
	$option = self::inputDecoder($option);

	if(is_array($reader)&&is_array($option)){

		if(isset($option['column'])){
			$return = $option['column'];
		}

	}

?>