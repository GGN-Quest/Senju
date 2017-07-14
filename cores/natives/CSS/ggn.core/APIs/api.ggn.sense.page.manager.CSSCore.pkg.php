/* Fichier : Gougnon.CSS.Gabarit.cssg, Nom : Gougnon CSS Gabarit, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');






$Core->selector('.sense-logo-x64'
	
	, [
	
		'background-image' => 'url(' . HTTP_HOST . 'logo/ggn.sense.png' . $GUI['IMAGE_FILTER_PRIMARY_TONE'] . '&width=32&height=32)'
	
	]

);





/* 
	Ouvreur / DEBUT /////////////////////////////////
*/

$Core->selector('.sense-pm-qs-opener'
	
	, [
	
		'bottom && left' => '0%'

		, 'background-color' => 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.96)'

		, 'opacity' => '1'
	
	]

);

$Core->selector('.sense-pm-qs-opener:hover'
	
	, [
	
		'background-color' => '' . $Core->styleProperty('background-color') . ''
	
	]

);

$Core->selector('.sense-pm-qs-opener.actived'
	
	, [
	
		'opacity' => '0.0'
	
	]

);



/* 
	Ouvreur / FIN /////////////////////////////////
*/





/* 
	Fentre / DEBUT /////////////////////////////////
*/

$Core->selector('.sense-pm-windoo'
	
	, [
	
		'bottom && left' => '0%'

		, 'width' => '100vw'

		, 'height' => '0px'

		, 'overflow-x && overflow-y' => 'hidden'

		// , 'background-color' => 'rgba(0,0,0,.86)'
	
	]

);

$Core->selector('.sense-pm-windoo.open'
	
	, [
	
		'height' => '100vh'
	
	]

);



$Core->selector(

		'.sense-pm-windoo > .light'

		. ', .sense-pm-windoo > .container'
	
	, [
	
		'top && left' => '0px'
	
	]

);

$Core->selector('.sense-pm-windoo > .light'
	
	, [
	
		'z-index' => '1'

		, 'background-color' => 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.97)'
	
	]

);


$Core->selector('.sense-pm-windoo > .container'
	
	, [
	
		'z-index' => '5'
	
	]

);

$Core->selector('.sense-pm-windoo > .container.mode-menu'
	
	, [

		'width' => '720px'

		, 'height' => '320px'
	
	]

);


$Core->selector('.sense-pm-windoo > .container.mode-full'
	
	, [
	
		'width' => '100%'

		, 'height' => '100%'
	
	]

);

	$Core->openMedia(' (max-width: '.$Core::SCREEN_Mi_MAX.') ');

		$Core->selector('.sense-pm-windoo > .container.mode-menu'
			
			, [
			
				'width' => '100%'

				, 'height' => '100%'
			
			]

		);

	$Core->closeMedia();



$Core->selector('.sense-pm-windoo > .container > .head'
	
	, [
	
		'background-color' => 'rgba(0,0,0,.45)'
	
	]

);


$Core->selector('.sense-pm-windoo > .container.mode-full > .head'
	
	, [
	
		'background-color' => 'transparent'
		// 'background-color' => 'rgba(' . $Core->styleProperty('palette-primary-color-rgb') . ',.86)'
	
	]

);


$Core->selector('.sense-pm-windoo > .container > .head > .title'
	
	, [
	
		'padding' => '8px 12px'

		, 'font-size' => '22px'
	
	]

);


$Core->selector('.sense-pm-windoo > .container > .head > .x-icon'
	
	, [
	
		'font-size' => '32px'

		, 'padding' => '8px 12px'

		, 'cursor' => 'pointer'
	
	]

);

$Core->selector(

		'.sense-pm-windoo > .container > .head > .x-icon:hover'

		. ',.sense-pm-windoo > .container > .head > .x-icon:focus'

		. ',.sense-pm-windoo > .container > .body .items .item:hover'

		. ',.sense-pm-windoo > .container > .body .items .item:focus'
	
	, [
	
		'color' => '' . $Core->styleProperty('palette-light-color') . ' !important'

		, 'background-color' => '' . $Core->styleProperty('palette-primary-color') . ' !important'
	
	]

);



$Core->selector('.sense-pm-windoo > .container > .body .items'
	
	, [

		'background-color' => 'rgba(0,0,0,.28)'
	
	]

);



/* 
	Fentre / FIN /////////////////////////////////
*/








?>