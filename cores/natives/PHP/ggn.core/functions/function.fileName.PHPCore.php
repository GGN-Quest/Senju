<?php
	
	$wr = (isset($args[1]))? $args[1]: false;
	$tr = (isset($args[2]))? $args[2]: false;
	
	$f = basename($args[0]);
	$df = dirname($args[0]);
	$type = self::fileExtension($f);
	$name = substr($f, 0, -strlen($type));
	$name = ($tr===false) ? $name:((self::isEmpty($name))?'/'.substr($type,1):$name);
	
	return (($wr===true)?$df . '/' . $name: basename($name));
?>