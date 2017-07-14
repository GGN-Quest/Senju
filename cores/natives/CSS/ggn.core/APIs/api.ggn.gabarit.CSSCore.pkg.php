/* Fichier : Gougnon.CSS.Gabarit.cssg, Nom : Gougnon CSS Gabarit, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* 
	De Base DEBUT ======================================
*/

$Core->selector('a:focus'
	
	, [
	
		// 'outline'=> '0px solid rgba(' . $Core->styleProperty('palette-tertiary-color-rgb') . ',.55)'
	
		// ,'background-clip'=>'content-box'
	
	]

);




/* 
	De Base FIN ======================================
*/





/* 
	Paragraphe DEBUT ======================================
*/

$Core->selector('p'

	, [

		'padding'=> '10px 15px'

	]

);


/* 
	Paragraphe FIN ======================================
*/





/* 
	Barre de Navigation DEBUT ======================================
*/

$Core->selector('.gui.gabarit.navbar'

	, [

		'background-color'=> $Core->styleProperty('palette-secondary-color')

		,'z-index'=> '100'

		,'transition'=> 'background-color 0.3s ease-out'

	]

);


/* 
	Barre de Navigation FIN ======================================
*/





/* 
	Menu DEBUT ======================================
*/


/* Minimiser */
$Core->selector('.gui.gabarit.menu-minimizing'
	, [

		'width'=> '32px'

		,'height'=> 'inherit'
	]
);

$Core->selector('.gui.gabarit.menu-minimizing .min-action'
	, [
		'font-size'=> '24px'
	]
);


/* Minimiser Retour */
$Core->selector('.gui.gabarit.menu-minimize-back'
	, [

		'height'=> '32px'

		,'padding'=> '8px 12px'
	]
);

$Core->selector('.gui.gabarit.menu-minimize-back .min-action'
	, [
		'font-size'=> '24px'
	]
);



/* Menu / DEBUT */
$Core->openMedia(' (max-width: '.$Core::SCREEN_S_MAX.') ');

	/* Minimiser Retour */

	$Core->selector('.gui.gabarit.menu-minimize-back'
		, [
		
			'position'=> 'fixed !important'

			,'margin-top'=> '-32px !important'

		]
	);



	$Core->selector('.gui.gabarit.menu.close'
	
		, [
	
			'animation'=> 'ggnTranslate-XOut 150ms ease'
	
		]
	
	);

	$Core->selector('.gui.gabarit.menu.open'
	
		, [
	
			'display'=> 'block !important'
	
			,'padding-top'=> '32px !important'

			,'position'=> 'fixed !important'
	
			,'left && top'=> '0px !important'
	
			,'width'=> '100vw !important'

			,'min-width'=> '300px !important'
	
			,'height'=> '100vh !important'

			,'overflow-x'=> 'hidden !important'

			,'overflow-y'=> 'auto !important'

			,'animation'=> 'ggnTranslate-XIn 150ms ease'
	
			,'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.8)'
	
		]
	
	);


	$Core->selector('.gui.gabarit.menu.open > .items'

		, [

			'flex-direction'=> 'column' 

			, 'align-items'=>'start'

			, 'justify-content'=>'start'

			, 'width'=> 'inherit'

		]

	);

	$Core->selector(

			'.gui.gabarit.menu.open > .items .item .iconx'

			. ',.gui.gabarit.menu.open > .items .item .label'

		, [

			'margin-left'=> '8px'

			, 'margin-right'=> 'auto'

		]

	);

	$Core->selector('.gui.gabarit.menu.open > .items .item'

		, [

			'width'=> '100%'

			,'padding'=> '0'

		]

	);

	$Core->selector('.gui.gabarit.menu.open > .items .item:hover'

		, [

			'background-color'=> '' . $Core->styleProperty('background-color:hover')

		]

	);

	$Core->selector('.gui.gabarit.menu.open > .items .item .item-decoration'

		, [

			'display'=> 'none !important'

		]

	);

$Core->closeMedia();

