/* Fichier : Gougnon.CSS.Styler.cssg, Nom : Gougnon CSS Styler, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* 
	Entrée de commande / DEBUT //////////////////////////////////////
*/

$Core->selector('.terminal-cmd-input'

	, [

		'resize'=> 'none'

		, 'background-color && border-color'=> 'transparent !important'

		, 'padding-left'=> '0px !important'

	]

);

/* 
	Entrée de commande / FIN //////////////////////////////////////
*/





/* 
	Console : Viewer / DEBUT //////////////////////////////////////
*/

// $Core->selector('.terminal-viewer'

// 	, [

// 	]

// );

$Core->selector('[terminal-cmd]'

	, [

		'cursor' => 'pointer'

	]

);

$Core->selector('.terminal-viewer .bloc'

	, [

		'padding' => '16px'

	]

);

// $Core->selector('.terminal-viewer .line'

// 	, [

// 		'padding' => '12px'

// 	]

// );

$Core->selector('.terminal-viewer b'

	, [

		'color' => $Core->styleProperty('font-color')

	]

);

$Core->selector('.terminal-viewer .cmd-line'

	, [

		'padding-top' => '12px'

		, 'color' => $Core->styleProperty('font-color')

	]

);

/* 
	Console : Viewer / FIN //////////////////////////////////////
*/





/* 
	Console : Procedure / DEBUT //////////////////////////////////////
*/

$Core->selector('.prc-content .proc-item input'

	, [

		'border-color && background-color' => 'transparent'

		, 'border-bottom' => '2px solid ' . $Core->styleProperty('palette-primary-color') 

	]

);

/* 
	Console : Procedure / FIN //////////////////////////////////////
*/

