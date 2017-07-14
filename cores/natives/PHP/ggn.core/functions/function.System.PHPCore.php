<?php
	
	return ((!class_exists('GSystem')))?_GGN::PHPCore('ggn.core.system'):new GSystem();
?>