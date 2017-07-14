<?php

	namespace GGN\DPO;
	
	new Using('DPO\Page');

	new Using('DPO\Theme');


	$Driver = new Theme\Preset( (isset($Args[0]) && is_string($Args[0])) ? $Args[0] : \_GGN::varn('SYSTEM_THEME'), true, (isset($Args[1]) ? $Args[1] : []) );

?>