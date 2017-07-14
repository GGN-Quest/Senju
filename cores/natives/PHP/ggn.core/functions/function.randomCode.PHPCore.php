<?php
	
	$type = (isset($args[0]))?$args[0]:"-alpha.numeric";
	$length = (isset($args[1]))?$args[1]:9;
	
	$_alpha = explode("|", STR_ALPHA_KEY);
	$_numeric = explode("|", STR_NUMERIC_KEY);
	$_alphaNumeric = explode("|", STR_ALPHA_AND_NUMERIC_KEY);
	$_type = strtolower($type);
	$_code = "";
	
	
	
		for($x=0;$x<($length);$x++){ 
			if($_type=="-alpha"){ $_code .= $_alpha[self::randomGetKeyOfStr(STR_ALPHA_KEY)]; }
			if($_type=="-numeric"){ $_code .= $_numeric[self::randomGetKeyOfStr(STR_NUMERIC_KEY)]; }
			if($_type=="-alpha.numeric"){ $_code .= $_alphaNumeric[self::randomGetKeyOfStr(STR_ALPHA_AND_NUMERIC_KEY)]; }
			}
			
	return $_code;	
?>