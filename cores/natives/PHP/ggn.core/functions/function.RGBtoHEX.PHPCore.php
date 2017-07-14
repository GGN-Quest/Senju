<?php
	
	$hex = "#";
	$hex.= str_pad(dechex($args[0]), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($args[1]), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($args[2]), 2, "0", STR_PAD_LEFT);
	return $hex;
?>