/* Menu / FIN */



/* Menu : Item / DEBUT */

$Core->selector('.gui.gabarit.menu, .gui.gabarit.menu > .items'
	, [
		'height'=> '100%'
	]
);

$Core->selector('.gui.gabarit.menu > .items a', ['text-decoration'=> 'none','height'=> '100%']);

$Core->selector('.gui.gabarit.menu > .items .item'

	, [

		'background-color'=> 'transparent'

		,'height'=> '100%'

		,'transition'=> 'background-color 0.3s ease-out'

	]

);


$Core->selector('.gui.gabarit.menu > .items .item .item-decoration'

	, [

		'background-color'=> 'transparent'

	]

);


$Core->selector('.gui.gabarit.menu > .items div.item > *', ['margin'=> 'auto'] );

$Core->selector(
		'.gui.gabarit.menu > .items .item:hover'
		.',.gui.gabarit.menu > .items .item.active'

	, [

		'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') .',.2)'

	]

);


/* Label */
$Core->selector('.gui.gabarit.menu > .items .item > .label'

	, [

		// 'color'=> $Core->styleProperty('font-color')

		// ,'font-size'=> '14px'

	]

);


$Core->selector(
		'.gui.gabarit.menu > .items .item:hover > .label'
		.',.gui.gabarit.menu > .items .item.active > .label'

	, [

		'filter'=> 'blur(0px)'

		,'animation'=> 'ggnBlurMotionOut 0.5s ease-out'

	]

);




/* Avec Sous menu */
$Core->selector('.gui.gabarit.menu > .items .item.with-sub-item > .sub-item'
	, [
		'width && height'=>'0px'
		,'overflow'=>'hidden'
		,'margin-top'=>'20%'
		,'transition'=>'width,margin-top, 0.3s ease-out'
	]
);

$Core->selector('.gui.gabarit.menu > .items .item.with-sub-item:hover > .sub-item'
	, [
		'width && height'=>'auto'
		,'overflow'=>'none'
		,'margin-top'=>'0px'
		,'animation'=>'ggnBlurMotionOut 0.3s ease-out'
	]
);

$Core->selector('.gui.gabarit.menu > .items .item.with-sub-item .sub-item > a', [

	// 'color'=> $Core->styleProperty('font-color')
	
]);

$Core->selector('.gui.gabarit.menu > .items .item.with-sub-item .sub-item'
	, [
		'background-color'=> $Core->styleProperty('palette-secondary-color')
	]
);


$Core->selector('.gui.gabarit.menu > .items .item.with-sub-item .sub-item > .item'
	, [
		'padding'=>'10px 15px'
	]
);


/* Menu : Item / FIN */

/* 
	Menu FIN ======================================
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
	]
);

$Core->selector('.gui.items > .items > .item'
	, [
		'padding'=> '12px 16px'
	]
);


/* Item : Vertical  */
$Core->selector('.gui.items.column'
	, [
		// ''=>''
	]
);

$Core->selector('.gui.items.column'
	, [
		'flex-direction'=> 'column'
	]
);

$Core->selector('.gui.items.column > .item'
	, [
		'padding'=> '7px 12px'
	]
);




/* Item : Horizontal  */
$Core->selector('.gui.items.row'
	, [
		// ''=>''
	]
);

$Core->selector('.gui.items.row'
	, [
		'flex-direction'=> 'row'
	]
);

$Core->selector('.gui.items.row > .item.text'
	, [
		'padding'=> '7px 12px'
	]
);





/* Item : Grille  */
$Core->selector('.gui.items.grid'
	, [
		'flex-wrap'=>'wrap'
	]
);

$Core->selector('.gui.items.grid .item'
	, [

		'flex-direction'=>'column'

		,'margin-bottom && margin-top'=>'25px'

	]
);


$Core->selector('.gui.items.grid .item > .env'
	, [

		// 'background-color'=>$Core->styleProperty('background-color')

		'padding-bottom' => '10px'
	]
);


