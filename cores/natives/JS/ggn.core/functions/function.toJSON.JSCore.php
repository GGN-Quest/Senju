<?php
	$var = $args[0];
	$array = $args[1];
	$json = [];
	
	foreach($array as $key => $value){array_push($json, '"'.$key.'": "'.Render::toJSDocWrite($value).'"');}
	_GGN::write($var . ' = {' . implode(', ',$json) . '};');
	
	
?>