<?php

	namespace GGN\Apps;

	new \GGN\Using('Apps');

	$Page = implode('/', \Gougnon::arrayValues($this->concatenate, 1));

	$App = new Vendor('ggn.terminal.rk');

	$App->Open($Page);

?>