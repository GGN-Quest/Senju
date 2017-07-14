<?php /*

	<phpcore name="isPlugins">
		Permet de charger un plug-in si celui-ci en est un
	</phpcore>
	
*/	
	$f = __PLUGINS__.$args[0].'.plg.php';
	
	if(is_file($f)){
		return $f;
	} 

	return false;

?>