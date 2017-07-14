<?php
	

	/* Plugins */

	new \GGN\Using('Plugins');
	




	// $style = (defined('DEFAULT_STYLE'))?DEFAULT_STYLE: self::STYLE;
	// $Core->Style($style);

	$path = './';
	$bgOnly = 'background-repeat:no-repeat;background-position:center center;';
	$boxRadius = '7px';
	$textEllipsis = 'white-space:nowrap;overflow:hidden;text-overflow:ellipsis;';



	$imageQuality = '-high';
	$PrimaryColor = $Core->styleProperty('font-color');
	$PrimaryColorRGB = implode(',',Gougnon::HEXtoRGB($PrimaryColor));

	$SecondColor = $Core->styleProperty('font-color:hover');
	$SecondColorRGB = implode(',',Gougnon::HEXtoRGB($SecondColor));

	$SecondDarkColor = '#025b66';
	$SecondDarkColorRGB = implode(',',Gougnon::HEXtoRGB($SecondDarkColor));




	$filterIcon = '?mode=-gd&filter=colorize:'.$Core::rgbToParam($PrimaryColorRGB).'&quality='.$imageQuality.'';
	$filterIconHover = '?mode=-gd&filter=colorize:'.$Core::rgbToParam($SecondColorRGB).'&quality='.$imageQuality.'';
	$filterIconWhite = '?mode=-gd&filter=colorize:'.$Core::rgbToParam('255,255,255').'';

	$fontColorRGB = implode(',',Gougnon::HEXtoRGB($Core->styleProperty('font-color')));





	$_appiconmenu = 'globe event shield dial user userphoto activity clearn fan alerte home setting settings browser search';
	$appiconmenu = explode(' ', $_appiconmenu);








?>