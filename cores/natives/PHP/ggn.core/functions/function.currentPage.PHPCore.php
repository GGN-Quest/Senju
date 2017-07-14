<?php

	$c = self::currentURL();
	$a = basename($c);
	$b = explode('?', $a);
	return $b[0];

?>