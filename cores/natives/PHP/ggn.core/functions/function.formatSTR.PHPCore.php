<?php

		$str = $args[0];
		$str = strtr($str, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝאבגדהוחטיךכלםמןנעףפץצשתûü‎ÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$str = preg_replace('/([^.a-z0-9]+)/i', '_', $str);
		
		return $str;
		
?>