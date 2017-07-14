<?php
	$d = $args[0];
	$a = explode("|", $d);$ret=0;$r=FALSE; 
	while($r===FALSE){$k = rand(0, count($a));if(isset($a[$k])){$ret = $k;$r=TRUE;}}
	return $ret;
?>