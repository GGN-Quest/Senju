<?php 
	global $OiDevice;
	$return=true;
	
	if(file_exists(__EMPTY_FILE__)){
		$i = $args;  $in = count($args); 
		for($x=0; $x<$in; $x++){
			if(@!copy(__EMPTY_FILE__, $i[0])):
				$return=false;
				break;
			endif;
			}
		}

	return $return;
?>