<?php
	
	
	$data = self::scanFolder($args[0]);
	$toScan = $data;
	$content = [];
	$row=0;
	$lim=count($toScan);
	
	
	for($x=0; $x<count($data); $x++){
		if(is_dir($data[$x])){$content = self::mergeArray($content, self::iScanFolder($data[$x]), false); }
		if(is_file($data[$x])){array_push($content, $data[$x]);}
		}
			
	return $content;
	
?>