$Core->selector('.gui.items.grid .item > *'
	, [

		'margin-left && margin-right'=>'1px'

	]
);


$Core->selector('.gui.items.grid .item .photo'
	, [

		'background-color'=>$Core->styleProperty('palette-dark-color')

		,'background-repeat'=>'no-repeat'

		,'background-position'=>'center'

		,'background-size'=>'auto 100%'

	]
);



$Core->selector(
	
		'.gui.items.grid .item .title'
	
		.',.gui.items.grid .item .about'
	
		.',.gui.items.grid .item .type'
	
	, [

		'margin-right && margin-left'=>'15px'

	]
);



$Core->selector('.gui.items.grid .item .type'
	, [

		'font-size'=>'13px'
		
	]
);


/* 
	Item FIN =================================================== 
*/







/* 
	Tag Select DEBUT =================================================== 
*/


$Core->selector('.gui.gabarit.tag-select'
	, [

		'border'=>'1px solid ' . $Core->styleProperty('textfield-border-color')

		// , 'z-index'=>'999'

		, 'color'=>$Core->styleProperty('textfield-font-color')

		, 'padding'=>'8px 16px'

		,'color'=>$Core->styleProperty('textfield-font-color')
		
		,'background-color'=>$Core->styleProperty('textfield-background-color')
		
	]
);

$Core->selector('.gui.gabarit.tag-select:hover'
	, [

		'border'=>'1px solid ' . $Core->styleProperty('textfield-border-color:hover')

		, 'color'=>$Core->styleProperty('textfield-font-color:hover')

		, 'padding'=>'8px 16px'

		,'color'=>$Core->styleProperty('textfield-font-color:hover')

		,'background-color'=>$Core->styleProperty('textfield-background-color:hover')
		
	]
);


$Core->selector('.gui.gabarit.tag-select > .label'
	, [

		// 'top'=>'-50px'
		
	]
);

$Core->selector('.gui.gabarit.tag-select > .label > .text'
	, [

		// 'padding'=>'8px 16px'
		
	]
);

$Core->selector('.gui.gabarit.tag-select > .label > .indexer'
	, [

		'padding-left'=>'8px'
		
	]
);


$Core->selector('.gui.gabarit.tag-select > .options'
	, [

		'opacity'=>'0'

		, 'z-index'=>'999'

		, 'max-height'=>'256px'

		,'margin-top'=>'8px'

		,'margin-left'=>'-17px'

		,'height'=>'0px'

		,'overflow-x && overflow-y'=>'hidden'

		,'border'=>'1px solid transparent'

		,'background-color'=>$Core->styleProperty('background-color')
		
	]
);


$Core->selector('.gui.gabarit.tag-select.focus > .options'
	, [

		'opacity'=>'1'

		,'box-shadow'=>'0px 5px 3px rgba(' . $Core->styleProperty('dark-shadow-color-rgb') . ',.2)'

		,'border'=>'1px solid ' . $Core->styleProperty('textfield-background-color')

		,'background-color'=>$Core->styleProperty('textfield-background-color')
		
	]
);

$Core->selector('.gui.gabarit.tag-select.focus > .options:hover'
	, [

		'overflow-y'=>'auto'
		
	]
);


$Core->selector('.gui.gabarit.tag-select > .options > .option-group-title'
	, [

		'padding' => '8px 16px'

		, 'font-style'=>'italic'

		, 'white-space'=>'nowrap'

		,'overflow'=>'hidden'

		,'text-overflow'=>'hidden'
		
	]
);


$Core->selector('.gui.gabarit.tag-select > .options > .option'
	, [

		'padding' => '8px 16px'

		,'transition' => 'all 150ms ease'
		
	]
);

$Core->selector('.gui.gabarit.tag-select > .options > .option:hover'
	, [

		'color'=>$Core->styleProperty('textfield-font-color')

		, 'background-color'=>$Core->styleProperty('textfield-background-color:hover')
		
	]
);




/* 
	Tag Select FIN =================================================== 
*/







?>