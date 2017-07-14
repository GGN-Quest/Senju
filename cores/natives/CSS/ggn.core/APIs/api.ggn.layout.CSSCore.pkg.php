/* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* 
	Feuille  =================================================== 
*/
	
	$Core->selector('html,body,.gui.sheet'
		, [
			'width && height'=> '100%'
		]
	);





/* 
	Dimension  =================================================== 
*/





/* 
	Barre de Navigation  =================================================== 
*/
	
	$Core->selector('.gui.layout.navbar'
		, [
			'position'=> 'fixed'
			,'top && left'=> '0px'
		]
	);

	/* Barre horizontale */
	$Core->selector('.gui.layout.navbar.flex.row', ['width'=> '100%'] );
	$Core->selector('.gui.layout.navbar.flex.row.full-size', ['width'=> '100vw'] );

	/* Barre verticale */
	$Core->selector('.gui.layout.navbar.flex.column', ['height'=> '100%'] );
	$Core->selector('.gui.layout.navbar.flex.column.full-size', ['height'=> '100vh'] );



	/* Logo Debut ===============================  */

		/* Logo : Alignement Gauche */
		$Core->selector('.gui.layout.navbar.align-left .logo', ['margin-right'=> '10px'] );

		/* Logo : Alignement Doite */
		$Core->selector('.gui.layout.navbar.align-right .logo', ['margin-left'=> '10px'] );

		/* Logo : Alignement Haut */
		$Core->selector('.gui.layout.navbar.flex.column.align-top .logo', ['margin-bottom'=> '10px']);

		/* Logo : Alignement Bas */
		$Core->selector('.gui.layout.navbar.flex.column.align-bottom .logo', ['margin-top'=> '10px']);

	/* Logo Fin ===============================  */


/* 
	Barre de Navigation FIN =================================================== 
*/










/* 
	Item DEBUT ======================================
*/

/* Item  */
$Core->selector('.gui.items'
	, [
	]
);

$Core->selector('.gui.items > .items'
	, [
		'padding'=> '0px'
	]
);

$Core->selector('.gui.items > .items > .item'
	, [
		// 'padding'=> '5px'
	]
);


/* 
	Item FIN =================================================== 
*/










/* 
	Menu DEBUT ======================================
*/

/* Menu horizontal */
$Core->selector(
		'.gui.layout.menu'
		. ',.gui.layout.menu > .items'
		. ',.gui.layout.menu > .items > .item'
	, [
		'height'=> '100%'
	]
);


$Core->selector('.gui.layout.menu > .items > .item > .label'
	, [
		'padding'=> '0px 12px'
	]
);



/* Menu vertical */
$Core->selector(
		'.gui.layout.menu'
		. ',.gui.layout.menu > .items.column'
		. ',.gui.layout.menu > .items.column > .item'
	, [
		'width'=> '100%'
	]
);



$Core->selector('.gui.layout.menu > .items.column > .item > .label'
	, [
		'padding'=> '12px'
	]
);




/* Avec Sous menu */
$Core->selector('.gui.gabarit.menu > .items > .item.with-sub-item'

	, [
		'position'=> 'relative'
	]

);

$Core->selector('.gui.gabarit.menu > .items > .item.with-sub-item > .sub-item'

	, [
		'min-width'=> '100%'
		,'position'=> 'absolute'
		,'top'=> '100%'
		,'left'=> '0px'
	]

);

/* 
	Menu FIN ======================================
*/










/* 
	Container DEBUT ======================================
*/

	/* X-Conteneur */
	$Core->selector('.gui.layout.x-container'
		, [
			'width'=> '100vw'
			,'height'=> '100vh'
		]
	);



	/* Conteneur lorsque suivi de navbar */
	$Core->selector('.gui.layout.navbar.row ~ .gui.layout.x-container'
		, [
			// 'padding-top'=> '50px'
		]
	);


/* 
	Container FIN ======================================
*/






?>