<?php
/*

	<phpcore name="loadPlugins">
		Permet de charger plusieurs plugins
	</phpcore>
	
*/
	
	for($x=0;$x<count($args);$x++){
		$plg = self::isPlugin($args[$x]);
		if (!is_string($plg)){_GGN::wCnsl($GLANG["PLUGIN"]["MISSING"] . ': <b>'.$args[$x].'</b>'); continue;}
		else{include $plg;}
	}
		
?>